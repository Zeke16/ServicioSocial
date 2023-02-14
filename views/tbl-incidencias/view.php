<?php

use yii\helpers\Html;

$this->title = 'Detalle de incidencia';
$this->params['breadcrumbs'][] = ['label' => 'Listado de incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                        ?><td><b>Municipio donde sucedio:</b></td>
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
            <div class="card-footer">
                <?php
                if (Yii::$app->user->can('MasterAccess')) {
                ?>
                    <?php echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_incidencia' => $model->id_incidencia], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>
                    <?php echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']) ?>
                <?php
                } ?>
            </div>
        </div>
    </div>
</div>
<?=
$this->render("_grid_estado_incidencia", [
    'model2' => $model2,
    'ubicacion' => $model->ubicacion_incidencia,
    'imagen' => $model->imagen_incidencia
])
?>