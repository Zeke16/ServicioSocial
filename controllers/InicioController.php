<?php

namespace app\controllers;

use app\models\InicioForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\Controller;

class InicioController extends Controller
{
    public function actionIndex()
    {
        $mensaje = 'Yes, it is';
        $h2 = 'UNIVO';
        $dateTime = new \DateTime();

        return $this->render(
            'index',
            [
                'mensaje' => $mensaje,
                'h2' => $h2,
                'dateTime' => $dateTime,
            ]
        );
    }

    public function actionSuma()
    {
        $model = new InicioForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $resultado = $model->valor_a + $model->valor_b;
            $respuesta = ("El resultado es: " . $resultado);

            return $this->render('suma', ['model' => $model, 'respuesta' => $respuesta]);
        }

        return $this->render('suma', ['model' => $model]);
    }

    public function actionResta()
    {
        $model = new InicioForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $resultado = $model->valor_a - $model->valor_b;
            $respuesta = ("El resultado es: " . $resultado);

            return $this->render('suma', ['model' => $model, 'respuesta' => $respuesta]);
        }

        return $this->render('suma', ['model' => $model]);
    }
}
