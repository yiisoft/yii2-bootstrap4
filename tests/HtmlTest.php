<?php

namespace yiiunit\extensions\bootstrap;

use yii\base\DynamicModel;
use yii\bootstrap\Html;

/**
 * @group bootstrap
 */
class HtmlTest extends TestCase
{
    /**
     * Data provider for [[testIcon()]]
     * @return array test data
     */
    public function dataProviderIcon()
    {
        return [
            [
                'star',
                [],
                '<span class="glyphicon glyphicon-star"></span>',
            ],
            [
                'star',
                [
                    'tag' => 'i',
                    'prefix' => 'my-icon icon-',
                ],
                '<i class="my-icon icon-star"></i>',
            ],
        ];
    }

    /**
     * @dataProvider dataProviderIcon
     *
     * @param $name
     * @param $options
     * @param $expectedHtml
     */
    public function testIcon($name, array $options, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Html::icon($name, $options));
    }

    /**
     * @return array
     */
    public function dataProviderStaticControl()
    {
        return [
            [
                'foo',
                [],
                '<p class="form-control-static">foo</p>'
            ],
            [
                '<html>',
                [],
                '<p class="form-control-static">&lt;html&gt;</p>'
            ],
            [
                '<html></html>',
                [
                    'encode' => false
                ],
                '<p class="form-control-static"><html></html></p>'
            ],
        ];
    }

    /**
     * @dataProvider dataProviderStaticControl
     *
     * @param string $value
     * @param array $options
     * @param string $expectedHtml
     */
    public function testStaticControl($value, array $options, $expectedHtml)
    {
        $this->assertEquals($expectedHtml, Html::staticControl($value, $options));
    }

    public function testRadioList()
    {
        $this->assertEquals('<div></div>', Html::radioList('test'));

        $dataItems = [
            'value1' => 'text1',
            'value2' => 'text2',
        ];

        $expected = <<<'EOD'
<div><div class="radio"><label><input type="radio" name="test" value="value1"> text1</label></div>
<div class="radio"><label><input type="radio" name="test" value="value2" checked> text2</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::radioList('test', ['value2'], $dataItems));

        $expected = <<<'EOD'
<div>0<label>text1 <input type="radio" name="test" value="value1"></label>
1<label>text2 <input type="radio" name="test" value="value2" checked></label></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::radioList('test', ['value2'], $dataItems, [
            'item' => function ($index, $label, $name, $checked, $value) {
                return $index . Html::label($label . ' ' . Html::radio($name, $checked, ['value' => $value]));
            },
        ]));

        $expected = <<<'EOD'
<div><div class="radio"><label><input type="radio" name="test" value="value"> label&amp;</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::radioList('test', [], ['value' => 'label&']));

        $expected = <<<'EOD'
<div><div class="radio"><label><input type="radio" name="test" value="value"> label&</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::radioList('test', [], ['value' => 'label&'], ['encode' => false]));
    }

    public function testCheckboxList()
    {
        $this->assertEquals('<div></div>', Html::checkboxList('test'));

        $dataItems = [
            'value1' => 'text1',
            'value2' => 'text2',
        ];

        $expected = <<<'EOD'
<div><div class="checkbox"><label><input type="checkbox" name="test[]" value="value1"> text1</label></div>
<div class="checkbox"><label><input type="checkbox" name="test[]" value="value2" checked> text2</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::checkboxList('test', ['value2'], $dataItems));

        $expected = <<<'EOD'
<div>0<label>text1 <input type="checkbox" name="test[]" value="value1"></label>
1<label>text2 <input type="checkbox" name="test[]" value="value2" checked></label></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::checkboxList('test', ['value2'], $dataItems, [
            'item' => function ($index, $label, $name, $checked, $value) {
                return $index . Html::label($label . ' ' . Html::checkbox($name, $checked, ['value' => $value]));
            },
        ]));

        $expected = <<<'EOD'
<div><div class="checkbox"><label><input type="checkbox" name="test[]" value="value" checked> label&amp;</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::checkboxList('test', 'value', ['value' => 'label&']));

        $expected = <<<'EOD'
<div><div class="checkbox"><label><input type="checkbox" name="test[]" value="value" checked> label&</label></div></div>
EOD;
        $this->assertEqualsWithoutLE($expected, Html::checkboxList('test', 'value', ['value' => 'label&'], ['encode' => false]));
    }

    public function testError()
    {
        $model = new DynamicModel();
        $model->addError('foo', 'Some error message.');

        $this->assertEquals('<p class="help-block help-block-error">Some error message.</p>', Html::error($model, 'foo'));
        $this->assertEquals('<p class="custom-class">Some error message.</p>', Html::error($model, 'foo', ['class' => 'custom-class']));
        $this->assertEquals('<p>Some error message.</p>', Html::error($model, 'foo', ['class' => null]));
        $this->assertEquals('<div class="help-block help-block-error">Some error message.</div>', Html::error($model, 'foo', ['tag' => 'div']));
    }
}