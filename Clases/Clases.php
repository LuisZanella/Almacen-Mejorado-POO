<?php
include("Conexion.php");
include("GestionProductos.php");
$accion=$_POST["accion"];
try{
    $conexion=new Conexion();
    $conexion=$conexion->conexion;
    $accion($conexion);
}
catch(Exception $ex){
    echo "Error al llamar la clase conexion";
}
    function AgregarCantidadProducto($conexion){
    GestionProductos::AgregarCantidadProducto($conexion);
    }
    function EliminarCantidadProducto($conexion){
    $mensaje=GestionProductos::EliminarCantidadProducto($conexion);
        echo $mensaje;

    }
    function EliminarProducto($conexion){
    GestionProductos::EliminarProducto($conexion);
    }
    function ModificarProducto($conexion){
    GestionProductos::ModificarProducto($conexion);
    }
    function AgregarProducto($conexion){
        $mensaje=GestionProductos::AgregarProducto($conexion);
        echo $mensaje;
    }

