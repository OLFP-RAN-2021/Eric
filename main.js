console.log('hello javascript')

const button = document.getElementById('form-button')

/* creation style */
var style = document.createElement('style');
// style.innerHTML = `
// #form-prenom::before {
//     content: "pour teste";
//     display: block;
//     color: #F00;
//     position: absolute;
//     z-index: 10;
//     top: 10px;
//     left: 10px;
// }
// `
// document.getElementsByTagName('head')[0].appendChild(style);

/* selection des elements dans form sauf submit */
const elements = document.querySelectorAll('form > *:not([type=submit])')
elements.forEach(element => {
  element.style.position = "relative"
  element.style.width = "100%"
  element.style.height  = "100%"

  const span = document.createElement('span')
  span.style.position = "relative"
  span.id = `span-${element.id}`
  span.style.gridArea = element.id.replace("form-", "")
  // span.style.setProperty("--text-error", `0`)
  
  element.parentNode.insertBefore(span, element)
  span.appendChild(element)
  // element.appendChild(span)
});
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
`;
document.getElementsByTagName('head')[0].appendChild(style);


/* détection de la validation du formulaire */
button.addEventListener('click', e => {
  e.preventDefault()

  validationForm()
  console.log('Bien tenté ;)');
})

function validationForm() {
  
  /* les champs a verifier */
  const elements = [
    {
      name: "prenom",
      empty: true,
      len:  4
    }, 
    {
      name:"nom",
      empty: true,
      len: 5
    }, 
    {
      name: "email",
      empty: true,
      email: true
    },
    {
      name: "sujet",
      empty: true,
      len: 10
    },
    {
      name: "text",
      empty: true,
      len: 40
    }
  ]

  
  function formVide(value) {

    return (value.trim() == "")

  }
  
  function setMessage(span, text) {

  }

  /* parcour des elements */
  for ( const el of elements) {
    const name = el.name
    const $el = document.getElementById(`form-${name}`)
    const $span = document.getElementById(`span-form-${name}`)
    /* enlever les classes */
    $el.classList.remove('error')
    /* enlever les message */
    $span.style.setProperty("--error-message", `\"\"`)

    // recup de la valeur
    let val = $el.value.trim()
    
    /* verif si vide ? */
    if (el.empty && val == "") {
      /* cadre pour erreur */
      $el.classList.add('error')
      /* message d'erreur */
      $span.style.setProperty("--error-message", `\"Doit pas être vide.\"`)
      continue
    }
    
    /* verif longueur */
    if(el.len !== undefined && val.length < el.len) {
      /* cadre pour erreur */
      $el.classList.add('error')
      /* message d'erreur */
      $span.style.setProperty("--error-message",`\"Doit contenir ${el.len} caractères.\"`)
      continue
    }

    /* verif email */
    if(el.email) {
      /* TODO : trouver le bon format pour email*/
      const mailformat = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/
      if (!$el.value.match(mailformat)) {
        /* cadre pour erreur */
        $el.classList.add('error')
        /* message d'erreur */
        $span.style.setProperty("--error-message",`\"Doit contenir une adresse email valide.\"`)
        continue
      }
    }


    console.log(`${name} : ${val}`)
    
  }

  
}