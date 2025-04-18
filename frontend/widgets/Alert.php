<?php

namespace frontend\widgets;

use Yii;
use yii\bootstrap5\Widget;

class Alert extends Widget
{
    public $toastContainerId = 'toast-container';

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $html = '';

        if (empty($flashes)) {
            return;
        }

        $html .= '<div id="' . $this->toastContainerId . '" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">';

        foreach ($flashes as $type => $messages) {
            foreach ((array) $messages as $i => $message) {
                $toastId = 'toast-' . $type . '-' . $i;
                $bgClass = match ($type) {
                    'success' => 'bg-success text-white',
                    'error', 'danger' => 'bg-danger text-white',
                    'warning' => 'bg-warning text-dark',
                    'info' => 'bg-info text-dark',
                    default => 'bg-primary text-white',
                };

                $html .= <<<HTML
<div id="{$toastId}" class="toast $bgClass" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
  <div class="d-flex">
    <div class="toast-body">{$message}</div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
  </div>
</div>
HTML;
            }

            $session->removeFlash($type);
        }

        $html .= '</div>';

        $this->getView()->registerJs(<<<JS
document.querySelectorAll('#{$this->toastContainerId} .toast').forEach(function(el) {
    new bootstrap.Toast(el).show();
});
JS);

        echo $html;
    }
}
