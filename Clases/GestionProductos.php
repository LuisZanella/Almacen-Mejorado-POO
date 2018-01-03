<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/01/2018
 * Time: 04:47 PM
 */

class GestionProductos
{
    /*public $id;
    private $con;
    public $cantidadproducto;
    public $cantidadregistrada;
    public $cantidad;
    public $suma;
    public $NombreProducto;
    public function __construct($_con)
    {
        $this->con=$_con;
    }
    */
    public static function AgregarCantidadProducto($conexion)
    {
            $cantidadproducto=$_POST["cantidad"];
            $id=$_POST["idproducto"];

            $cantidadregistrada = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT Cantidad FROM bodega WHERE IdProducto='$id'"));
            $cantidad=$cantidadregistrada['Cantidad'];
            $suma = $cantidad + $cantidadproducto;
            mysqli_query($conexion, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$id'");
    }
    public static function EliminarCantidadProducto($conexion){
        $cantidadproducto=$_POST["cantidad"];
        $id=$_POST["idproducto"];
        $cantidadregistrada = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT Cantidad FROM bodega WHERE IdProducto='$id'"));
        $cantidad=$cantidadregistrada['Cantidad'];
        $suma = $cantidad - $cantidadproducto ;
        if ($suma >= 0) {
            mysqli_query($conexion, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$id'");
            return "si";
        } else {
            return "no";
        }
    }
    public static function EliminarProducto($conexion){
        $id=$_POST["idproducto"];

        $productos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM bodega WHERE IdProducto='$id'"));
        if ($productos != 0) {
            mysqli_query($conexion, "DELETE FROM bodega WHERE IdProducto='$id'");
        }

    }
    public static function AgregarProducto($conexion){
        $cantidadproducto=$_POST["cantidad"];
        $NombreProducto=$_POST["nombre"];

        $productos = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT NombreProducto FROM bodega WHERE NombreProducto='$NombreProducto'"));
        if ($productos == 0) {
            mysqli_query($conexion, "INSERT INTO bodega (NombreProducto,Cantidad) VALUES ('$NombreProducto','$cantidadproducto')");
            return "si";
        } else {
            return "no";
        }
    }

    public static function ModificarProducto($conexion)
    {
        $cantidadproducto=$_POST["cantidad"];
        $NombreProducto=$_POST["nombre"];
        $id=$_POST["idproducto"];

        switch (true) {
            case ($NombreProducto !== "") && ($cantidadproducto !== ""):
                mysqli_query($conexion, "UPDATE bodega Set Cantidad=('$cantidadproducto') WHERE IdProducto='$id'");
                mysqli_query($conexion, "UPDATE bodega Set NombreProducto=('$NombreProducto') WHERE IdProducto='$id'");
                /*$respuesta = "Cantidad y Nombre del Producto modificado";*/
                break;
            case ($NombreProducto !== ""):
                mysqli_query($conexion, "UPDATE bodega Set NombreProducto=('$NombreProducto') WHERE IdProducto='$id'");
                /*$respuesta = "Nombre del Producto modificado";*/
                break;
            case ($cantidadproducto !== ""):
                mysqli_query($conexion, "UPDATE bodega Set Cantidad=('$cantidadproducto') WHERE IdProducto='$id'");
                /*$respuesta = "Cantidad modificada";*/
                break;
            default:
                return false;
                break;
        }
    }
    public function Tabla(){

    }


}