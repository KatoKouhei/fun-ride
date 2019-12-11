<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupUp extends Mailable
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
        $this->title = '【Fun-Ride】 参加グループがイベントを公開しました';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('emails.groupUp')
                    ->subject($this->title)
                    ->with($this->with);
    }
}
