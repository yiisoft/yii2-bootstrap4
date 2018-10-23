<?php

namespace yiiunit\extensions\bootstrap4;

use yii\base\DynamicModel;
use yii\bootstrap4\ActiveField;
use yii\bootstrap4\ActiveForm;
use yiiunit\extensions\bootstrap4\data\ExtendedActiveField;

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

    // Tests :

    public function testRadioList()
    {
        $html = $this->activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="form-check"><input type="radio" id="i0" class="form-check-input" name="DynamicModel[attributeName]" value="1">
<label class="form-check-label" for="i0">name1</label></div>
<div class="form-check"><input type="radio" id="i1" class="form-check-input" name="DynamicModel[attributeName]" value="2">
<label class="form-check-label" for="i1">name2</label></div></div>

<div class="invalid-feedback"></div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxList()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="form-check"><input type="checkbox" id="i0" class="form-check-input" name="DynamicModel[attributeName][]" value="1">
<label class="form-check-label" for="i0">name1</label></div>
<div class="form-check"><input type="checkbox" id="i1" class="form-check-input" name="DynamicModel[attributeName][]" value="2">
<label class="form-check-label" for="i1">name2</label></div></div>

<div class="invalid-feedback"></div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testRadioListInline()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->radioList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="form-check form-check-inline"><input type="radio" id="i0" class="form-check-input" name="DynamicModel[attributeName]" value="1">
<label class="form-check-label" for="i0">name1</label></div>
<div class="form-check form-check-inline"><input type="radio" id="i1" class="form-check-input" name="DynamicModel[attributeName]" value="2">
<label class="form-check-label" for="i1">name2</label></div></div>

<div class="invalid-feedback"></div>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxListInline()
    {
        \yii\bootstrap4\Html::$counter = 0;
        $this->activeField->inline = true;
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label>Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="form-check form-check-inline"><input type="checkbox" id="i0" class="form-check-input" name="DynamicModel[attributeName][]" value="1">
<label class="form-check-label" for="i0">name1</label></div>
<div class="form-check form-check-inline"><input type="checkbox" id="i1" class="form-check-input" name="DynamicModel[attributeName][]" value="2">
<label class="form-check-label" for="i1">name2</label></div></div>

<div class="invalid-feedback"></div>
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
        $content = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'], [
            'itemOptions' => [
                'data-attribute' => 'test'
            ]
        ])->render();

        $this->assertContains('data-attribute="test"', $content);
    }

    public function testHorizontalCssClasses()
    {
        $this->helperForm->layout = 'horizontal';

        $activeField = new ActiveField(['form' => $this->helperForm]);
        $activeField->model = $this->helperModel;
        $activeField->attribute = $this->attributeName;

        $html = $activeField->render();
        $expectedHtml = <<<EXPECTED
<div class="form-group row field-dynamicmodel-attributename">
<label class="col-md-2 col-form-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-md-10">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<div class="invalid-feedback "></div>

</div>
</div>
EXPECTED;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    /**
     * @depends testHorizontalCssClasses
     */
    public function testHorizontalCssClassesOverride()
    {
        $this->helperForm->layout = 'horizontal';

        $activeField = new ExtendedActiveField(['form' => $this->helperForm]);
        $activeField->model = $this->helperModel;
        $activeField->attribute = $this->attributeName;

        $html = $activeField->render();
        $expectedHtml = <<<EXPECTED
<div class="form-group row field-dynamicmodel-attributename">
<label class="col-md-2 col-form-label" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-md-10">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<div class="invalid-feedback "></div>

</div>
</div>
EXPECTED;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
