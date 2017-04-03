<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Alert;
use yii;

/**
 * Tests for Alert widget
 *
 * @group bootstrap
 */
class AlertTest extends TestCase
{
    public function testDismissibleAlert()
    {
        Alert::$counter = 0;
        $html = Alert::widget([
            'body' => "Message1",
        ]);

        $expectedHtml = <<<HTML
<div id="w0" class="alert fade show alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

Message1

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}