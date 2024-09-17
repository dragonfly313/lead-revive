<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Gmail;
use Google\Service\Oauth2;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Sync;
use App\Models\Company;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function showProfilePage()
    {
        $companies = Company::get();
        error_log('--------$authUrl----------------');
        return view('admin.profile', ['companies' => $companies]);
        
    }

    public function profileUpdateApi(Request $request)
    {
        // $name = $request->input('name');
        // $email = $request->input('email');
        // $role = $request->input('role');

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $mobile = $request->input('mobile');

        if (!$request->hasFile('avatar')) {
            User::where('id', $request->user()->id)->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
            ]);
        } else {
            $user = Auth::user();
            $avatar = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '.' . $avatar->getClientOriginalExtension();

            $avatar->storeAs('avatars', $filename, 'public');
            User::where('id', $request->user()->id)->update([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
                'avatar' => $filename,
            ]);
        }

        return redirect()->route('profilePage');
    }

    public function setLinkCompanyApi(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
            'company_id' => $request->input('company_id')
        ]);

        return "success";
    }
    public function setGmailSync($type)
    {
        Session::put("syncType", $type);

        // Load the client configuration file
        $client = new Client();
        $client->setApplicationName("LEAD-REVIVER CRM");
        $client->setScopes([Gmail::GMAIL_READONLY, Gmail::GMAIL_COMPOSE, Oauth2::USERINFO_PROFILE, Oauth2::USERINFO_EMAIL]); // Add scopes for Oauth2
        $client->setAuthConfig(storage_path("client_secret.json")); ///////jjj
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        // $client->setRedirectUri(env('APP_URL') . '/login/google/callback');
        new Oauth2($client);
        $authUrl = $client->createAuthUrl();
        // error_log($authUrl);
        return redirect($authUrl);
    }

    public function setGmailUnSync(Request $request)
    {
        Sync::where('user_id', Auth::user()->id)->delete();

        return redirect()->route('profile.show');
    }
}
