<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace yiiunit\extensions\bootstrap4;

use yii\bootstrap4\LinkPager;
use yii\data\Pagination;
use yii\helpers\ReplaceArrayValue;
use yii\helpers\StringHelper;

/**
 * @group bootstrap4
 */
class LinkPagerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->mockWebApplication([
            'components' => [
                'urlManager' => [
                    'scriptUrl' => '/',
                ],
            ],
        ]);
    }

    /**
     * Get pagination.
     * @param int $page
     * @return Pagination
     */
    private function getPagination($page)
    {
        $pagination = new Pagination();
        $pagination->setPage($page);
        $pagination->totalCount = 500;
        $pagination->route = 'test';
        return $pagination;
    }

    public function testFirstLastPageLabels()
    {
        $pagination = $this->getPagination(5);
        $output = LinkPager::widget([
            'pagination' => $pagination,
            'firstPageLabel' => true,
            'lastPageLabel' => true,
        ]);
        $this->assertStringContainsString('<li class="page-item first"><a class="page-link" href="/?r=test&amp;page=1" data-page="0">1</a></li>', $output);
        $this->assertStringContainsString('<li class="page-item last"><a class="page-link" href="/?r=test&amp;page=25" data-page="24">25</a></li>', $output);
        $output = LinkPager::widget([
            'pagination' => $pagination,
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
        ]);
        $this->assertStringContainsString('<li class="page-item first"><a class="page-link" href="/?r=test&amp;page=1" data-page="0">First</a></li>', $output);
        $this->assertStringContainsString('<li class="page-item last"><a class="page-link" href="/?r=test&amp;page=25" data-page="24">Last</a></li>', $output);
        $output = LinkPager::widget([
            'pagination' => $pagination,
            'firstPageLabel' => false,
            'lastPageLabel' => false,
        ]);
        $this->assertStringNotContainsString('<li class="page-item first">', $output);
        $this->assertStringNotContainsString('<li class="page-item last">', $output);
    }

    public function testDisabledPageElementOptions()
    {
        $output = LinkPager::widget([
            'pagination' => $this->getPagination(0),
            'disabledListItemSubTagOptions' => ['class' => ['foo-bar']],
        ]);
        $this->assertStringContainsString('<li class="page-item prev disabled"><a class="page-link foo-bar"', $output);
    }

    /**
     * @depends testDisabledPageElementOptions
     */
    public function testOverrideDisabledPageElementOptions()
    {
        $output = LinkPager::widget([
            'pagination' => $this->getPagination(0),
            'disabledListItemSubTagOptions' => ['class' => new ReplaceArrayValue(['foo-bar'])],
        ]);
        $this->assertStringContainsString('<li class="page-item prev disabled"><a class="foo-bar"', $output);
    }

    public function testDisableCurrentPageButton()
    {
        $pagination = $this->getPagination(5);
        $output = LinkPager::widget([
            'pagination' => $pagination,
            'disableCurrentPageButton' => false,
        ]);
        $this->assertStringContainsString('<li class="page-item active"><a class="page-link" href="/?r=test&amp;page=6" data-page="5">6</a></li>', $output);
        $output = LinkPager::widget([
            'pagination' => $pagination,
            'disableCurrentPageButton' => true,
        ]);
        $this->assertStringContainsString('<li class="page-item active disabled"><a class="page-link" href="/?r=test&amp;page=6" data-page="5" tabindex="-1">6</a></li>', $output);
    }

    public function testOptionsWithTagOption()
    {
        LinkPager::$counter = 0;
        $output = LinkPager::widget([
            'pagination' => $this->getPagination(5),
            'options' => [
                'tag' => 'div',
            ],
        ]);
        $this->assertTrue(StringHelper::startsWith($output, '<div id="w0">'));
        $this->assertTrue(StringHelper::endsWith($output, '</div>'));
    }

    public function testLinkWrapOptions()
    {
        $output = LinkPager::widget([
            'pagination' => $this->getPagination(1),
            'linkContainerOptions' => [
                'tag' => 'div',
                'class' => 'my-class',
            ],
        ]);
        $this->assertStringContainsString(
            '<div class="my-class"><a class="page-link" href="/?r=test&amp;page=3" data-page="2">3</a></div>',
            $output
        );
        $this->assertStringContainsString(
            '<div class="my-class active"><a class="page-link" href="/?r=test&amp;page=2" data-page="1">2</a></div>',
            $output
        );
    }

    /**
     * @see https://github.com/yiisoft/yii2/issues/15536
     */
    public function testShouldTriggerInitEvent()
    {
        $initTriggered = false;
        $output = LinkPager::widget([
            'pagination' => $this->getPagination(1),
            'on init' => function () use (&$initTriggered) {
                $initTriggered = true;
            }
        ]);
        $this->assertTrue($initTriggered);
    }
}
