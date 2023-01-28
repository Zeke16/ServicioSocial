<?php

use yii\helpers\Html;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    Estado de la incidencia
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <td width="50%"><b>Estado actual de la incidencia:</b></td>
                        <td width="50%">
                            <span style="font-size: 15px;" class="badge bg-<?= $model2->estado == 1 ? "green" : "red"; ?>"><?= $model2->estado == 1 ? "Solventado" : "En proceso de resolución"; ?></span>
                        </td>
                    </tr>
                    <?php
                    if ($model2->estado == 1) {
                    ?>
                        <tr>
                            <td><b>Mensaje de retroalimentación:</b></td>
                            <td><?= $model2->retroalimentacion ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2" class="text-center" style="font-size: large;"><b>Imagen de referencia:</b></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"> <img src="<?= Yii::$app->request->hostInfo . $imagen ?>" class="elevation-2 img-fluid" alt="User Image">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <?php
                if ($model2->estado == 1) {
                    if (Yii::$app->user->can('MasterAccess')) {
                        echo Html::a('<i class="fa fa-check"></i> Resolver incidencia', ['tbl-estado-incidencia/update', 'id_estado_incidencia' => $model2->id_estado_incidencia], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']);
                    }
                } else {
                    echo Html::a('<i class="fa fa-check"></i> Resolver incidencia', ['tbl-estado-incidencia/update', 'id_estado_incidencia' => $model2->id_estado_incidencia], ['class' => 'btn btn-primary', 'data-toggle' => 'tooltip', 'title' => 'Edit record']);
                    echo '&nbsp;<a target="_blank" href="https://maps.google.com/?q=' . $ubicacion . '" class="btn btn-success text-white border border-white"><i class="fa fa-paper-plane"></i>&nbsp;Ir a ubicación</a>';
                }
                ?>
            </div>
        </div>
    </div>
</div>