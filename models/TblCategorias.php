<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_categorias".
 *
 * @property int $id_categoria
 * @property string $nombre
 * @property string $fecha_ing
 * @property string $fecha_mod
 * @property int $id_usuario
 * @property int $estado
 */
class TblCategorias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_categorias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha_ing', 'fecha_mod', 'id_usuario', 'estado'], 'required'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['id_usuario', 'estado'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id',
            'nombre' => 'Nombre',
            'fecha_ing' => 'Fecha Ingreso',
            'fecha_mod' => 'Fecha Modificacion',
            'id_usuario' => 'Usuario',
            'estado' => 'Estado',
        ];
    }
}
