
let currentAngle = 0
const img = new Image
const canvas = document.querySelector("canvas")
const context = canvas.getContext("2d");
const $dropZone = document.querySelector('#drop-zone')
const $rotateButton = document.querySelector("#rotate-button")

/**
 * Teste si un object File est de type image 
 * @param {File} file - fichier à tester
 * @returns {boolean} True si image sino false
 */
const testFile = file => {
    return (file.type.indexOf("image/") == 0)
}

/**
 * Dessine l'image dans le canvas selon un angle donné
 * @param {integer} angle 
 * 
 * 
 */
const imageDraw = (angle = 0) => {
    // TODO : vérifier angle 0,90,180,270,360
    // calcul pour taille
    const ratio = img.width/img.height

    console.log(`ratio: ${ratio}`);

    // calcul du ratio pour orientation horizontale ou verticale
    if(ratio >= 1) {
        canvas.width = 300
        canvas.height = canvas.width / ratio
    } else {
        canvas.height = 300
        canvas.width = canvas.height * ratio
    }

    // mémorise width et heigth du canvas
    const w = canvas.width,
        h = canvas.height

    // echange width et height si position verticale
    if(angle == 90 || angle == 270) {
        [canvas.width, canvas.height] = [canvas.height, canvas.width];
    }

    /* dessin proprement dit */
    context.save()
    // centrer pour rotation du canvas
    context.translate(canvas.width / 2, canvas.height / 2);
    context.rotate(angle * Math.PI / 180);
    context.drawImage(img,0,0,img.width, img.height, -w/2, -h/2, w, h)
    context.restore();
    currentAngle = angle
}

// gestion évènement au chargement de l'image
img.addEventListener('load', evt => {
    imageDraw(0)
} )

/**
 * Charge l'image et l'affiche dans canvas
 * @param {event} e  - l'event emis (drop ou change)
 */
const chargeImage = (e) => {
    e.preventDefault()
    $dropZone.classList.remove('hover')
    
    const file = e.dataTransfer.files[0]
    
    if( testFile(file)) {
        img.src = URL.createObjectURL(file)
    } else {
        // TODO : msg d'erreur
        throw new Error("Erreur, pas d'image :(")
    }
    $rotateButton.disabled = false   
}

/* event pour dragover */
$dropZone.addEventListener('dragover', e => {
    e.preventDefault()

    if ( testFile(e.dataTransfer.items[0])) {
        $dropZone.classList.add('hover')
    } else {
        $dropZone.classList.add('error')
    }
})

/* event pour dragleave */
$dropZone.addEventListener('dragleave', e => {
    // e.preventDefault()
    $dropZone.classList.remove('hover','error')
})

/* event pour drop ou change */
let actions = ['drop','change']
actions.forEach( action => {
    $dropZone.addEventListener(action, chargeImage)
});

/* couper les listeners de la page */
actions = ['dragover', 'drop']
actions.forEach(action => {
    document.body.addEventListener(action, e => e.preventDefault())
})

/* event pour bouton de rotation */
$rotateButton.addEventListener('click', e => {
    if(img.src == "") return
    currentAngle = (currentAngle + 90) % 360
    imageDraw(currentAngle)
})