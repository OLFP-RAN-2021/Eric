# Les évènements 

## 1. Définition

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

## 2. Création d'un gestionnaire d'évènement

Il existe 3 façons d'implémenter des évènements :

- 2.1 Les attributs `HTML` (non recommandé).
- 2.2 Les propriétés `JS`.
- 2.3 La méthode `addEventListener()` (recommandé). 

<br>
<br>

### 2.1 Les attributs `HTML`


La méthode la plus ancienne et qui ne devrait plus être utilisé.

Il s'agit d'insérer un attribut `HTML` dans la balise ouvrante d'un élément.

Ces attributs `HTML` de type évènements possèdent le plus souvent le nom de l'évènement précédé de "**on**" :

- **onload** :      chargement,
- **onsubmit** :    soumission formulaire,
- **onclick** :     click sur élément,
- **onmouseover** : passage de la souris,
- **onblur** :      perte de focus,
- **onkeydown** :   etc.


Exemple :

```html
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Evenements dans HTML</title>
    </head>
    <body>
        <h1>Titre</h1>
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

### 2.2 Les propriétés JS.

Cette méthode consiste à utiliser une propriété d'un élément.

- Chaque évènement est représenté en ``JavaScript`` par un objet basé sur l’interface ``Event``.

- L’interface ``Event`` est l’interface de base commune pour tout évènement qui se produit dans le ``DOM``.


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

### 2.3 La méthode ``addEventListener()``


<br>
<br>

## 3. La propagation des évènements

