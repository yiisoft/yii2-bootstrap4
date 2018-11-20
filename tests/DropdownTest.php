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
<div class="dropdown" aria-expanded="false">
<a class="dropdown-item dropdown-toggle" href="#test" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown1</a>
<div id="w1" class="dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page2</h6>
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
                    '-',
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
<div id="w0" class="dropdown-menu"><div class="dropdown" aria-expanded="false">
<a class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown1</a>
<div id="w1" class="submenu-list dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page1</h6>
<h6 class="dropdown-header">Page2</h6></div>
</div>
<div class="dropdown-divider"></div>
<div class="dropdown" aria-expanded="false">
<a class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Dropdown2</a>
<div id="w2" class="submenu-override dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page3</h6>
<h6 class="dropdown-header">Page4</h6></div>
</div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testForms()
    {
        Dropdown::$counter = 0;
        $form = <<<HTML
<form class="px-4 py-3">
<div class="form-group">
<label for="exampleDropdownFormEmail1">Email address</label>
<input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
</div>
<div class="form-group">
<label for="exampleDropdownFormPassword1">Password</label>
<input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="dropdownCheck">
<label class="form-check-label" for="dropdownCheck">
Remember me
</label>
</div>
<button type="submit" class="btn btn-primary">Sign in</button>
</form>
HTML;

        $out = Dropdown::widget([
            'items' => [
                $form,
                '-',
                ['label' => 'New around here? Sign up', 'url' => '#'],
                ['label' => 'Forgot password?', 'url' => '#']
            ]
        ]);

        $expected = <<<HTML
<div id="w0" class="dropdown-menu"><form class="px-4 py-3">
<div class="form-group">
<label for="exampleDropdownFormEmail1">Email address</label>
<input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
</div>
<div class="form-group">
<label for="exampleDropdownFormPassword1">Password</label>
<input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="dropdownCheck">
<label class="form-check-label" for="dropdownCheck">
Remember me
</label>
</div>
<button type="submit" class="btn btn-primary">Sign in</button>
</form>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">New around here? Sign up</a>
<a class="dropdown-item" href="#">Forgot password?</a></div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
