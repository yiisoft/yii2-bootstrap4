<?php
/**
 * @package yii2-bootstrap4
 * @author Simon Karlen <simi.albi@outlook.com>
 * @copyright Copyright © 2019 Simon Karlen
 */

namespace yiiunit\extensions\bootstrap4;

use Yii;
use yii\base\DynamicModel;
use yii\bootstrap4\ActiveField;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\UnsetArrayValue;

class ActiveFieldDefaultFormCheckTest extends TestCase
{
    /**
     * @var ActiveField
     */
    private $_activeField;
    /**
     * @var DynamicModel
     */
    private $_helperModel;
    /**
     * @var ActiveForm
     */
    private $_helperForm;
    /**
     * @var string
     */
    private $_attributeName = 'attributeName';

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testHomeLinkNull()
        $_SERVER['SCRIPT_FILENAME'] = 'index.php';
        $_SERVER['SCRIPT_NAME'] = 'index.php';

        $this->mockWebApplication([
            'container' => [
                'definitions' => [
                    'yii\bootstrap4\ActiveField' => [
                        'checkTemplate' => "<div class=\"form-check\">\n{input}\n{label}\n{error}\n{hint}\n</div>",
                        'radioTemplate' => "<div class=\"form-check\">\n{input}\n{label}\n{error}\n{hint}\n</div>",
                        'checkHorizontalTemplate' => "{beginWrapper}\n<div class=\"form-check\">\n{input}\n{label}\n{error}\n{hint}\n</div>\n{endWrapper}",
                        'radioHorizontalTemplate' => "{beginWrapper}\n<div class=\"form-check\">\n{input}\n{label}\n{error}\n{hint}\n</div>\n{endWrapper}",
                        'checkOptions' => [
                            'class' => ['widget' => 'form-check-input'],
                            'labelOptions' => [
                                'class' => ['widget' => 'form-check-label']
                            ],
                            'wrapperOptions' => [
                                'class' => ['widget' => 'form-check']
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        $this->_helperModel = new DynamicModel(['attributeName']);
        ob_start();
        $this->_helperForm = ActiveForm::begin(['action' => '/something']);
        ActiveForm::end();
        ob_end_clean();

        $this->_activeField = Yii::createObject([
            'class' => 'yii\bootstrap4\ActiveField',
            'form' => $this->_helperForm
        ]);
        $this->_activeField->model = $this->_helperModel;
        $this->_activeField->attribute = $this->_attributeName;
    }

    public function testDefaultCheckboxByConfig()
    {
        Html::$counter = 0;
        $this->_activeField->inline = true;
        $html = $this->_activeField->checkbox()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="form-check">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="checkbox" id="dynamicmodel-attributename" class="form-check-input" name="DynamicModel[attributeName]" value="1">
<label class="form-check-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback"></div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testDefaultRadioByConfig()
    {
        Html::$counter = 0;
        $this->_activeField->inline = true;
        $html = $this->_activeField->radio()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="form-check">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="radio" id="dynamicmodel-attributename" class="form-check-input" name="DynamicModel[attributeName]" value="1">
<label class="form-check-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback"></div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testDefaultCheckboxListByConfig()
    {
        Html::$counter = 0;
        $html = $this->_activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="form-check">
<input type="checkbox" id="i0" class="form-check-input" name="DynamicModel[attributeName][]" value="1">
<label class="form-check-label" for="i0">name1</label>
</div>

<div class="form-check">
<input type="checkbox" id="i1" class="form-check-input" name="DynamicModel[attributeName][]" value="2">
<label class="form-check-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testDefaultRadioListByConfig()
    {
        Html::$counter = 0;
        $html = $this->_activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename" role="radiogroup"><div class="form-check">
<input type="radio" id="i0" class="form-check-input" name="DynamicModel[attributeName]" value="1">
<label class="form-check-label" for="i0">name1</label>
</div>

<div class="form-check">
<input type="radio" id="i1" class="form-check-input" name="DynamicModel[attributeName]" value="2">
<label class="form-check-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testHorizontalLayout()
    {
        Html::$counter = 0;
        ActiveForm::$counter = 0;
        ob_start();
        $model = new DynamicModel(['attributeName', 'checkbox', 'gridRadios']);
        $form = ActiveForm::begin([
            'action' => '/some-action',
            'layout' => ActiveForm::LAYOUT_HORIZONTAL
        ]);
        echo $form->field($model, 'attributeName');
        echo $form->field($model, 'checkbox')->checkbox(['wrapperOptions' => ['class' => ['widget' => new UnsetArrayValue()]]]);
        echo $form->field($model, 'gridRadios')->radioList([
            'option1' => 'First radio',
            'option2' => 'Second radio',
            'option3' => 'Third radio'
        ]);
        ActiveForm::end();
        $out = ob_get_clean();

        $expected = <<<HTML
<div class="form-group row field-dynamicmodel-attributename">
<label class="col-sm-2 col-form-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-sm-10">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<div class="invalid-feedback "></div>

</div>
</div>
HTML;
        $expected2 = <<<HTML
<div class="form-group row field-dynamicmodel-checkbox">
<div class="col-sm-10 offset-sm-2">
<div class="form-check">
<input type="hidden" name="DynamicModel[checkbox]" value="0"><input type="checkbox" id="dynamicmodel-checkbox" class="form-check-input" name="DynamicModel[checkbox]" value="1">
<label class="form-check-label" for="dynamicmodel-checkbox">Checkbox</label>
<div class="invalid-feedback "></div>

</div>
</div>
</div>
HTML;
        $expected3 = <<<HTML
<div class="form-group row field-dynamicmodel-gridradios">
<label class="col-sm-2 col-form-label">Grid Radios</label>
<div class="col-sm-10">
<input type="hidden" name="DynamicModel[gridRadios]" value=""><div id="dynamicmodel-gridradios" role="radiogroup"><div class="form-check">
<input type="radio" id="i0" class="form-check-input" name="DynamicModel[gridRadios]" value="option1">
<label class="form-check-label" for="i0">First radio</label>
</div>

<div class="form-check">
<input type="radio" id="i1" class="form-check-input" name="DynamicModel[gridRadios]" value="option2">
<label class="form-check-label" for="i1">Second radio</label>
</div>

<div class="form-check">
<input type="radio" id="i2" class="form-check-input" name="DynamicModel[gridRadios]" value="option3">
<label class="form-check-label" for="i2">Third radio</label>
<div class="invalid-feedback "></div>
</div>
</div>

</div>
</div>
HTML;


        $this->assertContains($expected, $out);
        $this->assertContains($expected2, $out);
        $this->assertContains($expected3, $out);
    }
}
