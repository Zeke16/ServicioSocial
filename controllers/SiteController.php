<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TblIncidencias;
use app\models\TblMunicipios;
use app\models\TblTipoIncidencias;
use yii\helpers\Json;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'login',
                            'error',
                            'get-filtro-departamentos',
                            'get-filtro-municipios',
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionGetFiltroMunicipios($tipoIncidencia, $municipio)
    {
        $incidenciasMun = TblIncidencias::find()->where(['id_tipo_incidencia' => $tipoIncidencia, 'id_municipio' => $municipio])->all();
        $nombreMunicipio = TblMunicipios::find()->where(['id_municipio' => $municipio])->one();
        $model = TblTipoIncidencias::find()->where(['id_tipo_incidencia' => $tipoIncidencia])->one();

        echo "
        <script>
             Highcharts.chart('container-munCantidad', {
                chart: {
                    type: 'column'
                },
                            title: {
                                text: 'Incidencias de " . $nombreMunicipio->nombre . "'
                            },
                            subtitle: {
                                text: 'Incidencias de tipo " . $model->nombre_incidencia . "'
                            },
                            xAxis: {
                                categories: ['" . $model->nombre_incidencia . "'],
                                title: {
                                    text: 'Tipo de incidencia'
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
                            tooltip: {
                                valueSuffix: '$'
                            },
                            plotOptions: {
                                column: {
                                    borderRadius: 5,
                                    color: '#c00713'
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
                                data: [" . count($incidenciasMun) . "],
                                tooltip: {
                                    valueSuffix: ''
                                }
                            }, ]
                        });
                    </script>";
    }

    public function actionGetFiltroDepartamentos($tipoIncidenciaDep, $departamento)
    {

        $db = Yii::$app->db;
        $posts = $db->createCommand('
        SELECT d.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_municipios m
        ON i.id_municipio = m.id_municipio
        INNER JOIN tbl_departamentos d
        ON m.id_departamento = d.id_departamento
        WHERE d.id_departamento = ' . $departamento . ' and i.id_tipo_incidencia = ' . $tipoIncidenciaDep)->queryAll();

        /*echo "<pre>";
        print_r($posts);
        echo "<pre>";*/

        $nombre = substr(mb_strtolower($posts[0]["nombre"], 'UTF-8'), 1);
        $inicial = $posts[0]["nombre"][0];

        $model = TblTipoIncidencias::find()->where(['id_tipo_incidencia' => $tipoIncidenciaDep])->one();

        echo "
        <script>
             Highcharts.chart('container-depCantidad', {
                chart: {
                    type: 'column'
                },
                            title: {
                                text: 'Incidencias de " . $inicial . $nombre .  "'
                            },
                            subtitle: {
                                text: 'Incidencias de tipo " . $model->nombre_incidencia . "'
                            },
                            xAxis: {
                                categories: ['" . $model->nombre_incidencia . "'],
                                title: {
                                    text: 'Tipo de incidencia'
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
                                column: {
                                    borderRadius: 5,
                                    color: '#095e03'
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
                                data: [" . $posts[0]['cantidad'] . "],
                                tooltip: {
                                    valueSuffix: ''
                                }
                            }, ]
                        });
                    </script>";
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
