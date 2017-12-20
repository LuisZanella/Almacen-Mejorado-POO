<?php
try {
    include_once('conectar.php');
    $idproducto = $_POST["idproducto"];
    $cantidadproducto = $_POST["cantidad"];
    $respuesta = "";
    $suma = 0;

    $cantidadregistrada = mysqli_fetch_assoc(mysqli_query($con, "SELECT Cantidad FROM bodega WHERE IdProducto='$idproducto'"));
        $cantidadproductoregistrada = $cantidadregistrada['Cantidad'];

        $suma = $cantidadproductoregistrada - $cantidadproducto;
        if ($suma >= 0) {

            mysqli_query($con, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$idproducto'");
            $respuesta = "$respuesta Cantidad Producto Restada ";
        } else {
            $respuesta = "$respuesta***Usted no tiene tanta cantidad de ese producto***";
        }
} catch (Exception $ex) {
    $respuesta = "$respuesta Error";
} finally {
    echo $respuesta;
}