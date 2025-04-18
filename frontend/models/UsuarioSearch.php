<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `common\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nome', 'email', 'senha_hash', 'auth_key', 'token_verificacao_email', 'access_token', 'token_reset_senha', 'expira_token_reset', 'ultimo_acesso', 'data_cadastro'], 'safe'],
            [['status'], 'boolean'],
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
        $query = Usuario::find()
            ->joinWith('clienteUsuarios')
            ->where([
                'cliente_usuario.status' => true,
            ]);

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'usuario.id' => $this->id,
            'usuario.expira_token_reset' => $this->expira_token_reset,
            'usuario.status' => $this->status,
            'usuario.ultimo_acesso' => $this->ultimo_acesso,
            'usuario.data_cadastro' => $this->data_cadastro,
        ]);

        $query->andFilterWhere(['like', 'usuario.nome', $this->nome])
            ->andFilterWhere(['like', 'usuario.email', $this->email])
            ->andFilterWhere(['like', 'usuario.senha_hash', $this->senha_hash])
            ->andFilterWhere(['like', 'usuario.auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'usuario.token_verificacao_email', $this->token_verificacao_email])
            ->andFilterWhere(['like', 'usuario.access_token', $this->access_token])
            ->andFilterWhere(['like', 'usuario.token_reset_senha', $this->token_reset_senha]);

        return $dataProvider;
    }
}
