<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Modulo */
?>
<div class="modulo-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'icone',
            'ordem',
            'status:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
