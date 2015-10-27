<?php

namespace CodeZero\Mailer;

use Illuminate\Contracts\Mail\MailQueue;
use Illuminate\Mail\Message;

class LaravelMailer implements Mailer
{
    /**
     * Laravel Mail Queue
     *
     * @var MailQueue
     */
    private $mail;

    /**
     * Create a new instance of LaravelMailer.
     *
     * @param MailQueue $mail
     */
    public function __construct(MailQueue $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Send an e-mail.
     *
     * @param string $toEmail
     * @param string $toName
     * @param string $subject
     * @param string $view
     * @param array $data
     * @param callable $options
     *
     * @return void
     */
    public function send($toEmail, $toName, $subject, $view, array $data = array(), $options = null)
    {
        $this->mail->queue($view, $data, function (Message $message) use ($toEmail, $toName, $subject, $options) {

            $message->to($toEmail, $toName)
                    ->subject($subject);

            // Allow the caller to run additional functions
            // on the $msg SwiftMailer object (cc, bcc, attach, ...)
            if ($options && is_callable($options)) {
                call_user_func($options, $message);
            }
        });
    }
}
