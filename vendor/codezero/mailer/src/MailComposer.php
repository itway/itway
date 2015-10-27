<?php

namespace CodeZero\Mailer;

abstract class MailComposer
{
    /**
     * Mail
     *
     * @var Mail
     */
    private $mail;

    /**
     * Create a new mail instance.
     *
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Compose an e-mail.
     *
     * @param string $toEmail
     * @param string $toName
     * @param string $subject
     * @param string $view
     * @param array $data
     * @param callable $options
     *
     * @return \CodeZero\Mailer\Mail
     */
    protected function getMail($toEmail, $toName, $subject, $view, array $data = array(), $options = null)
    {
        return $this->mail->compose($toEmail, $toName, $subject, $view, $data, $options);
    }
}
