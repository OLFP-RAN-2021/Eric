<?php

function testSwitch(int $camera): string
{
  switch ($camera) {
    case 1:
      $result = "photo";
      break;
    case 2:
      $result = "vidéo";
      break;

    default:
      throw new Exception("Erreur : appareil non défini");
      break;
  }
  return "appareil " . $result;
}

function testMatch(int $camera): string
{
  return "appareil " . match ($camera) {
    1 => "photo",
    2 => "vidéo",
    default => throw new Exception("Erreur : appareil non défini"),
  };
}

echo "<br>Switch : " . testSwitch(1);
echo "<br>Match : " . testMatch(1);
