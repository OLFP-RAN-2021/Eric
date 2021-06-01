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
    <form action="#" class="border-radius">
        <div class="flex">
            <label for="emailSender">Email émetteur</label>
            <input type="email" name="emailSender" id="emailSender" placeholder="votre.email@mail.fr" class="border-radius">
        </div>
        <div class="flex">
            <label for="emailDest">Email destinataire</label>
            <input type="email" name="emailDest" id="emailDest" placeholder="son.email@mail.fr" class="border-radius">
        </div>
        <div id="drop-zone">
            <!-- <input type="file" name="files" id="files"> -->
        </div>
        <button id="btnSend" class="border-radius">Envoyer</button>
    </form>
</body>

</html>