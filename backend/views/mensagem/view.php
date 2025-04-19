<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
?>
<div class="mensagem-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo',
            'usuario_id',
            'titulo',
            'conteudo:ntext',
            'status_envio',
            'tentativa',
            'max_tentativa',
            'data_agendada',
            'data_envio',
            'erro:ntext',
            'usuario_id_cad',
            'data_cadastro',
        ],
    ]) ?>

</div>
