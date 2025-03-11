<?php

namespace App\Mail;

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TagStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $tagId;
    public $status;

    public function __construct($name, $tagId, $status)
    {
        $this->name = $name;
        $this->tagId = $tagId;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject("Tag {$this->status} Successfully")
                    ->view('emails.tagStatus');
    }
}

