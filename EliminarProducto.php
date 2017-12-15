<?php
try{
    include_once('conectar.php');
    $nombreproducto=$_POST["nombre"];
    $respuesta="";

    $productos=mysqli_fetch_assoc(mysqli_query($con,"SELECT NombreProducto FROM bodega WHERE NombreProducto='$nombreproducto'"));
    if ($productos!=0){
        mysqli_query($con, "DELETE FROM bodega WHERE NombreProducto='$nombreproducto'");
        $respuesta="$respuesta Producto eliminado ";
    }
    else{
        $respuesta="$respuesta Ese producto no existe ";
    }
}
catch (Exception $ex){
    $respuesta="$respuesta Error";
}
finally{
    echo $respuesta;
}
