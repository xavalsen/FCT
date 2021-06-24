function formatoDireccion() {
    let direccion = document.getElementById("direccion").textContent;
    console.log("dir: " + direccion);
    let direccionsinbarras = direccion.split("//");
    console.log("Sin barras " + direccionsinbarras);
    let arrayComponentesDireccion = direccionsinbarras[0].split("..");
    console.log("Componentes dir " + arrayComponentesDireccion);
    let provincia = document.getElementById("provincia");
    let municipio = document.getElementById("municipio");
    let cp = document.getElementById("cp");
    let Direccion = document.getElementById("Direccion");
    let Numero = document.getElementById("Numero");
    let Piso = document.getElementById("Piso");
    let Bloque = document.getElementById("Bloque");
    let Puerta = document.getElementById("Puerta");
    let Escalera = document.getElementById("Escalera");
    provincia.innerHTML = arrayComponentesDireccion[0];
  
    if (arrayComponentesDireccion[1] == null) {
      municipio.innerHTML = "Sin datos";
    } else {
      municipio.innerHTML = arrayComponentesDireccion[1];
    }
    if (arrayComponentesDireccion[2] == null) {
      cp.innerHTML = "Sin datos";
    } else {
      cp.innerHTML = arrayComponentesDireccion[2];
    }
    if (arrayComponentesDireccion[3] == null) {
      Direccion.innerHTML = "Sin datos";
    } else {
      Direccion.innerHTML = arrayComponentesDireccion[3];
    }
    if (arrayComponentesDireccion[4] == null) {
      Numero.innerHTML = "Sin datos";
    } else {
      Numero.innerHTML = arrayComponentesDireccion[4];
    }
    if (arrayComponentesDireccion[5] == null) {
      Piso.innerHTML = "Sin datos";
    } else {
      Piso.innerHTML = arrayComponentesDireccion[5];
    }
    if (arrayComponentesDireccion[6] == null) {
      Bloque.innerHTML = "Sin datos";
    } else {
      Bloque.innerHTML = arrayComponentesDireccion[6];
    }
    if (arrayComponentesDireccion[7] == null) {
      Puerta.innerHTML = "Sin datos";
    } else {
      Puerta.innerHTML = arrayComponentesDireccion[7];
    }
    if (arrayComponentesDireccion[8] == null) {
      Escalera.innerHTML = "Sin datos";
    } else {
      Escalera.innerHTML = arrayComponentesDireccion[8];
    }
  }
  function loadEvents() {
    formatoDireccion();
  
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
          window.open("../../../comun/logout.php", "_self");
        }
      });
    });
  }
  