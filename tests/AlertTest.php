<?php

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Alert;

/**
 * Tests for Alert widget
 *
 * @group bootstrap4
 */
class AlertTest extends TestCase
{
    public function testNormalAlert()
    {
        Alert::$counter = 0;
        $html = Alert::widget([
            'body' => '<strong>Holy guacamole!</strong> You should check in on some of those fields below.',
            'options' => [
                'class' => ['alert-warning']
            ]
        ]);

        $expectedHtml = <<<HTML
<div id="w0" class="alert-warning alert alert-dismissible" role="alert">

<strong>Holy guacamole!</strong> You should check in on some of those fields below.
<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>

</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     * @depends testNormalAlert
     */
    public function testDismissibleAlert()
    {
        Alert::$counter = 0;
        $html = Alert::widget([
            'body' => "Message1",
        ]);

        $expectedHtml = <<<HTML
<div id="w0" class="alert alert-dismissible" role="alert">

Message1
<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
