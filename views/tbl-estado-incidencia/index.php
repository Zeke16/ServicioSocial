<?php

use app\models\TblEstadoIncidencia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\TblEstadoIncidenciaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Tbl Estado Incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-estado-incidencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Estado Incidencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_estado_incidencia',
            'id_incidencia',
            'estado',
            'retroalimentacion:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TblEstadoIncidencia $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_estado_incidencia' => $model->id_estado_incidencia]);
                 }
            ],
        ],
    ]); ?>


</div>
