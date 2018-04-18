<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Dropdown;

/**
 * Tests for Dropdown widget
 *
 * @group bootstrap4
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
                        'label' => 'Page1'
                    ],
                    [
                        'label' => 'Dropdown1',
                        'url' => '#test',
                        'items' => [
                            ['label' => 'Page2'],
                            ['label' => 'Page3'],
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
<div id="w1" class="dropdown">
<a id="w2" class="dropdown-item btn dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown1</a>

<div id="w3" class="dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page2</h6>
<h6 class="dropdown-header">Page3</h6></div>
</div></div>
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
<div id="w0" class="dropdown-menu"><div id="w1" class="dropdown">
<a id="w2" class="dropdown-item btn dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown1</a>

<div id="w3" class="submenu-list dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page1</h6>
<h6 class="dropdown-header">Page2</h6></div>
</div>
<div id="w4" class="dropdown">
<a id="w5" class="dropdown-item btn dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown2</a>

<div id="w6" class="submenu-override dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page3</h6>
<h6 class="dropdown-header">Page4</h6></div>
</div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
