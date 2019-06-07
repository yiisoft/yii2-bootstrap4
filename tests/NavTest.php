<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Nav;

/**
 * Tests for Nav widget
 *
 * @group bootstrap4
 */
class NavTest extends TestCase
{
    protected function setUp()
    {
        $this->mockWebApplication([
            'components' => [
                'request' => [
                    'class' => 'yii\web\Request',
                    'scriptUrl' => '/base/index.php',
                    'hostInfo' => 'http://example.com/',
                    'url' => '/base/index.php&r=site%2Fcurrent&id=42'
                ],
                'urlManager' => [
                    'class' => 'yii\web\UrlManager',
                    'baseUrl' => '/base',
                    'scriptUrl' => '/base/index.php',
                    'hostInfo' => 'http://example.com/',
                ]
            ],
        ]);
    }

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

    public function testRenderDropdownWithDropdownOptions()
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
                        'dropdownOptions' => ['class' => 'test', 'data-id' => 't1', 'id' => 'test1'],
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

    public function testActive()
    {
        $this->mockAction('site', 'users');

        Nav::$counter = 0;
        $out = Nav::widget([
            'items' => [
                [
                    'label' => 'Main',
                    'url' => ['site/index'],
                ],
                [
                    'label' => 'Admin',
                    'items' => [
                        ['label' => 'Users', 'url' => ['site/users']],
                        ['label' => 'Roles', 'url' => ['site/roles']],
                        ['label' => 'Statuses', 'url' => ['site/statuses']]
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="/base/index.php?r=site%2Findex">Main</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Admin</a><div id="w1" class="dropdown-menu"><a class="dropdown-item active" href="/base/index.php?r=site%2Fusers">Users</a>
<a class="dropdown-item" href="/base/index.php?r=site%2Froles">Roles</a>
<a class="dropdown-item" href="/base/index.php?r=site%2Fstatuses">Statuses</a></div></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/162
     */
    public function testExplicitActive()
    {
        $this->mockAction('site', 'index');

        Nav::$counter = 0;
        $out = Nav::widget([
            'activateItems' => false,
            'items' => [
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => ['site/index'],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Item1</a></li>
<li class="nav-item"><a class="nav-link" href="/base/index.php?r=site%2Findex">Item2</a></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/162
     */
    public function testImplicitActive()
    {
        $this->mockAction('site', 'index');

        Nav::$counter = 0;
        $out = Nav::widget([
            'items' => [
                [
                    'label' => 'Item1',
                    'active' => true,
                ],
                [
                    'label' => 'Item2',
                    'url' => ['site/index'],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link active" href="#">Item1</a></li>
<li class="nav-item"><a class="nav-link active" href="/base/index.php?r=site%2Findex">Item2</a></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/162
     */
    public function testExplicitActiveSubitems()
    {
        $this->mockAction('site', 'index');

        Nav::$counter = 0;
        $out = Nav::widget([
            'activateItems' => false,
            'items' => [
                [
                    'label' => 'Item1',
                ],
                [
                    'label' => 'Item2',
                    'items' => [
                        ['label' => 'Page2', 'content' => 'Page2', 'url' => ['site/index']],
                        ['label' => 'Page3', 'content' => 'Page3', 'active' => true],
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Item1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Item2</a><div id="w1" class="dropdown-menu"><a class="dropdown-item" href="/base/index.php?r=site%2Findex">Page2</a>
<h6 class="dropdown-header">Page3</h6></div></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/162
     */
    public function testImplicitActiveSubitems()
    {
        $this->mockAction('site', 'index');

        Nav::$counter = 0;
        $out = Nav::widget([
            'items' => [
                [
                    'label' => 'Item1',
                ],
                [
                    'label' => 'Item2',
                    'items' => [
                        ['label' => 'Page2', 'content' => 'Page2', 'url' => ['site/index']],
                        ['label' => 'Page3', 'content' => 'Page3', 'active' => true],
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link" href="#">Item1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Item2</a><div id="w1" class="dropdown-menu"><a class="dropdown-item active" href="/base/index.php?r=site%2Findex">Page2</a>
<h6 class="dropdown-header">Page3</h6></div></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    public function testDisabled()
    {
        $this->mockAction('site', 'index');

        Nav::$counter = 0;
        $out = Nav::widget([
            'items' => [
                [
                    'label' => 'Item1',
                    'disabled' => true
                ],
                [
                    'label' => 'Item2',
                    'items' => [
                        ['label' => 'Page2', 'content' => 'Page2', 'url' => ['site/index'], 'disabled' => true],
                        ['label' => 'Page3', 'content' => 'Page3', 'active' => true],
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Item1</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Item2</a><div id="w1" class="dropdown-menu"><a class="dropdown-item disabled" href="/base/index.php?r=site%2Findex" tabindex="-1" aria-disabled="true">Page2</a>
<h6 class="dropdown-header">Page3</h6></div></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
        $this->removeMockedAction();
    }

    /**
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/96
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/157
     */
    public function testDeepActivateParents()
    {
        Nav::$counter = 0;
        $out = Nav::widget([
            'activateParents' => true,
            'items' => [
                [
                    'label' => 'Dropdown',
                    'items' => [
                        [
                            'label' => 'Sub-dropdown',
                            'items' => [
                                ['label' => 'Page', 'content' => 'Page', 'active' => true],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<ul id="w0" class="nav"><li class="dropdown nav-item"><a class="dropdown-toggle nav-link active" href="#" data-toggle="dropdown">Dropdown</a><div id="w1" class="dropdown-menu"><div class="dropdown active" aria-expanded="false">
<a class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">Sub-dropdown</a>
<div id="w2" class="dropdown-submenu dropdown-menu"><h6 class="dropdown-header">Page</h6></div>
</div></div></li></ul>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
