<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Funcionalidade;

/**
 * FuncionalidadeSearch represents the model behind the search form about `common\models\Funcionalidade`.
 */
class FuncionalidadeSearch extends Funcionalidade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'modulo_id'], 'integer'],
            [['nome', 'chave', 'data_cadastro'], 'safe'],
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
        $query = Funcionalidade::find();

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
            'modulo_id' => $this->modulo_id,
            'data_cadastro' => $this->data_cadastro,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'chave', $this->chave]);

        return $dataProvider;
    }
}
