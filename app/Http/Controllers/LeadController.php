<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\GmailDraft;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $messages = GmailDraft::paginate(10);
        //  dd($messages);
        return view('leads.show', ['messages' => $messages, 'user' => Auth::user()]);
    }
    public function showInbox()
    {
        $today_leads = Lead::where('user_id', Auth::user()->id)->whereDate('created_at', today())->get();
        return view('leads.inbox', ['leads' => $today_leads]);
    }
    public function createAction(Request $request)
    {
        // $leadname = $request->input('leadname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $mobile_phone = $request->input('mobile_phone');
        $company = $request->input('company');
        $area_of_interest = $request->input('area_of_interest');
        // $tel = $request->input('tel');
        // $postcode = $request->input('postcode');
        // $mailContent = $request->input('mailContent');
        // $messageId = $request->input('messageId');

        $user = Auth::user();

        Lead::create([
            // 'leadname' => $leadname,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'mobile_phone' => $mobile_phone,
            'company' => $company,
            'area_of_interest' => $area_of_interest,
            'lead_source' => 'Gmail',
            'user_id' => $user->id,
            // 'phone' => $tel,
            // 'postcode' => $postcode,
            // 'requirement' => $mailContent,
            // 'salesperson' => $user->name,
            // 'signature' => $messageId,
        ]);

        return "success";
    }

    public function createViaWF(Request $request)
    {
        $leadname = $request->input('leadname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $company = $request->input('company');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $mobile = $request->input('mobile');
        $postcode = $request->input('postcode');
        $mailContent = $request->input('mailContent');
        $messageId = $request->input('messageId');

        $user = Auth::user();

        Lead::create([
            'leadname' => $leadname,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'company' => $company,
            'email' => $email,
            'phone' => $tel,
            'mobile' => $mobile,
            'postcode' => $postcode,
            //    'requirement' => $mailContent,
            'salesperson' => $user->name,
            'leadsource' => 'WebForm',
            'signature' => $messageId,
            'user_id' => $user->id,
        ]);
        return "success";
    }

    public function createViaCN(Request $request)
    {
        $leadname = $request->input('leadname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $company = $request->input('company');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $mobile = $request->input('mobile');
        $postcode = $request->input('postcode');
        $mailContent = $request->input('mailContent');
        $messageId = $request->input('messageId');

        $user = Auth::user();

        Lead::create([
            'leadname' => $leadname,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'company' => $company,
            'email' => $email,
            'phone' => $tel,
            'mobile' => $mobile,
            'postcode' => $postcode,
            //    'requirement' => $mailContent,
            'salesperson' => $user->name,
            'leadsource' => 'Campaign',
            'signature' => $messageId,
            'user_id' => $user->id,
        ]);
        return "success";
    }

    public function createViaTawk(Request $request)
    {
        $leadname = $request->input('leadname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $company = $request->input('company');
        $email = $request->input('email');
        $tel = $request->input('tel');
        $mobile = $request->input('mobile');
        $postcode = $request->input('postcode');
        // $mailContent = $request->input('mailContent');
        // $messageId = $request->input('messageId');

        $user = Auth::user();

        Lead::create([
            'leadname' => $leadname,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'company' => $company,
            'email' => $email,
            'phone' => $tel,
            'mobile' => $mobile,
            'postcode' => $postcode,
            // 'requirement' => $mailContent,
            'salesperson' => $user->name,
            'leadsource' => 'Gmail',
            'signature' => $email,
            'user_id' => $user->id,
        ]);
        return "success";
    }

    public function action()
    {
        return view('leads.action-engine');
    }
}
