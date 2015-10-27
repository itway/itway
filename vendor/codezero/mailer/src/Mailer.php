<?php

namespace CodeZero\Mailer;

interface Mailer
{
    /**
     * Send an e-mail
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
    public function send($toEmail, $toName, $subject, $view, array $data = array(), $options = null);
}
