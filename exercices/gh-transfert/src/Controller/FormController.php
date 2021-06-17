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
    public function validate(): Response
    {
        $files = [];
        $directoryTmp = "";
        $response = new JsonResponse();
        $responseArray = [];
        $filesUtilities = new FileUtilities();
        $mail = new EMail();
        $maxSize = 1024 * 3;

        $dir =  uniqid('rep');
        if (!empty($_POST)) {

            $files = $filesUtilities->filesReorder('files');
            // $nbFiles =  count($files);
            $check = $filesUtilities->filesChecker($files);
            if ($check['error'] == 0 && $check['size'] < $maxSize) {
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
                    $responseArray = array_merge($responseArray, ['email' => "erreur envoi message"]);
                }
                $responseArray = array_merge(
                    $responseArray,
                    ['directory' => $directoryTmp]
                );
            } else {
                $responseArray = array_merge($responseArray, [
                    'errorSize' => 1,
                    'maxSize' => $maxSize,
                    'email' => "message non envoyé"
                ]);
            }
        }

        $responseArray = array_merge($responseArray, $check);

        return $response->setData($responseArray);
    }
}
