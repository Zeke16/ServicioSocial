<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_estado_incidencia".
 *
 * @property int $id_estado_incidencia
 * @property int $id_incidencia
 * @property int $estado
 * @property string $retroalimentacion
 *
 * @property TblIncidencias $incidencia
 */
class TblEstadoIncidencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_estado_incidencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_incidencia', 'estado', 'retroalimentacion'], 'required'],
            [['id_incidencia', 'estado'], 'integer'],
            [['retroalimentacion'], 'string'],
            [['id_incidencia'], 'exist', 'skipOnError' => true, 'targetClass' => TblIncidencias::class, 'targetAttribute' => ['id_incidencia' => 'id_incidencia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_estado_incidencia' => 'Id Estado Incidencia',
            'id_incidencia' => 'Id Incidencia',
            'estado' => 'Estado',
            'retroalimentacion' => 'Retroalimentacion',
        ];
    }
    public static function getEstadoIncidencia($id_incidencia)
    {
        $estado = TblEstadoIncidencia::find()->where(['id_incidencia' => $id_incidencia])->one();
        return $estado;
    }
    /**
     * Gets query for [[Incidencia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncidencia()
    {
        return $this->hasOne(TblIncidencias::class, ['id_incidencia' => 'id_incidencia']);
    }
}
