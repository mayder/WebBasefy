<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Perfil */
?>
<div class="perfil-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'sigla',
            'status:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
