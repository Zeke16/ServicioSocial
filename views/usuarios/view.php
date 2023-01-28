<?php

use yii\helpers\Html;

$this->title = 'Detalle';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline" style="padding:15px;">

            <div class="card-body">
                <table class="table table-sm table-striped table-hover table-bordered">
                    <tr>
                        <td width="150px" rowspan="9">
                            <img src="<?= Yii::$app->request->hostInfo . $model->imagen ?>" width="150" />
                        </td>
                        <?php if (Yii::$app->user->can('MasterAccess')) { ?>
                            <td width="200px"><b>Usuario:</b></td>
                            <td><?= $model->username ?></td>
                            <td><b>Estado:</b></td>
                            <td>
                                <span class="badge bg-<?= $model->status == 1 ? "green" : "red"; ?>"><?= $model->status == 1 ? "Activo" : "Inactivo"; ?></span>
                            </td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><b>Nombre:</b></td>
                        <td><?= $model->nombres ?></td>
                        <td><b>Apellido:</b></td>
                        <td><?= $model->apellidos ?></td>
                    </tr>
                    <tr>
                        <td><b>DNI:</b></td>
                        <td><?= $model->dni ?></td>
                        <td><b>Email:</b></td>
                        <td><?= $model->email ?></td>
                    </tr>
                    <tr>
                        <td><b>Departamento:</b></td>
                        <td><?= $model->departamento->nombre ?></td>
                        <td><b>Municipio:</b></td>
                        <td><?= $model->municipio->nombre ?></td>
                    </tr>
                    <tr>
                        <td><b>Lugar de residencia:</b></td>
                        <td colspan="3"><?= $model->lugar_residencia ?></td>
                    </tr>
                    <?php if (Yii::$app->user->can('MasterAccess')) { ?>
                        <tr>
                            <td><b>Tipo de usuario:</b></td>
                            <td><?= $model->tipoUsuario->nombre_tipo ?></td>
                            <td><b>Comision:</b></td>
                            <td><?= $model->comision->nombre_comision ?></td>
                        </tr>
                        <tr>
                            <td><b>Fecha de creación:</b></td>
                            <td><?= date('d-m-Y H:i:s', $model->created_at) ?></td>
                            <td><b>Fecha de actualización:</b></td>
                            <td><?= date('d-m-Y H:i:s', $model->updated_at) ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td><b>Telefono:</b></td>
                        <td><?= $model->telefono ?></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <?php
                echo Html::a('<i class="fa fa-edit"></i> Editar', ['update', 'id_usuario' => $model->id_usuario], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record'])?>
                <?php
                if (Yii::$app->user->can('MasterAccess')) {
                    echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']);
                }else{
                    echo Html::a('<i class="fa fa-ban"></i> Cancelar', ['site/index'], ['class' => 'btn btn-danger', 'data-toggle' => 'tooltip', 'title' => 'Cancelar']);
                }
                ?>
            </div>
        </div>
    </div>
</div>