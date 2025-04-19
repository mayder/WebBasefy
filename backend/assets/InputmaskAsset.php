<?php

namespace app\assets;

use yii\web\AssetBundle;

class InputmaskAsset extends AssetBundle
{
    public $sourcePath = '@bower/inputmask/dist';
    public $js = [
        'jquery.inputmask.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
