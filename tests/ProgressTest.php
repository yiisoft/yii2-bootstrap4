<?php
namespace yiiunit\extensions\bootstrap4;


use yii\bootstrap4\Progress;

/**
 * @group bootstrap4
 */
class ProgressTest extends TestCase
{
    public function testRender()
    {
        Progress::$counter = 0;
        $out = Progress::widget([
            'bars' => [
                ['label' => 'Progress', 'percent' => 25]
            ]
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Progress</div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }

    /**
     * @depends testRender
     */
    public function testMultiple()
    {
        Progress::$counter = 0;
        $out = Progress::widget([
            'bars' => [
                ['label' => '', 'percent' => 15],
                ['label' => '', 'percent' => 30, 'options' => ['class' => ['bg-success']]],
                ['label' => '', 'percent' => 20, 'options' => ['class' => ['bg-info']]]
            ]
        ]);

        $expected = <<<HTML
<div id="w0" class="progress">
<div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"></div>
<div class="bg-success progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
<div class="bg-info progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div>
</div>
HTML;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
