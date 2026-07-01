<?php

/**
 * @package yii2-bootstrap4
 * @author Simon Karlen <simi.albi@outlook.com>
 */

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Breadcrumbs;

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
}
