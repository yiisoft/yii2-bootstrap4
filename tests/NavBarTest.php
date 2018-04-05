<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\NavBar;

/**
 * Tests for NavBar widget
 * 
 * @group bootstrap
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
<nav id="w0" class="navbar-inverse navbar-static-top navbar-frontend navbar" role="navigation"><div class="container"><div class="navbar-header"><button type="button" class="navbar-toggler hidden-sm-up" data-toggle="collapse" data-target="#w0-collapse"><span class="sr-only">Toggle navigation</span>
&#9776;</button><a class="navbar-brand" href="/">My Company</a></div><div id="w0-collapse" class="collapse navbar-toggleable-xs"></div></div></nav>
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

    public function testHeaderContent()
    {
        $testContent = <<<HTML
<form class="navbar-form navbar-left">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
HTML;

        $out = NavBar::widget([
            'headerContent' => $testContent,
        ]);

        $this->assertContains($testContent, $out);
    }
}
