<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuários';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>

<div class="container-fluid py-3 usuario-index">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-person-badge-fill me-1"></i> <?= Html::encode($this->title) ?>
            </h5>
        </div>
        <div class="card-body">
            <div id="ajaxCrudDatatable">
                <?= GridView::widget([
                    'id' => 'crud-datatable',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pjax' => true,
                    'columns' => require(__DIR__ . '/_columns.php'),
                    'toolbar' => [
                        [
                            'content' =>
                            Html::a(
                                '<i class="bi bi-plus-circle me-1"></i> Novo Usuário',
                                ['create'],
                                [
                                    'role' => 'modal-remote',
                                    'title' => 'Novo Usuário',
                                    'class' => 'btn btn-outline-primary'
                                ]
                            ) .
                                Html::a(
                                    '<i class="bi bi-arrow-clockwise"></i>',
                                    [''],
                                    [
                                        'data-pjax' => 1,
                                        'class' => 'btn btn-outline-success',
                                        'title' => 'Recarregar grade'
                                    ]
                                ) .
                                '{toggleData}' .
                                '{export}'
                        ],
                    ],
                    'striped' => true,
                    'hover' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'panel' => [
                        'type' => 'default',
                        'before' => '<em class="text-muted">* Você pode redimensionar as colunas arrastando as bordas.</em>',
                        'after' => BulkButtonWidget::widget([
                            'buttons' => Html::a(
                                '<i class="bi bi-trash"></i>&nbsp; Excluir Selecionados',
                                ['bulkdelete'],
                                [
                                    'class' => 'btn btn-danger btn-sm',
                                    'role' => 'modal-remote-bulk',
                                    'data-confirm' => false,
                                    'data-method' => false,
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => 'Excluir',
                                    'data-confirm-message' => 'Tem certeza que deseja excluir os itens selecionados?'
                                ]
                            ),
                        ]) . '<div class="clearfix"></div>',
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php Modal::begin([
    'id' => 'ajaxCrudModal',
    'footer' => '',
    'clientOptions' => [
        'tabindex' => false,
        'backdrop' => 'static',
        'keyboard' => false,
    ],
    'options' => [
        'tabindex' => false,
    ],
]) ?>
<?php Modal::end(); ?>