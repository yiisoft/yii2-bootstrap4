<?php
namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\ButtonDropdown;

/**
 * @group bootstrap4
 */
class ButtonDropdownTest extends TestCase
{
    public function testContainerOptions()
    {
        $containerClass = 'testClass';

        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => 'up',
            'options' => [
                'class' => $containerClass,
            ],
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    ['label' => 'DropdownA', 'url' => '/'],
                    ['label' => 'DropdownB', 'url' => '#'],
                ],
            ],
        ]);

        $this->assertContains("$containerClass dropup btn-group", $out);
    }

    public function testDirection()
    {
        ButtonDropdown::$counter = 0;
        $out = ButtonDropdown::widget([
            'direction' => 'left',
            'label' => 'Action',
            'dropdown' => [
                'items' => [
                    ['label' => 'ItemA', 'url' => '#'],
                    ['label' => 'ItemB', 'url' => '#'],
                ],
            ],
        ]);

        $expected = <<<EXPECTED
<div id="w0" class="dropleft btn-group"><button id="w0-button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>

<div id="w1" class="dropdown-menu"><a class="dropdown-item" href="#">ItemA</a>
<a class="dropdown-item" href="#">ItemB</a></div></div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
