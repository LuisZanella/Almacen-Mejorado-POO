<?php
try {
    include_once('conectar.php');
    $nombreproducto = $_POST["nombre"];
    $cantidadproducto = $_POST["cantidad"];
    $respuesta = "";
    $suma = 0;

    $productos = mysqli_fetch_assoc(mysqli_query($con, "SELECT NombreProducto FROM bodega WHERE NombreProducto='$nombreproducto'"));

    if ($productos != 0) {

        $cantidadregistrada = mysqli_fetch_assoc(mysqli_query($con, "SELECT Cantidad FROM bodega WHERE NombreProducto='$nombreproducto'"));
        $cantidadproductoregistrada = $cantidadregistrada['Cantidad'];

        $suma = $cantidadproductoregistrada - $cantidadproducto;
        if ($suma >= 0) {

            mysqli_query($con, "UPDATE bodega Set Cantidad=('$suma') WHERE NombreProducto='$nombreproducto'");
            $respuesta = "$respuesta Cantidad Producto Restada ";
        } else {
            $respuesta = "$respuesta***Usted no tiene tanta cantidad de ese producto***";
        }
    } else {
        $respuesta = "$respuesta Ese producto no existe ";
    }
} catch (Exception $ex) {
    $respuesta = "$respuesta Error";
} finally {
    echo $respuesta;
}