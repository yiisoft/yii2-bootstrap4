<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

/**
 * Tests for NavBar widget
 *
 * @group bootstrap4
 */
class NavBarTest extends TestCase
{
    public function testRender()
    {
        NavBar::$counter = 0;

        $out = NavBar::widget([
            'brandLabel' => 'My Company',
            'brandUrl' => '/',
            'options' => [
                'class' => 'navbar-inverse navbar-static-top navbar-frontend',
            ],
        ]);

        $expected = <<<EXPECTED
<nav id="w0" class="navbar-inverse navbar-static-top navbar-frontend navbar">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
</div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testBrandImage()
    {
        $out = NavBar::widget([
            'brandImage' => '/images/test.jpg',
            'brandUrl' => '/',
        ]);

        $this->assertContains('<a class="navbar-brand" href="/"><img src="/images/test.jpg" alt=""></a>', $out);
    }

    public function testBrandLink()
    {
        $out = NavBar::widget([
            'brandLabel' => 'Yii Framework',
            'brandUrl' => false,
        ]);

        $this->assertContains('<a class="navbar-brand" href="/index.php">Yii Framework</a>', $out);
    }

    public function testBrandSpan()
    {
        $out = NavBar::widget([
            'brandLabel' => 'Yii Framework',
            'brandUrl' => null,
        ]);

        $this->assertContains('<span class="navbar-brand">Yii Framework</span>', $out);
    }

    /**
     * @depends testRender
     */
    public function testNavAndForm() {

        NavBar::$counter = 0;

        ob_start();
        NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => '/',
            'options' => [
            ],
        ]);
        echo Nav::widget([
            'options' => [
                'class' => ['mr-auto']
            ],
            'items' => [
                ['label' => 'Home', 'url' => '#'],
                ['label' => 'Link', 'url' => '#'],
                ['label' => 'Dropdown', 'items' => [
                    ['label' => 'Action', 'url' => '#'],
                    ['label' => 'Another action', 'url' => '#'],
                    '-',
                    ['label' => 'Something else here', 'url' => '#'],
                ]]
            ]
        ]);
        echo <<<HTML
<form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>
HTML;
        NavBar::end();
        $out = ob_get_clean();

        $expected = <<<EXPECTED
<nav id="w0" class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
<a class="navbar-brand" href="/">My Company</a>
<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
<div id="w0-collapse" class="collapse navbar-collapse">
<ul id="w1" class="mr-auto nav"><li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
<li class="dropdown nav-item"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Dropdown</a><div id="w2" class="dropdown-menu"><a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">Something else here</a></div></li></ul><form class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form></div>
</div>
</nav>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
