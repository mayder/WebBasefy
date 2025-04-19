<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Idioma */
?>
<div class="idioma-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'sigla',
            'status:boolean',
            'padrao:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
