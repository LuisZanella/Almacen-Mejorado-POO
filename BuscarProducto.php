<?php
try {
    include_once('conectar.php');
    $nombre = $_POST["nombre"];
    $respuesta = "";
    $consulta = mysqli_query($con, "SELECT * FROM bodega WHERE NombreProducto='$nombre'");
    if (mysqli_num_rows($consulta) > 0) {
        ?>
        <div class="row">
            <div class="col-sm-12">
                <table>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Cantidad</th>
                        <th>Accion</th>
                    </tr>
                    <?php while ($ver = mysqli_fetch_row($consulta)) { ?>
                        <tr>
                            <td><?php echo $ver[1] ?></td>
                            <td><?php echo $ver[2] ?></td>
                            <td>
                                <input class="btn btn-success col-sm-5 material-icons" type="button" value="attach_money"
                                       id="VenderComprar"
                                       onclick="idproductos('<?php echo $ver[0] ?>')">
                                <input class="btn btn-danger col-sm-5 material-icons" type="button" value="delete_sweep"
                                       id="EliminarProducto" onclick="preguntaeliminar('<?php echo $ver[0] ?>')">
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <?php
        return true;
    }
    else{
        return false;
    }
}
catch (Exception $ex){
    return false;
}
    ?>