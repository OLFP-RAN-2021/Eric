# Les évènements 

## Définition

- Les évènements sont déclenchés par une action sur un document.
    
    - Le chargement du document.
    - Le survol d'un élément.
    - Le click sur un bouton.
    - La soumission d'un formulaire.
    - Le début ou la fin d'une animation.
    - Un glisser/déposer.
    - etc.  

- Ces actions seront interceptées par du code écrit en `JavaScript`.

- Il existe plus d'une centaine d'évènements en `JS` (MDN: [Référence des événements](https://developer.mozilla.org/fr/docs/Web/Events))

<br>

---

<br>

## Création d'un gestionnaire d'évènement

Il existe 3 façons d'implémenter des évènements :

- 2.1 Les attributs `HTML` (non recommandé).
- 2.2 Les propriétés `JS`.
- 2.3 La méthode `addEventListener()` (recommandé). 

<br>
<br>

## Evènements dans les attributs `HTML`

La méthode la plus ancienne et qui ne devrait plus être utilisé.

Il s'agit d'insérer un attribut `HTML` dans la balise ouvrante d'un élément.

Ces attributs `HTML` de type évènements possèdent le plus souvent le nom de l'évènement précédé de "**on**" :

- **onload** :      chargement,
- **onsubmit** :    soumission formulaire,
- **onclick** :     click sur élément,
- **onmouseover** : passage de la souris,
- **onblur** :      perte de focus,
- **onkeydown** :   etc.

Référence : [MDN GlobalEventHandlers](https://developer.mozilla.org/fr/docs/Web/API/GlobalEventHandlers)

Exemple :

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dans attributs HTML</title>
    </head>
    <body>
        <h1>Attribut "HTML"</h1>
        <p>Un paragraphe</p>

        <button onclick="alert('Bouton cliqué')">Cliquez moi !</button>
        <div>
            <p onmouseover="this.style.background='yellow'" onmouseout="this.style.background='transparent'">Un paragraphe dans une div.</p>

            <button onclick="console.log('click d\'un bouton dans une div')">Un bouton dans une div</button>
        </div>
    </body>
</html>
```

<br>
<br>

## Evènements dans les propriétés JS.

Cette méthode consiste à utiliser une propriété d'un élément.

- Chaque évènement est représenté en ``JavaScript`` par un objet basé sur l’interface ``Event``.

- L’interface ``Event`` est l’interface de base commune pour tout évènement qui se produit dans le ``DOM``.

Référence : [MDN Building_blocks/Events](https://developer.mozilla.org/fr/docs/Learn/JavaScript/Building_blocks/Events)

Exemple :

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dans les propriétés JS</title>
    </head>
    <body>
        <h1>Propriétés JavaScript</h1>
        <p>Un paragraphe</p>
        <button id="boutonAlert">Cliquez moi !</button>
        <div>
            <p id="paragraphe" >Un paragraphe dans une div.</p>
            <button id="boutonConsole" >Un bouton dans une div</button>
        </div>
        <script>
            // On selectionne les éléments
            const boutonAlert = document.querySelector("#boutonAlert")
            const boutonConsole = document.querySelector("#boutonConsole")
            const paragraphe = document.querySelector("#paragraphe")

            // les fonctions
            boutonAlert.onclick = function() {
                alert('Bouton cliqué')
            }
            
            paragraphe.onmouseover= function() {
                this.style.background='yellow'
            }
            paragraphe.onmouseout= function() {
                this.style.background='transparent'
            }

            function logConsole () {
                console.log("click d'un bouton dans une div") 
            }
            boutonConsole.onclick = logConsole

        </script>
    </body>
</html>
```

<br>
<br>

## Evènements dans la méthode ``addEventListener()``

Cette méthode consiste à attacher/écouter un évènement sur un élément.

- `addEventListener` ajoute une fonction à la liste des gestionnaires d'évènements pour le type d'évènement spécifié.
- Les cibles peuvent être `Window`, `Document` et bien sur `Element`.

Référence : [MDN addEventListener](https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener)

Exemple :

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><address>EventListener</address></title>
    </head>
    <body>
        <h1>addEventListener</h1>
        <p>Un paragraphe</p>
        <button id="boutonAlert">Cliquez moi !</button>
        <div>
            <p id="paragraphe" >Un paragraphe dans une div.</p>
            <button id="boutonConsole" >Un bouton dans une div</button>
        </div>
        <script>
            // On selectionne les éléments
            const boutonAlert = document.querySelector("#boutonAlert")
            const boutonConsole = document.querySelector("#boutonConsole")
            const paragraphe = document.querySelector("#paragraphe")

            // les fonctions
            boutonAlert.addEventListener('click', function() {
                alert('Bouton cliqué')
            }) 
            
            paragraphe.addEventListener('mouseover', function() {
                this.style.background='yellow'
            }) 
            paragraphe.addEventListener('mouseout', function() {
                this.style.background='transparent'
            }) 

            // avec appel de fonction externe
            function logConsole () {
                console.log("click d'un bouton dans une div") 
            }
            boutonConsole.addEventListener('click', logConsole)


        </script>
    </body>
</html>
```

<br>
<br>

## La suppression d'évènements `removeEventListener`

La méthode ``removeEventListener()`` va permettre de supprimer un gestionnaire d’évènement déclaré avec addEventListener().

ATTENTION : il faut préciser la fonction qui est rattachée à l'évènement.

Référence : [MDN removeEventListener](https://developer.mozilla.org/fr/docs/Web/API/EventTarget/removeEventListener)

Exemple :

````html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Remove Listener</title>
    </head>
    <body>
        <h1>removeEventListener</h1>
        <p>Un paragraphe</p>
        <button id="boutonAlert">Cliquez moi !</button>
        <div>
            <p id="paragraphe" >Un paragraphe dans une div.</p>
            <button id="boutonConsole" >Un bouton dans une div</button>
        </div>
        <script>
            // On selectionne les éléments
            const boutonAlert = document.querySelector("#boutonAlert")
            const boutonConsole = document.querySelector("#boutonConsole")
            const paragraphe = document.querySelector("#paragraphe")

            // les fonctions
            boutonAlert.addEventListener('click', function() {
                alert('Bouton cliqué')
            }) 
            
            paragraphe.addEventListener('mouseover', function() {
                this.style.background='yellow'
            }) 
            paragraphe.addEventListener('mouseout', function() {
                this.style.background='transparent'
            }) 

            // avec appel de fonction externe
            function logConsole () {
                console.log("click d'un bouton dans une div") 
            }
            boutonConsole.addEventListener('click', logConsole)

            // retrait d'évènement qui echoue
            // fonction anonyme :(
            boutonAlert.removeEventListener('click', function() {
                alert('Bouton cliqué')
            })
            
            // retrait d'évènement qui réussit ;)
            boutonConsole.removeEventListener('click', logConsole)


        </script>
    </body>
</html>
````

<br>
<br>

## La propagation des évènements

Les évènements sont propagés sur l'arborescence du `DOM`.

Rien de mieux qu'un exemple :

````html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Propagation</title>
    </head>
    <body>
        <h1>Propagation</h1>
        <p>Un paragraphe</p>
        <div id="div">
            <p id="paragraphe" >Un paragraphe dans une div.</p>
            <button id="boutonConsole" >Un bouton dans une div</button>
        </div>
        <script>
            // On selectionne les éléments
            const div = document.querySelector("#div")
            const paragraphe = document.querySelector("#paragraphe")
            const boutonConsole = document.querySelector("#boutonConsole")

            // evenements sur paragraphe
            paragraphe.addEventListener('mouseover', function() {
                this.style.background='yellow'
            }) 
            paragraphe.addEventListener('mouseout', function() {
                this.style.background='transparent'
            }) 

            // evenement sur bouton
            function logConsole () {
                console.log("click d'un bouton dans une div") 
            }
            boutonConsole.addEventListener('click', logConsole)

            // evenement sur div
            div.addEventListener('click', e => {
                console.log("Ma div a détecté un click ")
                console.log(e.path)
            })
        </script>
    </body>
</html>
````

<br>
<br>

## Les 2 phases de propagation

Comme vu précédemment, lorsqu’un évènement se déclenche, celui-ci va naviguer à travers le DOM et passer à travers les différents gestionnaires d’évènement disposés dans le document.

Cette propagation va se faire selon deux phases :
- une phase de capture.
- une phase de bouillonnement.