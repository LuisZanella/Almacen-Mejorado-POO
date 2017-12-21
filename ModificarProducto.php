<?php
include_once('conectar.php');
$idproducto = $_POST["idproducto"];
$nombre=$_POST["nombre"];
$cantidad=$_POST["cantidad"];
   switch (true){
       case ($nombre!=="") && ($cantidad!==""):
           $querycantidad=mysqli_query($con, "UPDATE bodega Set Cantidad=('$cantidad') WHERE IdProducto='$idproducto'");
           $querynombre=mysqli_query($con, "UPDATE bodega Set NombreProducto=('$nombre') WHERE IdProducto='$idproducto'");
           $respuesta="Cantidad y Nombre del Producto modificado";
           break;
       case ($nombre!==""):
           $querynombre=mysqli_query($con, "UPDATE bodega Set NombreProducto=('$nombre') WHERE IdProducto='$idproducto'");
           $respuesta="Nombre del Producto modificado";
           break;
       case ($cantidad!==""):
           $querycantidad=mysqli_query($con, "UPDATE bodega Set Cantidad=('$cantidad') WHERE IdProducto='$idproducto'");
           $respuesta="Cantidad modificada";
           break;
       default:
           return false;
           break;
   }