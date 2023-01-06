<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tipo_usuarios".
 *
 * @property int $id_tipo_usuario
 * @property string $nombre_tipo
 *
 * @property TblUsuarios[] $tblUsuarios
 */
class TblTipoUsuarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tipo_usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_tipo'], 'required'],
            [['nombre_tipo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_usuario' => 'Id Tipo Usuario',
            'nombre_tipo' => 'Nombre Tipo',
        ];
    }

    /**
     * Gets query for [[TblUsuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblUsuarios()
    {
        return $this->hasMany(TblUsuarios::class, ['id_tipo_usuario' => 'id_tipo_usuario']);
    }
}
