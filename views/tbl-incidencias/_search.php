<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblIncidenciasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-incidencias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_incidencia') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'id_municipio') ?>

    <?= $form->field($model, 'id_tipo_incidencia') ?>

    <?= $form->field($model, 'descripcion_incidencia') ?>

    <?php // echo $form->field($model, 'lugar_incidencia') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'incidencia_otro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
