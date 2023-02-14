<?php

use yii\helpers\Html;
?>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <?php

                    echo $model->tipoIncidencia->nombre_incidencia;

                    ?>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="30%"><b>Reportado por:</b></td>
                        <?php
                        if (Yii::$app->user->can('MasterAccess')) {
                        ?>
                            <td> <?= Html::a($model->usuario->nombreCompleto,  ['usuarios/view', 'id_usuario' => $model->id_usuario]); ?></td>
                        <?php
                        } else {
                        ?>
                            <td> <?= $model->usuario->nombreCompleto ?></td>
                        <?php
                        }
                        ?>
                        <td><b>Municipio donde sucedio:</b></td>
                        <td><?= $model->municipio->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripcion de la incidencia:</b></td>
                        <td colspan="3"><?= $model->descripcion_incidencia ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha del suceso:</b></td>
                        <td><?= $model->fecha_registro ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?=
$this->render("_mapaDetalles", [
    'model2' => $model2,
    'ubicacion' => $model->ubicacion_incidencia,
    'imagen' => $model->imagen_incidencia
])
?>