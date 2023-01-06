<?php

use app\models\TblProductos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-productos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tbl Productos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_producto',
            'id_categoria',
            'nombre',
            'descripcion:ntext',
            'imagen',
            //'fecha_ing',
            //'fecha_mod',
            //'id_usuario',
            //'estado',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, TblProductos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_producto' => $model->id_producto]);
                 }
            ],
        ],
    ]); ?>


</div>
