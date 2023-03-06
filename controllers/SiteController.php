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
                            'get-filtro-tipos'
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

    public function actionGetFiltroMunicipios($tipoIncidencia, $municipio, $tiempoInicioMun, $tiempoFinMun)
    {
        if ($tipoIncidencia === "Todas") {
            $db = Yii::$app->db;
            $posts = $db->createCommand('
                SELECT m.nombre, t.nombre_incidencia, count(i.id_incidencia) as cantidad, i.fecha_registro from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                INNER JOIN tbl_tipo_incidencias t
                ON i.id_tipo_incidencia = t.id_tipo_incidencia
                WHERE m.id_municipio = ' . $municipio . ' AND fecha_registro BETWEEN "' . $tiempoInicioMun . '" AND "' . $tiempoFinMun . '"
                GROUP BY t.id_tipo_incidencia
                ')->queryAll();
            /*echo "<pre>";
            print_r($posts);
            echo "<pre>";*/



            $incidencias = '';
            for ($i = 0; $i < count($posts); $i++) {
                $nombre = substr(mb_strtolower($posts[$i]['nombre_incidencia'], 'UTF-8'), 1);
                $inicial = $posts[$i]['nombre_incidencia'][0];
                $incidencias .= "'" . $inicial . $nombre .  "', ";
            }

            $cantidades = '';
            for ($i = 0; $i < count($posts); $i++) {
                $cantidades .= $posts[$i]["cantidad"] . ", ";
            }

            $nombre = substr(mb_strtolower($posts[0]['nombre'], 'UTF-8'), 1);
            $inicial = $posts[0]['nombre'][0];
            echo "
                <script>
                    Highcharts.chart('container-munCantidad', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Incidencias de " . $inicial . $nombre . "',
                        },
                        subtitle: {
                            text: 'Cantidad de incidencias'
                        },
                        xAxis: {
                            categories: [" . $incidencias . "],
                            title: {
                                text: 'Tipos de incidencias'
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
                            data: [" . $cantidades . "],
                            tooltip: {
                                valueSuffix: ''
                            }
                        }, ]
                    }, function(chart) { // on complete

                        chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                            .add();

                    });
                </script>
                ";
        } else {
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
                        }, function(chart) { // on complete

                            chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                                .add();
    
                        });
                    </script>";
        }
    }

    public function actionGetFiltroDepartamentos($tipoIncidenciaDep, $departamento, $tiempoInicio, $tiempoFin)
    {
        if ($tipoIncidenciaDep === "Todas") {
            $db = Yii::$app->db;
            $posts = $db->createCommand('
                SELECT d.nombre, t.nombre_incidencia, count(i.id_incidencia) as cantidad, i.fecha_registro from tbl_incidencias i 
                INNER JOIN tbl_municipios m
                ON i.id_municipio = m.id_municipio
                INNER JOIN tbl_departamentos d
                ON m.id_departamento = d.id_departamento
                INNER JOIN tbl_tipo_incidencias t
                ON i.id_tipo_incidencia = t.id_tipo_incidencia
                WHERE d.id_departamento = ' . $departamento . ' AND fecha_registro BETWEEN "' . $tiempoInicio . '" AND "' . $tiempoFin . '"
                GROUP BY t.id_tipo_incidencia
                ')->queryAll();
            /*echo "<pre>";
            print_r($posts);
            echo "<pre>";*/



            $incidencias = '';
            for ($i = 0; $i < count($posts); $i++) {
                $nombre = substr(mb_strtolower($posts[$i]['nombre_incidencia'], 'UTF-8'), 1);
                $inicial = $posts[$i]['nombre_incidencia'][0];
                $incidencias .= "'" . $inicial . $nombre .  "', ";
            }

            $cantidades = '';
            for ($i = 0; $i < count($posts); $i++) {
                $cantidades .= $posts[$i]["cantidad"] . ", ";
            }

            $route = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABFFBMVEX///8yOET///3//v////v8///W2NsyOEUzOEQxOUVITloeJzUtM0AxOkMyOUP29vUqMD00N0fu7/HDxMc3P0bNztHp6eseJzEoMDscJzQ0OULx9PUmLTctNkWsrbEkLTrg4eNydXsVHi4rMzsAEie3ur6RlJdRWWFiaHQ7Q06BhIlqcHRjaW+hpagMGCp5fISxtLQAFCNYXWeprbUAABUVIyx8goZCR0yanqYfJjmJj41vdHcAARw1PUJMUlUhLD9BQFALECwwL0RYV1mFi5hlZGa9v72nqKexscLQztYhIy2JkZoeLkAADhlTW2kWGinLz8ogIDhNTFoCGCq0urOZnZvr7ugAGjGAh4ciKUFqaWldWmw7+psqAAAVwUlEQVR4nO1dC3+aSL8eQQa5CYKDKHK1gCJEg03UbhO7vaSnsdt2N+/u2e77/b/HmcGkzTaS1Gw0dg/P77cbi1zmYWb+9xkBKFGiRIkSJUqUKFGiRIkSJUqUKFGiRIkSJUqUKFGiRIkSJUqU+HeCAiYCFPPYzdgeqCpIp6D6L2YIgNk8wp342K3YJuwWlz12G7YG2YXBbFDhlHiCXJV+7OZsAXpHEJwKhiLMnwSP3ZptgHEHYiWHOJ+A6mM3ZwuoAn2aU6wtAiJVf1TQlG5jfbBeIUCBbTQaxrP1lzJMFcSgSu/5FKVB2C3UeNqcrdRY46eCaxlKfx6APScIgCrO7SKNF86dk9OWFRWQwF244Jm915ahY02LjJahEOuyPRD0m1/lpHWjIeRSdl9Zqtpk6bGVei87TjV483s5dEnj1Zm75mIUhCNerFUG3tLW5C239L4wowtHqVSsRmPx+QAV9EPR4fHzxUqZKM7h8d5arnSfqHSWZS3lNutz3TcUCHx2pS7by70lSAF6iPuwLnFNCIplIrWOIT5bU1Z9GO61tnQFzJBzwntd3M+HKac+cJseFoFQEQ3OSO5zrcmLFUWsCGtk1B4hFIQPXts5vY8w1BVHiXlB2G+r/M0LmwYw+dW9x7Xo59jFquTl/Yb4jiCPVWKaAM29x8UIYhGD7fP97kMCqnpfkwQTrO6xGM1B2N3bOaAJHrQ5JUr8y0Ht1FV9jOlJ6bPdPUzTHsNlnPm7MyD5xwgjq4P2zowP5HfRrp71FanA+hvPDjLUNrnoUj2+su5ny98b6jiNI+zpiIMktDd5udjv09JNnkQBaIfDpkGe9VNo78zroH86NCy2VqlYltPSNrvU65sbnE4xOn/U4ywSKDfa/A49x7gl5c5qpbbh/ND73iYdgUepmXQljsRGnGSH8SkKhEbOsLnpuLFHib1RQylM0eiQPtwlQUBRukDCRuJwMzVFgaDdtjd92sQhDLFjvMPkMQW0Nicqtcrppoo4ELobK+/Y6ShixQl3yzBt+/xr32luOveHBrdxYi1xPo5GB85wlwwZMHqBPXF19HHDeegavWTTZpq1vgsAfNMwd2i5Vatnq2nvws0eGjpH2mbqBYA/LoPL79QdMqSo1cM2HW90hm2TTW296ubPeQBcWl6bRix0zofm6Y3DFMEtD8ufcf/ozy6B/CmArRsTkQSgfoTm/x1rUoQAjP3XKDLcbw/n7G4c3XeEp+ObNshbf/nB6N6QvzStapm3t2nRAmiz6K37raf0tiUp4k2GQE1P/6cwNb6vYMIouCGHztq9Ydy+YaxTAPGv5R9uKtqN6Q0F5got12xlN+SvmQnpD0bQnYFPnxeR+U2r0QFWhsHFt7Y381NXsMH43c6a9w9BYzmqj6sUjz0685qeoyk5c+IwjI2B+vUw1hNM7FQEGmgQX7jvWYsV4BQOdQo0KxVn9Lcv0o8zLQi0yVH8lQnmGgpi5YCmzARlm1p0jwTeENs6MEnKWoiv1SXoDj8LNC2YZG14TcqmbXyi7wJm4LwU9rZG4TrQeUecHqf6ggQBjsKvDEf+ctT3vMRbvr8WObPbxJcWUHAcSWxr/Jg6g6aqDF2lbjdEqSp4Y9Q6PcWELRJcWWj2qrsoCh32tVXz4fHhlyyopvUkTFHQwNSp1cTe9zTkH5C4/cYUcNM7XzGceIplDBBAeWmNKKMrMi+aX6JsdNS9/Iy/neYMbeDyC8uaBndlgCkgby0STYERx9zRh0CHS2U6xK6/RkapyMvgTMvn4uzn4Kt8QVjYEECsOBIS1HJmgDLjaWfoune0ogrs51uJKtK4lfq8PS4o+PnyfIr53UXkHPszYZjhnh8jUj07z1b9T6xVChw/hSAfE3h65gyXhD6Eb2+PpmIvqypP3z8Dt7pb90fs9E5v60KKcfEb1l2PvJA078OEhAO7Lu7+X1xsf7rIDjUk01XV+QAodUpoxg4epUpMojAzjcEj0L19mNhdzljrufwz6EE6yqyGJfLeLCgMzqinZlwDROLTIMwZYo+BUg95E33Ew1K3ka0FyLbxKEufByA5hLjnQofDDD3MEA8AcDo0h7BotpvaJE46Emfxw3D8wLka9fTIEOs1ieOMdquQYWxMuw3v1VeGyggzNH0liRQTIKQhiBCCrnpGgRdT732LcAlJH+LOxgyB128aAyspNG28JwuRkySprjhYHD/kQKUAnTic1ME37524RbeWHY6rs36aT9qYyFKRMJTbnOUHwNV0N7DT1J64QaAD9FHkWm7OkCMTFjOkQXBQESucrxe2/VmLw884keotjQj3h4WX19WJvFt4hn7EdSpGQobPFUM8ShlqWrEyLEYC3bYhLcOZrdtjBowcqaf+jSFF6UMsdrhW0QDE4z9PJ0ictI184juhshLrhVAxQ7G+BNcYJjQWep4iQMDMYGDryNOAngY6FiZqz8jyzjYqlwyrVTBhSR8WTQP8DlTyniVruAWCYCJURIXFvVKMpdNl025If2WIOTDAPlgCyg1QGtBTw1dBkKoIS8MUH8Yn/vSFIZaTzox3nMJHMNhXJq2QLH6THN334vV83o+FxW/rU0AURbuBqcR62G0nZHrF74lNw5nY0Y9I8F9HyEaYwvsUIBuSZKf8amDSFBP1VmoF60xvrnhq+BKLIwasLf+iwOTzPHomdsUt6Avw6lSjAfTOi+59jMZyqgawY1kdbKqEOUPBxR1ziO0EIEPXDsBPjvMKBGM4xscBOsR9yzjSiiHQml3W0T65gfsJJUW10nHNNoEe/7KFeSif4feKn/ppLUPa1bsjADXVlpsWawlDdZYznGvAbEVEQ6oaIqPTSzR1pqlafpfjCwigL+VqhY7bIsu2zTPo/gekh0hfMw6x8R/IOXd3OwlvujjErXY80cdKwFbljnQiSc4yIVXbrPIMjC5WGlxTMUUXnunpBLkrV1d/H4E070MlCw2rwVbaLpWab+GvRtJz1zSArgKGAfR2TLZbgB+oi5hQb6k91dEJFv5sz3R/e8/VOxX23ZP48jRZC8Z2GtrYzb+ay+nT4IOIhb/SQKBJsvXdM7M1SQeiZLX3qRiaMCQ9Vs/6RnbcJAwllUjWeh3PMOUyWMNoGIEW2PgPuhwLDE+EP+eMTMCc5vUIr6MG74msVKwUHwOYAalCr7CsyDnhgNQVDEiYLRDwR38CqjkfhGciWllueMDSq+uQf+k6ASYiDJVZqyHW2YbE9bYhLe8L0kehg1UDx7GKVrdI9YtJ6pl9riJG+eoJIjZ0FZmYHZSRroMVQxp4DlufE/eKSQhDRzth2QrbqBcrxceC3nGISdwa6T1uxZCh1DYnzcl0Qv1sRDiq2EE+05nrDqwqsCctiE07JiMDtgVTn9zn5fmGudcdwPWORGve1/Uem49SzNDssd2YJP0zVw5eYPEJNQaeAfC38HYqSG39C8M2lL22xflZoQf1mHCnpwED1HouMdRq3ug67q9JQoak6vGeF55OwuPwuqarYmGTvw6Gz2Nu2IDVsiaRMvtW8U2rMdHjU3nF0CHdApYXNqDgC3rVaXo2AW70NAiaGlBtnXQShecoOujjXqXkes7Qpf/Cosg9pfdvgd7oHTDPgDkMeOuyL4AqZQwwsQmZq4sqoPspnpNNzfROB5OTsRu/JdobjPBcxU4DiZuyyrupShZeQO/bnMfjIzoImf+A4UGQzychwAzj1p/2snEt4UInARarrwIATyHz7GgZRqNJmi6VBLtFsE20TB39EpmfXNvvbMN5+AeQ38LMOn9tp8L7wMtjZyGWK9iaQfy1hYh4KEYBqJoRHqVNF/zxRnN/IrFPErMB4y6RwaduexEHs7bYhOk+rWGjQF/Eip5dDiwnDol5Y2HngOf0Z3/p16KPxDL4DYtUPULA5VygZu/AM2zTybwkY0eYMPRShxWX2HxgB/wezUQsU2Z5AIDHWn8aENfXMhj7YJZ8Uy6L5YrJ4/7SpwjAqQt0HoJj3Isa9oUHHDbxnNSzKrVBHZtH3+StHhfE9W6vVriyYgwJWaubDgbRjWQZ7kU6swlFLaeoDt7lFL0Du811SPoidSo1fH2j0tqnBV4MdmpGeSdWuPYYkE8NqWcZiJG/gWmastoPZVofjGk40Kp654zxlkA/MizC0NfhRS1nqET7lmhj3ggvWU4SX8iACFNJEvl+xK9FlpH/RXyE/yN/sygGs3mDO2GtDgCJwkknJ8Z0/7SFGQ8Wc6uBZ56NO5GTupuJ+6bFndQULHY00Vo4A2+XZXrXUezRYBuLgcFvIziWXZ8EaGxQ3QDgEza4az72sLS0k8Lb3w7cnkGnHRd+RdNUtfo7nOnv+mokVqyIqTLfizw44jlcbcC8gjBAv+vVW+MUb8a3J8DuC3zP6FwHhXWEuJUp8ztAT+HZEbdAJJqyCXTDElLzuQ1S2lYLzW5S9gnPp8yWVuxrgrIEoGglq+y9heYYZi0bRg5xmjZjCNLzFzBwmu5MhpNkvT1D5X07NMhyb+rh6xlNNyJ2Y7EtZV84XJaIvWM+6WlwY6DBb4k3MJLsRPALZgMDGB2lBmfxGnxomw6ennRbIlept1qNwdr1BMhOFw1LNNh6UxRbfqvVFjDa/hOCiwtfyNEW2sLlp4v8mycH5B/zeavlz8VeneV6IrZnwvH6iv70sN3q1jmLdc4F331YiquikDzIO1r7cDXyVydUpPoLLe0RMxN/TpGWwzvPo2pcZ5DvDSK2stVxNMkPNMRuiDJOqq9uIUgFKbzZVTPE3oNHAWxndWsnXhtwvwy3EdSNPnb4E0FhMaPe73+sTkB9TIUTM5Kkqw+SS5tMtjkseAlhSKJZ3CVDp1AtpavtQdgOfPh9eiarzdZG62sV8LFgZbhhGiR7D1AmKBWp0m0lMw268N3kg6hwRoxvo4h8ivAhlHqKgM3QxRw7VSRtfMXQWRa1ngZxTtHZxqJS7bwuscTsWHtrcrAhcmRoNl562DbA5jg8brYdy7Lez9ttwfd9dsQ7ttYexIP20dERnqgL/KUisB7ZrUcn20jlDNlKq8CiIeHH4169JtXOt1EBN3M4Z25Ztyx1RH7OkCURxAQCFQJTC980Wx/P/XY9izUTOj7CRnZADp+0jnz/vPMm1FTgYi+jaQK1xuaT1y9aGpW7Jj2n0e7dlqi9N0Z+PUDZxeAWxzTwRQzHRiE8mIHoWR5skmVV11WZuArjdlsF7Xx1LbU6Kud9ZUsgOAzGNjJYfL1Q2HrMUBWFpQqTiy0EjGV+JoMq0Jpu4SlVMOEHffYXlZFj5wP83wFNY5OMsY/jM1JswwCVfeIyh213lcNC4Sg1AbbaqOQiOHYS2WSkRZ8fzIo3k8Ij39NJ8hQNHz4CIF/d8o5b/47sDDCR6CyN96QzoO8bow8DLXf3zGfhbLQKbKBoMBr5zzX8XgJsK/UarA7i0N0nz74ArgrjY5MnWsOaysBFWcx7y1E0TfWc5GpjtkkWebM48aJ3ENB9sSJKDVGfeUjep4xTEWhXGnhky6e61XOBSZLS4ZvMe61UojjVENLssD/ovx71T2MXD2EdCxhiGjT4uD7Q9s7tXYc0PKkrxPKoc93VIgrdhWE0Er3RKMui7ET6MFouPd6D7spwQULOkO1ZVhzfdfd9AHx6aVitUlCYAzzMAhgOkiyOR94ybnr9/umfECUHRM9fpmSIlrHY5/sUfloPsg1SKlwxrCguCPg44Kx5CEyUHicZz3/IXqefTJB2DWOy/DAD5tXGrfWTXsG+n3sFGqsHT7liyMdjwC8cbGq3V5YC8ehzgRMekSrAhch8+iu5YihF+xTmLgQ8+UWSpBoGVzeyatWdLdgK/seFS+bc1dpMs8vlGeMYmz+ewbJco9FgJe5gK9bYQ4NOj0TSerZnTAcaQM8v3YWQsWdjBmsLLUzdlZXO1g9tgE55w8hT5NxRvGf5mCIEvOI4jpikUB0l7uhyzFojafrxT2zBP1nwfJ6Cq7Bioo/6rpp6nVa32+I32jPjEYHNY5iGmkv2zcFW1uhKtC6O4aIng+E81Vr5RhDYixgNUV7PrqMwhcz9twnbLa4F42SkzS6d2gqrDEH4HNG/ZtjVvDxYryw19MfXS38MgtfBeEdd7opho64DPoSHLriSnhiGH+1RFm1DYK8/WErSFcN6Q8kms97J8TivKL2E1IuDNetp9wPqHUYkdhqedCXuiqH0+eeDVg9rEuHng682gXRiPL9bwMiPIWOrYPYda4QGnU4NqzpOkurzMXBHguMIHz5VNcMiGhN/06h37lSBFJjNHmFlImXWendJBvmvtigauN8sa96YBG/8eYD+4059fqJNF5bF9XrY2m7zd1aw0d2a+QhrL1OhNbkzohckWZKdTjvZ5F100lzkhrXOioOmpiWdwWmWJJF9RyoUP2HScnauKmUVTsX6C1f9HiFBqzpA3WPdyKh8D4jlUZA+DYB6+SMXd+SRZN19URenUN+lPNKyqClgiW8Jgyj7rl9VSZ+/JE4UyBf5zX5OQfa0ICz5N1AAfeA5gVQ7ChJ/sy5ga2CWvkVEpMXVj0L6O1pqIqgCc4odepJ0CxINmPCWHM8XYPNodiSxbO49+ktmZxYBBcJ5/lS2/d1xS/wa8i6gsVRE5gZNnbVWDOfhFsLcRcBu7rIrVdgaqe79vseuUpp0zpDKi9G/s7l4UDs17Dt2Z+uXYGwHpEQI63Kr40x28LTU6XAcYbjDn8LCDEeK5Tg9ozix/3A4dkTDsKzRbhnSmR9pZ7y/i103I58/07JfM3qnP2em5tvPyPar7UdW1FdjMn3Hp7sN4lyZwt+l8f/ho/JHUF/TCrvEzlfn7Bw/wBbqJUr8fwQFGPcfXOzu7289XYKsEInuuw0nXQXYQdpzAY2blxzCezaSAvAg23eGAKCWteHeu1+A3461VwsrbwDzUmEmck7g0pvGr2nyM55jx+plD151+IBwpy3fz9cE+XNl05KemTL3SQmY6PtCx91G8x4CmmNdBnrnow1/5Y9hRvP8ylrNMvY2iUgBtOJXc2K6IISrn62/Fp8dK7X86g7a243pSChmwZIflhsWWOUUCF8UXEvKm0nlX72L9lqcwjnL1uprf4czN9PVjq8V769jSJVGY77X0pTU2QrnPW7d73DmvGZO5eY+wpeQI6t3LjQ+b7xp+07xp18P3OGFsiYVYUItPT7hLGU4C9C6VIVuXHj6WfNgr6uG6L/ekj/wv2u2fPijd/A5T+mLTvuXYM1Mg/91yR/7r33OBOfrk0loVF7DwIwuaxbE3tpMgAxWEdF9JrhCwaoaCqhvVtltrkCW3L6t9z5hfSeQ8ldstNQqSmGd+g/QfbcB+0ZBi22IrFL0m84/OjDD5Xth0PcXe7c89IGAGfaFmQm039r7tDHLQ4KSUzUXtPk2WCVKlChRokSJEiVKlChRokSJEiVKlChRokSJEiVKlChRokSJEv9C/B/KUAiB2SlIFwAAAABJRU5ErkJggg==";
            $nombre = substr(mb_strtolower($posts[0]['nombre'], 'UTF-8'), 1);
            $inicial = $posts[0]['nombre'][0];
            echo "
                <script>
                    Highcharts.chart('container-depCantidad', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Incidencias de " . $inicial . $nombre . "',
                        },
                        subtitle: {
                            text: 'Cantidad de incidencias'
                        },
                        xAxis: {
                            categories: [" . $incidencias . "],
                            title: {
                                text: 'Tipos de incidencias'
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
                            data: [" . $cantidades . "],
                            tooltip: {
                                valueSuffix: ''
                            }
                        }, ]
                    }, function(chart) { // on complete

                        chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                            .add();

                    });
                </script>
                ";
        } else {

            $db = Yii::$app->db;
            $posts = $db->createCommand('
        SELECT d.nombre, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_municipios m
        ON i.id_municipio = m.id_municipio
        INNER JOIN tbl_departamentos d
        ON m.id_departamento = d.id_departamento
        WHERE d.id_departamento = ' . $departamento . ' and i.id_tipo_incidencia = ' . $tipoIncidenciaDep
                . ' AND fecha_registro between "' . $tiempoInicio . '" AND "' . $tiempoFin . '"')->queryAll();

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
                        }, function(chart) { // on complete

                            chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                                .add();
    
                        });
                    </script>";
        }
    }

    public function actionGetFiltroTipos($tiempoInicioTipo, $tiempoFinTipo)
    {

        $db = Yii::$app->db;
        $posts = $db->createCommand('
        SELECT t.nombre_incidencia, count(i.id_incidencia) as cantidad from tbl_incidencias i 
        INNER JOIN tbl_tipo_incidencias t
        ON i.id_tipo_incidencia = t.id_tipo_incidencia
        WHERE fecha_registro between "' . $tiempoInicioTipo . '" AND "' . $tiempoFinTipo . '" 
        GROUP BY t.id_tipo_incidencia
        ')->queryAll();

        $cantidad = TblIncidencias::find()->count();
        $incidencias = '';
        for ($i = 0; $i < count($posts); $i++) {
            $inicial = $posts[$i]["nombre_incidencia"];
            $incidencias .= "'" . $inicial . "', ";
        }
        $series = '';
        for ($i = 0; $i < count($posts); $i++) {
            $porcentaje = $posts[$i]["cantidad"] / $cantidad * 100;
            $series .= "{ 
            name: '" . $posts[$i]["nombre_incidencia"] . "',
            y: " . $porcentaje .
                "}, ";
        }
        echo "<script>
                Highcharts.chart('container-total-tipos', {
                    chart: {
                        type: 'pie',
                    },
                    title: {
                        text: 'Incidencias por tipo'
                    },
                    subtitle: {
                        text: 'Cantidad de incidencias registradas'
                    },
                    xAxis: {
                        categories: [" . $incidencias . "],
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
                        data: [" . $series . "],
                        tooltip: {
                            valueSuffix: '%'
                        }
                    }, ]
                }, function(chart) { // on complete

                    chart.renderer.image('https://scontent.fsal3-1.fna.fbcdn.net/v/t1.6435-9/120728429_10160432677613569_7084140902592378135_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=174925&_nc_eui2=AeGWCtb_Vrz4x2PFTBzmOSlLeaSpNR2Zd8N5pKk1HZl3w-R5rao2T9DvRkrSqwyio3JqCHbmeMkvZJaYbmJdB16a&_nc_ohc=efTqOoSR_zoAX8UZ3XX&_nc_ht=scontent.fsal3-1.fna&oh=00_AfDa8h7DUoM1g8pZujzdD7ZMeL3sLZKCppqztNf-Y0YYLg&oe=642C5BAB', 10, 10, 125, 125)
                        .add();

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
