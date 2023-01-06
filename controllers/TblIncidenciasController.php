<?php

namespace app\controllers;

use app\models\TblIncidencias;
use app\models\TblIncidenciasSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblIncidenciasController implements the CRUD actions for TblIncidencias model.
 */
class TblIncidenciasController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TblIncidencias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblIncidenciasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->sort->defaultOrder = ['fecha_registro' => SORT_DESC];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblIncidencias model.
     * @param int $id_incidencia Id Incidencia
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_incidencia)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_incidencia),
        ]);
    }

    /**
     * Creates a new TblIncidencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblIncidencias();

        if ($model->load($this->request->post())) {
            if (
                Yii::$app->user->can('UsuarioEstandarAccess') || Yii::$app->user->can('UsuarioConsultorAccess')
                || Yii::$app->user->can('UsuarioSupervisorAccess')
            ) {
                $model->id_usuario = Yii::$app->user->identity->id_usuario;
            }
            $model->fecha_registro = date('Y-m-d H:i:s');

            if (!$model->save()) {
                print_r($model->getErrors());
                die();
            }

            return $this->redirect(['view', 'id_incidencia' => $model->id_incidencia]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblIncidencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_incidencia Id Incidencia
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_incidencia)
    {
        $model = $this->findModel($id_incidencia);

        if ($model->load($this->request->post())) {
            if (
                Yii::$app->user->can('UsuarioEstandarAccess') || Yii::$app->user->can('UsuarioConsultorAccess')
                || Yii::$app->user->can('UsuarioSupervisorAccess')
            ) {
                $model->id_usuario = Yii::$app->user->identity->id_usuario;
            }

            if (!$model->save()) {
                print_r($model->getErrors());
                die();
            }

            return $this->redirect(['view', 'id_incidencia' => $model->id_incidencia]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblIncidencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_incidencia Id Incidencia
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_incidencia)
    {
        $this->findModel($id_incidencia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblIncidencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_incidencia Id Incidencia
     * @return TblIncidencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_incidencia)
    {
        if (($model = TblIncidencias::findOne(['id_incidencia' => $id_incidencia])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
