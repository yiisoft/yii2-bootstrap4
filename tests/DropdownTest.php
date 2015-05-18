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
<ul id="w0" class="dropdown-menu"><li class="dropdown-header">Page1</li>
<li class="dropdown-submenu"><a href="#" tabindex="-1">Dropdown1</a><ul><li class="dropdown-header">Page2</li>
<li class="dropdown-header">Page3</li></ul></li></ul>
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
<ul id="w0" class="dropdown-menu"><li class="dropdown-submenu"><a href="#" tabindex="-1">Dropdown1</a><ul class="submenu-list"><li class="dropdown-header">Page1</li>
<li class="dropdown-header">Page2</li></ul></li>
<li class="dropdown-submenu"><a href="#" tabindex="-1">Dropdown2</a><ul class="submenu-override"><li class="dropdown-header">Page3</li>
<li class="dropdown-header">Page4</li></ul></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
