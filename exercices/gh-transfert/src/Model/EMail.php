<?php

namespace App\Model;

class EMail
{

    private string $emailSenderName = "eric.vercheval@hotmail.fr";
    private string $emailDestinationName = "test.test@gmail.com";

    private string $emailBody;

    public function setEmailBody(string $emailBody)
    {
        $this->emailBody = $emailBody;
    }
    public function getSenderName()
    {
        return $this->emailSenderName;
    }
    public function setSenderName(string $emailSenderName)
    {
        // TODO : verifier adresse mail
        $this->emailSenderName = $emailSenderName;
    }

    public function setSenderMessage(string $senderMessage)
    {
        $this->senderMessage = $senderMessage;
    }

    public function getDestinationName()
    {
        return $this->emailDestinationName;
    }
    public function setDestinationName(string $emailDestinationName)
    {
        // TODO : verifier adresse mail
        $this->emailDestinationName = $emailDestinationName;
    }

    function sendEmail(): int
    {

        $transport = (new \Swift_SmtpTransport(
            EMailConst::$EMAIL_HOST,
            EMailConst::$EMAIL_PORT,
            EMailConst::$EMAIL_ENCRYPTION
        ))
            ->setUsername(EMailConst::$EMAIL_USERNAME)
            ->setPassword(EMailConst::$EMAIL_PSW);

        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message())
            ->setSubject('Partage de fichiers')
            ->setFrom([$this->emailSenderName])
            // ->setTo([$this->emailAddress, 'other@domain.org' => 'A name'])
            ->setTo([$this->emailDestinationName])
            ->setBody($this->emailBody, 'text/html');

        // Send the message
        return $mailer->send($message);
    }
}
