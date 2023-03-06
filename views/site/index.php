<?php

use app\models\TblDepartamentos;
use app\models\TblIncidencias;
use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use hail812\adminlte\widgets\Widget;
use kartik\widgets\DateTimePicker;
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
    if (Yii::$app->user->can('MasterAccess') || Yii::$app->user->can('UsuarioSupervisorAccess') || Yii::$app->user->can('UsuarioConsultorAccess')) {
    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por departamento</center>
            </h1>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'dep',
                'id' => 'departamento',
                'data' => ArrayHelper::map(TblDepartamentos::find()->all(), 'id_departamento', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccionar departamento',],
                'pluginOptions' => ['allowClear' => true],
            ])
            ?>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'tipoIncidenciasDep',
                'id' => 'tipo-incidencia-dep',
                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia') + ['Todas' => 'Todas'],
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccionar tipo de incidencia',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoInicio',
                'id' => 'tiempoInicio',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha inicio'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoFin',
                'id' => 'tiempoFin',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha fin'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
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
                <?php

                function _data_first_month_day()
                {
                    $month = date('m');
                    $year = date('Y');
                    return date('Y-m-d', mktime(0, 0, 0, $month, 1, $year));
                }
                function _data_last_month_day()
                {
                    $month = date('m');
                    $year = date('Y');
                    $day = date("d", mktime(0, 0, 0, $month + 1, 0, $year));

                    return date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
                };

                $db = Yii::$app->db;
                $posts = $db->createCommand('
                SELECT d.nombre, t.nombre_incidencia, count(i.id_incidencia) as cantidad from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                INNER JOIN tbl_departamentos d
                ON m.id_departamento = d.id_departamento
                INNER JOIN tbl_tipo_incidencias t
                ON i.id_tipo_incidencia = t.id_tipo_incidencia
                WHERE d.id_departamento = ' . Yii::$app->user->identity->id_departamento .
                    ' AND fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '" 
                GROUP BY t.id_tipo_incidencia')->queryAll();
                $decision = count($posts);
                ?>
                <div id="container-TotalDep" class="<?= $decision == 0 ? '' : 'border border-dark'; ?>"></div>
            </figure>
            <?php

            if (Yii::$app->user->can('MasterAccess')) {
                $db = Yii::$app->db;
                $posts = $db->createCommand('
                SELECT d.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                INNER JOIN tbl_departamentos d
                ON m.id_departamento = d.id_departamento
                WHERE fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '"
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
                            opposite: true,
                            gridLineWidth: 0.5,
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
                    }, function(chart) { // on complete

                        chart.renderer.image('https://pbs.twimg.com/profile_images/1388369785931583493/rUEuGtYb_400x400.jpg', 10, 10, 125, 125)
                            .add();

                    });
                </script>
                <?php
            } else if (Yii::$app->user->can('UsuarioSupervisorAccess') || Yii::$app->user->can('UsuarioConsultorAccess')) {
                $db = Yii::$app->db;
                $posts = $db->createCommand('
                SELECT d.nombre, t.nombre_incidencia, count(i.id_incidencia) as cantidad from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                INNER JOIN tbl_departamentos d
                ON m.id_departamento = d.id_departamento
                INNER JOIN tbl_tipo_incidencias t
                ON i.id_tipo_incidencia = t.id_tipo_incidencia
                WHERE d.id_departamento = ' . Yii::$app->user->identity->id_departamento .
                    ' AND fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '" 
                GROUP BY t.id_tipo_incidencia')->queryAll();
                if (count($posts) > 0) {
                ?>
                    <script>
                        Highcharts.chart('container-TotalDep', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                <?php
                                $nombre = substr(mb_strtolower($posts[0]["nombre"], 'UTF-8'), 1);
                                $inicial = $posts[0]["nombre"][0];
                                ?>
                                text: 'Incidencias de <?= $inicial . $nombre ?>',
                            },
                            subtitle: {
                                text: 'Cantidad de incidencias'
                            },
                            xAxis: {
                                categories: [
                                    <?php
                                    for ($i = 0; $i < count($posts); $i++) {
                                        $nombre = substr(mb_strtolower($posts[$i]["nombre_incidencia"], 'UTF-8'), 1);
                                        $inicial = $posts[$i]["nombre_incidencia"][0];
                                        echo "'" . $inicial . $nombre .  "', ";
                                    }
                                    ?>
                                ],
                                title: {
                                    text: 'Tipos de incidencias'
                                },
                                gridLineColor: 'transparent'
                            },
                            yAxis: {
                                gridLineWidth: 0.5,
                                opposite: true,
                                min: 0,
                                gridLineColor: 'transparent',
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
                        }, function(chart) { // on complete

                            chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                                .add();

                        });
                    </script>
            <?php
                } else {
                    echo "<h1>No existen incidencias para mostrar</h1>";
                }
            }
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por municipio</center>
            </h1>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'mun',
                'data' =>
                Yii::$app->user->can('MasterAccess')
                    ? ArrayHelper::map(TblMunicipios::find()->orderBy('nombre')->all(), 'id_municipio', 'nombre')
                    : ArrayHelper::map(TblMunicipios::find()->andWhere(['id_departamento' => Yii::$app->user->identity->id_departamento])->orderBy('nombre')->all(), 'id_municipio', 'nombre'),
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar municipio -- ', 'id' => 'municipio',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 mt-2">
            <?php
            echo Select2::widget([
                'name' => 'tipoIncidencias',
                'id' => 'tipo-incidencia',
                'data' => ArrayHelper::map(TblTipoIncidencias::find()->all(), 'id_tipo_incidencia', 'nombre_incidencia') + ["Todas" => "Todas"],
                'language' => 'es',
                'options' => ['placeholder' => '-- Seleccionar tipo de incidencia -- ',],
                'pluginOptions' => ['allowClear' => true]
            ])
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoInicioMun',
                'id' => 'tiempoInicioMun',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha inicio'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoFinMun',
                'id' => 'tiempoFinMun',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha fin'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
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
            if (Yii::$app->user->can('MasterAccess')) {
                $db = Yii::$app->db;
                $posts = $db->createCommand('
                SELECT m.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                WHERE fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '"
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
                            gridLineWidth: 0.5,
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
                    }, function(chart) { // on complete

                        chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                            .add();

                    });
                </script>
            <?php
            } else if (Yii::$app->user->can('UsuarioSupervisorAccess') || Yii::$app->user->can('UsuarioConsultorAccess')) {
                $db = Yii::$app->db;
                $posts = $db->createCommand('
                SELECT m.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                WHERE m.id_municipio = ' . Yii::$app->user->identity->id_municipio .
                    ' AND fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '"
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
                            gridLineWidth: 0.5,
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
                    }, function(chart) { // on complete

                        chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                            .add();

                    });
                </script>
            <?php
            }
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
            <h1 class="text-white border rounded" style="background-color: #111e60;">
                <center>Incidencias por tipo</center>
            </h1>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoInicioTipo',
                'id' => 'tiempoInicioTipo',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha de inicio'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-5 col-md-12 col-sm-12 mt-2">
            <?php
            echo DateTimePicker::widget([
                'name' => 'tiempoFinTipo',
                'id' => 'tiempoFinTipo',
                'removeButton' => false,
                'options' => ['placeholder' => 'Seleccionar fecha final'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd hh:ii:ss'
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12 mt-2">
            <button class="btn btn-primary w-100" id="seleccion-tipo">Generar Grafica</button>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-total-tipos"></div>
            </figure>
            <div id="container-total">
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 mt-2">
            <figure class="highcharts-figure">
                <div id="container-total-incidencias" class="border border-dark"></div>
            </figure>
            <?php
            $db = Yii::$app->db;
            $posts = $db->createCommand('
        SELECT t.nombre_incidencia, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_tipo_incidencias t
        ON i.id_tipo_incidencia = t.id_tipo_incidencia
        WHERE fecha_registro between "' . _data_first_month_day() . '" AND "' . _data_last_month_day() . '" 
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
                        gridLineWidth: 0.5,
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
                }, function(chart) { // on complete

                    chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                        .add();

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
        $tiempoInicioMun = $("#tiempoInicioMun").val();
        $tiempoFinMun = $("#tiempoFinMun").val();


        setTimeout(function() {
            $.ajax({
                    url: "index.php?r=site/get-filtro-municipios",
                    type: "get",
                    data: {
                        tipoIncidencia: $tipoIncidencia,
                        municipio: $municipio,
                        tiempoInicioMun: $tiempoInicioMun,
                        tiempoFinMun: $tiempoFinMun
                    },
                    success: function(res) {
                        console.log(res)
                        document.getElementById('container-munCantidad').classList.add('border')
                        document.getElementById('container-munCantidad').classList.add('border-dark')
                        $("#container-mun").html(res);

                    },
                    error: function(request, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No existen registros de este municipio!',
                        })
                        document.getElementById("container-munCantidad").innerHTML = "";
                        document.getElementById('container-munCantidad').classList.remove("border")
                    }
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
        $tiempoInicio = $("#tiempoInicio").val();
        $tiempoFin = $("#tiempoFin").val();

        setTimeout(function() {
            $.ajax({
                    url: "index.php?r=site/get-filtro-departamentos",
                    type: "get",
                    data: {
                        tipoIncidenciaDep: $tipoIncidenciaDep,
                        departamento: $departamento,
                        tiempoInicio: $tiempoInicio,
                        tiempoFin: $tiempoFin
                    },
                    success: function(res) {
                        console.log(res)
                        document.getElementById('container-depCantidad').classList.add('border')
                        document.getElementById('container-depCantidad').classList.add('border-dark')
                        $("#container-dep").html(res);
                    },
                    error: function(request, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No existen registros de este departamento!',
                        })
                        document.getElementById("container-depCantidad").innerHTML = "";
                        document.getElementById('container-depCantidad').classList.remove("border")
                    }
                },
                1000
            );
        });
    })

    let botonTipo = document.getElementById('seleccion-tipo')
    botonTipo.addEventListener("click", (e) => {
        e.preventDefault()
        $tiempoInicioTipo = $("#tiempoInicioTipo").val();
        $tiempoFinTipo = $("#tiempoFinTipo").val();

        setTimeout(function() {
            $.ajax({
                    url: "index.php?r=site/get-filtro-tipos",
                    type: "get",
                    data: {
                        tiempoInicioTipo: $tiempoInicioTipo,
                        tiempoFinTipo: $tiempoFinTipo
                    },
                    success: function(res) {
                        console.log(res)
                        document.getElementById('container-total-tipos').classList.add('border')
                        document.getElementById('container-total-tipos').classList.add('border-dark')
                        $("#container-total").html(res);
                    },
                    error: function(request, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No existen registros de este departamento!',
                        })
                        document.getElementById("container-total-tipos").innerHTML = "";
                        document.getElementById('container-total-tipos').classList.remove("border")
                    }
                },
                1000
            );
        });
    })
</script>
<?php
    }
?>