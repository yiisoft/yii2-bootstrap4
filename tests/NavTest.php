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
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Page1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Dropdown1</a><div id="w1" class="dropdown-menu"><h6 class="dropdown-header">Page2</h6>
<h6 class="dropdown-header">Page3</h6></div></li></ul>
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
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Page1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Dropdown1</a><div id="test1" class="test dropdown-menu" data-id="t1"><h6 class="dropdown-header">Page2</h6>
<h6 class="dropdown-header">Page3</h6></div></li></ul>
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
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Page1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Dropdown1</a><div id="w1" class="dropdown-menu"><h6 class="dropdown-header">Page2</h6>
<h6 class="dropdown-header">Page3</h6></div></li>
<li class="nav-item"><a class="nav-link" href="#">Page4</a></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
