var totalPag;
function procesarProductos() {
  if (this.readyState == 4 && this.status == 200) {
    var string = this.responseText;
    //console.log('string: ' + string);

    var k = string.indexOf("#");
    //console.log('k' + k);

    var paginacion = string.slice(k + 1, string.length);
    totalPag = parseInt(paginacion);
    //console.log('pag:' + paginacion);

    var stringProductos = string.slice(0, k);

    //console.log('string' + stringProductos);
    var arrayliProductos = stringProductos.split("//").filter(Boolean);
    //console.log('arrayliProductos  '+arrayliProductos);
    var numero = 1;
    arrayliProductos.forEach((element) => {
      var arrayCadaProducto = element.split("/");
      var tbody = document.getElementById("tbody");
      //console.log('id: '+arrayCadaProducto[0]);
      //console.log('img: '+arrayCadaProducto[1]);
      var tr = document.createElement("tr");
      var td1 = document.createElement("td");
      var img = document.createElement("img");
      img.src = rutaImagen(arrayCadaProducto[1]);
      img.width = 260;
      img.height = 200;
      img.alt = "Imagen Producto";
      //Pon el estilo
      //Estilo imagen
      td1.classList =
        "container w-100 h-200 p-1 color-White rounded-4 text-center mx-5 my-2 ";
      td1.appendChild(img);
      var td2 = document.createElement("td");
      //Pon el estilo
      //Nombre Producto
      td2.classList =
        "container w-150 h-200 p-4 color-White rounded-4 text-center mx-5 my-2";
      td2.innerHTML = arrayCadaProducto[2];
      var tdCat = document.createElement("td");
      //Pon el estilo
      //Categoria
      tdCat.classList =
        "container w-150 h-200 p-4 color-White rounded-4 text-center mx-5 my-2";
      tdCat.innerHTML = arrayCadaProducto[4];
      var td3 = document.createElement("td");
      //PRECIO
      td3.classList =
        "container w-150 h-200 p-4 color-White rounded-4 text-center mx-5 my-2";
      td3.innerHTML = arrayCadaProducto[3] + "€";
      var td4 = document.createElement("td");
      if (role != "NOSESSION" && role != "USERSESSION") {
        var editar = document.createElement("a");
        editar.href =
          "../../admin/Producto/vista/editarProducto.php?idProduct=" +
          arrayCadaProducto[0];
        //console.log(editar.id);
        //editar.value = arrayCadaProducto[0];
        //BOTON ESTILO
        editar.innerHTML = "Editar";
        editar.classList = "btn btn-primary btn-lg";
        td4.classList =
          "container w-200 h-200 p-4 color-White rounded-4 text-center mx-5 my-2";
        td4.appendChild(editar);
      } else {
        var anadir = document.createElement("button");
        var cantidad = document.createElement("input");
        anadir.innerHTML = "Añadir";
        anadir.id = "anadir" + numero;
        anadir.value = arrayCadaProducto[0];
        anadir.classList = "btn btn-primary";
        cantidad.type = "number";
        cantidad.min = 1;
        cantidad.max = 50;
        cantidad.value = 1;
        cantidad.id = "cantidad" + numero;
        cantidad.style = "width=30px;margin-rigth=10px";
        cantidad.classList = "btn btn-success";
        anadir.onclick = cambiarCantidad;

        //anadir.href="../../carrito/vista/carrito.html?idProduct="+arrayCadaProducto[0];
        anadir.append(cantidad);
        td4.classList =
          "container w-100 h-100 p-4 color-White-5 rounded-4 text-center mx-5 my-2";
        td4.appendChild(anadir);
        td4.insertBefore(cantidad, anadir);
        numero++;
      }
      //Pon el estilo
      tr.classList =
        "container border border-dark rounded-4 bg-white my-1 w-80 h-25 p-2 mx-1 d-flex text-center ";
      tbody.appendChild(tr);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(tdCat);
      tr.appendChild(td3);
      tr.appendChild(td4);
    });
    document.getElementById("contador").innerText = totalPag;
    document.getElementById("contadorActual").innerText = pagina;
  }
}
function cambiarCantidad() {
  if (role != "USERSESSION") {
    window.location = "../../comun/logout.php";
  } else {
    let numero = this.id.slice(-1);
    let cantidad = document.getElementById("cantidad" + numero);

    //console.log(cantidad.value);
    //console.log(cantidad);
    //console.log(this.value);
    añadirProductoCarrito(this.value, cantidad.value);
  }
}
function rutaImagen(imgName) {
  var rutaImgTemp = "/php/uploads/" + imgName;
  var rutaImg = rutaImgTemp.split(" ").join("");
  return rutaImg;
}
function respCarrito() {
  if (this.readyState == 4 && this.status == 200) {
    let string = this.responseText;
    console.log("str" + string);
    let ArrayStringResp = string.split("/");
    if (ArrayStringResp[1] === "0") {
      let nombreCantidad = ArrayStringResp[0].split("#");
      //alert(`${nombreCantidad[1]} ${nombreCantidad[0]} añadido al carrito correctamente`);
    } else {
      //alert(ArrayStringResp[0]);
    }
  }
}

function getURLParams() {
  const queryString = window.location.search;
  console.log(queryString);
  const urlParams = new URLSearchParams(queryString);
  const estadoActivo = urlParams.get('estadoActivo')
  console.log(estadoActivo);
  return estadoActivo;
}

var role;
function procesarSession() {
  if (this.readyState == 4 && this.status == 200) {
    role = this.responseText;
    console.log("role" + role);
    if (
      role != "NOSESSION" &&
      role != "USERSESSION" &&
      role != "ADMINSESSION" &&
      role != "SUPERADMINSESSION"
    ) {
      //console.log('role '+role);
      window.location = "../../comun/logout.php";
    }
    if (role === "ADMINSESSION" || role === "SUPERADMINSESSION") {
      //console.log("role "+role);
      document.getElementById("crearProd").style.visibility = "visible";
      document.getElementById("carrito").style.visibility = "hidden";
    } else {
    }
  }
}
function limpiarTable() {
  document.getElementById("tbody").innerHTML = "";
}

function getURLParams() {
  const queryString = window.location.search;
  console.log(queryString);
  const urlParams = new URLSearchParams(queryString);
  const estadoActivo = urlParams.get('estadoActivo')
  console.log(estadoActivo);
  return estadoActivo;
}

function procesarCategorias() {
  var selectorCategoria = document.getElementById("selectorFiltrado");

  if (this.readyState == 4 && this.status == 200) {
      var stringAll = this.responseText;
      //console.log('string'+stringAll);

      var arrayliCat = stringAll.split("//",);
      //console.log('arrayliCat  '+arrayliCat);
      selectorCategoria.innerHTML = "<option value='0'>Todos los Productos</option>" + "\n";
      for (let i = 0; i < arrayliCat.length - 1; i++) {
          var arraycomponentesCat = arrayliCat[i].split("/");
          selectorCategoria.innerHTML += "<option value=" + arraycomponentesCat[0] + ">" + arraycomponentesCat[1] + "</option>" + "\n"
          //console.log("arrayComponents "+arraycomponentesCat[1]);
      }

  }
}

function loadEvents() {
  document.getElementById("crearProd").style.visibility = "hidden";
  document.getElementById("carrito").style.visibility = "visible";
  comprobarSession();
  loadProductos();
  loadCategorias();

  let errorPedido = getURLParams();
  console.log(errorPedido)
  if (errorPedido === "0") {
    Swal.fire({
      icon: 'info',
      title: 'Ups...',
      text: 'Su Pedido ha sido descartado o finalizado',
    })
  } else {

  }

  document.getElementById("selectorFiltrado").addEventListener("change", (ev) => {
    console.log(ev.target.options.selectedIndex);
    idCat = ev.target.options.selectedIndex;
    pagina = 1;
    limpiarTable();
    loadProductos();
  });
  
  document.getElementById("primera").addEventListener("click", () => {
    pagina = 1;
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("anterior").addEventListener("click", () => {
    if (pagina === 1) {
      pagina = 1;
    } else {
      pagina--;
    }
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("siguiente").addEventListener("click", () => {
    if (pagina === totalPag) {
      pagina = totalPag;
    } else {
      pagina++;
    }
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });
  document.getElementById("ultima").addEventListener("click", () => {
    pagina = totalPag;
    //console.log("pagina"+pagina);
    limpiarTable();
    loadProductos();
  });

  try {
    //console.log("Solo dara error debido a que no se inició sesion");
    document.getElementById("cerrar").addEventListener("click", () => {
      Swal.fire({
        title: "Estas seguro?",
        text: "Una vez cerrada tendrás que volver a iniciar sesión!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Cierra sesión!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          window.open("../../comun/logout.php", "_self");
        }
      });
    });
  } catch (error) {
    console.log("Solo dará error debido a que no se inició sesión");
    console.log(error);
  }
}

function comprobarSession() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = procesarSession;
  xmlhttp.open("GET", "http://localhost/php/comun/comprobarSession.php", true);
  xmlhttp.send();
}
var idCat=0;
var pagina = 1;
function loadProductos() {
  let selectorFiltro = document.getElementById("selectorFiltrado");
  console.log(selectorFiltro);
  console.log("ID CAT :"+idCat);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = procesarProductos;
  xmlhttp.open("GET","http://localhost/php/Productos/modelo/getProductos.php?pagina="+pagina+"&categoria="+idCat,true);
  xmlhttp.send();
}
function añadirProductoCarrito(id, cantidad) {

  //Comprueba la cantidad
  if (cantidad <= 0 || cantidad > 50) {
    Swal.fire({
      icon: 'info',
      title: 'La cantidad no es valida',
      text: 'La cantidad del producto no es valida',
      footer: 'Al eligir un producto solo puede ser 1 o 50 como máximo',
  });
  }else{
    var formData = new FormData();
    formData.append("idProducto", id);
    console.log(id);
    formData.append("cantidad", cantidad);
    console.log(cantidad);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = respCarrito;
    xmlhttp.open("POST", "http://localhost/php/carrito/modelo/carrito.php", true);
    xmlhttp.send(formData);
  
    //Alert proccess
    Swal.fire({
      position: "top-end",
      icon: "success",
      title: "Producto añadido",
      showConfirmButton: false,
      timer: 1500,
    });
  }

}

function loadCategorias() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = procesarCategorias;
  xmlhttp.open("GET", "http://localhost/php/Productos/modelo/getCategorias.php", true);
  xmlhttp.send();
}