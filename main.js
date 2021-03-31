console.log('hello javascript')

const button = document.getElementById('form-button')

/* détection de la validation du formulaire */
button.addEventListener('click', e => {
  e.preventDefault()

  validationForm()
  console.log('Bien tenté ;)');
})

function validationForm() {
  
  const champs = [
    {
      name: "prenom",
      empty: false
    }, 
    {
      name:"nom",
      empty: false
    }, 
    {
      name: "email",
      empty: false
    },
    {
      name: "sujet",
      empty: false
    },
    {
      name: "text",
      empty: false
    }
  ]

  let nomChamp = {}
  
  function formVide(el) {
    console.log(el.value);
  }
  
  champs.forEach(el => {
    const name = el.name
    console.log(el.name)
    console.log(`form-${name}`);
    nomChamp[name] = document.getElementById(`form-${name}`)
    
    // console.log(el.empty);
    if(el.empty == false ) {
      formVide(nomChamp[name])
    }
    console.log(`${name} : ${nomChamp[name].value}`)
    
    
  })
  
    /* 
  const prenom = document.getElementById('form-prenom')
  const nom = document.getElementById('form-nom')
  const email = document.getElementById('form-email')
  const sujet = document.getElementById('form-sujet')
  const text = document.getElementById('form-text')

  console.log(`prenom : ${prenom.value}`);
  console.log(`nom : ${nom.value}`);
  console.log(`email : ${email.value}`);
  console.log(`sujet : ${sujet.value}`);
  console.log(`text : ${text.value}`); 
*/

  
}