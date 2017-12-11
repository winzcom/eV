<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Entities\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailToUsersWithoutPassword;

class SendDailyMailToThoseWithoutPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'smttwp:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to those without password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $users_without_passwords = User::where([
            ['password','!=',''],
            ['bounced','=',0]
        ])->orWhere(function($query) {
            $query->where('password',null)
                  ->where('bounced',0);
        })->get();
        if( $users_without_passwords->isNotEmpty() ) {
            $users_without_passwords->each(function($user) {
                Mail::to($user)->send(new MailToUsersWithoutPassword($user));
            });
        }

        try {
            $first = $users_without_passwords->first();
            $dummy_user = $first->newInstance([
                'email' => 'ebun68@gmail.com',
                'name' => 'Testing if cron job is running'
            ]);
            Mail::to($dummy_user)->send(new MailToUsersWithoutPassword($dummy_user));
        } catch(\Exception $e) {
            //
        }
       
        // $user = User::where([
        //     ['email','=','reangulara@gmail.com'],
        //     ['bounced','=',0]
        // ])->first();
        // Mail::to($user)->send(new MailToUsersWithoutPassword($user));
    }
}
