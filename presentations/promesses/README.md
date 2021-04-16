# Introduction aux `promises` (promesses)

## Définition

L'objet ``Promise`` (pour "promesse") est utilisé pour réaliser des traitements de façon asynchrone. 

Une ``Promise`` représente une valeur qui peut être disponible maintenant, dans le futur voire jamais.

Une ``Promise`` est dans un de ces états :

- ``pending`` (en attente) : état initial, la promesse n'est ni remplie, ni rompue ;
- ``fulfilled`` (tenue) : l'opération a réussi ;
- ``rejected`` (rompue) : l'opération a échoué ;
- ``settled`` (acquittée) : la promesse est tenue ou rompue mais elle n'est plus en attente.

<br>

><br>
>Pour mémoire, un ``fetch`` retourne une ``Promise`` : 
>
>c'est le premier `.then()` 
>
><br>


<br>


Références : 

- [MDN Promise](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Promise)

- [MDN Fetch](https://developer.mozilla.org/fr/docs/Web/API/Fetch_API/Using_Fetch)

<br>

---
<br>

## Syntaxe et utilisation de base

Nous utiliserons l'objet `Promise()` essentiellement afin de réaliser des traitements de façon asynchrone.

Pour utiliser une promesse nous lui attachons deux `callbacks` *(fonctions de rappel)*: 

- une en cas de réussite - **le plus souvent nommée `resolve()`**

- une en cas d'echec - **le plus souvent nommée `reject()`**


Exemple : [Base](1_base/index.html)


<br>

---
<br>

## Utilisation asynchrone

Exemple avec ``setTimeout()`` : [Asynchrone](2_asynchrone/index.html)

Autre exemple chargement d'une image : [Image](3_image/index.html)

<br>

---
<br>

## Promesses multiples

Nous allons maintenant tenter d'effectuer plusieurs requêtes asynchrones.

Exemple : [requêtes](4_requetes/index.html)


<br>

---
<br>

## ``Promise.all()``

La méthode `all()` de `Promise` permet d'effectuer plusieurs requêtes asynchrones.

 - Si toutes les promesses de l'itérable (tableau) sont tenues, ``Promise.all`` est tenue.

 - La valeur de résolution est un tableau qui contient les valeurs de résolution respectives des promesses de l'itérable (dans le même ordre). 
 
 - Si l'argument utilisé est un tableau vide, la méthode résout la promesse immédiatement et de façon synchrone.

>**ATTENTION**
>
>  **Si l'une des promesses échoue, ``Promise.all()`` échoue immédiatement et utilise la raison de l'échec**
>
>**(que les autres promesses aient été résolues ou non).**

Référence : [MDN Promise/all()](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Promise/all)

Exemple : 

- [all()](5_all/index.html)
- [Images](6_images/index.html)

<br>

---
<br>

## ``Promise.allSettled()``

La méthode `allSettled()` de `Promise` permet d'effectuer plusieurs requêtes asynchrones également.

Le gestionnaire passé à la promesse retournée recevra comme argument un tableau de valeur dont chacune est le résultat de chaque promesse de l'itérable initial.

Pour chaque objet contenu dans ce tableau, il y aura une propriété status qui est une chaîne de caractères. Si status vaut fulfilled, alors on aura une propriété value. Si status vaut rejected, alors une propriété reason sera présente. La valeur (ou la raison) reflète la valeur de résolution de la promesse.

Référence : [MDN allSettled()](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Promise/allSettled)

Exemple : [allSettled](7_allSettled/index.html)

<br>

---
<br>

# A voir également

- [Promise.any()](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Promise/any) : inverse de ``Promise.all()`` renvoie la première réponse résolue.

- [Promise.race()](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Global_Objects/Promise/race) : renvoie la première réponse résolue ou rejetée.

- [MDN async function](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Statements/async_function) et  [MDN await](https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Operators/await)


- [MDN Utiliser les promesses](https://developer.mozilla.org/fr/docs/Web/JavaScript/Guide/Using_promises)

<br>

---
