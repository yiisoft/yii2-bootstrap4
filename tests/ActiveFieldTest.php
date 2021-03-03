<?php

namespace yiiunit\extensions\bootstrap4;

use yii\base\DynamicModel;
use yii\bootstrap4\ActiveField;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

class ActiveFieldTest extends TestCase
{
    /**
     * @var ActiveField
     */
    private $activeField;
    /**
     * @var DynamicModel
     */
    private $helperModel;
    /**
     * @var ActiveForm
     */
    private $helperForm;
    /**
     * @var string
     */
    private $attributeName = 'attributeName';

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testHomeLinkNull()
        $_SERVER['SCRIPT_FILENAME'] = "index.php";
        $_SERVER['SCRIPT_NAME'] = "index.php";

        parent::setUp();

        $this->helperModel = new DynamicModel(['attributeName']);
        ob_start();
        $this->helperForm = ActiveForm::begin(['action' => '/something']);
        ActiveForm::end();
        ob_end_clean();

        $this->activeField = new ActiveField(['form' => $this->helperForm]);
        $this->activeField->model = $this->helperModel;
        $this->activeField->attribute = $this->attributeName;
    }

    public function testFileInput()
    {
        Html::$counter = 0;
        $html = $this->activeField->fileInput()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label for="dynamicmodel-attributename">Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><input type="file" id="dynamicmodel-attributename" class="form-control-file" name="DynamicModel[attributeName]">

<div class="invalid-feedback"></div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    // Tests :

    public function testRadioList()
    {
        Html::$counter = 0;
        $html = $this->activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename" role="radiogroup"><div class="custom-control custom-radio">
<input type="radio" id="i0" class="custom-control-input" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="i0">name1</label>
</div>

<div class="custom-control custom-radio">
<input type="radio" id="i1" class="custom-control-input" name="DynamicModel[attributeName]" value="2">
<label class="custom-control-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadioError()
    {
        Html::$counter = 0;
        $this->helperModel->addError($this->attributeName, 'Test print error message');
        $html = $this->activeField->radio()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="custom-control custom-radio">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="radio" id="dynamicmodel-attributename" class="custom-control-input is-invalid" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback">Test print error message</div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadioListError()
    {
        Html::$counter = 0;
        $this->helperModel->addError($this->attributeName, 'Test print error message');
        $html = $this->activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename" class="is-invalid" role="radiogroup" aria-invalid="true"><div class="custom-control custom-radio">
<input type="radio" id="i5" class="custom-control-input is-invalid" name="DynamicModel[attributeName]" value="0">
<label class="custom-control-label" for="i5">name1</label>
</div>

<div class="custom-control custom-radio">
<input type="radio" id="i6" class="custom-control-input is-invalid" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="i6">name2</label>
<div class="invalid-feedback">Test print error message</div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxList()
    {
        Html::$counter = 0;
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="custom-control custom-checkbox">
<input type="checkbox" id="i0" class="custom-control-input" name="DynamicModel[attributeName][]" value="1">
<label class="custom-control-label" for="i0">name1</label>
</div>

<div class="custom-control custom-checkbox">
<input type="checkbox" id="i1" class="custom-control-input" name="DynamicModel[attributeName][]" value="2">
<label class="custom-control-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxError()
    {
        Html::$counter = 0;
        $this->helperModel->addError($this->attributeName, 'Test print error message');
        $html = $this->activeField->checkbox()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="custom-control custom-checkbox">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="checkbox" id="dynamicmodel-attributename" class="custom-control-input is-invalid" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback">Test print error message</div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxListError()
    {
        Html::$counter = 0;
        $this->helperModel->addError($this->attributeName, 'Test print error message');
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename" class="is-invalid" aria-invalid="true"><div class="custom-control custom-checkbox">
<input type="checkbox" id="i5" class="custom-control-input is-invalid" name="DynamicModel[attributeName][]" value="0">
<label class="custom-control-label" for="i5">name1</label>
</div>

<div class="custom-control custom-checkbox">
<input type="checkbox" id="i6" class="custom-control-input is-invalid" name="DynamicModel[attributeName][]" value="1">
<label class="custom-control-label" for="i6">name2</label>
<div class="invalid-feedback">Test print error message</div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadioListInline()
    {
        Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename" role="radiogroup"><div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="i0" class="custom-control-input" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="i0">name1</label>
</div>

<div class="custom-control custom-radio custom-control-inline">
<input type="radio" id="i1" class="custom-control-input" name="DynamicModel[attributeName]" value="2">
<label class="custom-control-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxListInline()
    {
        Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="custom-control custom-checkbox custom-control-inline">
<input type="checkbox" id="i0" class="custom-control-input" name="DynamicModel[attributeName][]" value="1">
<label class="custom-control-label" for="i0">name1</label>
</div>

<div class="custom-control custom-checkbox custom-control-inline">
<input type="checkbox" id="i1" class="custom-control-input" name="DynamicModel[attributeName][]" value="2">
<label class="custom-control-label" for="i1">name2</label>
<div class="invalid-feedback"></div>
</div>
</div>

</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     * @depends testRadioList
     *
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/81
     */
    public function testRadioListItemOptions()
    {
        Html::$counter = 0;
        $content = $this->activeField->radioList([1 => 'name1', 2 => 'name2'], [
            'itemOptions' => [
                'data-attribute' => 'test'
            ]
        ])->render();

        $this->assertContains('data-attribute="test"', $content);
    }

    /**
     * @depends testCheckboxList
     *
     * @see https://github.com/yiisoft/yii2-bootstrap/issues/81
     */
    public function testCheckboxListItemOptions()
    {
        Html::$counter = 0;
        $content = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'], [
            'itemOptions' => [
                'data-attribute' => 'test'
            ]
        ])->render();

        $this->assertContains('data-attribute="test"', $content);
    }

    /**
     *
     */
    public function testCustomRadio()
    {
        Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->radio()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="custom-control custom-radio">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="radio" id="dynamicmodel-attributename" class="custom-control-input" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback"></div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     *
     */
    public function testCustomCheckbox()
    {
        Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->checkbox()->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<div class="custom-control custom-checkbox">
<input type="hidden" name="DynamicModel[attributeName]" value="0"><input type="checkbox" id="dynamicmodel-attributename" class="custom-control-input" name="DynamicModel[attributeName]" value="1">
<label class="custom-control-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="invalid-feedback"></div>

</div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
