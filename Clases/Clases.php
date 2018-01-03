<?php
include ("Conexion.php");
include ("GestionProductos.php");
$accion=$_POST["accion"];
try{
    $ClaseConexion= new \Conexion\Conexion();
    $conexion=$ClaseConexion->conexion;
    $accion($conexion);
}
catch(Exception $ex){
    $mensaje="$mensaje Error al llamar la clase conexion";
}
finally{
    echo $mensaje;
}
    function AgregarCantidadProducto($conexion){
        $cantidad=$_POST["cantidad"];
        $idproducto=$_POST["idproducto"];
        $GestionProducto= new \GestionProductos\GestionProductos($conexion,$idproducto,$cantidad,Null);
        $GestionProducto->AgregarCantidadProducto();
    }
    function EliminarCantidadProducto($conexion){
        $cantidad=$_POST["cantidad"];
        $idproducto=$_POST["idproducto"];
        $GestionProducto= new \GestionProductos\GestionProductos($conexion,$idproducto,$cantidad,Null);
        $Mensaje= $GestionProducto->EliminarCantidadProducto();
        echo $Mensaje;

    }
    function EliminarProducto($conexion){
        $idproducto=$_POST["idproducto"];
        $GestionProducto= new \GestionProductos\GestionProductos($conexion,$idproducto,Null,Null);
        $GestionProducto->EliminarProducto();
    }
    function ModificarProducto($conexion){
        $cantidad=$_POST["cantidad"];
        $NombreProducto=$_POST["nombre"];
        $idproducto=$_POST["idproducto"];
        $GestionProducto= new \GestionProductos\GestionProductos($conexion,$idproducto,$cantidad,$NombreProducto);
        $Mensaje= $GestionProducto->ModificarProducto();
    }
    function AgregarProducto($conexion){
        $cantidad=$_POST["cantidad"];
        $NombreProducto=$_POST["nombre"];
        $GestionProducto= new \GestionProductos\GestionProductos($conexion,null,$cantidad,$NombreProducto);
        $Mensaje= $GestionProducto->AgregarProducto();
        echo $Mensaje;
    }
    function BuscarProducto($conexion){

    }

