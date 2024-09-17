<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\GmailDraft;
use App\Models\websites;
use App\Models\Lead;
use App\Models\Sync;
use App\Models\Message as MSG;
use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;
use Google\Service\Gmail\ModifyMessageRequest;
use Google\Service\Oauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Google\Service\Gmail\WatchRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Illuminate\Http\Response;
use Sinevia\Cms\Models\Page;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Storage;

class GoogleClientController extends Controller
{

    private   $scopes        = [Gmail::MAIL_GOOGLE_COM, Gmail::GMAIL_COMPOSE, Gmail::GMAIL_SEND, Gmail::GMAIL_MODIFY, Gmail::GMAIL_LABELS, Oauth2::USERINFO_PROFILE, Oauth2::USERINFO_EMAIL];
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function getGoogleClient($syncType = 'Gmail')
    {
        $client = new Client();
        $client->setApplicationName('LEAD-REVIVER CRM');
        $client->setScopes($this->scopes); // Add scopes for Oauth2
        $client->setAuthConfig("../storage/client_secret.json");
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $userId    = Auth::user()->id;
        $tokenPath = "email_tokens/$syncType.token_$userId.json";

        // if (! file_exists($tokenPath)) {
        //     return null;
        // }

        // $accessToken = file_get_contents($tokenPath);

        if (!Storage::exists($tokenPath)) {
            return null;
        } else {
            $token = json_decode(Storage::get($tokenPath), true);
            $client->setAccessToken($token);

            return $client;
        }
    }
    public function getSyncState()
    {

        $userId = Auth::user()->id;
        $isSync = count(Sync::where(['user_id' => $userId])->get());

        if ($isSync == 0) {
            return null;
        }

        return true;
    }

    public function gmailWebHook()
    {
        $client = $this->getGoogleClient('Campaign');
        if (is_null($client))
            return redirect()->route('profile.show');

        $service = new Gmail($client);

        $optParams             = [];
        $optParams['labelIds'] = 'INBOX'; // Only show messages in Inbox

        $results     = $service->users_messages->listUsersMessages('me', $optParams);
        $listAddress = array();
        if ($results->getMessages()) {
            foreach ($results->getMessages() as $message) {
                $optParamsGet['format'] = 'full'; // Display message in payload
                $msg                    = $service->users_messages->get('me', $message->getId(), $optParamsGet);

                $fromAddress = '';
                foreach ($msg->getPayload()->getHeaders() as $header) {
                    if ($header->name == 'From') {
                        preg_match('/([^<]*)<([^>]*)>/', $header['value'], $matches);
                        if (count($matches) === 3) {
                            $fromAddress = trim($matches[2]);
                        } else {
                            $fromAddress = trim($header['value']);
                        }
                    }
                }
                $listAddress[] = $fromAddress;
            }
        }

        if (count($listAddress) > 0) {
            $customer = new Customer();
            $customer = $customer->where('email', $listAddress[0]);

            for ($i = 0; $i < count($listAddress); $i++) {
                $customer->orWhere('email', $listAddress[$i]);
            }
            return view('campaign.index', ['leads' => $customer->get()]);
        } else {
            return view('campaign.index', ['leads' => []]);
        }
    }

    public function googleAuthCallback(Request $request)
    {
        $syncType = Session::get('syncType');
        $client   = new Client();
        $client->setApplicationName('LEAD-REVIVER CRM');
        $client->setScopes($this->scopes); // Add scopes for Oauth2
        $client->setAuthConfig("../storage/client_secret.json");
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);

        $user      = Auth::user();
        $tokenPath = "email_tokens/$syncType.token_$user->id.json";
        // file_put_contents($tokenPath, json_encode($accessToken));
        Storage::put($tokenPath, json_encode($accessToken));
        $client->setAccessToken($accessToken);
        // dd($tokenPath, $accessToken);
        // Create the service object for Oauth2
        $oauthService = new Oauth2($client);
        $userInfo     = $oauthService->userinfo->get(); // Get userinfo

        $isSync = count(Sync::where(['user_id' => $user->id, 'type' => $syncType])->get());

        if ($isSync == 0) {
            Sync::create([
                'user_id' => $user->id,
                'mail'    => $userInfo->email,
                'name'    => $userInfo->name,
                'type'    => $syncType,
            ]);
        } else {
            Sync::where(['user_id' => $user->id, 'type' => $syncType])->update([
                'mail' => $userInfo->email,
                'name' => $userInfo->name,
            ]);
        }

        return redirect()->route('profile.show');
    }

    public function showGmailInbox($page)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $service = new Gmail($client);

        $optParams             = [];
        $optParams['labelIds'] = 'INBOX'; // Only show messages in Inbox

        $results     = $service->users_messages->listUsersMessages('me', $optParams);
        $messages    = array();
        $allMessages = $results->getMessages();
        $count       = count($allMessages);
        if ($count) {
            $slice = array_slice($allMessages, ($page - 1) * 10, 10);
            foreach ($slice as $message) {
                $optParamsGet['format'] = 'full'; // Display message in payload
                $msg                    = $service->users_messages->get('me', $message->getId(), $optParamsGet);
                $messages[]             = $msg;
            }
        }

        // // $mail = "";

        return view('gmail.inbox', ['messages' => $messages, 'page' => $page, 'count' => $count]);
    }

    public function showGmailCompose()
    {
        return view('gmail.compose');
    }
    public function showWebsitesCompose()
    {
        $messages = websites::get();

        return view('websites.compose', ['messages' => $messages]);
    }
    public function showWebsitesPublished($published_id)
    {
        // $messages = websites::where('id', $published_id)->where('user_id', Auth::user()->id)->firstOrFail();
        $messages = Page::where('Id', $published_id)->get();

        // $messages = Page::where('id', $published_id)->where('user_id', Auth::user()->id)->get();
        //dd(' $messages---->', $messages);
        // $messages = Page::where('id', $published_id)->where('user_id', Auth::user()->id)->get();       
        //$messages = base64_decode(strtr($messages, '-_', '+/'));
        // dd($messages);
        return view('websites.published', ['messages' => $messages]);

    }

    public function sendWebsitesAction(Request $request)
    {
        // $client = $this->getGoogleClient();
        // if (is_null($client))
        //     return redirect()->route('profile.show');

        // $service = new Gmail($client);

        // $oauthService = new Oauth2($client);
        // $userInfo = $oauthService->userinfo->get(); // Get userinfo
        // $mail_sender = $userInfo->email;
        // $mail_to = $request->input('mail_to');
        // dd(Auth::user()->em);
        $mail_content = $request->input('mail_content');
        $mail_subject = $request->input('mail_subject');
        $mail_type    = $request->input('mail_type');

        // $message = new Message();
        // $rawMessageString = "From: <{$mail_sender}>\r\n";
        // $rawMessageString .= "To: <{$mail_to}>\r\n";
        // $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($mail_subject) . "?=\r\n";
        // $rawMessageString .= "MIME-Version: 1.0\r\n";
        // $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        // $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        // $rawMessageString .= "{$mail_content}\r\n";
        // $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
        // $message->setRaw($rawMessage);
        //   $mail_content = strtr(base64_encode($mail_content), array('+' => '-', '/' => '_'));
        //   dd("$mail_content----->",$mail_content);
        if ($mail_type == 'add') {
            // $service->users_messages->send($mail_sender, $message);
            $draft_id = $request->input('draft_id');
            if ($draft_id != '') {
                // websites::where('id', $draft_id)->delete();
                websites::where('id', $draft_id)->update([
                    'pro_name' => $mail_subject,
                    'content'  => $mail_content,
                    'user_id'  => Auth::user()->id
                ]);
            }
        } else {
            //  dd('user---',Auth::user()->id);
            websites::create([
                'pro_name' => $mail_subject,
                'user_id'  => Auth::user()->id,
                'content'  => $mail_content,

            ]);
        }
        return back();
    }
    public function sendGmailAction(Request $request)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');

        $service = new Gmail($client);

        $oauthService = new Oauth2($client);
        $userInfo     = $oauthService->userinfo->get(); // Get userinfo
        $mail_sender  = $userInfo->email;
        $mail_to      = $request->input('mail_to');
        $mail_content = $request->input('mail_content');
        $mail_subject = $request->input('mail_subject');
        $mail_type    = $request->input('mail_type');

        $message          = new Message();
        $rawMessageString = "From: <{$mail_sender}>\r\n";
        $rawMessageString .= "To: <{$mail_to}>\r\n";
        $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($mail_subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $rawMessageString .= "{$mail_content}\r\n";
        $rawMessage       = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
        $message->setRaw($rawMessage);

        if ($mail_type == 'send') {
            $service->users_messages->send($mail_sender, $message);
            $draft_id = $request->input('draft_id');
            if ($draft_id != '') {
                GmailDraft::where('id', $draft_id)->delete();
            }
        } else {
            GmailDraft::create([
                'to'      => $mail_to,
                'subject' => $mail_subject,
                'content' => $mail_content,
            ]);
        }
        return back();
    }

    public function showGmailDetailInbox($messageId)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        //dd($messageId);
        $service = new Gmail($client);

        $optParamsGet['format'] = 'full'; // Display message in payload
        $message                = $service->users_messages->get('me', $messageId, $optParamsGet);
        // dd($message);
        return view('gmail.detailinbox', ['message' => $message]);
    }

    public function showGmailDetailSent($messageId)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $service = new Gmail($client);

        $optParamsGet['format'] = 'full'; // Display message in payload
        $message                = $service->users_messages->get('me', $messageId, $optParamsGet);

        return view('gmail.detailsent', ['message' => $message]);
    }

    public function deleteGmailAction(Request $request)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $service = new Gmail($client);
        try {
            $cnt = (int) ($request->input('count'));

            for ($i = 0; $i < $cnt; $i++) {
                $service->users_messages->delete('me', $request->input('messageId' . $i));
                break;
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return "success";
    }

    public function archiveGmailAction(Request $request)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $service = new Gmail($client);
        try {
            $cnt = (int) ($request->input('count'));
            for ($i = 0; $i < $cnt; $i++) {
                $messageId = $request->input('messageId' . $i);
                $labels    = new ModifyMessageRequest();
                $labels->setRemoveLabelIds(['INBOX']);
                $service->users_messages->modify('me', $messageId, $labels);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return "success";
    }

    public function showGmailDraft()
    {
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $messages = GmailDraft::get();

        return view('gmail.draft', ['messages' => $messages]);
    }

    public function showGmailDraftItem(Request $request)
    {
        return GmailDraft::where('id', $request->input('id'))->get()[0];
    }

    public function showwebsitesItem(Request $request)
    {
        // dd( $request->input('id'));
        return Page::where('Id', $request->input('id'))->get()[0];
    }

    public function showGmailSent()
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');

        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');

        $service = new Gmail($client);

        $optParams             = [];
        $optParams['labelIds'] = 'SENT'; // Only show messages in Inbox

        $results  = $service->users_messages->listUsersMessages('me', $optParams);
        $messages = array();
        if ($results->getMessages()) {
            foreach ($results->getMessages() as $message) {
                $optParamsGet['format'] = 'full'; // Display message in payload
                $msg                    = $service->users_messages->get('me', $message->getId(), $optParamsGet);
                $messages[]             = $msg;
            }
        }
        return view('gmail.sent', ['messages' => $messages]);
    }

    public function showGmailArchive()
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return redirect()->route('profile.show');
        $syncState = $this->getSyncState();
        if (is_null($syncState))
            return redirect()->route('profile.show')->with('alert', 'UnSynced with Gmail!');
        $service = new Gmail($client);
        // DB::table('messages')->delete();
        $optParams             = [];
        $optParams['labelIds'] = 'IMPORTANT'; // Only show messages in Inbox

        $results  = $service->users_messages->listUsersMessages('me', $optParams);
        $messages = array();
        if ($results->getMessages()) {
            foreach ($results->getMessages() as $message) {
                $optParamsGet['format'] = 'full'; // Display message in payload
                $msg                    = $service->users_messages->get('me', $message->getId(), $optParamsGet);
                $messages[]             = $msg;
            }
        }
        // foreach ($msg->getPayload()->getHeaders() as $header) {
        //     if ($header->name == 'Subject')
        //         $mail = $header->value;
        // }

        // DB::table('messages')->insert([
        //     'name' => json_encode($msg->getId()),
        //     'email' => json_encode($mail),
        //     'message' => json_encode($msg->getSnippet()),
        //     'created_at' => date('Y-m-d H:i:s', $msg->getInternalDate() / 1000),

        // ]);

        return view('gmail.archive', ['messages' => $messages,]);
    }

    public function getAllLeadAction()
    {

        return Lead::where('user_id', Auth::user()->id)->get('signature');
    }
    public function generateCSV()
    {
        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        // Add headers to the CSV file
        $csv->insertOne(['No', 'First Name', 'Last Name', 'Email', 'Mobile Phone', 'Company', 'Area of Interest', 'Lead Source', 'Date']);

        $today_leads = Lead::where('user_id', Auth::user()->id)->whereDate('created_at', today())->get();
        foreach ($today_leads as $index => $today_lead) {
            $csv->insertOne([
                // $today_lead->leadname,
                $index + 1,
                $today_lead->firstname,
                $today_lead->lastname,
                $today_lead->email,
                $today_lead->mobile_phone,
                $today_lead->company,
                $today_lead->area_of_interest,
                // $today_lead->mobile,
                // $today_lead->postcode,
                // $today_lead->salesperson,
                $today_lead->lead_source,
                $today_lead->created_at,
            ]);
        }
        // for ($i = 0; $i < $today_leads_cc; $i++) {
        //     $csv->insertOne(['Data1', 'Data2', 'Data3']);
        // }
        // Add data rows to the CSV file
        // $csv->insertOne(['Data1', 'Data2', 'Data3']);
        // $csv->insertOne(['Data4', 'Data5', 'Data6']);

        // Set the headers
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="today_leads.csv"',
        ];

        // Return the CSV file as a response
        return response($csv->output(), 200, $headers);
    }

    public function getLead($service, $msgId)
    {
        $optParamsGet['format'] = 'full'; // Display message in payload
        $msg                    = $service->users_messages->get('me', $msgId, $optParamsGet);

        $textContent = "";
        $email       = "";
        $company     = "";
        $fullName    = '';
        $payload     = $msg->getPayload();
        $headers     = $payload->getHeaders();
        $parts       = $payload->getParts();
        foreach ($parts as $part) {
            $textContent = base64_decode(strtr($part['body']['data'], '-_', '+/'));
        }
        $textContent = str_replace('\u{FEFF}', '', $textContent);

        $textContent = str_replace(['color: #fff', 'color:#fff', 'color:  #fff', 'color : #fff', 'color :#fff'], 'color: #430d71', $textContent);
        $textContent = str_replace(['text-decoration: underline', 'text-decoration:underline;', 'text-decoration :underline', 'text-decoration : underline'], 'text-decoration: none', $textContent);
        // dd('textContent---------->', $textContent);
        foreach ($headers as $header) {
            if ($header->name == 'From') {
                preg_match('/([^<]*)<([^>]*)>/', $header['value'], $matches);
                if (count($matches) === 3) {
                    $email = trim($matches[2]);
                } else {
                    $email = trim($header['value']);
                }
                $fullName = $matches[1] ?? null;
            }
        }
        $domain = explode('@', $email)[1] ?? null;
        ;
        $company = str_replace(['.com', 'gmail.', '.net', '.org', 'email.'], '', $domain);

        $firstName     = '';
        $fullNameArray = explode(' ', $fullName);
        if (! empty($fullNameArray)) {
            $firstName = reset($fullNameArray);
        }

        // Extract Last Name (assuming the last word in the full name is the last name)
        $lastName = '';
        if (count($fullNameArray) > 1) {
            $lastName = end($fullNameArray);
        }

        $mobile_phone = '';
        $pattern      = '/\b(?:\d{3}[-.]\d{3}[-.]\d{4}|\(\d{3}\) \d{3}-\d{4}|1\.\d{3}\.\d{3}\.\d{4})\b/';

        // Find all mobile_phone numbers matching the pattern in the email message
        preg_match_all($pattern, $textContent, $matches);

        // Extract matched mobile_phone numbers
        if (! empty($matches[0])) {
            $mobile_phone = $matches[0];
        }

        $telephone = '';

        $pattern = '/\b\d{3}-\d{3}-\d{4}\b/';

        // Find the phone number matching the pattern in the text
        preg_match($pattern, $textContent, $matches);

        // Extract the matched phone number
        if (! empty($matches)) {
            $telephone = $matches[0];
        }

        $postcode = '';
        $pattern  = '/[A-Z]{2}\s\d{5}-\d{4}/';
        preg_match($pattern, $textContent, $matches);

        if (! empty($matches)) {
            $postcode = $matches[0];
        }
        if ($postcode == '') {

            $pattern = '/[A-Z]{2}\s\d{5}/';
            preg_match($pattern, $textContent, $matches);
            if (! empty($matches)) {
                $postcode = $matches[0];

            }
        }

        $areaOfInterest = $this->openAIService->extractAreaOfInterest($textContent);

        return [
            'req'              => $textContent,
            'firstname'        => $firstName,
            'lastname'         => $lastName,
            'email'            => $email,
            'mobile_phone'     => $mobile_phone,
            'company'          => $company,
            'postcode'         => $postcode,
            'telephone'        => $telephone,
            'area_of_interest' => $areaOfInterest,
        ];
    }

    public function getRecommendAction(Request $request)
    {
        $client = $this->getGoogleClient();
        if (is_null($client))
            return "gmail_not_connected";

        $service = new Gmail($client);
        $msgId   = $request->input("messageId");

        $lead = $this->getLead($service, $msgId);

        return response()->json($lead);
    }

    public function getLeads($page)
    {
        $client = $this->getGoogleClient();
        if (is_null($client)) {
            $res = [
                "status" => "error",
                "msg"    => "Gmail not connected",
            ];
            return response()->json($res);
        }

        $syncState = $this->getSyncState();
        if (is_null($syncState)) {
            $res = [
                "status" => "error",
                "msg"    => "UnSynced with Gmail!",
            ];
            return response()->json($res);
        }
        $service = new Gmail($client);

        $optParams             = [];
        $optParams['labelIds'] = 'INBOX'; // Only show messages in Inbox

        $results     = $service->users_messages->listUsersMessages('me', $optParams);
        $leads       = array();
        $allMessages = $results->getMessages();
        $count       = count($allMessages);
        if ($count <= ($page - 1) * 10) {
            $res = [
                "status" => "error",
                "msg"    => "Lack of leads",
            ];
            return response()->json($res);
        }

        $slice = array_slice($allMessages, ($page - 1) * 10, 10);
        foreach ($slice as $message) {
            $lead    = $this->getLead($service, $message->getId());
            $leads[] = $lead;
        }

        $res = [
            "status" => 'success',
            "leads"  => $leads,
        ];

        return response()->json($res);
    }
}
