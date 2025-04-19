<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Funcionalidade */
?>
<div class="funcionalidade-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'chave',
            'modulo_id',
            'data_cadastro',
        ],
    ]) ?>

</div>
