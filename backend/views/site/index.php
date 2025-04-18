<?php

use yii\helpers\Html;
use yii\web\JsExpression;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-index">
    <div class="row">
        <?php foreach (
            [
                ['label' => 'Usuários', 'value' => $totalUsuarios, 'icon' => 'person', 'bg' => 'info'],
            ] as $card
        ): ?>
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-<?= $card['icon'] ?> fs-1 text-<?= $card['bg'] ?> me-3"></i>
                        <div>
                            <h5 class="mb-0"><?= $card['value'] ?></h5>
                            <small class="text-muted"><?= $card['label'] ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>