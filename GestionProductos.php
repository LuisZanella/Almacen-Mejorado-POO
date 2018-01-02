<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/01/2018
 * Time: 04:47 PM
 */

namespace GestionProductos;


class GestionProductos
{
    public $id;
    public $con;
    public $cantidadproducto;
    public $cantidadregistrada;
    public $cantidad;
    public $suma = 0;
    public $NombreProducto;
    public function __construct($_con,$_id,$_cantidadproducto,$_NombreProducto)
    {
        $this->con=$_con;
        $this->cantidadproducto=$_cantidadproducto;
        $this->id=$_id;
        $this->NombreProducto=$_NombreProducto;
    }
    public function AgregarCantidadProducto()
    {
            $this->cantidadregistrada = mysqli_fetch_assoc(mysqli_query($this->con, "SELECT Cantidad FROM bodega WHERE IdProducto='$this->id'"));
            $this->cantidad=$this->cantidadregistrada['Cantidad'];
            $this->suma = $this->cantidad + $this->cantidadproducto;
            mysqli_query($this->con, "UPDATE bodega Set Cantidad=('$this->suma') WHERE IdProducto='$this->id'");
    }
    public  function EliminarCantidadProducto(){
        $this->cantidadregistrada = mysqli_fetch_assoc(mysqli_query($this->con, "SELECT Cantidad FROM bodega WHERE IdProducto='$this->id'"));
        $this->cantidad=$this->cantidadregistrada['Cantidad'];
        $this->suma = $this->cantidad - $this->cantidadproducto ;
        if ($this->suma >= 0) {
            mysqli_query($this->con, "UPDATE bodega Set Cantidad=('$this->suma') WHERE IdProducto='$this->id'");
            return "si";
        } else {
            return "no";
        }
    }
    public function EliminarProducto(){
        $productos = mysqli_fetch_assoc(mysqli_query($this->con, "SELECT * FROM bodega WHERE IdProducto='$this->id'"));
        if ($productos != 0) {
            mysqli_query($this->con, "DELETE FROM bodega WHERE IdProducto='$this->id'");
        }

    }
    public function AgregarProducto(){
        $productos = mysqli_fetch_assoc(mysqli_query($this->con, "SELECT NombreProducto FROM bodega WHERE NombreProducto='$this->NombreProducto'"));
        if ($productos == 0) {
            mysqli_query($this->con, "INSERT INTO bodega (NombreProducto,Cantidad) VALUES ('$this->NombreProducto','$this->cantidadproducto')");
            return "si";
        } else {
            return "no";
        }
    }

    public function ModificarProducto()
    {
        switch (true) {
            case ($this->NombreProducto !== "") && ($this->cantidadproducto !== ""):
                mysqli_query($this->con, "UPDATE bodega Set Cantidad=('$this->cantidadproducto') WHERE IdProducto='$this->id'");
                mysqli_query($this->con, "UPDATE bodega Set NombreProducto=('$this->NombreProducto') WHERE IdProducto='$this->id'");
                /*$respuesta = "Cantidad y Nombre del Producto modificado";*/
                break;
            case ($this->NombreProducto !== ""):
                mysqli_query($this->con, "UPDATE bodega Set NombreProducto=('$this->NombreProducto') WHERE IdProducto='$this->id'");
                /*$respuesta = "Nombre del Producto modificado";*/
                break;
            case ($this->cantidadproducto !== ""):
                mysqli_query($this->con, "UPDATE bodega Set Cantidad=('$this->cantidadproducto') WHERE IdProducto='$this->id'");
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