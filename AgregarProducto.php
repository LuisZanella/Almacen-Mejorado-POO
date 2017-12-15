<?php
try{
include_once('conectar.php');
$nombreproductonuevo=$_POST["nombre"];
$cantidadproducto=$_POST["cantidad"];
$respuesta="";

    $productos=mysqli_fetch_assoc(mysqli_query($con,"SELECT NombreProducto FROM bodega WHERE NombreProducto='$nombreproductonuevo'"));
    if ($productos==0){
        mysqli_query($con, "INSERT INTO bodega (NombreProducto,Cantidad) VALUES ('$nombreproductonuevo','$cantidadproducto')");
        $respuesta="$respuesta ~~~~Producto Registrado~~~~~~ ";
    }
    else{
        $respuesta="*********************$respuesta Ese producto ya existe ********************";
    }
}
catch (Exception $ex){
    $respuesta="**********$respuesta Error***************";
}
finally{
   echo $respuesta;
}
