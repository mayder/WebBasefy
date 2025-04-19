<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */
?>
<div class="ticket-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'usuario_id',
            'cliente_id',
            'titulo',
            'descricao:ntext',
            'tipo_id',
            'status_id',
            'publico:boolean',
            'prioridade',
            'voto',
            'data_resposta',
            'data_cadastro',
        ],
    ]) ?>

</div>
