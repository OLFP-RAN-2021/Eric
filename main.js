// console.log('hello javascript')


/* selection des elements dans form sauf submit */
const elements = document.querySelectorAll('form > *:not([type=submit])')

/* parcours des elements */
elements.forEach(element => {
  /* redefinition css avant wrapping */
  element.style.position = "relative"
  element.style.width = "100%"
  element.style.height  = "100%"
  
  /* creation des span (wrapper) */
  const span = document.createElement('span')
  span.style.position = "relative"
  span.id = `span-${element.id}`
  span.style.gridArea = element.id.replace("form-", "")
  /* insertion dans DOM */
  element.parentNode.insertBefore(span, element)
  /* placement element dans span */
  span.appendChild(element)
  /* Création évènement pour chaque élément (option?)*/
  element.addEventListener('blur', () => {
    validationElement(element)
  })
});

/* creation style et insertion DOM (head) */
var style = document.createElement('style');
style.innerHTML = `
form span[id^="span-form-"]::before { 
  content: var(--error-message);
  display: block;
  padding: .2em;
  font-size: 0.7em;
  color: red;
  position: absolute;
  left: 0;
  top: -1.2em;
  z-index: 1;
  display: block;
  background-color: transparent;
}
.form-error {
  border: 1px dot red;
}
`;
document.getElementsByTagName('head')[0].appendChild(style);


/* selection du submit */
const button = document.getElementById('form-button')
/* détection de la validation du formulaire */
button.addEventListener('click', e => {
  e.preventDefault()

  validationForm()
})

/**
 * Validation du formulaire avec parcours des champs.
 * TODO : affichage d'un message si formulaire correct et envoyé.
 */
function validationForm() {
  
  let errors = 0
  /* parcour des elements */
  for ( const $el of elements) {
    
    // validité du champ et comptage des erreurs
    if (!validationElement($el)) errors++ 
    
  }
  
  /* TODO : message si aucune erreur (errors=0)*/
  console.log(`errors : ${errors}`);
  console.log(`${errors == 0 ? `message envoyé` : `Bien tenté ;)`}`) 
  
}

/**
 * Vérifier si une saisie est valide pour un champ passé en paramètre
 * @param {HTMLElement} $el élément dont la value est à vérifier
 * @returns {boolean} true si passe la validation sinon false
 * 
 */
function validationElement($el) {
  /* récupère le span */
  const $span = document.getElementById(`span-${$el.id}`)
    
  console.log(parseInt($el.dataset.length,10) )
  console.log(parseInt($el.dataset.length, 10) ? true : false);
  
  /* enlever la classe */
  $el.classList.remove('form-error')
  /* vider le message */
  $span.style.setProperty("--error-message", `\"\"`)
  
  // recupéré la valeur de l'input sans espaces
  let val = $el.value.trim()
    
  /* verifier la longueur de la chaine */
  const length = parseInt($el.dataset.length, 10)
  if( length && parseInt( val.length, 10) < length) {
    /* cadre pour erreur */
    $el.classList.add('form-error')
    /* message d'erreur */
    $span.style.setProperty("--error-message",`\"Doit contenir ${length} caractères.\"`)
    // ne fonctionne pas ?
    // $el.setCustomValidity("erreur setCustomValidity")
    return false
  }

  // TODO : dataset alpha pour vérification saisie sans chiffre

  /* verif email */
  const email = $el.dataset.email
  if(email) {
    /* TODO : trouver le bon format pour email*/
    // const mailformat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
    // https://www.regextester.com/19
    // const mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/
    
    // https://www.analyste-programmeur.com/javascript/les-expressions-regulieres/verifier-une-adresse-email-en-javascript
    const mailformat = /^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$/
    if (!val.match(mailformat)) {
      /* cadre pour erreur */
      $el.classList.add('form-error')
      /* message d'erreur qui ne fonctionne pas? */
      $span.style.setProperty("--error-message",`\"Doit contenir une adresse email valide.\"`)
      return false
    }
  }
  return true
}