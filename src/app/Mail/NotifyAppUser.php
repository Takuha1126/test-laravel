<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyAppUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
public $messageContent;


    public function __construct($user, $messageContent)
{
    $this->user = $user;
    $this->messageContent = $messageContent;
}

    public function build()
{
    return $this->view('admin.mail.email')
                ->with([
                    'user' => $this->user,
                    'messageContent' => $this->messageContent,
                ])
                ->subject('お知らせメール');
}

}