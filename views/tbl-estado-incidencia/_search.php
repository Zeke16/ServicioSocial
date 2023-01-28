<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblEstadoIncidenciaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="tbl-estado-incidencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_estado_incidencia') ?>

    <?= $form->field($model, 'id_incidencia') ?>

    <?= $form->field($model, 'estado') ?>

    <?= $form->field($model, 'retroalimentacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
