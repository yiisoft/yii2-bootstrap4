<?php
namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Dropdown;

/**
 * Tests for Dropdown widget
 *
 * @group bootstrap
 */
class DropdownTest extends TestCase
{
    public function testIds()
    {
        Dropdown::$counter = 0;
        $out = Dropdown::widget(
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
<div id="w0" class="dropdown-menu"><h6 class="dropdown-header">Page1</h6>
<div class="dropdown-submenu"><a class="dropdown-item" href="#" tabindex="-1">Dropdown1</a><div><h6 class="dropdown-header">Page2</h6>
<h6 class="dropdown-header">Page3</h6></div></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testSubMenuOptions()
    {
        Dropdown::$counter = 0;
        $out = Dropdown::widget(
            [
                'submenuOptions' => [
                    'class' => 'submenu-list',
                ],
                'items' => [
                    [
                        'label' => 'Dropdown1',
                        'items' => [
                            ['label' => 'Page1', 'content' => 'Page2'],
                            ['label' => 'Page2', 'content' => 'Page3'],
                        ]
                    ],
                    [
                        'label' => 'Dropdown2',
                        'items' => [
                            ['label' => 'Page3', 'content' => 'Page4'],
                            ['label' => 'Page4', 'content' => 'Page5'],
                        ],
                        'submenuOptions' => [
                            'class' => 'submenu-override',
                        ],
                    ]
                ]
            ]
        );

        $expected = <<<EXPECTED
<div id="w0" class="dropdown-menu"><div class="dropdown-submenu"><a class="dropdown-item" href="#" tabindex="-1">Dropdown1</a><div class="submenu-list"><h6 class="dropdown-header">Page1</h6>
<h6 class="dropdown-header">Page2</h6></div></div>
<div class="dropdown-submenu"><a class="dropdown-item" href="#" tabindex="-1">Dropdown2</a><div class="submenu-override"><h6 class="dropdown-header">Page3</h6>
<h6 class="dropdown-header">Page4</h6></div></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
