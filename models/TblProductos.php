<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_productos".
 *
 * @property int $id_producto
 * @property int $id_categoria
 * @property string $nombre
 * @property string|null $descripcion
 * @property string|null $imagen
 * @property string $fecha_ing
 * @property string $fecha_mod
 * @property int $id_usuario
 * @property int $estado
 *
 * @property TblCategorias $categoria
 */
class TblProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'nombre', 'fecha_ing', 'fecha_mod', 'id_usuario', 'estado'], 'required'],
            [['id_categoria', 'id_usuario', 'estado'], 'integer'],
            [['descripcion'], 'string'],
            [['fecha_ing', 'fecha_mod'], 'safe'],
            [['nombre', 'imagen'], 'string', 'max' => 255],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategorias::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_producto' => 'Producto',
            'id_categoria' => 'Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'imagen' => 'Imagen',
            'fecha_ing' => 'Fecha Ing',
            'fecha_mod' => 'Fecha Mod',
            'id_usuario' => 'Id Usuario',
            'estado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(TblCategorias::class, ['id_categoria' => 'id_categoria']);
    }
}
