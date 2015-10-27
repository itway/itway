<?php

namespace App;

use CodeZero\Mailer\MailComposer;

class ExampleMailComposer extends MailComposer
{
    /**
     * Compose a welcome mail. (example)
     *
     * @param string $email
     * @param string $firstname
     *
     * @return \CodeZero\Mailer\Mail
     */
    public function compose($email, $firstname)
    {
        $toEmail = $email;
        $toName = $firstname;
        $subject = 'Welcome!';
        $view = 'emails.welcome';
        $data = [
            'name' => $firstname
        ];

        return $this->getMail($toEmail, $toName, $subject, $view, $data);
    }
}
