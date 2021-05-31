<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nouveautés PHP 8</title>
  <style>
    body {
      font-size: 1.5rem;
    }

    button {
      font-size: inherit;
      padding: 1em;
    }
  </style>
</head>

<body>

  <?php

  $data = [
    [
      'link' => "namedArgument",
      'text' => "Named argument"
    ],
    [
      'link' => "constructor",
      'text' => "Constructor property promotion"
    ],
    [
      'link' => "unionTypes",
      'text' => "Union types"
    ],
    [
      'link' => "matchExpression",
      'text' => "Match expression"
    ],
    [
      'link' => "nullSafe",
      'text' => "null safe operator"
    ],
    [
      'link' => "attributes",
      'text' => "Attributes"
    ]
  ];

  foreach ($data as $value) {
    echo "<button><a href='{$value['link']}.php'>{$value['text']}</a></button>";
  }

  ?>

</body>

</html>