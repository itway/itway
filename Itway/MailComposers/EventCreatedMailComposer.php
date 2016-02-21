<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 2/20/2016
 * Time: 11:59 PM
 */

namespace Itway\MailComposers;

use CodeZero\Mailer\MailComposer;


class EventCreatedMailComposer extends MailComposer
{

    /**
     * @param $email
     * @param $firstname
     * @param $title
     * @param $link
     * @return \CodeZero\Mailer\Mail
     */
    public function compose($email, $firstname, $title, $link)
    {
        $toEmail = $email;
        $toName = $firstname;
        $subject = 'Your event created!';
        $view = 'emails.event-created';
        $data = ['name' => $firstname, 'title'=> $title, 'link' => $link];
        $options = null;

        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
    }
}