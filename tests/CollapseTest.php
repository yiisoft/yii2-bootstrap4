<?php
namespace yiiunit\extensions\bootstrap4;

use yii\base\DynamicModel;
use yii\bootstrap4\Collapse;
use yii\widgets\ActiveForm;

/**
 * @group bootstrap4
 */
class CollapseTest extends TestCase
{
    public function testRender()
    {
        Collapse::$counter = 0;
        $output = Collapse::widget([
            'items' => [
                [
                    'label' => 'Collapsible Group Item #1',
                    'content' => [
                        'test content1',
                        'test content2'
                    ],
                ],
                [
                    'label' => 'Collapsible Group Item #2',
                    'content' => 'Das ist das Haus vom Nikolaus',
                    'contentOptions' => [
                        'class' => 'testContentOptions'
                    ],
                    'options' => [
                        'class' => 'testClass',
                        'id' => 'testId'
                    ],
                    'footer' => 'Footer'
                ],
                [
                    'label' => '<h1>Collapsible Group Item #3</h1>',
                    'content' => [
                        '<h2>test content1</h2>',
                        '<h2>test content2</h2>'
                    ],
                    'contentOptions' => [
                        'class' => 'testContentOptions2'
                    ],
                    'options' => [
                        'class' => 'testClass2',
                        'id' => 'testId2'
                    ],
                    'encode' => false,
                    'footer' => 'Footer2'
                ],
                [
                    'label' => '<h1>Collapsible Group Item #4</h1>',
                    'content' => [
                        '<h2>test content1</h2>',
                        '<h2>test content2</h2>'
                    ],
                    'contentOptions' => [
                        'class' => 'testContentOptions3'
                    ],
                    'options' => [
                        'class' => 'testClass3',
                        'id' => 'testId3'
                    ],
                    'encode' => true,
                    'footer' => 'Footer3'
                ],
            ]
        ]);

        $this->assertEqualsWithoutLE(<<<HTML
<div id="w0">
<div class="card"><div id="w0-collapse0-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w1" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse0" aria-expanded aria-controls="w0-collapse0" data-parent="#w0">Collapsible Group Item #1</button>
</h5></div>
<div id="w0-collapse0" class="collapse show" aria-labelledby="w0-collapse0-heading">
<ul class="list-group">
<li class="list-group-item">test content1</li>
<li class="list-group-item">test content2</li>
</ul>

</div></div>
<div id="testId" class="testClass card"><div id="w0-collapse1-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w2" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse1" aria-controls="w0-collapse1" data-parent="#w0">Collapsible Group Item #2</button>
</h5></div>
<div id="w0-collapse1" class="testContentOptions collapse" aria-labelledby="w0-collapse1-heading">
<div class="card-body">Das ist das Haus vom Nikolaus</div>

<div class="card-footer">Footer</div>
</div></div>
<div id="testId2" class="testClass2 card"><div id="w0-collapse2-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w3" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse2" aria-controls="w0-collapse2" data-parent="#w0"><h1>Collapsible Group Item #3</h1></button>
</h5></div>
<div id="w0-collapse2" class="testContentOptions2 collapse" aria-labelledby="w0-collapse2-heading">
<ul class="list-group">
<li class="list-group-item"><h2>test content1</h2></li>
<li class="list-group-item"><h2>test content2</h2></li>
</ul>

<div class="card-footer">Footer2</div>
</div></div>
<div id="testId3" class="testClass3 card"><div id="w0-collapse3-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w4" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse3" aria-controls="w0-collapse3" data-parent="#w0">&lt;h1&gt;Collapsible Group Item #4&lt;/h1&gt;</button>
</h5></div>
<div id="w0-collapse3" class="testContentOptions3 collapse" aria-labelledby="w0-collapse3-heading">
<ul class="list-group">
<li class="list-group-item"><h2>test content1</h2></li>
<li class="list-group-item"><h2>test content2</h2></li>
</ul>

<div class="card-footer">Footer3</div>
</div></div>
</div>

HTML
        , $output);
    }

    public function testLabelKeys()
    {
        ob_start();
        $form = ActiveForm::begin(['action' => '/something']);
        ActiveForm::end();
        ob_end_clean();

        Collapse::$counter = 0;
        $output = Collapse::widget([
            'items' => [
                'Item1' => 'Content1',
                'Item2' => [
                    'content' => 'Content2',
                ],
                [
                    'label' => 'Item3',
                    'content' => 'Content3',
                ],
                'FormField' => $form->field(new DynamicModel(['test']), 'test',['template' => '{input}']),
            ]
        ]);

        $this->assertEqualsWithoutLE(<<<HTML
<div id="w0">
<div class="card"><div id="w0-collapse0-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w1" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse0" aria-expanded aria-controls="w0-collapse0" data-parent="#w0">Item1</button>
</h5></div>
<div id="w0-collapse0" class="collapse show" aria-labelledby="w0-collapse0-heading">
<div class="card-body">Content1</div>

</div></div>
<div class="card"><div id="w0-collapse1-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w2" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse1" aria-controls="w0-collapse1" data-parent="#w0">Item2</button>
</h5></div>
<div id="w0-collapse1" class="collapse" aria-labelledby="w0-collapse1-heading">
<div class="card-body">Content2</div>

</div></div>
<div class="card"><div id="w0-collapse2-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w3" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse2" aria-controls="w0-collapse2" data-parent="#w0">Item3</button>
</h5></div>
<div id="w0-collapse2" class="collapse" aria-labelledby="w0-collapse2-heading">
<div class="card-body">Content3</div>

</div></div>
<div class="card"><div id="w0-collapse3-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w4" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse3" aria-controls="w0-collapse3" data-parent="#w0">FormField</button>
</h5></div>
<div id="w0-collapse3" class="collapse" aria-labelledby="w0-collapse3-heading">
<div class="card-body"><div class="form-group field-dynamicmodel-test">
<input type="text" id="dynamicmodel-test" class="form-control" name="DynamicModel[test]">
</div></div>

</div></div>
</div>

HTML
        , $output);
    }

    public function invalidItemsProvider()
    {
        return [
            [ ['content'] ], // only content without label key
            [ [[]] ], // only content array without label
            [ [['content' => 'test']] ], // only content array without label
        ];
    }

    /**
     * @dataProvider invalidItemsProvider
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testMissingLabel($items)
    {
        Collapse::widget([
            'items' => $items,
        ]);
    }

    /**
     * @see https://github.com/yiisoft/yii2/issues/8357
     */
    public function testRenderObject()
    {
        $template = ['template' => '{input}'];
        ob_start();
        $form = ActiveForm::begin(['action' => '/something']);
        ActiveForm::end();
        ob_end_clean();
        $model = new data\Singer;

        Collapse::$counter = 0;
        $output = Collapse::widget([
            'items' => [
                [
                    'label' => 'Collapsible Group Item #1',
                    'content' => $form->field($model, 'firstName', $template)
                ],
            ]
        ]);

        $this->assertEqualsWithoutLE(<<<HTML
<div id="w0">
<div class="card"><div id="w0-collapse0-heading" class="card-header"><h5 class="mb-0"><button type="button" id="w1" class="btn-link btn" data-toggle="collapse" data-target="#w0-collapse0" aria-expanded aria-controls="w0-collapse0" data-parent="#w0">Collapsible Group Item #1</button>
</h5></div>
<div id="w0-collapse0" class="collapse show" aria-labelledby="w0-collapse0-heading">
<div class="card-body"><div class="form-group field-singer-firstname">
<input type="text" id="singer-firstname" class="form-control" name="Singer[firstName]">
</div></div>

</div></div>
</div>

HTML
        , $output);
    }

    public function testAutoCloseItems()
    {
        $items = [
            [
                'label' => 'Item 1',
                'content' => 'Content 1',
            ],
            [
                'label' => 'Item 2',
                'content' => 'Content 2',
            ],
        ];

        $output = Collapse::widget([
            'items' => $items
        ]);
        $this->assertContains('data-parent="', $output);
        $output = Collapse::widget([
            'autoCloseItems' => false,
            'items' => $items
        ]);
        $this->assertNotContains('data-parent="', $output);
    }

    /**
     * @depends testRender
     */
    public function testItemToggleTag()
    {
        $items = [
            [
                'label' => 'Item 1',
                'content' => 'Content 1',
            ],
            [
                'label' => 'Item 2',
                'content' => 'Content 2',
            ],
        ];

        Collapse::$counter = 0;

        $output = Collapse::widget([
            'items' => $items,
            'itemToggleOptions' => [
                'tag' => 'a',
                'class' => 'custom-toggle',
            ],
        ]);
        $this->assertContains('<h5 class="mb-0"><a type="button" class="custom-toggle" href="#w0-collapse0" ', $output);
        $this->assertNotContains('<button', $output);

        $output = Collapse::widget([
            'items' => $items,
            'itemToggleOptions' => [
                'tag' => 'a',
                'class' => ['widget' => 'custom-toggle'],
            ],
        ]);
        $this->assertContains('<h5 class="mb-0"><a type="button" class="custom-toggle" href="#w1-collapse0" ', $output);
        $this->assertNotContains('collapse-toggle', $output);
    }
}
