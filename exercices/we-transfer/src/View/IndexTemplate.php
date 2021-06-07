<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Transfert</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js" type="module"></script>
</head>

<body>
    <noscript>
        Vous devez disposer d'un navigateur compatible avec JavaScript.
    </noscript>
    <form name="myForm" id="#myForm" action="reception.php" method="post" class="border-radius" enctype="multipart/form-data">
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
            <input type="file" name="files[]" id="files" multiple>
        </div>
        <input id="btnSend" type="submit" value="Envoyer" class="border-radius">
        <!-- <button >Envoyer</button> -->
    </form>
</body>

</html>