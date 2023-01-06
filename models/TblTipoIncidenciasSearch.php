<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblTipoIncidencias;

/**
 * TblTipoIncidenciasSearch represents the model behind the search form of `app\models\TblTipoIncidencias`.
 */
class TblTipoIncidenciasSearch extends TblTipoIncidencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tipo_incidencia'], 'integer'],
            [['nombre_incidencia'], 'safe'],
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
        $query = TblTipoIncidencias::find();

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
            'id_tipo_incidencia' => $this->id_tipo_incidencia,
        ]);

        $query->andFilterWhere(['like', 'nombre_incidencia', $this->nombre_incidencia]);

        return $dataProvider;
    }
}
