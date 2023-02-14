<?php

use app\models\TblDepartamentos;
use app\models\TblIncidencias;
use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use hail812\adminlte\widgets\Widget;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

$this->title = 'Página de inicio';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<style>
    .bg-info {
        background-color: #111e60 !important;
    }

    .bg-danger {
        background-color: #a30101 !important;
    }

    .bg-success {
        background-color: #126a26 !important;
    }

    .bg-dark {
        background-color: #4f0868 !important;
    }

    .highcharts-figure,
    .highcharts-data-table table {
        margin: 1em auto;
    }

    #container {
        height: 400px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>
<div class="row">
    <?php
    if (Yii::$app->user->can('UsuarioEstandarAccess') || Yii::$app->user->can('UsuarioSupervisorAccess') || Yii::$app->user->can('MasterAccess')) {
    ?>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=tbl-incidencias/index">
                <div class="small-box bg-success text-white p-2">
                    <div class="inner">
                        <h3>Incidencias</h3>
                        <p>Administrar incidencias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book text-white"></i>
                    </div>
                    <a href="index.php?r=tbl-incidencias/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>
    <?php
    }
    ?>


    <?php
    if (Yii::$app->user->can('MasterAccess')) {
    ?>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=tbl-comisiones/index">
                <div class="small-box bg-info text-white p-2">
                    <div class="inner">
                        <h3>Instituciones de gobierno</h3>
                        <p>Administrar instituciones</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-gavel text-white"></i>
                    </div>
                    <a href="index.php?r=tbl-comisiones/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=tbl-tipo-incidencias/index">
                <div class="small-box bg-danger text-white p-2">
                    <div class="inner">
                        <h3>Tipos de incidencias</h3>
                        <p>Administrar tipos de incidencias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-fire text-white"></i>
                    </div>
                    <a href="index.php?r=tbl-tipo-incidencias/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <a href="index.php?r=usuarios/index">
                <div class="small-box bg-dark text-white p-2">
                    <div class="inner">
                        <h3>Usuarios</h3>
                        <p>Administrar usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <a href="index.php?r=usuarios/index" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </a>
        </div>
    <?php
    }
    ?>
    <?php
    if (Yii::$app->user->can('MasterAccess')) {
    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por municipio</center>
            </h1>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'mun',
                'data' => ArrayHelper::map(TblMunicipios::find()->all(), 'id_municipio', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar municipio -- ', 'id' => 'municipio',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'tipoIncidencias',
                'id' => 'tipo-incidencia',
                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia'),
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar tipo de incidencia -- ',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <button class="btn btn-primary w-100" id="seleccion">Generar Grafica</button>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-munCantidad"></div>
            </figure>
            <div id="container-mun">
                <!--Aca se coloca el script del ajax-->
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-TotalMun" class="border border-dark"></div>
            </figure>
            <?php
            $db = Yii::$app->db;
            $posts = $db->createCommand('
            SELECT m.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
            INNER JOIN tbl_municipios m
            ON i.id_municipio = m.id_municipio
            GROUP BY m.id_municipio
            ')->queryAll();
            ?>
            <script>
                Highcharts.chart('container-TotalMun', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Incidencias por municipio'
                    },
                    subtitle: {
                        text: 'Cantidad de incidencias por municipio'
                    },
                    xAxis: {
                        categories: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                echo "'" . $posts[$i]["nombre"] . "', ";
                            }
                            ?>
                        ],
                        title: {
                            text: 'Municipios'
                        }
                    },
                    yAxis: {
                        opposite: true,
                        min: 0,
                        title: {
                            text: 'Cantidad registrada',
                            align: 'middle'
                        },
                        labels: {
                            overflow: 'justify'
                        },
                    },
                    plotOptions: {
                        column: {
                            borderRadius: 5,
                            color: '#111e60'
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{ //Cantidades a mostrar, filtros
                        name: 'Cantidad',
                        data: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                echo $posts[$i]["cantidad"] . ", ";
                            }
                            ?>
                        ],
                        tooltip: {
                            valueSuffix: ''
                        }
                    }, ]
                });
            </script>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por departamento</center>
            </h1>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'dep',
                'id' => 'departamento',
                'data' => ArrayHelper::map(TblDepartamentos::find()->all(), 'id_departamento', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar departamento -- ',],
                'pluginOptions' => ['allowClear' => true],
                'pluginEvents' => [
                    "change" => "function() { log('change'); }",
                ]
            ])
            ?>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'tipoIncidenciasDep',
                'id' => 'tipo-incidencia-dep',
                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia'),
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar tipo de incidencia -- ',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <button class="btn btn-primary w-100" id="seleccion-dep">Generar Grafica</button>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-depCantidad"></div>
            </figure>
        </div>
        <div id="container-dep">
            <!--Aca se coloca el script del ajax-->
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-TotalDep" class="border border-dark"></div>
            </figure>
            <?php
            $db = Yii::$app->db;
            $posts = $db->createCommand('
        SELECT d.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_municipios m
        ON i.id_municipio = m.id_municipio
        INNER JOIN tbl_departamentos d
        ON m.id_departamento = d.id_departamento
        GROUP BY d.id_departamento
        ')->queryAll();
            ?>
            <script>
                Highcharts.chart('container-TotalDep', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Incidencias por departamento'
                    },
                    subtitle: {
                        text: 'Cantidad de incidencias por departamento'
                    },
                    xAxis: {
                        categories: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                $nombre = substr(mb_strtolower($posts[$i]["nombre"], 'UTF-8'), 1);
                                $inicial = $posts[$i]["nombre"][0];
                                echo "'" . $inicial . $nombre .  "', ";
                            }
                            ?>
                        ],
                        title: {
                            text: 'Departamentos'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad registrada',
                            align: 'middle'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{ //Cantidades a mostrar, filtros
                        name: 'Cantidad',
                        data: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                echo $posts[$i]["cantidad"] . ", ";
                            }
                            ?>
                        ],
                        tooltip: {
                            valueSuffix: ''
                        }
                    }, ]
                });
            </script>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por tipo</center>
            </h1>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-total-incidencias" class="border border-dark"></div>
            </figure>
            <?php
            $db = Yii::$app->db;
            $posts = $db->createCommand('
        SELECT t.nombre_incidencia, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_tipo_incidencias t
        ON i.id_tipo_incidencia = t.id_tipo_incidencia
        GROUP BY t.id_tipo_incidencia
        ')->queryAll();
            ?>
            <script>
                Highcharts.chart('container-total-incidencias', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Incidencias por tipo'
                    },
                    subtitle: {
                        text: 'Cantidad de incidencias registradas'
                    },
                    xAxis: {
                        categories: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                $inicial = $posts[$i]["nombre_incidencia"];
                                echo "'" . $inicial . "', ";
                            }
                            ?>
                        ],
                        title: {
                            text: 'Departamentos'
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Cantidad registrada',
                            align: 'middle'
                        },
                        labels: {
                            overflow: 'justify'
                        }
                    },
                    plotOptions: {
                        bar: {
                            dataLabels: {
                                enabled: true
                            }
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -40,
                        y: 80,
                        floating: true,
                        borderWidth: 1,
                        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                        shadow: true
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{ //Cantidades a mostrar, filtros
                        name: 'Cantidad',
                        data: [
                            <?php
                            for ($i = 0; $i < count($posts); $i++) {
                                echo "{ 
                                name: '" . $posts[$i]["nombre_incidencia"] . "',
                                y: " . $posts[$i]["cantidad"] .
                                    "}, ";
                            }
                            ?>
                        ],
                        tooltip: {
                            valueSuffix: ''
                        }
                    }, ]
                });
            </script>
        </div>
</div>
<script>
    let boton = document.getElementById('seleccion')
    boton.addEventListener("click", (e) => {
        e.preventDefault()
        $tipoIncidencia = $("#tipo-incidencia").val();
        $municipio = $("#municipio").val();

        setTimeout(function() {
            $.ajax({
                    url: "index.php?r=site/get-filtro-municipios",
                    type: "get",
                    data: {
                        tipoIncidencia: $tipoIncidencia,
                        municipio: $municipio
                    },
                    success: function(res) {
                        console.log(res)
                        document.getElementById('container-munCantidad').classList.add('border')
                        document.getElementById('container-munCantidad').classList.add('border-dark')
                        $("#container-mun").html(res);

                    },
                },
                1000
            );
        });
    })

    let botonDep = document.getElementById('seleccion-dep')
    botonDep.addEventListener("click", (e) => {
        e.preventDefault()
        $tipoIncidenciaDep = $("#tipo-incidencia-dep").val();
        $departamento = $("#departamento").val();

        setTimeout(function() {
            $.ajax({
                    url: "index.php?r=site/get-filtro-departamentos",
                    type: "get",
                    data: {
                        tipoIncidenciaDep: $tipoIncidenciaDep,
                        departamento: $departamento
                    },
                    success: function(res) {
                        console.log(res)
                        document.getElementById('container-depCantidad').classList.add('border')
                        document.getElementById('container-depCantidad').classList.add('border-dark')
                        $("#container-dep").html(res);
                    },
                },
                1000
            );
        });
    })
</script>
<?php
    }
?>