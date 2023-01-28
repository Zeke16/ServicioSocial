<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblEstadoIncidencia;

/**
 * TblEstadoIncidenciaSearch represents the model behind the search form of `app\models\TblEstadoIncidencia`.
 */
class TblEstadoIncidenciaSearch extends TblEstadoIncidencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_estado_incidencia', 'id_incidencia', 'estado'], 'integer'],
            [['retroalimentacion'], 'safe'],
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
        $query = TblEstadoIncidencia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_estado_incidencia' => $this->id_estado_incidencia,
            'id_incidencia' => $this->id_incidencia,
            'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'retroalimentacion', $this->retroalimentacion]);

        return $dataProvider;
    }
}
