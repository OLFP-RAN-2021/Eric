<?php

namespace App\View;

class HomeTemplate
{
    function render()
    {
        $html = <<<HTML
    <body>
        <noscript>
            Vous devez disposer d'un navigateur compatible avec JavaScript.
        </noscript>
        <form name="myForm" id="myForm" action="/" method="post" class="border-radius" enctype="multipart/form-data">
            <div class="flex">
                <label for="emailSender">Email émetteur :</label>
                <input type="email" name="emailSender" id="emailSender" placeholder="votre.email@mail.fr" class="input border-radius">
            </div>
            <div class="flex">
                <label for="emailDest">Email destinataire :</label>
                <input type="email" name="emailDest" id="emailDest" placeholder="son.email@mail.fr" class="input border-radius">
            </div>
            <div class="flex">
                <label for="message">Message :</label>
                <input type="text" name="message" id="message" placeholder="votre message" class="input border-radius">
            </div>
            <div id="drop-zone" class="flex flex-center">
                <label for="files">Glissez vos fichiers</label>
                <input type="file" name="files[]" id="files"  multiple>
                <!-- <input type="file" name="directories[]" id="directory" webkitdirectory  directory  multiple> -->
            </div>
            <!-- <button id="btnSend" type="submit" class="border-radius">Envoyer</button> -->
            <input id="btnSend" type="submit" value="Envoyer" class="border-radius">
            <!-- <button >Envoyer</button> -->
        </form>
    </body>
    
    </html>
    HTML;

        $header = new HeaderTemplate();

        return $header->render() . $html;
    }
}
