function procesarProducto() {
    if (this.readyState == 4 && this.status == 200) {
        var stringProducto = this.responseText;
        console.log('string' + stringProducto);

        var arrayAtributosProduct = stringProducto.split("/");
        console.log('arrayAtributosProduct  ' + arrayAtributosProduct);
        var foto = document.getElementById("imagenFoto");
        var img = document.createElement("img");
        img.src = rutaImagen(arrayAtributosProduct[0]);
        img.width = 200;
        img.height = 110;
        img.alt = "Imagen Producto";
        img.classList = "imgProduct";
        foto.appendChild(img);
        var nombreProducto = document.getElementById("nombreProducto");
        nombreProducto.setAttribute("value", arrayAtributosProduct[1]);
        var precioProducto = document.getElementById("precioProducto");
        precioProducto.setAttribute("value", arrayAtributosProduct[2]);
    }
}
function rutaImagen(imgName) {
    var rutaImgTemp = "/php/uploads/" + imgName;
    var rutaImg = rutaImgTemp.split(" ").join("");
    return rutaImg;
}

function getURLParams() {
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const IDproduct = urlParams.get('idProduct')
    console.log(IDproduct);
    return IDproduct;
}
function existeProducto() {
    //En este método se procesa la respuesta de la petición comprobarProducto para mirar si ya existe algún producto con este nombre
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        console.log('string ' + string);
        var err = string.split("/");
        console.log('err ' + err);
        var span = document.getElementById("spanErr");
        if (err[1] === "1" || err[1] === "2") {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: err[0],
                showConfirmButton: false,
                timer: 1000
              })
            /*span.textContent = err[0];
            span.style = "color:red;";*/
            //divErr.appendChild(span1);
        } else if (err[1] === "0") {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: err[0],
                showConfirmButton: false,
                timer: 1500
              }).then(()=>{
                   document.getElementById("formularioProducto").submit(); 
              })
            /*span.textContent = err[0];
            span.style = "color:green;";*/
           

        }
    }
}
//Resp de la petición POST form de imagen
function procesarIMG() {
    if (this.readyState == 4 && this.status == 200) {
        var str = this.responseText;
        console.log('img ' + str);
        var imgNombre = str.split("/");
        console.log("imgNom " + imgNombre);
        var span = document.getElementById("spanErr");
        if (imgNombre[1] === "1" || imgNombre[1] === "2") {
            /*span.innerHTML = imgNombre[0];
            span.style = "color:red;";*/
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: imgNombre[0], 
                footer: 'La imagen no se cambiara',               
              })
        } else if (imgNombre[1] === "0") {
            /*span.innerHTML = "La imagen" + imgNombre[0] + " és totalmente válida";
            span.style = "color:green;";*/
            Swal.fire({
                icon: 'success',
                title: 'Correcto',
                text: "La imagen " + imgNombre[0] + " és totalmente válida",                
              })
        }
    }
}
//Esta función se utiliza para poder ver la img antes de enviarla a la carpeta de imágenes del servidor en este caso uploads
function previewImg(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();

    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);

    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function () {
        let preview = document.getElementById('imagenFoto'),
            image = document.createElement('img');

        image.src = reader.result;
        image.width = 200;
        image.height = 200;

        preview.innerHTML = '';
        preview.append(image);
    };
    //reader.readAsDataURL(e.target.files[0]); no tocar dejar comentado
}
var role;
function procesarSession() {
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role' + role);
        if (!(role === "ADMINSESSION" || role === "SUPERADMINSESSION")) {
            window.location = "../../../comun/logout.php";
        }
    }
}

function loadEvents() {
    comprobarSession();
    loadProducto();
    var idProduct = getURLParams();
    document.getElementById("idProduct").setAttribute("value", idProduct);
    document.getElementById("idProduct1").setAttribute("value", idProduct);
    var inputIMG = document.getElementById("imagenInput");
    inputIMG.addEventListener("change", previewImg);
    document.getElementById("botonEnviar").addEventListener("click", imagen);
    // document.getElementById("botonEnviar").addEventListener("click", () => {
    //     location.reload();
    // });

    document.getElementById("eliminar").addEventListener("click", () => {
        Swal.fire({
            title: 'Estas seguro de eliminar este producto?',
            text: "Una vez eliminado no podrás recuperarlo!",
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, elimínelo!',
            cancelButtonText: "Cancelar",
            closeOnConfirm: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("../modelo/eliminarProducto.php?idProd=" + idProduct, "_self");
            }
        },
            event.preventDefault()
        )

    });
    document.getElementById("dataProducto").addEventListener("click", comprobarProducto);

    document.getElementById("cerrar").addEventListener("click", () => {
        Swal.fire({
            title: 'Estas seguro?',
            text: "Una vez cerrada tendrás que volver a iniciar sesión!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Cierra sesión!',
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("../../../comun/logout.php", "_self");
            }
        })
    });
}
//petición para comprobar la Producto válido
function comprobarProducto() {
    var formData = new FormData(document.getElementById("formularioProducto"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = existeProducto;
    xmlhttp.open("POST", "http://localhost/php/admin/Producto/modelo/comprobarProductoEditar.php", true);
    xmlhttp.send(formData);
}
function imagen() {
    var formData = new FormData(document.getElementById("formimg"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarIMG;
    xmlhttp.open("POST", "http://localhost/php/comun/datosImagen.php", true);
    xmlhttp.send(formData);
}
function comprobarSession() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarSession;
    xmlhttp.open("GET", "http://localhost/php/comun/comprobarSession.php", true);
    xmlhttp.send();
}
function loadProducto() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarProducto;
    xmlhttp.open("GET", "http://localhost/php/admin/Producto/modelo/getProductoPorID.php?idProducto=" + getURLParams(), true);
    xmlhttp.send();
}
