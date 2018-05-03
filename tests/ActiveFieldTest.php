<?php

namespace yiiunit\extensions\bootstrap4;

use yii\base\DynamicModel;
use yii\bootstrap4\ActiveField;
use yii\bootstrap4\ActiveForm;
use Yii;
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
        $this->helperForm = ActiveForm::begin(['action' => '/something', 'enableClientScript' => false]);
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
<label class="control-label">Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="radio"><label><input type="radio" name="DynamicModel[attributeName]" value="1"> name1</label></div>
<div class="radio"><label><input type="radio" name="DynamicModel[attributeName]" value="2"> name2</label></div></div>

<p class="text-danger"></p>
</div>
HTML;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }

    public function testCheckboxList()
    {
        $html = $this->activeField->checkboxList([1 => 'name1', 2 => 'name2'])->render();

        $expectedHtml = <<<HTML
<div class="form-group field-dynamicmodel-attributename">
<label class="control-label">Attribute Name</label>
<input type="hidden" name="DynamicModel[attributeName]" value=""><div id="dynamicmodel-attributename"><div class="checkbox"><label><input type="checkbox" name="DynamicModel[attributeName][]" value="1"> name1</label></div>
<div class="checkbox"><label><input type="checkbox" name="DynamicModel[attributeName][]" value="2"> name2</label></div></div>

<p class="text-danger"></p>
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
<div class="form-group field-dynamicmodel-attributename">
<label class="control-label col-sm-3" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-sm-6">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<p class="help-block help-block-error "></p>
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
<div class="form-group field-dynamicmodel-attributename">
<label class="control-label col-md-4" for="dynamicmodel-attributename">Attribute Name</label>
<div class="col-md-6">
<input type="text" id="dynamicmodel-attributename" class="form-control" name="DynamicModel[attributeName]">
<p class="help-block help-block-error col-md-3"></p>
</div>

</div>
EXPECTED;
        $this->assertEqualsWithoutLE($expectedHtml, $html);
    }
}
