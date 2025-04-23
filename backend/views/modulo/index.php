<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ModuloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Módulos');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>

<div class="container-fluid py-3 modulo-index">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-box me-1"></i> <?= Html::encode($this->title) ?>
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
                                '<i class="bi bi-plus-circle me-1"></i> ' . Yii::t('app', 'Novo Módulo'),
                                ['create'],
                                [
                                    'role' => 'modal-remote',
                                    'title' => Yii::t('app', 'Novo Módulo'),
                                    'class' => 'btn btn-outline-primary'
                                ]
                            ) .
                                Html::a(
                                    '<i class="bi bi-arrow-clockwise"></i>',
                                    [''],
                                    [
                                        'data-pjax' => 1,
                                        'class' => 'btn btn-outline-success',
                                        'title' => Yii::t('app', 'Recarregar grade')
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
                        'before' => '<em class="text-muted">* ' . Yii::t('app', 'Você pode redimensionar as colunas arrastando as bordas.') . '</em>',
                        'after' => BulkButtonWidget::widget([
                            'buttons' => Html::a(
                                '<i class="bi bi-trash"></i>&nbsp; ' . Yii::t('app', 'Excluir Selecionados'),
                                ['bulkdelete'],
                                [
                                    'class' => 'btn btn-danger btn-sm',
                                    'role' => 'modal-remote-bulk',
                                    'data-confirm' => false,
                                    'data-method' => false,
                                    'data-request-method' => 'post',
                                    'data-confirm-title' => Yii::t('app', 'Excluir'),
                                    'data-confirm-message' => Yii::t('app', 'Tem certeza que deseja excluir os itens selecionados?')
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