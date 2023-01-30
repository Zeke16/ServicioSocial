<?php

namespace app\models;

use yii\base\Model;
use app\models\User;
use Yii;

/**
 * Signup form
 */
class UserSignup extends Model
{
    public $username;
    public $nombres;
    public $apellidos;
    public $dni;
    public $id_departamento;
    public $id_municipio;
    public $lugar_residencia;
    public $email;
    public $telefono;
    public $id_tipo_usuario;
    public $id_comision;
    public $status;
    public $imagen;
    public $password;
    public $authKey;
    public $reCaptcha;

    public static function tableName()
    {
        return 'tbl_usuarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nombres', 'apellidos', 'dni', 'lugar_residencia', 'email', 'password', 'telefono'], 'trim'],
            [['username', 'nombres', 'apellidos', 'dni', 'id_departamento', 'id_municipio', 'lugar_residencia', 'email', 'password', 'telefono'], 'required'],
            [['id_departamento', 'id_municipio', 'id_tipo_usuario', 'id_comision', 'status'], 'integer'],

            ['dni', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Documento de identidad ya registrado.'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Direccion de correo ya existe.'],

            [['lugar_residencia', 'password'], 'string'],
            [['username', 'nombres', 'apellidos', 'email'], 'string', 'max' => 255],
            [['dni'], 'string', 'max' => 10],
            [['telefono'], 'string', 'max' => 20],

            [['imagen'], 'safe'],
            [['imagen'], 'file', 'extensions' => 'jpg, gif, png'],
            ['imagen', 'string', 'min' => 2, 'max' => 255],

            ['reCaptcha', \himiklab\yii2\recaptcha\ReCaptchaValidator::class, 'secret' => '6LcoCxQkAAAAAABOzyCmw_TtpgZVeLcWPz_yw2d2']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'username' => 'Username',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'dni' => 'Documento Nacional de Identidad (DUI o Pasaporte)',
            'id_departamento' => 'Departamento',
            'id_municipio' => 'Municipio',
            'lugar_residencia' => 'Lugar de residencia',
            'email' => 'Correo electrónico',
            'password' => 'Contraseña',
            'telefono' => 'Telefono',
            'id_tipo_usuario' => 'Tipo de usuario',
            'id_comision' => 'Institución',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Contraseña',
            'password_reset_token' => 'Password Reset Token',
            'imagen' => 'Seleccione una foto suya',
            'status' => 'Estado',
            'reCaptcha' => 'reCaptcha'
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->nombres = $this->nombres;
        $user->apellidos = $this->apellidos;
        $user->dni = $this->dni;
        $user->id_departamento = $this->id_departamento;
        $user->id_municipio = $this->id_municipio;
        $user->lugar_residencia = $this->lugar_residencia;
        $user->id_tipo_usuario = $this->id_tipo_usuario;
        $user->id_comision = $this->id_comision;
        $user->email = $this->email;
        $user->telefono = $this->telefono;
        $user->imagen = $this->imagen;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public static function obtenerUltimousuario(){
        $usuario = TblUsuarios::find()->orderBy(['id_usuario' => SORT_DESC])->one();
        return $usuario;
    }
}
