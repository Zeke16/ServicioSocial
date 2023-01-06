<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblUsuarios;

/**
 * TblUsuariosSearch represents the model behind the search form of `app\models\TblUsuarios`.
 */
class TblUsuariosSearch extends TblUsuarios
{
    public $nombreCompleto;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_departamento', 'id_municipio', 'id_tipo_usuario', 'id_comision', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'nombres', 'apellidos', 'dni', 'lugar_residencia', 'email', 'telefono', 'auth_key', 'password_hash', 'password_reset_token', 'imagen', 'verification_token', 'nombreCompleto'], 'safe'],
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
        $query = TblUsuarios::find();

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
            'id_usuario' => $this->id_usuario,
            'id_departamento' => $this->id_departamento,
            'id_municipio' => $this->id_municipio,
            'id_tipo_usuario' => $this->id_tipo_usuario,
            'id_comision' => $this->id_comision,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'lugar_residencia', $this->lugar_residencia])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'imagen', $this->imagen])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'nombreCompleto', $this->nombreCompleto]);

        return $dataProvider;
    }
}
