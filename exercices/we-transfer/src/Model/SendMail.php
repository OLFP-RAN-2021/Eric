<?php

namespace App\Model;

class MyMail
{

    private string $emailSenderName = "eric.vercheval@hotmail.fr";
    private string $emailPsw = "427e44f18d6673";

    private string $emailDestinationName = "45bc6e824d-f6c6a3@inbox.mailtrap.io";

    private string $emailHost = 'smtp.mailtrap.io';
    private int $emailPort = 2525;
    private string $emailEncryption = 'tls';

    private string $emailBody = '<html>' .
        '  <body>' .
        '<p>Mon message, mes fichiers : </p>' .
        '</body>' .
        '</htm>';

    public function getSenderName()
    {
        return $this->emailSenderName;
    }
    public function setSenderName(string $emailSenderName)
    {
        // TODO : verifier adresse mail
        $this->emailSenderName = $emailSenderName;
    }

    function sendEmail()
    {

        $transport = (new \Swift_SmtpTransport('smtp.mailtrap.io', 2525))
            ->setUsername('655a4cb4030dd9') // generated by Mailtrap
            ->setPassword('427e44f18d6673') // generated by Mailtrap
        ;
        $mailer = new \Swift_Mailer($transport);


        // Create a message
        $message = (new \Swift_Message())
            ->setSubject('Partage de fichiers')
            ->setFrom([$this->emailSenderName])
            // ->setTo([$this->emailAddress, 'other@domain.org' => 'A name'])
            ->setTo([$this->emailDestinationName])
            ->setBody($this->emailBody, 'text/html');

        // Send the message
        try {
            $result = $mailer->send($message);
            echo "message envoyé";
        } catch (\Throwable $e) {
            echo "erreur envoi message";
            dump($e);
        }
    }
}
