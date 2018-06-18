<?php
namespace yiiunit\extensions\bootstrap4;

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
<nav id="w0" class="navbar-inverse navbar-static-top navbar-frontend navbar" role="navigation"><div class="container"><a class="navbar-brand" href="/">My Company</a><button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#w0-collapse" aria-controls="w0-collapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button><div id="w0-collapse" class="collapse navbar-collapse"></div></div></nav>
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
}
