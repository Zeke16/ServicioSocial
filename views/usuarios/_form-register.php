<?php

use app\models\TblDepartamentos;
use app\models\TblMunicipios;
use himiklab\yii2\recaptcha\ReCaptcha2;
use kartik\depdrop\DepDrop;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
        <h1 class="text-center text-white border rounded" style="background-color: #111e60;">
            <b>Crear usuario</b>
        </h1>
        <div class="card card-primary card-outline" style="padding:15px;">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data'
                ]
            ]); ?>
            <form role="form">
                <div class="row border">
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'nombres')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'dni')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
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
                        <?= Html::hiddenInput('model_id1', '', ['id' => 'model_id1']); ?>
                        <?= Html::activeLabel($model, 'id_municipio', ['class' => 'control-label']) ?>
                        <?= $form->field($model, 'id_municipio', ['showLabels' => false])->widget(DepDrop::class, [
                            'data' => ArrayHelper::map(TblMunicipios::find()->all(), 'id_municipio', 'nombre'),
                            'language' => 'es',
                            'type' => DepDrop::TYPE_SELECT2,
                            'options' => ['placeholder' => '-- Seleccionar municipio -- ',],
                            'pluginOptions' => [
                                'depends' => ['usersignup-id_departamento'],
                                'initialize' => false,
                                'url' => Url::to(['/usuarios/municipios']),
                                'placeholder' => '- Seleccionar Municipio -',
                                'loadingText' => 'Cargando datos...',
                                'params' => ['model_id1'] ///SPECIFYING THE PARAM
                            ]
                        ]); ?>
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
                        <?= $form->field($model, 'password')->widget(PasswordInput::class, []); ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6 mt-2">
                        <?= $form->field($model, 'reCaptcha')->widget(
                            ReCaptcha2::class,
                            [
                                'siteKey' => '6LcoCxQkAAAAABs_L10DnB4t3mU8hkC8oqiYwZ-X',
                                'options' => [ 'enableAjaxValidation' => true],
                            ]
                        ) ?>
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

<ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>