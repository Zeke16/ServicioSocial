<?php

use yii\helpers\Html;

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <?php
                    if ($model->tipoIncidencia->nombre_incidencia == "Otro") {
                        echo $model->incidencia_otro;
                    } else {
                        echo $model->tipoIncidencia->nombre_incidencia;
                    }
                    ?>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="30%"><b>Reportado por:</b></td>
                        <td> <?= Html::a($model->usuario->nombreCompleto,  ['usuarios/view', 'id_usuario' => $model->id_usuario]); ?></td>
                        <td><b>Municipio donde sucedio:</b></td>
                        <td><?= $model->municipio->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Descripcion de la incidencia:</b></td>
                        <td colspan="3"><?= $model->descripcion_incidencia ?></td>
                    </tr>
                    <tr>
                        <td width="30%"><b>Lugar donde sucedio:</b></td>
                        <td><?= $model->lugar_incidencia ?></td>
                        <td><b>Fecha del suceso:</b></td>
                        <td><?= $model->fecha_registro ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <?php echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_incidencia' => $model->id_incidencia], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>
                <?php echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']) ?>
            </div>
        </div>
    </div>
</div>