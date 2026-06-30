<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yii\bootstrap4;

use Yii;
use yii\base\InvalidConfigException;
use yii\web\Application;

/**
 * \yii\bootstrap4\Widget is the base class for all bootstrap widgets.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Qiang Xue <qiang.xue@gmail.com>
 */
class Widget extends \yii\base\Widget
{
    use BootstrapWidgetTrait;

    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];

    /**
     * @return Application
     * @throws InvalidConfigException
     */
    protected function getApp()
    {
        $app = Yii::$app;

        if (!$app instanceof Application) {
            throw new InvalidConfigException('Bootstrap widgets require Yii::$app to be an instance of yii\web\Application.');
        }

        return $app;
    }
}
