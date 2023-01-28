<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TblEstadoIncidencia $model */

$this->title = 'Create Tbl Estado Incidencia';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Estado Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-estado-incidencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
