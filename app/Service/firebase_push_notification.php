<?php

namespace App\Service;

use  App\Interfaces\PushNotificationInterface as PI;
use  GuzzleHttp\Client;

class FirebasePushNotification implements PI{

    public function  __construct(){

    }

    public function pushMessage($endpoint,$vendor,$category){

            try{
                    $client = new Client();
                    $response = $client->request('POST','https://fcm.googleapis.com/fcm/send',[
                    'headers'=>[
                        'Authorization'=>
                        'key=AAAACibIqQw:APA91bEb38fU50M73-j9BFTsRKAGsBQoEbc4sLKvu8F59FnVNZ0nBLVNYSLHNCNX_FZhNqrNmwx7HWPbOrsW4AVmk0PH1Uq9Qz3lB9_oellbdUVY7_iJBsl2mupTvZ-c5C5MjesF_gyVMQ0JkBasa39FD3lT9aJd-Q',
                        'Content-Type'=>'application/json'

                    ],
                    'json'=>[
                        'to'=>$endpoint,
                        'data'=>[
                            
                                'title'=> 'New Quote',
                                'body'=>'A new Quotes from '.$vendor->name.' For '.$category.' Has Been Sent to Your Inbox',
                                'click_action'=>'https://eventpad.ng/culogin'
                            
                        ],
                        'notification'=>[
                            'title'=>'New Quote for '.$category,
                            'body'=>$vendor->name.' as replied with a quote',
                            'click_action'=>'https://eventpad.ng/culogin'                ]
                    ]
                ]); 
            }catch(\Exception $e){
                
            }   
    }
}

?>