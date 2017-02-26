<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientSendMail;

class MailController extends Controller
{

    public function sendMail(Request $request){

        return $this->sendMailRequest($request);
        
    }

    public function sendRequestQuotationMail(Request $request){

        return $this->sendMailRequest($request);
    }

    private function sendMailRequest(Request $request){

        if($request->ajax()){
            return response()->json([
                        'message'=>'sent'
                ]);
        }
        else{
               try{
                    Mail::to($request->company_email)
                        ->cc($request->email)
                        ->queue(new ClientSendMail($request->all()));
                        return back()->with('message','Email Sent');
               }
               catch(Exception $e){
                   dd($e);
               }
        }
    }
}
