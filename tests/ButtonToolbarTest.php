<?php

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\ButtonGroup;
use yii\bootstrap4\ButtonToolbar;

/**
 * @group bootstrap4
 */
class ButtonToolbarTest extends TestCase
{
    public function testContainerOptions(): void
    {
        ButtonToolbar::$counter = 0;
        $out = ButtonToolbar::widget([
            'options' => [
                'aria-label' => 'Toolbar with button groups'
            ],
            'buttonGroups' => [
                ButtonGroup::widget([
                    'options' => [
                        'aria-label' => 'First group',
                        'class' => ['mr-2']
                    ],
                    'buttons' => [
                        ['label' => '1'],
                        ['label' => '2'],
                        ['label' => '3'],
                        ['label' => '4']
                    ]
                ]),
                [
                    'options' => [
                        'aria-label' => 'Second group'
                    ],
                    'buttons' => [
                        ['label' => '5'],
                        ['label' => '6'],
                        ['label' => '7']
                    ]
                ]
            ]
        ]);

        $expected = <<<HTML
<div id="w5" class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar"><div id="w0" class="mr-2 btn-group" aria-label="First group" role="group"><button type="button" id="w1" class="btn">1</button>
<button type="button" id="w2" class="btn">2</button>
<button type="button" id="w3" class="btn">3</button>
<button type="button" id="w4" class="btn">4</button></div>
<div id="w6" class="btn-group" aria-label="Second group" role="group"><button type="button" id="w7" class="btn">5</button>
<button type="button" id="w8" class="btn">6</button>
<button type="button" id="w9" class="btn">7</button></div></div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testAdditionalContent(): void
    {
        ButtonToolbar::$counter = 0;
        $addHtml = <<<HTML
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text" id="btnGroupAddon">@</div>
</div>
<input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
</div>
HTML;
        $out = ButtonToolbar::widget([
            'options' => [
                'aria-label' => 'Toolbar with button groups'
            ],
            'buttonGroups' => [
                [
                    'options' => [
                        'aria-label' => 'First group',
                        'class' => ['mr-2']
                    ],
                    'buttons' => [
                        ['label' => '1'],
                        ['label' => '2'],
                        ['label' => '3'],
                        ['label' => '4']
                    ]
                ],
                $addHtml
            ]
        ]);

        $expected = <<<HTML
<div id="w0" class="btn-toolbar" aria-label="Toolbar with button groups" role="toolbar"><div id="w1" class="mr-2 btn-group" aria-label="First group" role="group"><button type="button" id="w2" class="btn">1</button>
<button type="button" id="w3" class="btn">2</button>
<button type="button" id="w4" class="btn">3</button>
<button type="button" id="w5" class="btn">4</button></div>
<div class="input-group">
<div class="input-group-prepend">
<div class="input-group-text" id="btnGroupAddon">@</div>
</div>
<input type="text" class="form-control" placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
</div></div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
