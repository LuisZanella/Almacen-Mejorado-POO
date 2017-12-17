<link rel="stylesheet" href="editado.css">
<?php
try {
    include_once('conectar.php');
    $respuesta = "";
    $consulta = mysqli_query($con, "SELECT * FROM bodega ORDER BY NombreProducto ASC");
    $tamanio = mysqli_num_rows($consulta);
    if ($tamanio > 0) {
        echo "<table list-style-type: class='TFtable col-sm-8'>" .
            "<tr>" .
            "<th>" . "Nombre del producto" . "</th>" .
            "<th>" . "Cantidad" . "</th>" .
            "</tr>";

        for ($i = 0; $i < $tamanio; $i++) {
            $fila = mysqli_fetch_array($consulta);
            echo "<tr>" . "<td>" . $fila["NombreProducto"] . "</td>" . "<td> " . $fila["Cantidad"] . "</td>" . "</tr>";
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
