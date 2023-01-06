<?php

use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use app\models\TblUsuarios;
use backend\models\TblSucursales;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<style>
    #tblincidencias-descripcion_incidencia {
        resize: none;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card card-primary">
            
            <div class="card-header">
                <h3 class="card-title">Crear / Editar registro</h3>
            </div>

            <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_HORIZONTAL]); ?>
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <?php if (Yii::$app->user->can('MasterAccess')) { ?>
                            <div class="col-md-6">
                                <?= Html::activeLabel($model, 'id_usuario', ['class' => 'control-label']) ?>
                                <?= $form->field($model, 'id_usuario', ['showLabels' => false])->widget(Select2::class, [
                                    'data' => ArrayHelper::map(TblUsuarios::find()->all(), 'id_usuario', 'nombreCompleto'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => '-- Seleccionar usuario -- ',],
                                    'pluginOptions' => ['allowClear' => true]
                                ]) ?>
                            </div>
                        <?php } ?>
                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'id_municipio', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_municipio', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(TblMunicipios::find()->all(), 'id_municipio', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => '-- Seleccionar municipio -- ',],
                                'pluginOptions' => ['allowClear' => true]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'id_tipo_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_tipo_incidencia', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia'),
                                'language' => 'es',
                                'options' => ['placeholder' => '-- Seleccionar tipo de incidencia -- ',],
                                'pluginOptions' => ['allowClear' => true]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'incidencia_otro', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'incidencia_otro', ['showLabels' => false])->textInput(['autofocus' => true])->label('AAAA') ?>
                        </div>
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'descripcion_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'descripcion_incidencia', ['showLabels' => false])->textarea([]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'lugar_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'lugar_incidencia', ['showLabels' => false])->textarea([]) ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
