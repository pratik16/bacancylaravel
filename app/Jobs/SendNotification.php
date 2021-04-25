<?php

namespace App\Jobs;

use App\Mail\ContactMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $notification_type;
    public $objData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $objData)
    {
        $this->notification_type = $type;
        $this->objData = $objData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notification_type = $this->notification_type;
        $objData = $this->objData;

        switch ($notification_type) {
            case 'email':
                \Log::info('notification send');
                $message = "Hi";
                $users = array();
                foreach ($objData as $user) {
                    //$users[] = $user['email'];
                    $email = $user['email'];
                    $name = $user['name'];
                    Mail::to($email)->send(new ContactMailable($name));
                }
                //Mail::to($users)->send(new ContactMailable($message));
                //dd( Mail:: failures());
                break;
            default:
                \Log::info('No notification send!');
        }
    }
}
