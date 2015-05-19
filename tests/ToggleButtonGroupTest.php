<?php

namespace yiiunit\extensions\bootstrap;

use yii\base\Model;
use yii\bootstrap\ToggleButtonGroup;

/**
 * @group bootstrap
 */
class ToggleButtonGroupTest extends TestCase
{
    public function testCheckbox()
    {
        ToggleButtonGroup::$counter = 0;
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
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" data-toggle="buttons"><label class="btn"><input type="checkbox" name="ToggleButtonGroupTestModel[value][]" value="1"> item 1</label>
<label class="btn"><input type="checkbox" name="ToggleButtonGroupTestModel[value][]" value="2"> item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadio()
    {
        ToggleButtonGroup::$counter = 0;
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
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group" data-toggle="buttons"><label class="btn"><input type="radio" name="ToggleButtonGroupTestModel[value]" value="1"> item 1</label>
<label class="btn"><input type="radio" name="ToggleButtonGroupTestModel[value]" value="2"> item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}

class ToggleButtonGroupTestModel extends Model
{
    public $value;
}