console.log('dans main.js')

const btnSend = document.querySelector('#btnSend')
const dropZone = document.querySelector('#drop-zone')
const emailSender = document.querySelector('#emailSender')
const emailDest = document.querySelector('#emailDest')
const form = document.querySelector('form')
const inputFiles = document.querySelector('#files')
const fileList = inputFiles.files

let files

form.style.display = "flex"

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

// function addFiles(e) {
//     console.log('dans addFiles')
//     console.log(inputFiles.files)

//     debugger
// }
function addDropFiles(e) {
    e.preventDefault()
    files = e.dataTransfer.files
    // console.table(files)
    inputFiles.files = files
    // console.log(inputFiles.files)
    // console.log(fileList)
}

async function envoiMessage(e) {
    e.preventDefault()
    const myForm = document.getElementById('#myForm');
    const formData = new FormData(myForm);
    // formData.append('file', files)

    console.log('formData : ', formData)
    debugger
    for (const pair of formData) {
        console.log(pair[0], pair[1]);
    }
    // console.log(emailSender.value, emailDest.value);
    let response = await fetch("reception.php", {
        method: 'POST',
        body: formData
    })
    if (response.ok) {
        const data = await response.text()
        console.log('reponse : ', data)
    }
    // .then(response => response.text())
    // .then(data => console.log('reponse : ', data))
    // .then(data => data)
}

/* couper les listeners de la page */
let actions = ['dragover', 'drop']
actions.forEach(action => {
    document.body.addEventListener(action, e => e.preventDefault())
})