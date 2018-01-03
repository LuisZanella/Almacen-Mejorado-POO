<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 01/01/2018
 * Time: 04:25 PM
 */

namespace Conexion;
class Conexion
{
    public $conexion;
    public function __construct()
    {
        $_conexion=mysqli_connect('localhost', 'root', 'sqlserver', 'almacen');
        $this->conexion=$_conexion;
    }
}
