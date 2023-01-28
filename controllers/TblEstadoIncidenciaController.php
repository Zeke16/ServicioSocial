<?php

namespace app\controllers;

use app\models\TblEstadoIncidencia;
use app\models\TblEstadoIncidenciaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblEstadoIncidenciaController implements the CRUD actions for TblEstadoIncidencia model.
 */
class TblEstadoIncidenciaController extends Controller
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
     * Lists all TblEstadoIncidencia models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblEstadoIncidenciaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblEstadoIncidencia model.
     * @param int $id_estado_incidencia Id Estado Incidencia
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_estado_incidencia)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_estado_incidencia),
        ]);
    }

    /**
     * Creates a new TblEstadoIncidencia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblEstadoIncidencia();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_estado_incidencia' => $model->id_estado_incidencia]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblEstadoIncidencia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_estado_incidencia Id Estado Incidencia
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_estado_incidencia)
    {
        $model = $this->findModel($id_estado_incidencia);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['tbl-incidencias/view', 'id_incidencia' => $model->id_incidencia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblEstadoIncidencia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_estado_incidencia Id Estado Incidencia
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_estado_incidencia)
    {
        $this->findModel($id_estado_incidencia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblEstadoIncidencia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_estado_incidencia Id Estado Incidencia
     * @return TblEstadoIncidencia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_estado_incidencia)
    {
        if (($model = TblEstadoIncidencia::findOne(['id_estado_incidencia' => $id_estado_incidencia])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
