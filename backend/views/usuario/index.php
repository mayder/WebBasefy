<?php

use common\models\Usuario;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\UsuarioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Usuários');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="usuario-index">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
            <?= Html::a('<i class="bi bi-plus-lg me-1"></i> Novo Usuário', ['create'], ['class' => 'btn btn-light btn-sm']) ?>
        </div>

        <div class="card-body">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-bordered table-striped table-hover'],
                'columns' => [
                    // ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'nome',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'filter' => [1 => 'Ativo', 0 => 'Inativo'],
                        'value' => function ($model) {
                            return $model->status
                                ? '<span class="badge bg-success">Ativo</span>'
                                : '<span class="badge bg-danger">Inativo</span>';
                        },
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    'ultimo_acesso:datetime',
                    'data_cadastro:datetime',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Usuario $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => fn($url) => Html::a('<i class="bi bi-eye"></i>', $url, ['title' => 'Visualizar', 'class' => 'btn btn-sm btn-outline-secondary me-1']),
                            'update' => fn($url) => Html::a('<i class="bi bi-pencil"></i>', $url, ['title' => 'Editar', 'class' => 'btn btn-sm btn-outline-primary me-1']),
                            'delete' => fn($url) => Html::a('<i class="bi bi-trash"></i>', $url, [
                                'title' => 'Excluir',
                                'class' => 'btn btn-sm btn-outline-danger',
                                'data-confirm' => 'Tem certeza que deseja excluir este item?',
                                'data-method' => 'post',
                            ]),
                        ],
                        'contentOptions' => ['class' => 'text-center text-nowrap align-middle'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>