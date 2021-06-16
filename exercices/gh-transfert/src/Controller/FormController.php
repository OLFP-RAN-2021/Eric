<?php

namespace App\Controller;

use App\Model\EMail;
use App\Model\FileUtilities;
use App\View\HomeTemplate;
use App\View\SenderMailTemplate;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class FormController extends AbstractController
{

    #[Route('/form', name: 'Form')]
    public function validate()
    {
        $files = [];
        $directoryTmp = "";
        $response = new Response();
        $content = "";
        $filesUtilities = new FileUtilities();
        $mail = new EMail();


        $dir =  uniqid('rep');
        if (!empty($_POST)) {

            $files = $filesUtilities->filesReorder('files');
            $nbFiles =  count($files);
            $directoryTmp = $filesUtilities->createDirectory($dir);
            $filesUtilities->saveFiles($directoryTmp, $files);

            $mailTemplate = new SenderMailTemplate();
            $mailTemplate->addParams('message', $_POST['message']);
            $mailTemplate->addParams('directory', $directoryTmp);
            $mail->setEmailBody($mailTemplate->render());

            $mail->setSenderName($_POST['emailSender']);
            $mail->setDestinationName($_POST['emailDest']);
            $mail->setSenderMessage($_POST['message']);


            if ($mail->sendEmail() === 0) {
                $content .= "message non envoyé";
            }
            $content .= "{$nbFiles},{$directoryTmp}";
        }
        $response->setContent($content);
        return $response;

        // $data = "test ReceptionController";
        // $headers = [];
        // $status = 200;
        // $response = new JsonResponse($data, $status, $headers);
        // return $response;
    }
}
