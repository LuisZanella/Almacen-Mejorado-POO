<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/01/2018
 * Time: 04:47 PM
 */

class GestionProductos
{
    public $Conexion;
    public $Id;
    public $CantidadProducto;
    public $NombreProducto;
    public $TipoTabla;
    public $consulta;
    public $CantidadRegistrada;
    public $Cantidad;
    public function __construct()
    {
        $_conexion=new Conexion();
        $_conexion=$_conexion->conexion;
        $this->Conexion=$_conexion;
        $this->CantidadProducto=$_POST["cantidad"];
        $this->Id=$_POST["idproducto"];
        $this->NombreProducto=$_POST["nombre"];
        $this->TipoTabla=$_POST["TipoBusqueda"];
        $Cantidad=mysqli_fetch_assoc(mysqli_query($this->Conexion, "SELECT Cantidad FROM bodega WHERE IdProducto='$this->Id'"));
        $this->CantidadRegistrada=$Cantidad['Cantidad'];
    }
    public function AgregarCantidadProducto()
    {
            $suma = $this->CantidadRegistrada + $this->CantidadProducto;

            mysqli_query($this->Conexion, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$this->Id'");
    }
    public function EliminarCantidadProducto(){
             $suma = $this->CantidadRegistrada - $this->CantidadProducto ;

        if ($suma >= 0) {
            mysqli_query($this->Conexion, "UPDATE bodega Set Cantidad=('$suma') WHERE IdProducto='$this->Id'");
            echo "si";
        } else {
            echo "no";
        }
    }
    public function EliminarProducto(){
        $productos = mysqli_fetch_assoc(mysqli_query($this->Conexion, "SELECT * FROM bodega WHERE IdProducto='$this->Id'"));
        if ($productos != 0) {
            mysqli_query($this->Conexion, "DELETE FROM bodega WHERE IdProducto='$this->Id'");
        }

    }
    public function AgregarProducto(){
        $productos = mysqli_fetch_assoc(mysqli_query($this->Conexion, "SELECT NombreProducto FROM bodega WHERE NombreProducto='$this->NombreProducto'"));
        if ($productos == 0) {
            mysqli_query($this->Conexion, "INSERT INTO bodega (NombreProducto,Cantidad) VALUES ('$this->NombreProducto','$this->CantidadProducto')");
            echo "si";
        } else {
            echo "no";
        }
    }

    public function ModificarProducto()
    {
        switch (true) {
            case ($this->NombreProducto !== "") && ($this->CantidadProducto !== ""):
                mysqli_query($this->Conexion, "UPDATE bodega Set Cantidad=('$this->CantidadProducto') WHERE IdProducto='$this->Id'");
                mysqli_query($this->Conexion, "UPDATE bodega Set NombreProducto=('$this->NombreProducto') WHERE IdProducto='$this->Id'");
                $respuesta = "Cantidad y Nombre del Producto modificado";
                echo $respuesta;
                break;
            case ($this->NombreProducto !== ""):
                mysqli_query($this->Conexion, "UPDATE bodega Set NombreProducto=('$this->NombreProducto') WHERE IdProducto='$this->Id'");
                $respuesta = "Nombre del Producto modificado";
                echo $respuesta;
                break;
            case ($this->CantidadProducto !== ""):
                mysqli_query($this->Conexion, "UPDATE bodega Set Cantidad=('$this->CantidadProducto') WHERE IdProducto='$this->Id'");
                $respuesta = "Cantidad modificada";
                echo $respuesta;
                break;
            default:
                echo "Error";
                break;
        }
    }
    public function Tabla(){

        ob_clean();
        ob_start();
            $this->TipoDeBusqueda();
            $devuelta=$this->consulta;
        include ("C:\Users\Luis\PhpstormProjects\Almacen\Index\PruebaTabla.php");
    }
    public function TipoDeBusqueda(){
        switch ($this->TipoTabla){
            case "uno":
                $consulta = mysqli_query($this->Conexion, "SELECT * FROM bodega ORDER BY NombreProducto ASC");
                $this->consulta=$consulta;
                break;
            case "dos":
                $consulta = mysqli_query($this->Conexion, "SELECT * FROM bodega WHERE NombreProducto LIKE '%$this->NombreProducto%'");
                $this->consulta=$consulta;
                break;
            default:
                return false;
        }
    }

}