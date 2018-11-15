<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Button;
use yii\bootstrap4\ButtonGroup;

/**
 * @group bootstrap4
 */
class ButtonGroupTest extends TestCase
{
    public function testContainerOptions()
    {
        ButtonGroup::$counter = 0;
        $out = ButtonGroup::widget([
            'buttons' => [
                ['label' => 'button-A'],
                ['label' => 'button-B', 'visible' => true],
                ['label' => 'button-C', 'visible' => false],
                Button::widget(['label' => 'button-D']),
            ],
        ]);

        $expected = <<<HTML
<div id="w1" class="btn-group" role="group"><button type="button" id="w2" class="btn">button-A</button>
<button type="button" id="w3" class="btn">button-B</button>
<button id="w0" class="btn">button-D</button></div>
HTML;


        $this->assertEqualsWithoutLE($expected, $out);
    }
}
