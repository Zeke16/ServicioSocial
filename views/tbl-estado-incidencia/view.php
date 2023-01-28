<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\TblEstadoIncidencia $model */

$this->title = $model->id_estado_incidencia;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Estado Incidencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-estado-incidencia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_estado_incidencia' => $model->id_estado_incidencia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_estado_incidencia' => $model->id_estado_incidencia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_estado_incidencia',
            'id_incidencia',
            'estado',
            'retroalimentacion:ntext',
        ],
    ]) ?>

</div>
