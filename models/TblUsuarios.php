<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_usuarios".
 *
 * @property int $id_usuario
 * @property string $username
 * @property string $nombres
 * @property string $apellidos
 * @property string $dni
 * @property int $id_departamento
 * @property int $id_municipio
 * @property string $lugar_residencia
 * @property string $email
 * @property string $telefono
 * @property int $id_tipo_usuario
 * @property int $id_comision
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $imagen
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property TblComisiones $comision
 * @property TblDepartamentos $departamento
 * @property TblMunicipios $municipio
 * @property TblTipoUsuarios $tipoUsuario
 */
class TblUsuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_usuarios';
    }

    public function getNombreCompleto(){
        return $this->nombres . ' ' . $this->apellidos;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'nombres', 'apellidos', 'dni', 'id_departamento', 'id_municipio', 'lugar_residencia', 'email', 'telefono', 'id_tipo_usuario', 'id_comision', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['id_departamento', 'id_municipio', 'id_tipo_usuario', 'id_comision', 'status', 'created_at', 'updated_at'], 'integer'],
            [['lugar_residencia'], 'string'],
            [['username', 'nombres', 'apellidos', 'email', 'password_hash', 'password_reset_token', 'imagen', 'verification_token'], 'string', 'max' => 255],
            [['dni'], 'string', 'max' => 10],
            [['telefono'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['id_comision'], 'exist', 'skipOnError' => true, 'targetClass' => TblComisiones::class, 'targetAttribute' => ['id_comision' => 'id_comision']],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => TblDepartamentos::class, 'targetAttribute' => ['id_departamento' => 'id_departamento']],
            [['id_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => TblMunicipios::class, 'targetAttribute' => ['id_municipio' => 'id_municipio']],
            [['id_tipo_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblTipoUsuarios::class, 'targetAttribute' => ['id_tipo_usuario' => 'id_tipo_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            'lugar_residencia' => 'Lugar Residencia',
            'email' => 'Email',
            'telefono' => 'Telefono',
            'id_tipo_usuario' => 'Tipo de usuario',
            'id_comision' => 'Institución',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Contraseña',
            'password_reset_token' => 'Password Reset Token',
            'imagen' => 'Imagen',
            'status' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'nombreCompleto' => 'Usuario'
        ];
    }

    /**
     * Gets query for [[Comision]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComision()
    {
        return $this->hasOne(TblComisiones::class, ['id_comision' => 'id_comision']);
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(TblDepartamentos::class, ['id_departamento' => 'id_departamento']);
    }

    /**
     * Gets query for [[Municipio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio()
    {
        return $this->hasOne(TblMunicipios::class, ['id_municipio' => 'id_municipio']);
    }

    /**
     * Gets query for [[TipoUsuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoUsuario()
    {
        return $this->hasOne(TblTipoUsuarios::class, ['id_tipo_usuario' => 'id_tipo_usuario']);
    }
}
