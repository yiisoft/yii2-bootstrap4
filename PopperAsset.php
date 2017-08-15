<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use yii\web\AssetBundle;

/**
 * Asset bundle for Popper javascript files.
 *
 * @author Artur Zhdanov <zhdanovartur@gmail.com>
 * @since 2.0
 */
class PopperAsset extends AssetBundle
{
    public $sourcePath = '@bower/popper.js/dist';
    public $js = [
        'umd/popper.js',
    ];
}
