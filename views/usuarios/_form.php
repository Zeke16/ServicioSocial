<?php

use app\models\TblComisiones;
use app\models\TblDepartamentos;
use app\models\TblTipoUsuarios;
use kartik\depdrop\DepDrop;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

Yii::$app->language = 'es_ES';

?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
        <h1 class="text-center text-white border rounded" style="background-color: #111e60;">
            <b>Crear usuario</b>
        </h1>
        <div class="card card-primary card-outline" style="padding:15px;">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <form role="form">
                <div class="row border">
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'nombres')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'dni')->textInput(['maxlength' => true, 'autofocus' => true])->label('Documento Nacional de Identidad (DUI o Carnet de minoridad)') ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'lugar_residencia')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::activeLabel($model, 'id_departamento', ['class' => 'control-label']) ?>
                        <?= $form->field($model, 'id_departamento', ['showLabels' => false])->widget(Select2::class, [
                            'data' => ArrayHelper::map(TblDepartamentos::find()->all(), 'id_departamento', 'nombre'),
                            'language' => 'es',
                            'options' => ['placeholder' => '-- Seleccionar departamento -- ',],
                            'pluginOptions' => ['allowClear' => true]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::hiddenInput('model_id1', $model->isNewRecord ? '' : $model->id_departamento, ['id' => 'model_id1']); ?>
                        <?= Html::activeLabel($model, 'id_municipio', ['class' => 'control-label']) ?>
                        <?= $form->field($model, 'id_municipio', ['showLabels' => false])->widget(DepDrop::class, [
                            'language' => 'es',
                            'type' => DepDrop::TYPE_SELECT2,
                            'pluginOptions' => [
                                'depends' => ['tblusuarios-id_departamento'],
                                'initialize' => $model->isNewRecord ? false : true,
                                'url' => Url::to(['/usuarios/municipios']),
                                'placeholder' => '- Seleccionar Municipio -',
                                'loadingText' => 'Cargando datos...',
                                'params' => ['model_id1'] ///SPECIFYING THE PARAM
                            ]
                        ]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::activeLabel($model, 'id_comision', ['class' => 'control-label']) ?>
                        <?= $form->field($model, 'id_comision', ['showLabels' => false])->widget(Select2::class, [
                            'name' => 'comision',
                            'data' => ArrayHelper::map(TblComisiones::find()->all(), 'id_comision', 'nombre_comision'),
                            'language' => 'es',
                            'id' => 'dep',
                            'options' => ['placeholder' => '-- Seleccionar comision -- ',],
                            'pluginOptions' => ['allowClear' => true]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= Html::activeLabel($model, 'id_tipo_usuario', ['class' => 'control-label']) ?>
                        <?= $form->field($model, 'id_tipo_usuario', ['showLabels' => false])->widget(Select2::class, [
                            'name' => 'comision',
                            'data' => ArrayHelper::map(TblTipoUsuarios::find()->all(), 'id_tipo_usuario', 'nombre_tipo'),
                            'language' => 'es',
                            'id' => 'dep',
                            'options' => ['placeholder' => '-- Seleccionar tipo de usuario -- ',],
                            'pluginOptions' => ['allowClear' => true]
                        ]) ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-12 mt-2">
                        <?= $form->field($model, 'imagen')->label('Imagen')->widget(FileInput::class, [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png'],],
                        ]); ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'password_hash')->widget(PasswordInput::class, []); ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'status')->widget(SwitchInput::class, [
                            'pluginOptions' => [
                                'handleWidth' => 70,
                                'onColor' => 'success',
                                'offColor' => 'danger',
                                'onText' => '<i class="fa fa-check"></i> Activo',
                                'offText' => '<i class="fa fa-close"></i> Inactivo',
                            ]
                        ]); ?>
                    </div>
                    <div class="col-sm-12 col-md-12 col-xl-12 my-4 d-flex justify-content-between">
                        <?= Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger mt-2 w-25',]) ?>
                        <?= Html::submitButton('<i class="fa fa-user-plus"></i> Registrar', ['class' => 'btn btn-success mt-2 w-25', 'name' => 'signup-button']) ?>
                    </div>
                </div>
            </form>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>