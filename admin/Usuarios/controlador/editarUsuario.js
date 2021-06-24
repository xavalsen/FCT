function procesarUsuario() {
    if (this.readyState == 4 && this.status == 200) {
        var string = this.responseText;
        //console.log('string' + string);

        var arrayAtributosUsuario = string.split("/");
        //console.log('arrayAtributosUsuario  ' + arrayAtributosUsuario);
        var nombre = document.getElementById("nombre");
        nombre.setAttribute("value", arrayAtributosUsuario[0]);
        var email = document.getElementById("email");
        email.setAttribute("value", arrayAtributosUsuario[1]);
        var telefono = document.getElementById("telefono");
        telefono.setAttribute("value", arrayAtributosUsuario[2]);
        //console.log('sds '+arrayAtributosUsuario[3]);
        let idRole = parseInt(arrayAtributosUsuario[3]) - 1;
        document.getElementById("selectorRole").selectedIndex = idRole;
        document.getElementById("IDRole").setAttribute("value", arrayAtributosUsuario[3]);




    }
}
function procesarRoles() {
    var selectorRole = document.getElementById("selectorRole");
    if (this.readyState == 4 && this.status == 200) {
        var stringAll = this.responseText;
        //console.log('stringRoles '+stringAll);

        var arrayliRole = stringAll.split("//",);
        // console.log('arrayliRole  '+arrayliRole);

        for (let i = 0; i < arrayliRole.length - 1; i++) {
            var arraycomponentesRoles = arrayliRole[i].split("/");
            selectorRole.innerHTML += "<option value=" + arraycomponentesRoles[0] + ">" + arraycomponentesRoles[1] + "</option>" + "\n"
            //console.log("arrayComponents "+arraycomponentesRoles[1]);

        }



    }
}


var role;
function procesarSession() {
    if (this.readyState == 4 && this.status == 200) {
        role = this.responseText;
        console.log('role' + role);
        if (role != "SUPERADMINSESSION") {
            window.location = "../../../comun/logout.php";
        }
    }
}
function getURLParamsError() {
    const queryString = window.location.search;
    console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const error = urlParams.get('error')
    console.log(error);
    return error;
}

let error = getURLParamsError();
console.log(error)
if (error != null) {
    Swal.fire({
        icon: 'info',
        title: 'Vaya',
        text: error,
    })
} else {

}
function getURLParams() {
        const queryString = window.location.search;
        console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const IDUsuario = urlParams.get('i')
        console.log(IDUsuario);
        return IDUsuario;
    }
function loadEvents() {
    comprobarSession();
    var idUsuario = getURLParams();
    console.log('id: '+idUsuario);
    
    document.getElementById("idUsuario").setAttribute("value", idUsuario);
    loadRoles();
    loadUsuarios();

    var selectorRole = document.getElementById("selectorRole");
    selectorRole.addEventListener("change", () => {
        let index = selectorRole.options[selectorRole.selectedIndex].value;
        document.getElementById("IDRole").setAttribute("value", index);
    });
    document.getElementById("eliminar").addEventListener("click", () => {

        Swal.fire({
            title: 'Estas seguro?',
            text: "Una vez eliminado no podrás recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Elimínelo!',
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('hola estoy confirmando eliminar'+idUsuario);
                window.location = "../modelo/eliminarUsuario.php?idUser=" + idUsuario;
                
                /* Read more about handling dismissals below */
            } 
            // else if (result.dismiss === Swal.DismissReason.cancel) {
            //     window.location = "../vista/listaUsuarios.php";
            // }
        },
           event.preventDefault()
        );
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
    xmlhttp.open("GET", "http://localhost/php/comun/comprobarSession.php", true);
    xmlhttp.send();
}
function loadUsuarios() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarUsuario;
    xmlhttp.open("GET", "http://localhost/php/admin/Usuarios/modelo/getUsuarioPorID.php?id=" + getURLParams(), true);
    xmlhttp.send();
}

function loadRoles() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = procesarRoles;
    xmlhttp.open("GET", "http://localhost/php/admin/Usuarios/modelo/getRoles.php", true);
    xmlhttp.send();
}
