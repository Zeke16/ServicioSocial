<?php

use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use app\models\TblUsuarios;
use backend\models\TblSucursales;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<style>
    #tblestadoincidencia-retroalimentacion {
        resize: none;
        height: 100px;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Finalizar incidencia</h3>
            </div>

            <?php $form = ActiveForm::begin(
                [
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]
            ); ?>
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'retroalimentacion', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'retroalimentacion', ['showLabels' => false])->textarea([]) ?>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= Html::activeLabel($model, 'estado', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'estado', ['showLabels' => false])->widget(SwitchInput::class, [
                                'pluginOptions' => [
                                    'handleWidth' => 100,
                                    'onColor' => 'success',
                                    'offColor' => 'danger',
                                    'onText' => '<i class="fa fa-check"></i> Finalizada',
                                    'offText' => '<i class="fa fa-close"></i> En proceso',
                                ]
                            ]); ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Finalizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <button class="btn btn-danger" onclick="history.back()"><i class="fa fa-ban"></i>&nbsp; Cancelar</button>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>