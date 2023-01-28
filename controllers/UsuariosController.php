<?php

namespace app\controllers;

use app\models\AuthAssignment;
use app\models\TblMunicipios;
use Yii;
use app\models\TblUsuarios;
use app\models\TblUsuariosSearch;
use app\models\UserSignup;
use app\models\UserSignupAdmin;
use app\models\UsuariosSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\UploadedFile;

/**
 * UsuariosController implements the CRUD actions for TblUsuarios model.
 */
class UsuariosController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TblUsuarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TblUsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblUsuarios model.
     * @param int $id_usuario Id Usuario
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_usuario)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_usuario),
        ]);
    }

    public function actionSignup()
    {
        $model = new UserSignupAdmin();

        if ($model->load(Yii::$app->request->post())) {
            $model->username = $model->nombres . $model->apellidos;
            $image = UploadedFile::getInstance($model, 'imagen');
            if (empty($image)) {
                $name = $this->request->baseUrl . '/avatars/default.png';
                $model->imagen = $name;
            } else {
                $tmp = explode(".", $image->name);
                $ext = end($tmp);
                $name = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::$app->basePath . '/web/avatars/' . $name;
                $path2 = Yii::$app->request->baseUrl . '/avatars/' . $name;
                $model->imagen = $path2;
                $image->saveAs($path);
            }
            if ($model->signup()) { {
                    $this->asignarRol();
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionCreateUser()
    {
        $this->layout = 'main-register';
        $model = new UserSignup();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            $model->username = $model->nombres . $model->apellidos;
            $model->id_comision = 8;
            $model->id_tipo_usuario = 1;


            $image = UploadedFile::getInstance($model, 'imagen');
            if (empty($image)) {
                $name = $this->request->baseUrl . '/avatars/default.png';
                $model->imagen = $name;
            } else {
                $tmp = explode(".", $image->name);
                $ext = end($tmp);
                $name = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::$app->basePath . '/web/avatars/' . $name;
                $path2 = Yii::$app->request->baseUrl . '/avatars/' . $name;
                $model->imagen = $path2;
                $image->saveAs($path);
            }
            if ($model->signup()) {
                $this->asignarRol();
                return $this->redirect(['site/login']);
            }
        }

        return $this->render('_form-register', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_usuario)
    {
        $model = $this->findModel($id_usuario);
        $model2 = TblUsuarios::find()
            ->where(['id_usuario' => $id_usuario])
            ->one();

        //TODO: Remover required password hash de TblUsuario
        $model->password_hash = '';
        $j = $model2->password_hash;
        $imagenAntigua = $model->imagen;
        $comisionVieja = $model->id_comision;
        $tipoUsuarioViejo = $model->id_tipo_usuario;

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_at = strtotime("now");
            $image = UploadedFile::getInstance($model, 'imagen');

            if (empty($image)) {
                $model->imagen = $imagenAntigua;
            } else {
                $tmp = explode(".", $image->name);
                $ext = end($tmp);
                $name = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::$app->basePath . '/web/avatars/' . $name;
                $path2 = Yii::$app->request->baseUrl . '/avatars/' . $name;;
                $model->imagen = $path2;
                $image->saveAs($path);
            }

            $id_comision = $_POST['TblUsuarios']['id_comision'];
            if (empty($id_tipo)) {
                $model->id_comision = $comisionVieja;
            }

            $id_tipo = $_POST['TblUsuarios']['id_tipo_usuario'];
            if (empty($id_tipo)) {
                $model->id_comision = $tipoUsuarioViejo;
            }

            $i = $_POST['TblUsuarios']['password_hash'];
            if (empty($i)) {
                $model->password_hash = $j;
            } else {
                $new_password = Yii::$app->security->generatePasswordHash($i);
                $model->password_hash = $new_password;
            }
            $model->save();
            return $this->redirect(['view', 'id_usuario' => $model->id_usuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_usuario Id Usuario
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_usuario)
    {
        $this->findModel($id_usuario)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_usuario Id Usuario
     * @return TblUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_usuario)
    {
        if (($model = TblUsuarios::findOne(['id_usuario' => $id_usuario])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionLists($id)
    {
        $countMunicipios = TblMunicipios::find()->where(['id_departamento' => $id])->count();

        $municipios = TblMunicipios::find()->where(['id_departamento' => $id])->orderBy('id_municipio ASC')->all();

        echo "<option>-- Seleccionar municipio --</option>";
        if ($countMunicipios > 0) {
            foreach ($municipios as $municipio) {
                echo "<option value='" . $municipio->id_municipio . "'>" . $municipio->nombre . "</option>";
            }
        }
    }

    function asignarRol()
    {
        $usuario = UserSignup::obtenerUltimousuario();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $auth = Yii::$app->authManager;
            if ($usuario->id_tipo_usuario == 1) {
                $authorRole = $auth->getRole('UsuarioEstandarRol');
            }else if($usuario->id_tipo_usuario == 2){
                $authorRole = $auth->getRole('UsuarioConsultorRol');
            }else if($usuario->id_tipo_usuario == 3){
                $authorRole = $auth->getRole('UsuarioSupervisorRol');
            }else if($usuario->id_tipo_usuario == 4){
                $authorRole = $auth->getRole('MasterRol');
            }

            $auth->assign($authorRole, $usuario->id_usuario);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            print_r($e->getMessage());
            return $this->redirect(['site/login']);
        }
    }

    public function actionMunicipios()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {

            $id = end($_POST['depdrop_parents']);
            $list = TblMunicipios::find()->where(['id_departamento' => $id])->asArray()->all();
            $selected = null;

            if ($id != null && count($list) > 0) {
                $selected = '';
                if (!empty($_POST['depdrop_params'])) {
                    $id1 = $_POST['depdrop_all_params']['model_id1'];

                    foreach ($list as $municipio) {
                        $out[] = ['id' => $municipio['id_municipio'], 'name' => $municipio['nombre']];

                        if ($municipio['id_municipio'] == $id1) {
                            $selected = $id;
                        }
                    }
                }

                return Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }
        return Json::encode(['output' => $out, 'selected' => $selected]);
    }
}
