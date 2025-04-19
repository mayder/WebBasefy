<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notificacao_sistema".
 *
 * @property int $id
 * @property int $usuario_id
 * @property string $titulo
 * @property string|null $conteudo
 * @property string $tipo
 * @property string|null $link
 * @property bool $lida
 * @property string $data_cadastro
 *
 * @property Usuario $usuario
 */
class NotificacaoSistema extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_INFO = 'info';
    const TIPO_WARNING = 'warning';
    const TIPO_SUCCESS = 'success';
    const TIPO_DANGER = 'danger';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificacao_sistema';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['conteudo', 'link'], 'default', 'value' => null],
            [['lida'], 'default', 'value' => 0],
            [['usuario_id', 'titulo', 'tipo'], 'required'],
            [['usuario_id'], 'integer'],
            [['conteudo', 'tipo', 'link'], 'string'],
            [['lida'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'titulo' => Yii::t('app', 'Titulo'),
            'conteudo' => Yii::t('app', 'Conteudo'),
            'tipo' => Yii::t('app', 'Tipo'),
            'link' => Yii::t('app', 'Link'),
            'lida' => Yii::t('app', 'Lida'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuarioQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::class, ['id' => 'usuario_id']);
    }

    /**
     * {@inheritdoc}
     * @return NotificacaoSistemaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificacaoSistemaQuery(get_called_class());
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_INFO => Yii::t('app', 'info'),
            self::TIPO_WARNING => Yii::t('app', 'warning'),
            self::TIPO_SUCCESS => Yii::t('app', 'success'),
            self::TIPO_DANGER => Yii::t('app', 'danger'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoInfo()
    {
        return $this->tipo === self::TIPO_INFO;
    }

    public function setTipoToInfo()
    {
        $this->tipo = self::TIPO_INFO;
    }

    /**
     * @return bool
     */
    public function isTipoWarning()
    {
        return $this->tipo === self::TIPO_WARNING;
    }

    public function setTipoToWarning()
    {
        $this->tipo = self::TIPO_WARNING;
    }

    /**
     * @return bool
     */
    public function isTipoSuccess()
    {
        return $this->tipo === self::TIPO_SUCCESS;
    }

    public function setTipoToSuccess()
    {
        $this->tipo = self::TIPO_SUCCESS;
    }

    /**
     * @return bool
     */
    public function isTipoDanger()
    {
        return $this->tipo === self::TIPO_DANGER;
    }

    public function setTipoToDanger()
    {
        $this->tipo = self::TIPO_DANGER;
    }
}
