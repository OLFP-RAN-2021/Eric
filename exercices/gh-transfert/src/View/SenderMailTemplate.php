<?php

namespace App\View;


class SenderMailTemplate
{

    private array $params = [];

    public function addParams(string $key, string $value)
    {
        $this->params[$key] = $value;
    }

    function render()
    {
        print_r($this->params);
        $message = $this?->params['message'];
        $directory = str_contains($_SERVER['SERVER_NAME'], 'localhost') ? 'http' : 'https';
        $directory .= ":\\" . $_SERVER['HTTP_HOST'] . "/upload/" . $this?->params['directory'];

        $html = <<<HTML
    <html>
    <body>
        Mon message :
        <p>$message</p>
        <a href='$directory' >Charger les fichiers</a>
    </body>
    </html>
HTML;

        return  $html;
    }
}
