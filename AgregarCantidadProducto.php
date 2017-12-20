<?php
    include_once('conectar.php');
    $id = $_POST["idproducto"];
    $cantidadproducto = $_POST["cantidad"];
    $respuesta = "";
    $suma = 0;
        $cantidadregistrada = mysqli_fetch_assoc(mysqli_query($con, "SELECT Cantidad FROM bodega WHERE IdProducto='$id'"));

        $cantidadproductoregistrada = $cantidadregistrada['Cantidad'];

        $suma = $cantidadproductoregistrada + $cantidadproducto;

        mysqli_query($con, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$id'");