<?php
Yii::$app->language = 'es_ES';

use app\models\TblComisiones;
use app\models\TblDepartamentos;
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

$this->title = 'Listado de tipos de incidencias';
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
                    'class' => 'kartik\grid\SerialColumn',
                    'contentOptions' => ['class' => 'kartik-sheet-style'],
                    'width' => '10%',
                    'header' => '#',
                    'headerOptions' => ['class' => 'kartik-sheet-style']
                ],
                [
                    'class' => 'kartik\grid\DataColumn',
                    'attribute' => 'nombre_incidencia',
                    'width' => '80%',
                    'vAlign' => 'middle',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget) {
                        return Html::a($model->nombre_incidencia,  ['view', 'id_tipo_incidencia' => $model->id_tipo_incidencia]);
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
                    'class' => 'kartik\grid\ActionColumn',
                    'width' => '20%',
                    'urlCreator' => function ($action, TblTipoIncidencias $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_tipo_incidencia' => $model->id_tipo_incidencia]);
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
                            ]) . ' '.
                            Html::a('<i class="fas fa-redo"></i>', ['index'], [
                                'class' => 'btn btn-outline-success',
                                'title'=>Yii::t('kvgrid', 'Limpiar filtros'),
                                'data-pjax' => 0, 
                            ]), 
                        'options' => ['class' => 'btn-group mr-2']
                    ],
                    '{toggleData}',
                    
                ],
                'toggleDataContainer' => ['class' => 'btn-group mr-2'],
                // set export properties
                // parameters from the demo form
                'bordered'=> true,
                'striped'=> true,
                'condensed'=> true,
                'responsive'=> true,
                'hover'=> true,
                //'showPageSummary'=>$pageSummary,
                'panel' => [
                    'type' => GridView::TYPE_PRIMARY,
                    'heading'=> 'Tipos de incidencias',
                ],
                'persistResize' => false,
            ]);
            ?>
        </div>
    </div>
</div>