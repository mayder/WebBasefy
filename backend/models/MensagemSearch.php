<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mensagem;

/**
 * MensagemSearch represents the model behind the search form about `common\models\Mensagem`.
 */
class MensagemSearch extends Mensagem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'tentativa', 'max_tentativa', 'usuario_id_cad'], 'integer'],
            [['tipo', 'titulo', 'conteudo', 'status_envio', 'data_agendada', 'data_envio', 'erro', 'data_cadastro'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Mensagem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'tentativa' => $this->tentativa,
            'max_tentativa' => $this->max_tentativa,
            'data_agendada' => $this->data_agendada,
            'data_envio' => $this->data_envio,
            'usuario_id_cad' => $this->usuario_id_cad,
            'data_cadastro' => $this->data_cadastro,
        ]);

        $query->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'conteudo', $this->conteudo])
            ->andFilterWhere(['like', 'status_envio', $this->status_envio])
            ->andFilterWhere(['like', 'erro', $this->erro]);

        return $dataProvider;
    }
}
