<?php

namespace app\controllers;

use app\models\TblProductos;
use app\models\ProductosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductosController implements the CRUD actions for TblProductos model.
 */
class ProductosController extends Controller
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
     * Lists all TblProductos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblProductos model.
     * @param int $id_producto Id Producto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_producto)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_producto),
        ]);
    }

    /**
     * Creates a new TblProductos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TblProductos();

        if ($model->load($this->request->post())) {
            $model->fecha_ing = date('Y-m-d H:i:s');
            $model->fecha_mod = date('Y-m-d H:i:s');
            $model->id_usuario = 1;
            
            if (!$model->save()){
               print_r($model->getErrors());
               die(); 
            }

            return $this->redirect(['view', 'id_producto' => $model->id_producto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TblProductos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_producto Id Producto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_producto)
    {
        $model = $this->findModel($id_producto);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_producto' => $model->id_producto]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblProductos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_producto Id Producto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_producto)
    {
        $this->findModel($id_producto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblProductos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_producto Id Producto
     * @return TblProductos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_producto)
    {
        if (($model = TblProductos::findOne(['id_producto' => $id_producto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
