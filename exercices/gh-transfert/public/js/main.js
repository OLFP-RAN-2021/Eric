// console.log('dans main.js')

const btnSend = document.querySelector('#btnSend')
const dropZone = document.querySelector('#drop-zone')
const emailSender = document.querySelector('#emailSender')
const emailDest = document.querySelector('#emailDest')
const myForm = document.querySelector('#myForm')
const inputFiles = document.querySelector('#files')
const fileList = inputFiles.files

let files
let formData = new FormData(myForm);

myForm.style.display = "flex"

btnSend.addEventListener('click', envoiMessage)

dropZone.addEventListener('drop', addDropFiles)
// dropZone.addEventListener('change', addFiles)

dropZone.addEventListener('dragover', e => {
    e.preventDefault()
    if (
        dropZone.classList.contains('error') ||
        dropZone.classList.contains('valid')
    ) { return }
    dropZone.classList.add("valid")
    console.log('hover');
})
dropZone.addEventListener('dragleave', e => {
    e.preventDefault()
    dropZone.classList.remove('valid', 'error')
})

function addDropFiles(e) {
    e.preventDefault()
    files = e.dataTransfer.files
    console.table(formData)
    console.log(files[0].name);
    inputFiles.files = files
    // formData.set(files[0].name,)

}

async function envoiMessage(e) {
    e.preventDefault()

    // console.table(files)

    formData = new FormData(myForm)
    // formData.set('emailSender', emailSender.value);
    // formData.set('emailDest', emailDest.value);

    // console.table(formData)
    // for (const pair of formData) {
    //     console.log(pair[0], pair[1]);
    // }

    // return

    // const myForm = document.getElementById('#myForm');
    // const formData = new FormData(myForm);

    // document.forms["myform"].submit();
    // console.log(emailSender.value, emailDest.value);

    let response = await fetch("/", {
        method: 'POST',
        body: formData
    })
    if (!response.ok) {
        console.log(response)
    } else {
        const data = await response.json()
        console.table('data : ', data)

        // myForm.reset()
    }
}

/* couper les listeners de la page */
let actions = ['dragover', 'drop']
actions.forEach(action => {
    document.body.addEventListener(action, e => e.preventDefault())
})