<?php

namespace yiiunit\extensions\bootstrap4;

use Yii;
use yii\base\Action;
use yii\base\Module;
use yii\di\Container;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * This is the base class for all yii framework unit tests.
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockWebApplication();
    }

    /**
     * Clean up after test.
     * By default the application created with [[mockApplication]] will be destroyed.
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->destroyApplication();
    }

    /**
     * @param array $config
     * @param string $appClass
     */
    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => dirname(__DIR__) . '/vendor',
            'aliases' => [
                '@bower' => '@vendor/bower-asset',
                '@npm' => '@vendor/npm-asset',
            ],
            'components' => [
                'request' => [
                    'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
                    'scriptFile' => __DIR__ . '/index.php',
                    'scriptUrl' => '/index.php',
                ],
            ]
        ], $config));
    }

    /**
     * Mocks controller action with parameters
     *
     * @param string $controllerId
     * @param string $actionID
     * @param string $moduleID
     * @param array $params
     */
    protected function mockAction($controllerId, $actionID, $moduleID = null, $params = [])
    {
        Yii::$app->controller = $controller = new Controller($controllerId, Yii::$app);
        $controller->actionParams = $params;
        $controller->action = new Action($actionID, $controller);

        if ($moduleID !== null) {
            $controller->module = new Module($moduleID);
        }
    }

    /**
     * Removes controller
     */
    protected function removeMockedAction()
    {
        Yii::$app->controller = null;
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        Yii::$app = null;
        Yii::$container = new Container();
    }

    /**
     * Asserting two strings equality ignoring line endings
     *
     * @param string $expected
     * @param string $actual
     */
    public function assertEqualsWithoutLE($expected, $actual): void
    {
        $expected = str_replace("\r\n", "\n", $expected);
        $actual = str_replace("\r\n", "\n", $actual);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Asserting two strings equality ignoring line endings
     *
     * @param string $needle
     * @param string $haystack
     */
    public function assertContainsWithoutLE($needle, $haystack): void
    {
        $needle = str_replace("\r\n", "\n", $needle);
        $haystack = str_replace("\r\n", "\n", $haystack);

        $this->assertStringContainsString($needle, $haystack);
    }
}
