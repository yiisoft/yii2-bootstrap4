<?php
namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Nav;

/**
 * Tests for Nav widget
 *
 * @group bootstrap
 */
class NavTest extends TestCase
{
    public function testIds()
    {
        Nav::$counter = 0;
        $out = Nav::widget(
            [
                'items' => [
                    [
                        'label' => 'Page1',
                        'content' => 'Page1',
                    ],
                    [
                        'label' => 'Dropdown1',
                        'items' => [
                            ['label' => 'Page2', 'content' => 'Page2'],
                            ['label' => 'Page3', 'content' => 'Page3'],
                        ]
                    ],
                    [
                        'label' => 'Dropdown2',
                        'visible' => false,
                        'items' => [
                            ['label' => 'Page4', 'content' => 'Page4'],
                            ['label' => 'Page5', 'content' => 'Page5'],
                        ]
                    ]
                ]
            ]
        );

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li><a href="#">Page1</a></li>
<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Dropdown1 <span class="caret"></span></a><ul id="w1" class="dropdown-menu"><li class="dropdown-header">Page2</li>
<li class="dropdown-header">Page3</li></ul></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
    
    public function testRenderDropDownWithDropDownOptions()
    {
        Nav::$counter = 0;
        $out = Nav::widget(
            [
                'items' => [
                    [
                        'label' => 'Page1',
                        'content' => 'Page1',
                    ],
                    [
                        'label' => 'Dropdown1',
                        'dropDownOptions' => ['class' => 'test', 'data-id' => 't1', 'id' => 'test1'],
                        'items' => [
                            ['label' => 'Page2', 'content' => 'Page2'],
                            ['label' => 'Page3', 'content' => 'Page3'],
                        ]
                    ],
                    [
                        'label' => 'Dropdown2',
                        'visible' => false,
                        'items' => [
                            ['label' => 'Page4', 'content' => 'Page4'],
                            ['label' => 'Page5', 'content' => 'Page5'],
                        ]
                    ]
                ]
            ]
        );

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li><a href="#">Page1</a></li>
<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Dropdown1 <span class="caret"></span></a><ul id="test1" class="test dropdown-menu" data-id="t1"><li class="dropdown-header">Page2</li>
<li class="dropdown-header">Page3</li></ul></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testEmptyItems()
    {
        Nav::$counter = 0;
        $out = Nav::widget([
            'items' => [
                [
                    'label' => 'Page1',
                    'items' => null,
                ],
                [
                    'label' => 'Dropdown1',
                    'items' => [
                        ['label' => 'Page2', 'content' => 'Page2'],
                        ['label' => 'Page3', 'content' => 'Page3'],
                    ],
                ],
                [
                    'label' => 'Page4',
                    'items' => [],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li><a href="#">Page1</a></li>
<li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Dropdown1 <span class="caret"></span></a><ul id="w1" class="dropdown-menu"><li class="dropdown-header">Page2</li>
<li class="dropdown-header">Page3</li></ul></li>
<li><a href="#">Page4</a></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/162
     */
    public function testExplicitActive()
    {
        Nav::$counter = 0;
        $out = Nav::widget([
            'activateItems' => false,
            'items' => [
                [
                    'label' => 'Item1',
                    //'url' => ['some/route1'],
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    //'url' => ['some/route2'],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="active"><a href="#">Item1</a></li>
<li><a href="#">Item2</a></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
