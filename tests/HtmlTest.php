<?php

namespace yiiunit\extensions\bootstrap;

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
} 