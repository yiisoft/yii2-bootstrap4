<?php

namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\Modal;

/**
 * @group bootstrap
 */
class ModalTest extends TestCase
{
    public function testBodyOptions()
    {
        $out = Modal::widget([
            'bodyOptions' => ['class' => 'modal-body test', 'style' => 'text-align:center;']
        ]);


        $expected = <<<EXPECTED

<div id="w1" class="fade modal" role="dialog" tabindex="-1">
<div class="modal-dialog ">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

</div>
<div class="modal-body test" style="text-align:center;">

</div>

</div>
</div>
</div>
EXPECTED;

        $this->assertEqualsWithoutLE($expected, $out);
    }
}
