<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_incidencias".
 *
 * @property int $id_incidencia
 * @property int $id_usuario
 * @property int $id_municipio
 * @property int $id_tipo_incidencia
 * @property string $descripcion_incidencia
 * @property string $lugar_incidencia
 * @property string $fecha_registro
 * @property string $incidencia_otro
 *
 * @property TblMunicipios $municipio
 * @property TblTipoIncidencias $tipoIncidencia
 * @property TblUsuarios $usuario
 */
class TblIncidencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_incidencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_municipio', 'id_tipo_incidencia', 'descripcion_incidencia', 'lugar_incidencia', 'fecha_registro'], 'required'],
            [['id_usuario', 'id_municipio', 'id_tipo_incidencia'], 'integer'],
            [['descripcion_incidencia', 'lugar_incidencia', 'incidencia_otro'], 'string'],
            [['fecha_registro'], 'safe'],
            [['id_municipio'], 'exist', 'skipOnError' => true, 'targetClass' => TblMunicipios::class, 'targetAttribute' => ['id_municipio' => 'id_municipio']],
            [['id_tipo_incidencia'], 'exist', 'skipOnError' => true, 'targetClass' => TblTipoIncidencias::class, 'targetAttribute' => ['id_tipo_incidencia' => 'id_tipo_incidencia']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => TblUsuarios::class, 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_incidencia' => 'Id Incidencia',
            'id_usuario' => 'Usuario que reporto',
            'id_municipio' => 'Municipio',
            'id_tipo_incidencia' => 'Tipo de Incidencia',
            'descripcion_incidencia' => 'Descripcion de incidencia',
            'lugar_incidencia' => 'Lugar de incidencia',
            'fecha_registro' => 'Fecha de registro',
            'incidencia_otro' => 'Si selecciono otro, indique que sucede:',
        ];
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
     * Gets query for [[TipoIncidencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoIncidencia()
    {
        return $this->hasOne(TblTipoIncidencias::class, ['id_tipo_incidencia' => 'id_tipo_incidencia']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(TblUsuarios::class, ['id_usuario' => 'id_usuario']);
    }
}
