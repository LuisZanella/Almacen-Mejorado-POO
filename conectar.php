<?php
try {
    ini_set("display_errors", 1);
    $con = mysqli_connect('localhost', 'root', 'sqlserver', 'almacen');
} catch (Exception $ex) {
    echo "Error: No se pudo conectar a MySQL." . $ex->getMessage();
}