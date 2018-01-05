<div class="row">
    <div class="col-sm-12">
        <table>
            <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
                <th>Accion</th>
            </tr>
            <?php
            while ($ver=(mysqli_fetch_row($devuelta))):
                ?>
                <tr>
                    <td><?php echo $ver[1] ?></td>
                    <td><?php echo $ver[2] ?></td>
                    <td>
                        <div class="row">
                        <div class="col-sm-3">
                            <a title="Vender/Comprar" class="btn btn-sm btn-success" type="button" id="VenderComprar"
                               onclick="idproductos('<?php $ver[0] ?>'); VenderComprar();"><i
                                        class="material-icons">attach_money</i></a>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-sm btn-warning" type="button" id="ModificarProductoInicio"
                               onclick="idproductos('<?php echo $ver[0] ?>'); modificar('<?php echo $ver[2] ?>','<?php echo $ver[1] ?>');"><i
                                        class="material-icons">mode_edit</i></a>
                        </div>
                        <div class="col-sm-3">
                            <a class="btn btn-sm btn-danger" type="button" id="EliminarProducto"
                               onclick="preguntaeliminar('<?php echo $ver[0] ?>')"><i class="material-icons">delete_sweep</i></a>
                        </div>
                        </div>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
        </table>
    </div>
</div>