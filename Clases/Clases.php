<?php
include("Conexion.php");
include("GestionProductos.php");
$accion=$_POST["accion"];
try{
    $Gestion=new GestionProductos();
    $Gestion->$accion();
}
catch(Exception $ex){
    echo "Error al llamar la clase conexion";
}
