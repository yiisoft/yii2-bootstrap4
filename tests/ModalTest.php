<?php

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\Modal;

/**
 * @group bootstrap4
 */
class ModalTest extends TestCase
{
    public function testBodyOptions()
    {
        Modal::$counter = 0;
        $out = Modal::widget([
            'bodyOptions' => ['class' => 'modal-body test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<EXPECTED

<div id="w0" class="fade modal" role="dialog" tabindex="-1" aria-hidden="true">
<div class="modal-dialog ">
<div class="modal-content">

<div class="modal-body test" style="text-align:center;">

</div>

</div>
</div>
</div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
