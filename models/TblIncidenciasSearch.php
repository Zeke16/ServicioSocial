<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblIncidencias;
use Yii;

/**
 * TblIncidenciasSearch represents the model behind the search form of `app\models\TblIncidencias`.
 */
class TblIncidenciasSearch extends TblIncidencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_incidencia', 'id_usuario', 'id_municipio', 'id_tipo_incidencia'], 'integer'],
            [['descripcion_incidencia', 'fecha_registro'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (Yii::$app->user->can('MasterAccess')) {
            $query = TblIncidencias::find();
        } else if (Yii::$app->user->can('UsuarioEstandarAccess')) {
            $query = TblIncidencias::find()->where(['id_usuario' => Yii::$app->user->identity->id_usuario]);
        } else if (Yii::$app->user->can('UsuarioSupervisorAccess')) {
            $query = TblIncidencias::find()
                ->innerJoin('tbl_municipios', 'tbl_municipios.id_municipio = tbl_incidencias.id_municipio')
                ->innerJoin('tbl_departamentos', 'tbl_departamentos.id_departamento = tbl_municipios.id_departamento')
                ->andWhere(['tbl_departamentos.id_departamento' => Yii::$app->user->identity->id_departamento]);
            /**Este query creado con yii2 es equivalente al siguiente query crudo:
             * 
             * SELECT *
             * FROM tbl_incidencias i
             * INNER JOIN tbl_municipios m
             * ON i.id_municipio = m.id_municipio
             * INNER JOIN tbl_departamentos d
             * ON d.id_departamento = m.id_departamento
             * where d.id_departamento =  Yii::$app->user->identity->id_departamento
             */
        }


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_incidencia' => $this->id_incidencia,
            'id_usuario' => $this->id_usuario,
            'id_municipio' => $this->id_municipio,
            'id_tipo_incidencia' => $this->id_tipo_incidencia,
            'fecha_registro' => $this->fecha_registro,
        ]);

        $query->andFilterWhere(['like', 'descripcion_incidencia', $this->descripcion_incidencia]);

        return $dataProvider;
    }
}
