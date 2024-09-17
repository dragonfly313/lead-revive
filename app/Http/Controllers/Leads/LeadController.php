<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showInbox()
    {
        return view('leads.inbox', ['leads' => Lead::get()]);
    }

    public function createAction(Request $request)
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
          //  'requirement' => $mailContent,
            'salesperson' => $user->name,
            'leadsource' => 'Gmail',
            'signature' => $messageId,
            'user_id' => $user->id,
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
          //  'requirement' => $mailContent,
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
         //   'requirement' => $mailContent,
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
}
