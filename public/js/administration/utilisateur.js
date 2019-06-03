
////// DOCUMENTS ///////////////
$(document).on('dragover', function (e) {
    var dt = e.originalEvent.dataTransfer;
    if (dt.types && (dt.types.indexOf ? dt.types.indexOf('Files') != -1 : dt.types.contains('Files'))) {
        $("#file_principal").css('z-index', '3');
        window.clearTimeout(dragTimer);
    }
});
$(document).on('dragleave', function (e) {
    dragTimer = window.setTimeout(function () {
        $("#file_principal").css('z-index', '1');
    }, 25);
});
$(document).bind('drop', function () {
    dragTimer = window.setTimeout(function () {
        $("#file_principal").css('z-index', '1');
    }, 25);
});

function addOriginalTitleInForm() {

    let originalTitle = $('#fileList').text();
    $('#titre-original-document').val(originalTitle);
}

//Récupération de données sur le document
function checkFileUploaded(fileInput) {
    var files = fileInput.files;
    var file = files[0];
    $('#filesize').val(file["size"]);
}

/**
 * fonction d'affichage d'un aperçu du fichier importé
 * @param {event} event
 */
var openFile = function (event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('output');
        output.src = dataURL;
    };
    // on récupére l'extention
    let exetension = recupereExtention(input.value);
    // si c'est une image
    if (exetension === "png" || exetension === "jpg" || exetension === "jpeg") {
        // on affiche un paerçu
        reader.readAsDataURL(input.files[0]);
    } else {
        let logoAAfficher = afficheLogoExtention(exetension);
        // si l'extention n'est pas autorisée
        if (logoAAfficher === false) {
            // on affiche une erreur
            $("#fileList").html('<p style="color:red">Fichier non pris en charge</p>');
            // on affiche le panneau de danger
            output.src = rootPath + "danger.png";
        } else {
            // si autorisé on affiche le logo correspondant à l'extention
            output.src = logoAAfficher;
        }
    }
    /**
     * prend une extention en paramètre et retourne le logo à afficher
     * @param {extention} extention
     */
    function afficheLogoExtention(extention) {

        let urlLogoPDF = rootPath + "pdficon.png";
        let urlLogoExcel = rootPath + "xlsicondoc.png";
        let urlWorlLogo = rootPath + "wordicondoc.png";
        let urlLogoCSV = rootPath + "csvicondoc.png";
        let urlLogoMP3 = rootPath + "mp3.png";
        let urlLogoDanger = rootPath + "danger.png";
        // switch de retour de l'url du logo à afficher
        switch (extention) {
            case 'pdf':
                return urlLogoPDF;
                break;
            case 'docx':
            case 'doc':
                return urlWorlLogo;
                break;
            case 'xls' :
            case 'xlsx':
                return urlLogoExcel;
                break;
            case 'csv':
                return urlLogoCSV;
                break;
            case "mp3":
                return urlLogoMP3;
                break;
            default:
                return false;
        }
    }


};

/**
 * récupére et retourne l'extention depuis la fakeurl
 * @param {fakeUrl} fakeUrl
 */
function recupereExtention(fakeUrl) {
    let fakeUrlToLower = fakeUrl.toLowerCase();
    let split = fakeUrlToLower.split('.');
    let extention = split[1];
    return extention;
}