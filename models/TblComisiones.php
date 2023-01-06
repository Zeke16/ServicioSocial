<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comisiones".
 *
 * @property int $id_comision
 * @property string $nombre_comision
 *
 * @property TblUsuarios[] $tblUsuarios
 */
class TblComisiones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_comisiones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_comision'], 'required'],
            [['nombre_comision'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_comision' => 'Id Comision',
            'nombre_comision' => 'Nombre Comision',
        ];
    }

    /**
     * Gets query for [[TblUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsuarios()
    {
        return $this->hasMany(TblUsuarios::class, ['id_comision' => 'id_comision']);
    }
}
