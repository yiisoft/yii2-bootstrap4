<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap4;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap default theme.
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 */
class BootstrapThemeAsset extends AssetBundle
{
    public $sourcePath = '@bower/bootstrap/dist';
    public $css = [
        'css/bootstrap-theme.css',
    ];
    public $depends = [
        'yii\bootstrap4\BootstrapAsset',
    ];
}
