<?php
namespace yiiunit\extensions\bootstrap;

use yii\bootstrap\ActiveForm;

/**
 * Tests for ActiveForm widget
 * 
 * @group bootstrap
 */
class ActiveFormTest extends TestCase
{

    protected function setUp()
    {
        // dirty way to have Request object not throwing exception when running testFormNoRoleAttribute()
        $_SERVER['REQUEST_URI'] = "index.php";

        parent::setUp();

    }

    /**
     * Fixes #196
     */
    public function testFormNoRoleAttribute()
    {
        $form = ActiveForm::widget();

        $this->assertNotContains('role="form"', $form);
    }
}
