<?php

namespace CodeZero\Mailer;

class Mail
{
    /**
     * To E-mail Address
     *
     * @var string
     */
    private $toEmail;

    /**
     * To Name
     *
     * @var string
     */
    private $toName;

    /**
     * Subject
     *
     * @var string
     */
    private $subject;

    /**
     * View
     *
     * @var string
     */
    private $view;

    /**
     * View Data
     *
     * @var array
     */
    private $data = array();

    /**
     * Mailer Options
     *
     * @var callable
     */
    private $options = null;

    /**
     * Mailer
     *
     * @var Mailer
     */
    private $mailer;

    /**
     * Create a new mailer instance.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Compose an activation mail.
     *
     * @param string $toEmail
     * @param string $toName
     * @param string $subject
     * @param string $view
     * @param array $data
     * @param callable $options
     *
     * @return Mail
     */
    public function compose($toEmail, $toName, $subject, $view, array $data = array(), $options = null)
    {
        $this->toEmail = $toEmail;
        $this->toName = $toName;
        $this->subject = $subject;
        $this->view = $view;
        $this->data = $data;
        $this->options = $options;

        return $this;
    }

    /**
     * Send an e-mail.
     *
     * @return void
     */
    public function send()
    {
        $this->mailer->send($this->toEmail, $this->toName, $this->subject, $this->view, $this->data, $this->options);
    }
}
