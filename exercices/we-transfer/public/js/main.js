console.log('dans main.js')

const btnSend = document.querySelector('#btnSend')
const emailSender = document.querySelector('#emailSender')
const emailDest = document.querySelector('#emailDest')
const dropZone = document.querySelector('#drop-zone')

btnSend.addEventListener('click', envoiMessage)

dropZone.addEventListener('drop', e => {
    e.preventDefault()
    console.log(e.target);
})
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

function envoiMessage(e) {
    e.preventDefault()

    console.log(emailSender, emailDest);
}