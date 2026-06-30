<?php

/**
 * @package yii2-bootstrap4
 * @author Simon Karlen <simi.albi@outlook.com>
 */

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Widget;
use yii\base\InvalidConfigException;
use yii\web\Application;

/**
 * @group bootstrap4
 */
class BreadcrumbsTest extends TestCase
{
    public function testRender(): void
    {
        Breadcrumbs::$counter = 0;
        $out = Breadcrumbs::widget([
            'homeLink' => ['label' => 'Home', 'url' => '#'],
            'links' => [
                ['label' => 'Library', 'url' => '#'],
                ['label' => 'Data']
            ]
        ]);

        $expected = <<<HTML
<nav aria-label="breadcrumb"><ol id="w0" class="breadcrumb"><li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol></nav>
HTML;


        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderWithDefaultHomeLink(): void
    {
        Breadcrumbs::$counter = 0;
        $out = Breadcrumbs::widget([
            'links' => [
                ['label' => 'Library', 'url' => '#'],
                ['label' => 'Data']
            ]
        ]);

        $expected = <<<HTML
<nav aria-label="breadcrumb"><ol id="w0" class="breadcrumb"><li class="breadcrumb-item"><a href="/index.php">Home</a></li>
<li class="breadcrumb-item"><a href="#">Library</a></li>
<li class="breadcrumb-item active" aria-current="page">Data</li>
</ol></nav>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testRenderRequiresWebApplication(): void
    {
        $this->destroyApplication();

        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('Bootstrap widgets require Yii::$app to be an instance of yii\web\Application.');

        $widget = new class () extends Widget {
            public function getApplication(): Application
            {
                return $this->getApp();
            }
        };

        $widget->getApplication();
    }
}
