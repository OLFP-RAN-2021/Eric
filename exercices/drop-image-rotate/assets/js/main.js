
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
    
    // initialisation des marges
    let margin = {
        left: 0,
        right: 0,
        top: 0,
        bottom: 0
    }

    // ratio img pour orientation
    // si ratio => 1 alors horizontal
    // si ratio < 1 alors vertical
    const imgRatio = img.width/img.height
    console.log(`imgRatio: ${imgRatio}`);
    
    [canvas.width, canvas.height] = (imgRatio < 1) ?  [200, 300]:  [300, 200]
    const canvasRatio = canvas.width/canvas.height
    console.log(`canvasRatio: ${canvasRatio}`);
  
    // test taille imgInCanvas
    //  a revoir
    // const imgInCanvas = {
    //     height: 0,
    //     width: 0
    // }
    // imgInCanvas.height = img.height/canvas.height < 1 ? (canvas.height * (img.height/canvas.height)): (canvas.height / (img.height/canvas.height))
    // imgInCanvas.width = img.width/canvas.width < 1 ? (canvas.width * (img.width/canvas.width)): (canvas.width / (img.width/canvas.width))
    
    
    let marginOrientation = Math.sign((img.width/canvas.width) - (img.height/canvas.height))

    // if(imgRatio < 1 ){
    //     imgInCanvas.height = img.height / (img.width / canvas.width)
    //     imgInCanvas.width = img.width / (img.height / canvas.height)
    // } 

    // console.table(imgInCanvas)

    // tester si img avec marge
    switch (marginOrientation) {
        case 0:
            // pas de marges ;)
            console.log(` ${marginOrientation} : pas de marges`);
            break;
        case 1:
            // marges verticales
            console.log(`${marginOrientation} : marges verticales`);

            console.log(`img.height/canvas.height : ${img.height/canvas.height}`);
            
            let imgHeight = img.height/canvas.height < 1 ? (canvas.height * (img.height/canvas.height)): (canvas.height / (img.height/canvas.height))
            if(imgRatio < 1 ){
                imgHeight = img.height / (img.width / canvas.width)
            } 

            margin.top = (canvas.height - imgHeight) /2
            console.log(`margin.top : ${margin.top}`);
            
            margin.bottom = canvas.height - (margin.top + imgHeight)
            console.log(`margin.bottom : ${margin.bottom}`);

            break;
        case -1:
            // marges horizontales
            console.log(`${marginOrientation} : marges horizontales`);

            console.log(`img.width/canvas.width : ${img.width/canvas.width}`);
            
            let imgWidth = img.width/canvas.width < 1 ? (canvas.width * (img.width/canvas.width)): (canvas.width / (img.width/canvas.width))
            if(imgRatio < 1 ){
                imgWidth = img.width / (img.height / canvas.height)
            } 

            margin.left = (canvas.width - imgWidth) /2
            console.log(`margin.left : ${margin.left}`);
            
            margin.right = canvas.width - (margin.left + imgWidth)
            console.log(`margin.right : ${margin.right}`);
            

        break;
        default:
            break;
    }
    
     

    // mémorise width et heigth du canvas
    const[w, h] = [canvas.width, canvas.height]

    // echange width et height si position verticale
    if(angle == 90 || angle == 270) {
        [canvas.width, canvas.height] = [canvas.height, canvas.width];
    }

    /* dessin proprement dit */
    context.save()
    // centrer pour rotation du canvas
    context.translate(canvas.width / 2, canvas.height / 2);
    context.rotate(angle * Math.PI / 180);
    // context.drawImage(img,0,0,img.width, img.height, -w/2, -h/2, w, h)
    context.drawImage(img,0,0,img.width, img.height, -(w/2 - margin.left), -(h/2 - margin.top), (w-(margin.left + margin.right)), (h-(margin.top + margin.bottom)))
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