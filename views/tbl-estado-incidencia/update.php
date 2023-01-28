<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsuarios */

$this->title = 'Actualizar registro';
$this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Detalle', 'url' => ['tbl-incidencias/view', 'id_incidencia' => $model->id_incidencia]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="tbl-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

