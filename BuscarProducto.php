<?php
try {
    include_once('conectar.php');
    $nombreproducto = $_POST["nombre"];
    $respuesta = "";
    $consulta = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bodega WHERE NombreProducto='$nombreproducto'"));
    if ($consulta > 0) {
        $cantidadproducto = $consulta['Cantidad'];
        $nombre = $consulta['NombreProducto'];
        echo "<table>" .
            "<tr>" .
            "<th>" . "Nombre del producto" . "</th>" .
            "<th>" . "Cantidad" . "</th>" .
            "</tr>";
        echo
        "<tr>
                <td>$nombre</td>
                <td>$cantidadproducto</td>
          </tr>
        </table>";


    } else {
        $respuesta = "$respuesta No existe el producto con el nombre: $nombreproducto";
    }


} catch (Exception $exception) {
    $respuesta = "$respuesta Error";
} finally {
    echo $respuesta;
}