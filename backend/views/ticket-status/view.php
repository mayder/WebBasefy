<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TicketStatus */
?>
<div class="ticket-status-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'status:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
