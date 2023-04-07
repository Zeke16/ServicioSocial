<?php

use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use app\models\TblUsuarios;
use backend\models\TblSucursales;
use kartik\daterange\DateRangePicker;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use kartik\widgets\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<style>
    #tblincidencias-descripcion_incidencia {
        resize: none;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12">
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Crear / Editar registro</h3>
            </div>
            <?php $form = ActiveForm::begin(
                [
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'options' => [
                        'enctype' => 'multipart/form-data'
                    ]
                ]
            ); ?>
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <?php if (Yii::$app->user->can('MasterAccess')) { ?>
                            <div class="col-md-6">
                                <?= Html::activeLabel($model, 'id_usuario', ['class' => 'control-label']) ?>
                                <?= $form->field($model, 'id_usuario', ['showLabels' => false])->widget(Select2::class, [
                                    'data' => ArrayHelper::map(TblUsuarios::find()->all(), 'id_usuario', 'nombreCompleto'),
                                    'language' => 'es',
                                    'options' => ['placeholder' => '-- Seleccionar usuario -- ',],
                                    'pluginOptions' => ['allowClear' => true]
                                ]) ?>
                            </div>
                        <?php } ?>
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'ubicacion_incidencia', ['class' => 'control-label']) ?>
                            <div id="map" style="width: 100%; height: 500px;"></div>
                            <button id="ubicacion" class="btn btn-primary mt-2"><i class="fas fa-crosshairs" style="font-size: 20px;"></i>&nbsp; Obtener mi ubicación actual</button>
                            <?= $form->field($model, 'ubicacion_incidencia', ['showLabels' => false])->textInput([
                                'id' => 'ubicacion_incidencia',
                                'hidden' => true
                            ]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'imagen_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'imagen_incidencia', ['showLabels' => false])->widget(FileInput::class, [
                                'options' => ['accept' => 'image/*'],
                                'pluginOptions' => ['allowedFileExtensions' => ['jpg', 'gif', 'png'],],
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'id_municipio', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_municipio', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(TblMunicipios::find()->all(), 'id_municipio', 'nombre'),
                                'language' => 'es',
                                'options' => ['placeholder' => '-- Seleccionar municipio -- ',],
                                'pluginOptions' => ['allowClear' => true]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= Html::activeLabel($model, 'id_tipo_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'id_tipo_incidencia', ['showLabels' => false])->widget(Select2::class, [
                                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia'),
                                'language' => 'es',
                                'options' => ['placeholder' => '-- Seleccionar tipo de incidencia -- ',],
                                'pluginOptions' => ['allowClear' => true]
                            ]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= Html::activeLabel($model, 'descripcion_incidencia', ['class' => 'control-label']) ?>
                            <?= $form->field($model, 'descripcion_incidencia', ['showLabels' => false])->textarea([]) ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-save"></i> Guardar' : '<i class="fa fa-save"></i> Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        <?= Html::a('<i class="fa fa-ban"></i> Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    let markers = [];
    let count = 0;
    let miUbicacion = document.getElementById('ubicacion')


    function initMap() {
        let options = {
            zoom: 12,
            center: {
                lat: 13.5024217,
                lng: -88.1779086
            }
        }
        const map = new google.maps.Map(document.getElementById("map"), options);
        map.addListener("click", (e) => {
            deleteMarkers()
            placeMarkerAndPanTo(e.latLng, map);
        });

        miUbicacion.addEventListener("click", (e) => {
            deleteMarkers()
            e.preventDefault()
            if (navigator.geolocation) { //check if geolocation is available
                navigator.geolocation.getCurrentPosition(function(position) {
                    console.log(position.coords)
                    let latLng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    const marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });
                    map.panTo(latLng);
                    document.getElementById('ubicacion_incidencia').value = position.coords.latitude + ", " + position.coords.longitude

                    markers.push(marker);
                });
            }
        })

        function setMapOnAll(map) {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        function hideMarkers() {
            setMapOnAll(null);
        }

        function deleteMarkers() {
            hideMarkers();
            markers = [];
        }
    }


    function placeMarkerAndPanTo(latLng, map) {
        const marker = new google.maps.Marker({
            position: latLng,
            map: map,
        });
        map.panTo(latLng);

        let data = JSON.stringify(latLng.toJSON())
        let coordenadas = JSON.parse(data)
        document.getElementById('ubicacion_incidencia').value = coordenadas.lat + ", " + coordenadas.lng

        markers.push(marker);
    }

    window.initMap = initMap
</script>