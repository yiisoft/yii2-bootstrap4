<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap4;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

/**
 * Progress renders a bootstrap progress bar component.
 *
 * For example,
 *
 * ```php
 * // default with label
 * echo Progress::widget([
 *     'percent' => 60,
 *     'label' => 'test',
 * ]);
 *
 * // styled
 * echo Progress::widget([
 *     'percent' => 65,
 *     'options' => ['class' => 'progress-danger']
 * ]);
 *
 * // striped
 * echo Progress::widget([
 *     'percent' => 70,
 *     'options' => ['class' => 'progress-warning progress-striped']
 * ]);
 *
 * // striped animated
 * echo Progress::widget([
 *     'percent' => 70,
 *     'options' => ['class' => 'progress-success active progress-striped']
 * ]);
 *
 * // stacked bars
 * echo Progress::widget([
 *     'bars' => [
 *         ['percent' => 30, 'options' => ['class' => 'progress-danger']],
 *         ['percent' => 30, 'label' => 'test', 'options' => ['class' => 'progress-success']],
 *         ['percent' => 35, 'options' => ['class' => 'progress-warning']],
 *     ]
 * ]);
 * ```
 * @see https://getbootstrap.com/docs/4.1/components/progress/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @author Simon Karlen <simi.albi@gmail.com>
 */
class Progress extends Widget
{
    /**
     * @var string the button label.
     */
    public $label;
    /**
     * @var int the amount of progress as a percentage.
     */
    public $percent = 0;
    /**
     * @var array a set of bars that are stacked together to form a single progress bar.
     * Each bar is an array of the following structure:
     *
     * ```php
     * [
     *     // required, the amount of progress as a percentage.
     *     'percent' => 30,
     *     // optional, the label to be displayed on the bar
     *     'label' => '30%',
     *     // optional, array, additional HTML attributes for the bar tag
     *     'options' => [],
     * ]
     * ```
     */
    public $bars;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Html::addCssClass($this->options, ['widget' => 'progress']);
    }

    /**
     * {@inheritdoc}
     * @throws InvalidConfigException
     */
    public function run()
    {
        BootstrapAsset::register($this->getView());
        return $this->renderProgress();
    }

    /**
     * Renders the progress.
     * @return string the rendering result.
     * @throws InvalidConfigException if the "percent" option is not set in a stacked progress bar.
     */
    protected function renderProgress()
    {
        $out = Html::beginTag('div', $this->options);
        if (empty($this->bars)) {
            $this->bars = [
                ['label' => $this->label, 'percent' => $this->percent, 'options' => []]
            ];
        }
        $bars = [];
        foreach ($this->bars as $bar) {
            $label = ArrayHelper::getValue($bar, 'label', '');
            if (!isset($bar['percent'])) {
                throw new InvalidConfigException("The 'percent' option is required.");
            }
            $options = ArrayHelper::getValue($bar, 'options', []);
            $bars[] = $this->renderBar($bar['percent'], $label, $options);
        }
        $out .= implode("\n", $bars);
        $out .= Html::endTag('div');

        return $out;
    }

    /**
     * Generates a bar
     * @param int $percent the percentage of the bar
     * @param string $label , optional, the label to display at the bar
     * @param array $options the HTML attributes of the bar
     * @return string the rendering result.
     */
    protected function renderBar($percent, $label = '', $options = [])
    {
        $options = array_merge($options, [
            'role' => 'progressbar',
            'aria-valuenow' => $percent,
            'aria-valuemin' => 0,
            'aria-valuemax' => 100
        ]);
        Html::addCssClass($options, ['widget' => 'progress-bar']);
        Html::addCssStyle($options, ['width' => \Yii::$app->formatter->asPercent($percent / 100)], true);

        return Html::tag('div', $label, $options);;
    }
}
