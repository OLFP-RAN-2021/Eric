
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
const imageDraw = (angle = 0, size = {w: 450, h:300}) => {
    // TODO : vérifier angle 0,90,180,270,360

    // ratio img pour orientation
    // si ratio => 1 alors horizontal
    // si ratio < 1 alors vertical
    const imgRatio = img.width / img.height
    console.log(`imgRatio: ${imgRatio}`);

    // ;([canvas.width, canvas.height] = ((imgRatio < 1) ? [size.h, size.w] : [size.w, size.h]))
    
    ;[canvas.width, canvas.height] = (imgRatio < 1) ? [size.h, size.w] : [size.w, size.h]
    
    // debugger
    const canvasRatio = canvas.width / canvas.height
    console.log(`canvasRatio: ${canvasRatio}`);

    // test taille imgInCanvas
    const imgInCanvas = {
        height: canvas.height,
        width: canvas.width
    }

    let marginOrientation = Math.sign((img.width / canvas.width) - (img.height / canvas.height))
    switch (marginOrientation) {
        case 0:
            console.log(` ${marginOrientation} : pas de marges`);
            break
        case 1:
            console.log(`${marginOrientation} : marges verticales`);
            imgInCanvas.height = img.height / canvas.height < 1 ? (canvas.height * (img.height / canvas.height)) : (canvas.height / (img.height / canvas.height))
            // if (imgRatio < 1) {
            if (imgRatio < canvasRatio) {
                imgInCanvas.height = img.height / (img.width / canvas.width)
            }
            break
        case -1:
            console.log(`${marginOrientation} : marges horizontales`);
            imgInCanvas.width = img.width / canvas.width < 1 ? (canvas.width * (img.width / canvas.width)) : (canvas.width / (img.width / canvas.width))
            // if (imgRatio < 1) {
            if (imgRatio < canvasRatio) {
                imgInCanvas.width = img.width / (img.height / canvas.height)
            }
            break
    }

    // les données concernant la taille de l'image dessinée dans le canvas
    console.table(imgInCanvas)

    // echange width et height si position verticale
    if (angle == 90 || angle == 270) {
        [canvas.width, canvas.height] = [canvas.height, canvas.width];
    }

    /* dessin proprement dit */
    context.save()
    // centrer pour rotation du canvas
    context.translate(canvas.width / 2, canvas.height / 2);
    context.rotate(angle * Math.PI / 180);
    // context.drawImage(img,0,0,img.width, img.height, -w/2, -h/2, w, h)
    context.drawImage(img,
         0, 0, img.width, img.height,
          -(imgInCanvas.width/2), -(imgInCanvas.height/2), imgInCanvas.width, imgInCanvas.height)
    context.restore();
    currentAngle = angle

}

// gestion évènement au chargement de l'image
img.addEventListener('load', evt => {
    imageDraw(0)
})

/**
 * Charge l'image et l'affiche dans canvas
 * @param {event} e  - l'event emis (drop ou change)
 */
const chargeImage = (e) => {
    e.preventDefault()
    $dropZone.classList.remove('hover')

    const file = e.dataTransfer.files[0]

    if (testFile(file)) {
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

    if (testFile(e.dataTransfer.items[0])) {
        $dropZone.classList.add('hover')
    } else {
        $dropZone.classList.add('error')
    }
})

/* event pour dragleave */
$dropZone.addEventListener('dragleave', e => {
    // e.preventDefault()
    $dropZone.classList.remove('hover', 'error')
})

/* event pour drop ou change */
let actions = ['drop', 'change']
actions.forEach(action => {
    $dropZone.addEventListener(action, chargeImage)
});

/* couper les listeners de la page */
actions = ['dragover', 'drop']
actions.forEach(action => {
    document.body.addEventListener(action, e => e.preventDefault())
})

/* event pour bouton de rotation */
$rotateButton.addEventListener('click', e => {
    if (img.src == "") return
    currentAngle = (currentAngle + 90) % 360
    imageDraw(currentAngle)
})