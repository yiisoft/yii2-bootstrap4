<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap4;

use yii\web\AssetBundle;

/**
 * Asset bundle for Popper javascript files.
 *
 * @author Artur Zhdanov <zhdanovartur@gmail.com>
 */
class PopperAsset extends AssetBundle
{
    public $sourcePath = '@npm/popper.js/dist';
    public $js = [
        'popper.min.js',
    ];
}
