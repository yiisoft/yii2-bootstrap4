<?php

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

/**
 * @group bootstrap4
 */
class ModalTest extends TestCase
{
    public function testBodyOptions()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'bodyOptions' => ['class' => 'modal-body test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">

<div class="modal-body test" style="text-align:center;">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @depends testBodyOptions
     */
    public function testTitleOptions()
    {
        Modal::$counter = 0;

        ob_start();
        Modal::begin([
            'title' => 'Modal title',
            'titleOptions' => [
                'tag' => 'h4',
                'class' => 'my-class',
                'data-test' => 'string'
            ]
        ]);
        echo '<p>Woohoo, you\'re reading this text in a modal!</p>';
        Modal::end();
        $out = ob_get_clean();

        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="w0-label">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 id="w0-label" class="my-class modal-title" data-test="string">Modal title</h4>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<p>Woohoo, you're reading this text in a modal!</p>
</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @depends testBodyOptions
     */
    public function testContainerOptions()
    {
        Modal::$counter = 0;

        ob_start();
        Modal::begin([
            'title' => 'Modal title',
            'footer' => Html::button('Close', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-secondary'],
                    'data' => [
                        'dismiss' => 'modal'
                    ]
                ]) . "\n" . Html::button('Save changes', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-primary']
                ])
        ]);
        echo '<p>Woohoo, you\'re reading this text in a modal!</p>';
        Modal::end();
        $out = ob_get_clean();

        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="w0-label">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 id="w0-label" class="modal-title">Modal title</h5>
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
<p>Woohoo, you're reading this text in a modal!</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testTriggerButton()
    {
        Modal::$counter = 0;

        ob_start();
        Modal::begin([
            'toggleButton' => [
                'class' => ['btn', 'btn-primary'],
                'label' => 'Launch demo modal'
            ],
            'title' => 'Modal title',
            'footer' => Html::button('Close', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-secondary']
                ]) . "\n" . Html::button('Save changes', [
                    'type' => 'button',
                    'class' => ['btn', 'btn-primary']
                ])
        ]);
        echo '<p>Woohoo, you\'re reading this text in a modal!</p>';
        Modal::end();
        $out = ob_get_clean();

        $this->assertContains('<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#w0">Launch demo modal</button>',
            $out);
    }
    
    public function testDialogOptions()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'dialogOptions' => ['class' => 'test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true">
<div class="test modal-dialog" role="document" style="text-align:center;">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
    
    public function testCenterVertical()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'centerVertical'=>true
        ]);


        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
    public function testScrollable()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'closeButton' => false,
            'scrollable'=>true
        ]);


        $expected = <<<HTML

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">

<div class="modal-body">

</div>

</div>
</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
