<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TripTrackTagScannedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userTag;
    public $latitude;
    public $longitude;
    public $mapPath;

    public function __construct($userTag, $latitude = null, $longitude = null, $mapPath = null)
    {
        $this->userTag = $userTag;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->mapPath = $mapPath;
    }

    public function build()
    {
        $email = $this->subject('TripTrack Alert: Your Tag Was Scanned')
                      ->view('emails.triptrack_tag_scanned');

        if ($this->mapPath) {
            $email->attach($this->mapPath, [
                'as' => 'location-map.png',
                'mime' => 'image/png',
            ]);
        }

        return $email;
    }
}
