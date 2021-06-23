
var i = 0;
var images = [];
var images2 = [];
var time = 5000;

images[0] = '../uploads/oferta4.jpg';
images[1] = '../uploads/oferta5.jpg';
images[2] = '../uploads/oferta6.jpg';
images[3] = '../uploads/oferta1.jpg';
images[4] = '../uploads/oferta3.jpg';
images[5] = '../uploads/oferta2.jpg';
//images[3] = '../uploads/Florentina.jpg';

function changeImg() {
    var id = document.getElementById("imagenC");

    id.addEventListener("click", function () {
        window.location.href = "http://localhost/php/paginaHome.php";
    });

    id.src = images[i];

    if (i < images.length - 1) {
        i++
    } else {
        i = 0;
    }

    setTimeout("changeImg()", time);

}

images2[0] = 'uploads/oferta4.jpg';
images2[1] = 'uploads/oferta5.jpg';
images2[2] = 'uploads/oferta6.jpg';
images2[3] = 'uploads/oferta1.jpg';
images2[4] = 'uploads/oferta3.jpg';
images2[5] = 'uploads/oferta2.jpg';
//images[3] = '../uploads/Florentina.jpg';

function changeImg2() {
    var id = document.getElementById("imagenC");

    id.addEventListener("click", function () {
        window.location.href = "http://localhost/php/paginaHome.php";
    });

    id.src = images2[i];

    if (i < images2.length - 1) {
        i++
    } else {
        i = 0;
    }

    setTimeout("changeImg2()", time);

}