<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $system;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user     = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Infinity Clubcards')
                    ->to($this->user->email, $this->user->name)
                    ->subject('Account Created Successfully')
                    ->replyTo(env('MAIL_FROM_ADDRESS'))
                    ->markdown('email.user-registered')
                    ->with([
                        'user'  => $this->user,
                        'system'=> $this->system,
                    ]);
    }
}
