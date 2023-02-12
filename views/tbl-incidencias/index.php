<?php
Yii::$app->language = 'es_ES';

use app\models\TblComisiones;
use app\models\TblDepartamentos;
use app\models\TblEstadoIncidencia;
use app\models\TblIncidencias;
use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use app\models\TblUsuarios;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OsigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listado de incidencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <div class="tbl-osig-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>
            <?php
            $gridColumns = [
                [
                    'class' => 'kartik\grid\ExpandRowColumn',
                    'width' => '50px',
                    'value' => function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail' => function ($model) {
                        $paciente = TblIncidencias::getIncidencia($model->id_incidencia);
                        $model2 = TblEstadoIncidencia::getEstadoIncidencia($model->id_incidencia);
                        return Yii::$app->controller->renderPartial('_detalles', [
                            'model' => $paciente,
                            'model2' => $model2
                        ]);
                    },
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                    'expandOneOnly' => true
                ],
                [
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '5%',
                    'header' => '#',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'id_municipio',
                    'width' => '20%',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->municipio->nombre;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblMunicipios::find()->orderBy('nombre')->all(), 'id_municipio', 'nombre'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'descripcion_incidencia',
                    'width' => '20%',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->descripcion_incidencia;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblIncidencias::find()->orderBy('descripcion_incidencia')->all(), 'id_incidencia', 'descripcion_incidencia'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'id_tipo_incidencia',
                    'width' => '20%',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget) {
                        return $model->tipoIncidencia->nombre_incidencia;
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblTipoIncidencias::find()->orderBy('nombre_incidencia')->all(), 'id_tipo_incidencia', 'nombre_incidencia'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'fecha_registro',
                    'width' => '20%',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget) {
                        return date("Y-m-d H:i:s", strtotime($model->fecha_registro));
                    },
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(TblIncidencias::find()->orderBy('fecha_registro')->all(), 'id_incidencia', 'fecha_registro'),
                    'filterWidgetOptions' => [
                        'options' => ['placeholder' => 'Todos...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ],
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'width' => '20%',
                    'urlCreator' => function ($action, TblIncidencias $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_incidencia' => $model->id_incidencia]);
                    }
                ],
            ];

            $exportmenu = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_HTML => false,
                    ExportMenu::FORMAT_CSV => false,
                ],
                'container' => ['class' => 'btn-group float-left mr-2']
            ]);

            echo GridView::widget([
                'id' => 'kv-grid-demo',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
                'headerRowOptions' => ['class' => 'kartik-sheet-style'],
                'filterRowOptions' => ['class' => 'kartik-sheet-style'],
                'pjax' => true, // pjax is set to always true for this demo
                // set your toolbar
                'toolbar' =>  [
                    $exportmenu,
                    [
                        'content' =>
                        Html::a('<i class="fas fa-plus"></i> Agregar', ['create'], [
                            'class' => 'btn btn-success',
                            'data-pjax' => 0,
                        ]) . ' ' .
                            Html::a('<i class="fas fa-redo"></i>', ['index'], [
                                'class' => 'btn btn-outline-success',
                                'title' => Yii::t('kvgrid', 'Limpiar filtros'),
                                'data-pjax' => 0,
                            ]),
                        'options' => ['class' => 'btn-group mr-2']
                    ],
                    '{toggleData}',

                ],
                'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                // set export properties
                // parameters from the demo form
                'bordered' => true,
                'striped' => true,
                'condensed' => true,
                'responsive' => true,
                'hover' => true,
                //'showPageSummary'=>$pageSummary,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading' => 'Tipos de incidencias',
                ],
                'persistResize' => false,
            ]);
            ?>
        </div>
    </div>
</div>