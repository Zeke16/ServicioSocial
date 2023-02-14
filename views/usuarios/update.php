<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsuarios */

$this->title = 'Actualizar registro';
if (Yii::$app->user->can('MasterAccess')) {
    $this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => 'Detalle de usuario', 'url' => ['view', 'id_usuario' => $model->id_usuario]];
    $this->params['breadcrumbs'][] = 'Actualizar';
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Listado', 'url' => ['tbl-incidencias/index']];
    $this->params['breadcrumbs'][] = ['label' => 'Detalle de usuario', 'url' => ['view', 'id_usuario' => $model->id_usuario]];
    $this->params['breadcrumbs'][] = 'Actualizar';
}
?>
<div class="tbl-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>