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
    public function testDismissibleAlert()
    {
        Alert::$counter = 0;
        $html = Alert::widget([
            'body' => "Message1",
        ]);

        $expectedHtml = <<<HTML
<div id="w0" class="alert alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>

Message1

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
