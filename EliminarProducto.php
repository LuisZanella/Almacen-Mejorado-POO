<?php
try {
    include_once('conectar.php');
    $id = $_POST["id"];
    $respuesta = "";

    $productos = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bodega WHERE IdProducto='$id'"));
    if ($productos != 0) {
        mysqli_query($con, "DELETE FROM bodega WHERE IdProducto='$id'");
    }
} catch (Exception $ex) {
    $respuesta = "$respuesta Error";
} finally {
    echo $respuesta;
}
