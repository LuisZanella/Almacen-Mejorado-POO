$(document).ready(function () {
        $("#AgregarProductoInicio").click(
            function () {
                aparecermodal()

                window.onclick = function(event) {
                    if (event.target == document.getElementsByClassName('modal')[0]) {
                        quitarspan();
                    }
                }
                $("#salir").click(
                    function () {
                        quitarspan()
                    }
                )
            }

        )


        $("#AgregarProducto").click(
            function () {



                var nombreproducto = $("#NombreProducto").val();
                var cantidadproducto = $("#CantidadProducto").val();
                var ejecutar = validar(nombreproducto, cantidadproducto);

                if (ejecutar == true) {
                    $.post("AgregarProducto.php",
                        {nombre: nombreproducto, cantidad: cantidadproducto},
                        function (informacion) {
                            $("#spanagregar").html(informacion)
                        });
                    borrartexto();
                    quitarspan();

                }
                else {
                    $("#spanagregar").html(ejecutar);
                }
                setTimeout(reloj, 5000)
            }
        )
        $("#AgregarCantidadProducto").click(
            function () {
                var nombreproducto = $("#NombreProducto").val();
                var cantidadproducto = $("#CantidadProducto").val();
                var ejecutar = validar(nombreproducto, cantidadproducto);
                if (ejecutar == true) {
                    $.post("AgregarCantidadProducto.php",
                        {nombre: nombreproducto, cantidad: cantidadproducto},
                        function (informacion) {
                            $("#exito").html(informacion)
                        });
                    borrartexto();
                }
                else {
                    $("#exito").html(ejecutar);
                }
            }
        )
        $("#BuscarProducto").click(
            function () {
                var nombreproducto = $("#NombreProducto").val();
                var ejecutar = validarnombre(nombreproducto);
                if (ejecutar == true) {
                    $.post("BuscarProducto.php",
                        {nombre: nombreproducto},
                        function (informacion) {
                            $("#exito").html(informacion)
                        });
                    borrartexto();
                }
                else {
                    $("#exito").html(ejecutar);
                }

            })


        $("#VerProducto").click(
            function () {
                $.get("VerProducto.php",
                    function (informacion) {
                        $("#exito").html(informacion)
                    });
                borrartexto();
            })


        $("#EliminarProducto").click(
            function () {
                var nombreproducto = $("#NombreProducto").val();
                var ejecutar = validarnombre(nombreproducto);
                if (ejecutar == true) {
                    $.post("EliminarProducto.php",
                        {nombre: nombreproducto},
                        function (informacion) {
                            $("#exito").html(informacion)
                        });
                    borrartexto();
                }
                else {
                    $("#exito").html(ejecutar);
                }
            })

        $("#EliminarCantidadProducto").click(

            )
    }
)

function validar(nombreproducto, cantidadproducto) {
    var mensaje = "";
    switch (true) {
        case nombreproducto !== "" && cantidadproducto !== "" && nombreproducto.length <= 50 && (isNaN(parseInt(cantidadproducto))) == false && cantidadproducto >= 0:
            return true;
            break;
        case nombreproducto == "":
            mensaje = mensaje + "--Introduzca un nombre porfavor--";
            break;
        case (isNaN(parseInt(cantidadproducto)) == true):
            mensaje = mensaje + "--Introduzca una cantidad al producto que sea numerica--"
            break;
        case cantidadproducto == "":
            mensaje = mensaje + "--Introduzca una cantidad al producto--";
            break;
        case nombreproducto.length > 50:
            mensaje = mensaje + "--El nombre del producto es muy largo debe ser de menos de 50 caracteres--";
            break;
        case cantidadproducto < 0:
            mensaje = mensaje + "--No inserte numero negativos--";
            break;
        default:
            mensaje = mensaje + "--Error desconocido--"
            break;
    }
    return mensaje;
}

function validarnombre(nombreproducto) {
    var mensaje = "";
    switch (true) {
        case nombreproducto !== "" && nombreproducto.length <= 50:
            return true;
            break;
        case nombreproducto == "":
            mensaje = mensaje + "--Introduzca nombre del producto--";
            break;
        case nombreproducto.length > 50:
            mensaje = mensaje + "--El nombre del producto es muy largo, verifique que sea menor a 50 caracteres--";
            break;
    }
    return mensaje;
}

function borrartexto() {
    document.getElementById("NombreProducto").value = "";
    document.getElementById("CantidadProducto").value = "";
}

function aparecermodal() {
    document.getElementsByClassName("modal")[0].style.display="block";
}
function reloj() {
        $("#spanagregar").html("")
}
function quitarspan() {
    document.getElementsByClassName('modal')[0].style.display= "none";
}