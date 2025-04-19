<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TicketTipo */
?>
<div class="ticket-tipo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'publico:boolean',
            'status:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
