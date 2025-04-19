<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NotificacaoSistema */
?>
<div class="notificacao-sistema-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'usuario_id',
            'titulo',
            'conteudo:ntext',
            'tipo',
            'link:ntext',
            'lida:boolean',
            'data_cadastro',
        ],
    ]) ?>

</div>
