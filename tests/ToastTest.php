<?php

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Toast;

/**
 * @group bootstrap4
 */
class ToastTest extends TestCase
{
    public function testBodyOptions(): void
    {
        Toast::$counter = 0;
        $out = Toast::widget([
            'bodyOptions' => ['class' => 'toast-body test', 'style' => ['text-align' => 'center']]
        ]);

        $expected = <<<HTML
<div id="w0" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
<div class="toast-header">
<strong class="mr-auto"></strong>
<button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="toast-body test" style="text-align: center;">


</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @depends testBodyOptions
     */
    public function testContainerOptions(): void
    {
        Toast::$counter = 0;

        ob_start();
        Toast::begin([
            'title' => 'Toast title',
            'dateTime' => time() - 60
        ]);
        echo 'Woohoo, you\'re reading this text in a toast!';
        Toast::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div id="w0" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
<div class="toast-header">
<strong class="mr-auto">Toast title</strong>
<small class="text-muted">a minute ago</small>
<button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="toast-body">
Woohoo, you're reading this text in a toast!

</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testDateTimeOptions(): void
    {
        Toast::$counter = 0;
        $out = Toast::widget([
            'title' => 'Toast title',
            'dateTime' => time() - 60,
            'dateTimeOptions' => ['class' => ['toast-date-time'], 'style' => ['text-align' => 'right']]
        ]);

        $expected = <<<HTML
<div id="w0" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
<div class="toast-header">
<strong class="mr-auto">Toast title</strong>
<small class="toast-date-time text-muted" style="text-align: right;">a minute ago</small>
<button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="toast-body">


</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testTitleOptions(): void
    {
        Toast::$counter = 0;
        $out = Toast::widget([
            'title' => 'Toast title',
            'titleOptions' => ['tag' => 'h5', 'style' => ['text-align' => 'left']]
        ]);

        $expected = <<<HTML
<div id="w0" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
<div class="toast-header">
<h5 class="mr-auto" style="text-align: left;">Toast title</h5>
<button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="toast-body">


</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
