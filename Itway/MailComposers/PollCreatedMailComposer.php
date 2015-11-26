<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/29/2015
 * Time: 6:49 PM
 */

namespace Itway\MailComposers;

use CodeZero\Mailer\MailComposer;


class QuizCreatedMailComposer extends  MailComposer
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
        $subject = 'Your quiz created!';
        $view = 'emails.quiz-created';
        $data = ['name' => $firstname, 'title'=> $title, 'link' => $link];
        $options = null;

        return $this->getMail($toEmail, $toName, $subject, $view, $data, $options);
    }

}