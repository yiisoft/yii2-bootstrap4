<?php

namespace yiiunit\extensions\bootstrap4;

use yii\base\Model;
use yii\bootstrap4\ToggleButtonGroup;

/**
 * @group bootstrap4
 */
class ToggleButtonGroupTest extends TestCase
{
    public function testCheckbox()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => 'checkbox',
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" data-toggle="buttons"><label class="btn" for="i0"><input type="checkbox" id="i0" class="d-none" name="ToggleButtonGroupTestModel[value][]" value="1" autocomplete="off">item 1</label>
<label class="btn" for="i1"><input type="checkbox" id="i1" class="d-none" name="ToggleButtonGroupTestModel[value][]" value="2" autocomplete="off">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadio()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => 'radio',
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" data-toggle="buttons"><label class="btn" for="i0"><input type="radio" id="i0" class="d-none" name="ToggleButtonGroupTestModel[value]" value="1" autocomplete="off">item 1</label>
<label class="btn" for="i1"><input type="radio" id="i1" class="d-none" name="ToggleButtonGroupTestModel[value]" value="2" autocomplete="off">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}

class ToggleButtonGroupTestModel extends Model
{
    public $value;
}
