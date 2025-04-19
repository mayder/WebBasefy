<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Plano */
?>
<div class="plano-view">
 
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
