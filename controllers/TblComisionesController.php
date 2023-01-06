<?php

namespace app\controllers;

use app\models\TblComisiones;
use app\models\TblComisionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblComisionesController implements the CRUD actions for TblComisiones model.
 */
class TblComisionesController extends Controller
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
     * Lists all TblComisiones models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblComisionesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblComisiones model.
     * @param int $id_comision Id Comision
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_comision)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_comision),
        ]);
    }

    /**
     * Creates a new TblComisiones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblComisiones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_comision' => $model->id_comision]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblComisiones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_comision Id Comision
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_comision)
    {
        $model = $this->findModel($id_comision);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_comision' => $model->id_comision]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblComisiones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_comision Id Comision
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_comision)
    {
        $this->findModel($id_comision)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblComisiones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_comision Id Comision
     * @return TblComisiones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_comision)
    {
        if (($model = TblComisiones::findOne(['id_comision' => $id_comision])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
