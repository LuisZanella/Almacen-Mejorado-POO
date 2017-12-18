<link rel="stylesheet" href="editado.css">
<?php
try {
    include_once('conectar.php');
    $respuesta = "";
    $consulta = mysqli_query($con, "SELECT * FROM bodega ORDER BY NombreProducto ASC");
    $tamanio = mysqli_num_rows($consulta);
    if ($tamanio > 0) {
        echo "<table>" .
            "<tr>" .
            "<th>" . "Nombre del producto" . "</th>" .
            "<th>" . "Cantidad" . "</th>" .
            "<th>" . "Comprar" . "</th>" .
            "<th>" . "Vender" . "</th>" .
            "<th>" . "Eliminar" . "</th>" .
            "</tr>";

        for ($i = 0; $i < $tamanio; $i++) {
            $fila = mysqli_fetch_array($consulta);
            echo "<tr>"
                . "<td>" . $fila["NombreProducto"] . "</td>"
                . "<td> " . $fila["Cantidad"] . "</td>"
                ."<td>". "<input class=\"btn btn-info col-sm-12\" type=\"button\" 
                 value=\"Venta\" id=\"EliminarCantidadProducto\">" ."</td>"
                ."<td>". "<input class=\"btn btn-info col-sm-12\" type=\"button\" 
                 value=\"Compra\" id=\"AgregarCantidadProducto\">" ."</td>"
                ."<td>"."<input class=\"btn btn-danger col-sm-12\" type=\"button\"
                 value=\"Eliminar Producto\" id=\"EliminarProducto\">"."</td>"
                . "</tr>";
        }
        echo "</table>";
    } else {
        $respuesta = "$respuesta No existen productos";
    }
} catch (Exception $exception) {
    $respuesta = "$respuesta Error";
} finally {
    echo $respuesta;
}
