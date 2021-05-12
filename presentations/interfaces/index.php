<?php

interface Chanteur {
    // ERREUR : pas de propriété possible
    // public string $typeDeChant = "cui cui";
    // POSSIBLE : une constante
    const TYPE_DE_CHANT = "cui cui"; 
    public function chanter();
}

interface Volant {
    public function decoller();
    public function voler();
    public function atterrir();
}

interface ChanteurVolant extends Chanteur, Volant
{

}

class Animal
{

}

class Oiseau extends Animal implements Chanteur, Volant
{
    public function chanter(){
        echo "je chante : la la la<br>";
        echo Oiseau::TYPE_DE_CHANT."<br>";
    }
    public function decoller(){
        echo "Je décolle<br>";
    }
    public function voler(){
        echo "Je vole<br>";
    }
    public function atterrir(){
        echo "J'atterri<br>";
    }
}
 class Scene {
     public function monterSur(Chanteur $chanteur): void
     {
        $this->chanteur= $chanteur;
     }
 }

$rossignol = new Oiseau();
$rossignol->chanter();

$scene = new Scene();

$scene->monterSur($rossignol);

// $manchot = new OiseauChanteur();
// $cigogne = new OiseauVolant();













