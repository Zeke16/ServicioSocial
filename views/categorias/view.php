<?php

use yii\helpers\Html;

Yii::$app->formatter->locale = 'en-US';
$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $model->nombre ?></h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="16%"><b>ID:</b></td>
                        <td width="34%"><?= $model->id_categoria ?></td>
                        <td width="16%"><b>Nombre:</b></td>
                        <td width="34%"> <?= $model->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Fecha creacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_ing)) ?></td>
                        <td><b>Fecha modificacion:</b></td>
                        <td><?= date('d-m-Y H:m:i', strtotime($model->fecha_mod)) ?></td>
                    </tr>
                    <tr>
                        <td><b>Usuario: </b></td>
                        <td><?= $model->id_usuario ?></td>
                        <td><b>Estado: </b></td>
                        <td><span class="badge bg-<?= $model->estado == 1 ? "green" : "red"; ?>"><?= $model->estado == 1 ? "Activo" : "Inactivo"; ?></span></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                    <?php echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_categoria' => $model->id_categoria], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']) ?>
                <?php echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']) ?>
            </div>
        </div>
    </div>
</div>