<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 11/30/2015
 * Time: 1:50 AM
 */

namespace Itway\MailComposers;
use CodeZero\Mailer\MailComposer;


class TeamWasCreatedMailComposer extends  MailComposer
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
        $subject = 'Your team created!';
        $view = 'emails.team-created';
        $data = ['name' => $firstname, 'title'=> $title, 'link' => $link];
        $options = null;

        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
    }

}