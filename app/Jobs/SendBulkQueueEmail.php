<?php

namespace App\Jobs;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBulkQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail_info;
    public $timeout = 7200; // 2 hours

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail_info)
    {
        $this->mail_info = $mail_info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emails = Str::of($this->mail_info['email'])->explode(',');
        // $emails = ['admin@email.com', 'hello@email.com'];
        $input['subject'] = $this->mail_info['subject'];

        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $input['email'] = $email;
                Mail::send('email_template.bulk', ['content' => $this->mail_info['content']], function ($message) use ($input) {
                    $message->to($input['email'])->subject($input['subject']);
                });
            } 
        }
    }
}
