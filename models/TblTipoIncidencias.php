<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tipo_incidencias".
 *
 * @property int $id_tipo_incidencia
 * @property string $nombre_incidencia
 */
class TblTipoIncidencias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tipo_incidencias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_incidencia'], 'required'],
            [['nombre_incidencia'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_incidencia' => 'Id Tipo Incidencia',
            'nombre_incidencia' => 'Tipo de incidencia',
        ];
    }
}
