console.log('dans main.js')

const btnSend = document.querySelector('#btnSend')
const emailSender = document.querySelector('#emailSender')
const emailDest = document.querySelector('#emailDest')

btnSend.addEventListener('click', envoiMessage)


function envoiMessage(e) {
    e.preventDefault()

    console.log(emailSender, emailDest);
}