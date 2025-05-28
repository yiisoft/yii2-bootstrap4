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
            'type' => ToggleButtonGroup::TYPE_CHECKBOX,
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group-toggle" data-toggle="buttons"><label class="btn btn-secondary" for="togglebuttongrouptestmodel-value-0"><input type="checkbox" id="togglebuttongrouptestmodel-value-0" name="ToggleButtonGroupTestModel[value][]" value="1" autocomplete="off">item 1</label>
<label class="btn btn-secondary" for="togglebuttongrouptestmodel-value-1"><input type="checkbox" id="togglebuttongrouptestmodel-value-1" name="ToggleButtonGroupTestModel[value][]" value="2" autocomplete="off">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     * @depends testCheckbox
     */
    public function testCheckboxChecked() {
        \yii\bootstrap4\Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_CHECKBOX,
            'model' => new ToggleButtonGroupTestModel(['value' => '2']),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $this->assertStringContainsString('<input type="checkbox" id="togglebuttongrouptestmodel-value-1" name="ToggleButtonGroupTestModel[value][]" value="2" checked autocomplete="off">', $html);
    }

    public function testRadio()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_RADIO,
            'model' => new ToggleButtonGroupTestModel(),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $expectedHtml = <<<HTML
<input type="hidden" name="ToggleButtonGroupTestModel[value]" value=""><div id="togglebuttongrouptestmodel-value" class="btn-group-toggle" data-toggle="buttons"><label class="btn btn-secondary" for="togglebuttongrouptestmodel-value-0"><input type="radio" id="togglebuttongrouptestmodel-value-0" name="ToggleButtonGroupTestModel[value]" value="1" autocomplete="off">item 1</label>
<label class="btn btn-secondary" for="togglebuttongrouptestmodel-value-1"><input type="radio" id="togglebuttongrouptestmodel-value-1" name="ToggleButtonGroupTestModel[value]" value="2" autocomplete="off">item 2</label></div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     * @depends testRadio
     */
    public function testRadioChecked() {
        \yii\bootstrap4\Html::$counter = 0;
        $html = ToggleButtonGroup::widget([
            'type' => ToggleButtonGroup::TYPE_RADIO,
            'model' => new ToggleButtonGroupTestModel(['value' => '2']),
            'attribute' => 'value',
            'items' => [
                '1' => 'item 1',
                '2' => 'item 2',
            ],
        ]);

        $this->assertStringContainsString('<input type="radio" id="togglebuttongrouptestmodel-value-1" name="ToggleButtonGroupTestModel[value]" value="2" checked autocomplete="off">', $html);
    }
}

class ToggleButtonGroupTestModel extends Model
{
    public $value;
}
