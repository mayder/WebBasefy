<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cliente */
?>
<div class="cliente-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'plano_id',
            'status:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
