var totalPag;
function procesarPedidos() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        //console.log('string: ' + string);

        var k = string.indexOf("#");
        //console.log('k' + k);

        var paginacion = string.slice(k + 1, string.length);
        totalPag = parseInt(paginacion);
        // console.log('pag:' + paginacion);


        var stringPedidos = string.slice(0, k);
        //console.log('string' + stringPedidos);

        var arrayliPedidos = stringPedidos.split("//").filter(Boolean);
        //console.log('arrayliPedidos  ' + arrayliPedidos);
        var numero = 1;
        arrayliPedidos.forEach(element => {
            var arrayCadaPedido = element.split('/__');
            // console.log('arrayCadaPedido ' + arrayCadaPedido);
            // console.log('Cod pedido: ' + arrayCadaPedido[0]);
            // console.log('Nombre cliente: ' + arrayCadaPedido[1]);
            // console.log('Teléfono: ' + arrayCadaPedido[2]);
            // console.log('Dirección: ' + arrayCadaPedido[3]);
            // console.log('Comentario: ' + arrayCadaPedido[4]);
            // console.log('Precio total: ' + arrayCadaPedido[5]);
            // console.log('Hora: ' + arrayCadaPedido[6]);
            // console.log('Estado: ' + arrayCadaPedido[7]);
            // console.log('ID_Estado: ' + arrayCadaPedido[8]);
            // console.log('Activo: ' + arrayCadaPedido[9]);
            var td1 = document.createElement("td");
            td1.innerHTML = arrayCadaPedido[0];
            td1.id = numero + "td1";
            var td2 = document.createElement("td");
            td2.innerHTML = arrayCadaPedido[1];
            td2.id = numero + "td2";
            var td3 = document.createElement("td");
            td3.id = numero + "td3";
            td3.innerHTML = arrayCadaPedido[2];
            var td4 = document.createElement("td");
            td4.id = numero + "td4";
            td4.innerHTML = arrayCadaPedido[3];
            var td5 = document.createElement("td");
            td5.id = numero + "td5";
            td5.innerHTML = arrayCadaPedido[4];
            var td6 = document.createElement("td");
            td6.id = numero + "td6";
            td6.innerHTML = arrayCadaPedido[5] + "€";
            var td7 = document.createElement("td");
            td7.id = numero + "td7";
            td7.innerHTML = arrayCadaPedido[6];
            var td8 = document.createElement("td");
            td8.id = numero + "td8";
            if (arrayCadaPedido[8] == 6) {
                console.log(arrayCadaPedido[8]);
                td8.style.backgroundColor = "#F12222"
                td8.innerHTML = arrayCadaPedido[7];
            } else if (arrayCadaPedido[8] == 5) {
                td8.style.backgroundColor = "yellow"
                td8.innerHTML = arrayCadaPedido[7];
            } else if (arrayCadaPedido[8] == 4) {
                td8.style.backgroundColor = "#85F130"
                td8.innerHTML = arrayCadaPedido[7];
            } else if (arrayCadaPedido[8] == 3) {
                td8.style.backgroundColor = "#85C1E9"
                td8.innerHTML = arrayCadaPedido[7];
            } else if (arrayCadaPedido[8] == 2) {
                td8.style.backgroundColor = "#D9FF6B"
                td8.innerHTML = arrayCadaPedido[7];
            } else {
                td8.style.backgroundColor = "#E5E7E9"
                td8.innerHTML = arrayCadaPedido[7];
            }
            var td9 = document.createElement("td");
            td9.id = numero + "td9";
            let btnEstado = document.createElement("button");
            btnEstado.id = numero + "btnEditar";
            btnEstado.innerHTML = "Cambiar estado";
            btnEstado.onclick = cambiarEstado;
            let vistaPedidoPorID = document.createElement("a");
            let vistaPedidoPorIco = document.createElement("i");
            vistaPedidoPorIco.classList = "bi bi-eye";
            vistaPedidoPorID.href = "../vista/vistaPedidoPorID.php?idPedido=" + arrayCadaPedido[0];

            vistaPedidoPorID.appendChild(vistaPedidoPorIco);
            td9.appendChild(vistaPedidoPorID);
            td9.appendChild(btnEstado);
            td9.insertBefore(btnEstado, vistaPedidoPorID);

            let tbody = document.getElementById("tbody");
            let tr = document.createElement("tr");

            //Set styles
            td1.classList = "text-center";
            td2.classList = "text-center";
            td3.classList = "text-center";
            td4.classList = "text-center";
            td5.classList = "text-center";
            td6.classList = "text-center";
            td7.classList = "text-center";
            td8.classList = "text-center";
            td9.classList = "text-center";
            btnEstado.classList = " btn btn-warning my-1";
            vistaPedidoPorID.classList = "btn btn-primary ms-1";
            tr.classList = "border-bottom border-dark overflow-auto";

            tbody.appendChild(tr);
            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            tr.appendChild(td7);
            tr.appendChild(td8);
            tr.appendChild(td9);

            numero++;
            //Muestra la pagina actual y el total de paginas
            try {
                document.getElementById("contador").innerText = totalPag;
                document.getElementById("contadorActual").innerText = pagina;

            } catch (error) {
                console.log("Si aparece este error es porque no hay contenido");
            }
        });
    }
}
var idPedido;
function cambiarEstado() {
    //console.log(this.id);
    let row = this.id.slice(0, 1);
    //console.log(row)
    idPedido = document.getElementById(row + "td1").textContent;
    console.log(idPedido)
    loadPedidoPorID();
    //let resp =enviarDatatoUpdateEstado();

}
function procesarPedidoxID() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        console.log('string: ' + string);
        let pedido = string.split("/");
        //console.log(pedido)
        document.getElementById("divCambioEstado").style = "display:block";
        let selectEstados = document.getElementById("selectEstados");
        selectEstados.selectedIndex = pedido[1] - 1;

    }
}

/*function enviarDatatoUpdateEstado(idPedido){
    var indexOption;
    let selectEstados = document.getElementById("selectEstados");
    selectEstados.addEventListener("change",()=>{
        indexOption = selectEstados.options[selectEstados.selectedIndex].value;
        console.log("idPedido: "+idPedido+" idEstado: "+indexOption);
    });
    //indexOption= selectEstados.options[selectEstados.selectedIndex].value;
     
    //updateEstado(idPedido,indexOption);
    
    
    
}*/
function procesarEstado() {
    let selectEstados = document.getElementById("selectEstados");
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        //console.log(string)
        let lineaEstado = string.split("//");
        for (let index = 0; index < lineaEstado.length - 1; index++) {
            let cadaEstado = lineaEstado[index].split("/");//Array cada estado cadaEstado[0]->ID_Estado ...[1] -> Estado lo usamos para poder llenar el select del swal

            selectEstados.innerHTML += "<option value=" + cadaEstado[0] + ">" + cadaEstado[1] + "</option>" + "\n"
            //console.log(cadaEstado)
        }
    }

}

function respUpdateEstado() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        console.log('s: ' + string);
        loadPedidos();
        limpiarTable();
        document.getElementById("divCambioEstado").style = "display:none";


    }

}
var role;
function procesarSession() {
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role' + role);
        if ((role != "NOSESSION" && role != "USERSESSION" && role != "ADMINSESSION" && role != "SUPERADMINSESSION")) {
            //console.log('role '+role);
            window.location = "../../../comun/logout.php";
        } else {
            if (role === "ADMINSESSION") {
                console.log("role " + role);
                return;
            } else {
                window.location = "../../../comun/logout.php";
            }
        }

    }
}
function limpiarTable() {
    document.getElementById("tbody").innerHTML = "";
}
function loadEvents() {
    comprobarSession();
    loadEstado();
    loadPedidos();
    let selectEstados = document.getElementById("selectEstados");
    let botonConfirmar = document.getElementById("btnConfirmarCambios");
    botonConfirmar.addEventListener("click", () => {
        Swal.fire({
            title: 'Estas seguro que desea cambiar el estado del pedido?',
            text: "Recuerda que una vez confirmado va a cambiar el estado del pedido!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar Cambio!',
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                let indexOption = selectEstados.options[selectEstados.selectedIndex].value;
                updateEstado(indexOption);
                Swal.fire(
                    'Estado actualizado!',
                    'El estado del pedido se actualizado correctamente',
                    'success'
                )
            }
        })


    })
    /*optionsdelSelect.addEventListener("click",()=>{
        let indexOption = selectEstados.options[selectEstados.selectedIndex].value;
        updateEstado(indexOption);
    });*/
    // selectEstados.addEventListener("",()=>{
    //     let indexOption = selectEstados.options[selectEstados.selectedIndex].value;
    //     updateEstado(indexOption);
    // });

    document.getElementById("primera").addEventListener("click", () => {
        pagina = 1;
        //console.log("pagina"+pagina);
        loadPedidos();
        limpiarTable();
    });
    document.getElementById("anterior").addEventListener("click", () => {
        if (pagina === 1) {
            pagina = 1;
        } else {
            pagina--;
        }
        //console.log("pagina"+pagina);
        loadPedidos();
        limpiarTable();
    });
    document.getElementById("siguiente").addEventListener("click", () => {
        if (pagina === totalPag) {
            pagina = totalPag;
        } else {
            pagina++;
        }
        //console.log("pagina"+pagina);
        loadPedidos();
        limpiarTable();
    });
    document.getElementById("ultima").addEventListener("click", () => {
        pagina = totalPag;
        //console.log("pagina"+pagina);
        loadPedidos();
        limpiarTable();
    });
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

function comprobarSession() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarSession;
    xmlhttp.open("GET", "http://localhost/practicas/comun/comprobarSession.php", true);
    xmlhttp.send();
}
function updateEstado(idEstado) {
    let formData = new FormData();
    formData.append("idPedido", idPedido);
    formData.append("idEstado", idEstado);
    console.log(`idPedido ${idPedido} i idEstado ${idEstado}`)
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = respUpdateEstado;
    xmlhttp.open("POST", "http://localhost/practicas/admin/pedido/modelo/cambiarEstados.php", true);
    xmlhttp.send(formData);
}
function loadEstado() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarEstado;
    xmlhttp.open("GET", "http://localhost/practicas/admin/pedido/modelo/getEstados.php", true);
    xmlhttp.send();
}
var pagina = 1;
function loadPedidos() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarPedidos;
    xmlhttp.open("GET", "http://localhost/practicas/admin/pedido/modelo/getPedidos.php?pagina=" + pagina, true);
    xmlhttp.send();
}
function loadPedidoPorID() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarPedidoxID;
    xmlhttp.open("GET", "http://localhost/practicas/admin/pedido/modelo/getPedidoPorID.php?idPedido=" + idPedido, true);
    xmlhttp.send();
}