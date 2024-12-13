<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;

class ApplicationUpdated extends Mailable
{
    use SerializesModels;

    public $application;

    /**
     * Create a new message instance.
     *
     * @param Application $application
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('มีงานประชุมวิชาการที่ท่านต้องพิจารณา')
            ->view('emails.application.updated');
    }
}
