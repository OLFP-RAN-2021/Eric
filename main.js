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
  /* event */
  element.addEventListener('blur', () => {
    validationElement(element)
  })
});

/* creation style et insertion DOM (head) */
var style = document.createElement('style');
style.innerHTML = `
span::before { 
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

/* validation du formulaire */
function validationForm() {
  
  let errors = 0
  /* parcour des elements */
  for ( const $el of elements) {
    
    if (!validationElement($el)) errors++ 
    
  }
  
  /* TODO : message si aucune erreur (errors=0)*/
  console.log(`errors : ${errors}`);
  console.log(`${errors == 0 ? `message envoyé` : `Bien tenté ;)`}`) 
  
}

function validationElement($el) {
  const $span = document.getElementById(`span-${$el.id}`)
    
  console.log(parseInt($el.dataset.length,10) )
  console.log(parseInt($el.dataset.length, 10) ? true : false);
  
  /* enlever les classes */
  $el.classList.remove('form-error')
  /* enlever les message */
  $span.style.setProperty("--error-message", `\"\"`)
  
  // recup de la valeur sans espaces
  let val = $el.value.trim()
  
  
  /* verif longueur */
  const length = parseInt($el.dataset.length, 10)
  if( length && parseInt( val.length, 10) < length) {
    /* cadre pour erreur */
    $el.classList.add('form-error')
    /* message d'erreur */
    $span.style.setProperty("--error-message",`\"Doit contenir ${length} caractères.\"`)
    $el.setCustomValidity("erreur setCustomValidity")
    return false
  }

  /* verif email */
  const email = $el.dataset.email
  if(email) {
    /* TODO : trouver le bon format pour email*/
    // const mailformat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
    // https://www.regextester.com/19
    // const mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/

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