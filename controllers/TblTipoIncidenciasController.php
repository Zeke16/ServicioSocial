<?php

namespace app\controllers;

use app\models\TblTipoIncidencias;
use app\models\TblTipoIncidenciasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblTipoIncidenciasController implements the CRUD actions for TblTipoIncidencias model.
 */
class TblTipoIncidenciasController extends Controller
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
     * Lists all TblTipoIncidencias models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblTipoIncidenciasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblTipoIncidencias model.
     * @param int $id_tipo_incidencia Id Tipo Incidencia
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_tipo_incidencia)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_tipo_incidencia),
        ]);
    }

    /**
     * Creates a new TblTipoIncidencias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblTipoIncidencias();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_tipo_incidencia' => $model->id_tipo_incidencia]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblTipoIncidencias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_tipo_incidencia Id Tipo Incidencia
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tipo_incidencia)
    {
        $model = $this->findModel($id_tipo_incidencia);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_tipo_incidencia' => $model->id_tipo_incidencia]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblTipoIncidencias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_tipo_incidencia Id Tipo Incidencia
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_tipo_incidencia)
    {
        $this->findModel($id_tipo_incidencia)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblTipoIncidencias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_tipo_incidencia Id Tipo Incidencia
     * @return TblTipoIncidencias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_tipo_incidencia)
    {
        if (($model = TblTipoIncidencias::findOne(['id_tipo_incidencia' => $id_tipo_incidencia])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
