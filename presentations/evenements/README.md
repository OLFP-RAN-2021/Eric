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

- Dans les attributs `HTML` (non recommandé).
- Dans les propriétés `JS`.
- Avec la méthode `addEventListener()` (recommandé). 

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

Exemple : [event_attribut](event_attribut/index.html)

<br>
<br>

## Evènements dans les propriétés JS.

Cette méthode consiste à utiliser une propriété d'un élément.

- Chaque évènement est représenté en ``JavaScript`` par un objet basé sur l’interface ``Event``.

- L’interface ``Event`` est l’interface de base commune pour tout évènement qui se produit dans le ``DOM``.

Référence : [MDN Building_blocks/Events](https://developer.mozilla.org/fr/docs/Learn/JavaScript/Building_blocks/Events)

Exemple : [event_property](event_property/index.html)

<br>
<br>

## Evènements dans la méthode ``addEventListener()``

Cette méthode consiste à attacher/écouter un évènement sur un élément.

- `addEventListener` ajoute une fonction à la liste des gestionnaires d'évènements pour le type d'évènement spécifié.
- Les cibles peuvent être `Window`, `Document` et bien sur `Element`.

Référence : [MDN addEventListener](https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener)

Exemple : [event_add](event_add/index.html)

<br>
<br>

## La suppression d'évènements `removeEventListener`

La méthode ``removeEventListener()`` va permettre de supprimer un gestionnaire d’évènement déclaré avec addEventListener().

ATTENTION : il faut préciser la fonction qui est rattachée à l'évènement.

Référence : [MDN removeEventListener](https://developer.mozilla.org/fr/docs/Web/API/EventTarget/removeEventListener)

Exemple : [event_remove](event_remove/index.html)

<br>
<br>

## La propagation des évènements

Les évènements sont propagés sur l'arborescence du `DOM`.

Rien de mieux qu'un exemple : [event_propagation](event_propagation/index.html)


<br>
<br>

## Les 2 phases de propagations

Comme vu précédemment, lorsqu’un évènement se déclenche, celui-ci va naviguer à travers le ``DOM`` et passer à travers les différents gestionnaires d’évènement disposés dans le document.

Cette propagation va se faire selon deux phases. 
- une phase de capture.
- une phase de bouillonnement.

Le choix de la phase de propagation est déterminée par un troisième argument précisé à `addEventListener`. 

Cet argument est un `booléen` :
- ``false`` pour capture (par defaut).
- ``true`` pour bouillonement.

Exemple : [event_phases](event_phases/index.html)