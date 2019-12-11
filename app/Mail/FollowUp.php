<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FollowUp extends Mailable
{
    use Queueable, SerializesModels;

    protected $with;
    protected $title;

    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($with)
    {
        //
        $this->with = $with;
        $this->title = '【Fun-Ride】 フォローしている人がイベントに参加しました';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.followUp')
                    ->subject($this->title)
                    ->with($this->with);
    }
}
