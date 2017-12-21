$.getScript("http://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js");
cargartabla();
$(document).ready(function () {

        window.onclick = function (event) {
            if (event.target === document.getElementsByClassName('modal')[0]) {
                borrartexto();
                quitarspan();
            }
        };
        $("#Regresar").click(
            function () {
                cargartabla();
                document.getElementById("Regresar").style.display="none";
            }
        );
        $("#salir").click(
            function () {
                borrartexto();
                quitarspan();
            }
        );
        $("#AgregarProductoInicio").click(
            function () {
                aparecermodal();
                aparecerspanparaagregar();
            }
        );
        $("#BuscarProductoInicio").click(
            function () {
                aparecermodal();
                aparecerspanparabuscar();
            }
        );
        $("#AgregarProducto").click(
            function () {
                var nombreproducto = $("#NombreProductoModal").val();
                var cantidadproducto = $("#CantidadProductoModal").val();
                var ejecutar = validar(nombreproducto, cantidadproducto);

                if (ejecutar === true) {
                    $.post("AgregarProducto.php",
                        {nombre: nombreproducto, cantidad: cantidadproducto});
                    borrartexto();
                    quitarspan();
                    cargartabla();
                }
                else {
                    alert(ejecutar);
                }
            }
        );
        $("#BuscarProducto").click(
            function () {
                var nombreproducto = $("#NombreProductoModal").val();
                var ejecutar = validarnombre(nombreproducto);
                if (ejecutar === true) {
                    $.post("Tabla.php",{nombre: nombreproducto,TipoBusqueda:2},
                        function (informacion) {
                            if (informacion === false) {
                                alert("No existe ese producto")
                            }
                            else {
                                cargartablabuscar(informacion);
                                borrartexto();
                                quitarspan();
                                document.getElementById("Regresar").style.display="block";
                            }
                        });
                }
                else {
                    alert(ejecutar);
                }
            });

    $("#ComprarProducto").click
    (
        function () {
            var cantidadproducto = $("#CantidadProductoModal").val();
            var ejecutar = validarcantidad(cantidadproducto);
            if (ejecutar===true)
                $.post("AgregarCantidadProducto.php", {cantidad: cantidadproducto, idproducto: $("#idproducto").val()},
                    function () {
                        borrartexto();
                        quitarspan();
                        cargartabla();
                    });
            else {
                alert(ejecutar);
            }
        }
    );
    $("#ModificarProducto").click (
        function () {
            var cantidadproducto = $("#CantidadProductoModal").val();
            var nombreproducto = $("#NombreProductoModal").val();
            var ejecutar= validarmodificar(nombreproducto,cantidadproducto);
                if(ejecutar===true){
                $.post("ModificarProducto.php", {cantidad: cantidadproducto, idproducto: $("#idproducto").val(),nombre:nombreproducto},
                    function () {
                            borrartexto();
                            quitarspan();
                            cargartabla();
                    });
                }
                else {alert(ejecutar);}
            }
          );
    $("#VenderProducto").click
    (
        function () {
            var cantidadproducto = $("#CantidadProductoModal").val();
            var ejecutar = validarcantidad(cantidadproducto);
            if (ejecutar===true)
                $.post("EliminarCantidadProducto.php", {cantidad: cantidadproducto, idproducto: $("#idproducto").val()},
                    function (respuesta) {
                        if (respuesta!=="***Usted no tiene tanta cantidad de ese producto***"){
                        borrartexto();
                        quitarspan();
                        cargartabla();
                        }
                        else{
                            alert(respuesta);
                        }

                    });
            else {
                alert(ejecutar);
            }
        }
    )
    }
);

function cargartabla() {
    $.post("Tabla.php",{TipoBusqueda:1},
        function (tabla) {
            $('#tabla').html(tabla);
        });
}
function cargartablabuscar(tabla) {
    $('#tabla').html(tabla);
}

function validar(nombreproducto, cantidadproducto) {
    var mensaje = "";
    switch (true) {
        case nombreproducto !== "" && cantidadproducto !== "" && nombreproducto.length <= 50 && !isNaN(parseInt(cantidadproducto)) && cantidadproducto >= 0:
            return true;
        case nombreproducto === "":
            mensaje = mensaje + "--Introduzca un nombre porfavor--";
            break;
        case cantidadproducto === "":
            mensaje = mensaje + "--Introduzca una cantidad al producto--";
            break;
        case isNaN(parseInt(cantidadproducto)):
            mensaje = mensaje + "--Introduzca una cantidad al producto que sea numerica--";
            break;
        case nombreproducto.length > 50:
            mensaje = mensaje + "--El nombre del producto es muy largo debe ser de menos de 50 caracteres--";
            break;
        case cantidadproducto < 0:
            mensaje = mensaje + "--No inserte numero negativos--";
            break;
        default:
            mensaje = mensaje + "--Error desconocido--";
            break;
    }
    return mensaje;
}

function validarcantidad(cantidadproducto) {
    var mensaje = "";
    switch (true) {
        case !isNaN(parseInt(cantidadproducto)) && cantidadproducto >= 0 && cantidadproducto!=="":
            return true;
        case isNaN(parseInt(cantidadproducto)):
            mensaje = mensaje + "--Introduzca una cantidad al producto que sea numerica--";
            break;
        case cantidadproducto < 0:
            mensaje = mensaje + "--No inserte numero negativos--";
            break;

        default:
            mensaje = mensaje + "--Error desconocido--";
            break;
    }
    return mensaje;
}

function validarnombre(nombreproducto) {
    var mensaje = "";
    switch (true) {
        case nombreproducto !== "" && nombreproducto.length <= 50:
            return true;
        case nombreproducto === "":
            mensaje = mensaje + "--Introduzca nombre del producto--";
            break;
        case nombreproducto.length > 50:
            mensaje = mensaje + "--El nombre del producto es muy largo, verifique que sea menor a 50 caracteres--";
            break;
    }
    return mensaje;
}
function validarmodificar(nombreproducto,cantidadproducto) {
    var mensaje="";
    switch (true) {
        case !isNaN(parseInt(cantidadproducto)) && cantidadproducto >= 0 && nombreproducto!=="":
            return true;
        case nombreproducto!=="" && nombreproducto.length<50:
            return true;
        case !isNaN(parseInt(cantidadproducto)) && cantidadproducto >= 0:
            return true;
        case nombreproducto ==="" && isNaN(parseInt(cantidadproducto)) || nombreproducto==="" && cantidadproducto==="":
            mensaje= "--Introduzca un nombre para modificar como mínimo--";
            break;
        case nombreproducto>50:
            mensaje="--El nombre del producto es demasiado largo--";
            break;
        case isNaN(parseInt(cantidadproducto)) :
            mensaje = "--Introduzca una cantidad de producto numerica--";
            break;
        case cantidadproducto < 0:
            mensaje = "--No inserte numero negativos--";
    }
    return mensaje;
}
function borrartexto() {
    $("#NombreProductoModal").val("");
    $("#CantidadProductoModal").val("");
}

function aparecermodal() {
    document.getElementsByClassName("modal")[0].style.display = "block";
}

function quitarspan() {
    document.getElementsByClassName("modal")[0].style.display = "none";
}

function BaseModal() {
    document.getElementsByClassName('modal-header')[0].style.backgroundColor = "";
    document.getElementById("AgregarProducto").style.display = "none";
    document.getElementById("BuscarProducto").style.display = "none";
    document.getElementById("ComprarProducto").style.display = "none";
    document.getElementById("VenderProducto").style.display = "none";
    document.getElementById("ModificarProducto").style.display = "none";

    document.getElementById("ModificarModal").style.display = "none";
    document.getElementById("AgregarModal").style.display = "none";
    document.getElementById("BuscarModal").style.display = "none";
    document.getElementById("CompraVentaModal").style.display = "none";

    document.getElementById("CantidadProductoModal").style.display = "none";
    document.getElementById("NombreProductoModal").style.display = "none";
}

function aparecerspanparaagregar() {
    BaseModal();
    document.getElementById("AgregarProducto").style.display = "block";
    document.getElementById("AgregarModal").style.display = "block";
    document.getElementById("CantidadProductoModal").style.display = "block";
    document.getElementById("NombreProductoModal").style.display = "block";
}

function aparecerspanparabuscar() {
    BaseModal();
    document.getElementsByClassName('modal-header')[0].style.backgroundColor = "dodgerblue";
    document.getElementById("BuscarProducto").style.display = "block";
    document.getElementById("BuscarModal").style.display = "block";
    document.getElementById("NombreProductoModal").style.display = "block";
}

function aparecerspanparacomprarvender() {
    BaseModal();
    document.getElementsByClassName('modal-header')[0].style.backgroundColor = "#e68a00";
    document.getElementById("CompraVentaModal").style.display = "block";
    document.getElementById("ComprarProducto").style.display = "block";
    document.getElementById("VenderProducto").style.display = "block";
    document.getElementById("CantidadProductoModal").style.display = "block";
}
function aparecerspanparamodificar(nombreactual,cantidadactual) {
    BaseModal();
    document.getElementsByClassName('modal-header')[0].style.backgroundColor = "orange";
    document.getElementById("ModificarProducto").style.display = "block";
    document.getElementById("ModificarModal").style.display = "block";
    document.getElementById("CantidadProductoModal").style.display = "block";
    document.getElementById("NombreProductoModal").style.display = "block";
    $("#CantidadProductoModal").val(nombreactual) ;
    $("#NombreProductoModal").val(cantidadactual);
}

function preguntaeliminar(id) {
    /*Tambien se puede utilizar para no usar librerias externas

    if(confirm("seguro?")){
        alert("Hola");
    }
    */
    alertify.confirm('¡ALERTA!', '¿Está seguro de eliminar este elemento?',
        function () {
            eliminardatos(id)
        },
        function () {
            alertify.error('Cancelado')
        }
    )
}

function eliminardatos(id) {
    $.post("EliminarProducto.php", {id: id},
        function () {
            cargartabla();
            alertify.success('Eliminado');
        }
    )
}

function VenderComprar() {
    aparecermodal();
    aparecerspanparacomprarvender();
}

function idproductos(idproducto) {
    $("#idproducto").val(idproducto);
}
function modificar(nombreactual,cantidadactual) {
    aparecermodal();
    aparecerspanparamodificar(nombreactual,cantidadactual);

}