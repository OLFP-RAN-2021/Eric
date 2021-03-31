console.log('hello javascript')

const button = document.getElementById('form-button')

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

  /* pour memorisation */
  // let champs = {}
  
  function formVide(value) {

    return (value.trim() == "")

  }
  
  /* parcour des elements */
  // for (let i = 0; i < elements.length; i++) {
  for ( const el of elements) {
    // const el = elements[i]
    const name = el.name
    // console.log(el.name)
    // console.log(`form-${name}`);
    const $el = document.getElementById(`form-${name}`)
    
    /* enlever les classes */
    $el.classList.remove('error')

    // recup de la valeur
    let val = $el.value.trim()
    
    /* verif si vide ? */
    if (el.empty && val == "") {
      $el.classList.add('error')
      continue
    }
  
    /* verif longueur */
    if(el.len !== undefined && val.length < el.len) {
      $el.classList.add('error')
      continue
    }
    console.log(`${name} : ${val}`)
    
  }

  
}