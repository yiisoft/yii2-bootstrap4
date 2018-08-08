<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap4;

use yii\helpers\ArrayHelper;

/**
 * A Bootstrap 4 enhanced version of [[\yii\widgets\ActiveField]].
 *
 * This class adds some useful features to [[\yii\widgets\ActiveField|ActiveField]] to render all
 * sorts of Bootstrap 4 form fields in different form layouts:
 *
 * - [[inputTemplate]] is an optional template to render complex inputs, for example input groups
 * - [[horizontalCssClasses]] defines the CSS grid classes to add to label, wrapper, error and hint
 *   in horizontal forms
 * - [[inline]]/[[inline()]] is used to render inline [[checkboxList()]] and [[radioList()]]
 * - [[enableError]] can be set to `false` to disable to the error
 * - [[enableLabel]] can be set to `false` to disable to the label
 * - [[label()]] can be used with a `bool` argument to enable/disable the label
 *
 * There are also some new placeholders that you can use in the [[template]] configuration:
 *
 * - `{beginLabel}`: the opening label tag
 * - `{labelTitle}`: the label title for use with `{beginLabel}`/`{endLabel}`
 * - `{endLabel}`: the closing label tag
 * - `{beginWrapper}`: the opening wrapper tag
 * - `{endWrapper}`: the closing wrapper tag
 *
 * The wrapper tag is only used for some layouts and form elements.
 *
 * Note that some elements use slightly different defaults for [[template]] and other options.
 * You may want to override those predefined templates for checkboxes, radio buttons, checkboxLists
 * and radioLists in the [[\yii\widgets\ActiveForm::fieldConfig|fieldConfig]] of the
 * [[\yii\widgets\ActiveForm]]:
 *
 * - [[checkTemplate]] the default template for checkboxes and radios
 * - [[checkEnclosedTemplate]] the template for checkboxes and radios enclosed by label
 *
 * Example:
 *
 * ```php
 * use yii\bootstrap4\ActiveForm;
 *
 * $form = ActiveForm::begin(['layout' => 'horizontal']);
 *
 * // Form field without label
 * echo $form->field($model, 'demo', [
 *     'inputOptions' => [
 *         'placeholder' => $model->getAttributeLabel('demo'),
 *     ],
 * ])->label(false);
 *
 * // Inline radio list
 * echo $form->field($model, 'demo')->inline()->radioList($items);
 *
 * // Control sizing in horizontal mode
 * echo $form->field($model, 'demo', [
 *     'horizontalCssClasses' => [
 *         'wrapper' => 'col-sm-2',
 *     ]
 * ]);
 *
 * // With 'default' layout you would use 'template' to size a specific field:
 * echo $form->field($model, 'demo', [
 *     'template' => '{label} <div class="row"><div class="col-sm-4">{input}{error}{hint}</div></div>'
 * ]);
 *
 * // Input group
 * echo $form->field($model, 'demo', [
 *     'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
 * ]);
 *
 * ActiveForm::end();
 * ```
 *
 * @property-read \yii\bootstrap4\ActiveForm $form
 *
 * @see \yii\bootstrap4\ActiveForm
 * @see http://getbootstrap.com/css/#forms
 *
 * @author Michael Härtl <haertl.mike@gmail.com>
 * @author Simon Karlen <simi.albi@gmail.com>
 */
class ActiveField extends \yii\widgets\ActiveField
{
    /**
     * @var bool whether to render [[checkboxList()]] and [[radioList()]] inline.
     */
    public $inline = false;
    /**
     * @var string|null optional template to render the `{input}` placeholder content
     */
    public $inputTemplate;
    /**
     * @var array options for the wrapper tag, used in the `{beginWrapper}` placeholder
     */
    public $wrapperOptions = [];
    /**
     * {@inheritdoc}
     */
    public $options = ['class' => ['widget' => 'form-group']];
    /**
     * {@inheritdoc}
     */
    public $inputOptions = ['class' => ['widget' => 'form-control']];
    /**
     * {@inheritdoc}
     */
    public $errorOptions = ['class' => 'invalid-feedback'];
    /**
     * {@inheritdoc}
     */
    public $labelOptions = [];
    /**
     * {@inheritdoc}
     */
    public $hintOptions = ['class' => ['widget' => 'form-text', 'text-muted']];
    /**
     * @var null|array CSS grid classes for horizontal layout. This must be an array with these keys:
     *  - 'offset' the offset grid class to append to the wrapper if no label is rendered
     *  - 'label' the label grid class
     *  - 'wrapper' the wrapper grid class
     *  - 'error' the error grid class
     *  - 'hint' the hint grid class
     */
    public $horizontalCssClasses = [];
    /**
     * @var string the template for checkboxes and radios in default layout
     */
    public $checkTemplate = "<div class=\"form-check\">\n{input}\n{label}\n{error}\n{hint}\n</div>";
    /**
     * @var string the `enclosed by label` template for checkboxes and radios in default layout
     */
    public $checkEnclosedTemplate = "<div class=\"form-check\">\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{error}\n{hint}\n</div>";
    /**
     * @var bool whether to render the error. Default is `true` except for layout `inline`.
     */
    public $enableError = true;
    /**
     * @var bool whether to render the label. Default is `true`.
     */
    public $enableLabel = true;


    /**
     * {@inheritdoc}
     */
    public function __construct($config = [])
    {
        $layoutConfig = $this->createLayoutConfig($config);
        $config = ArrayHelper::merge($layoutConfig, $config);
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function render($content = null)
    {
        if ($content === null) {
            if (!isset($this->parts['{beginWrapper}'])) {
                $options = $this->wrapperOptions;
                $tag = ArrayHelper::remove($options, 'tag', 'div');
                $this->parts['{beginWrapper}'] = Html::beginTag($tag, $options);
                $this->parts['{endWrapper}'] = Html::endTag($tag);
            }
            if ($this->enableLabel === false) {
                $this->parts['{label}'] = '';
                $this->parts['{beginLabel}'] = '';
                $this->parts['{labelTitle}'] = '';
                $this->parts['{endLabel}'] = '';
            } elseif (!isset($this->parts['{beginLabel}'])) {
                $this->renderLabelParts();
            }
            if ($this->enableError === false) {
                $this->parts['{error}'] = '';
            }
            if ($this->inputTemplate) {
                $input = isset($this->parts['{input}'])
                    ? $this->parts['{input}']
                    : Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
                $this->parts['{input}'] = strtr($this->inputTemplate, ['{input}' => $input]);
            }
        }
        return parent::render($content);
    }

    /**
     * {@inheritdoc}
     */
    public function checkbox($options = [], $enclosedByLabel = false)
    {
        Html::removeCssClass($options, 'form-control');
        Html::addCssClass($options, 'form-check-input');
        Html::addCssClass($this->labelOptions, 'form-check-label');

        if (!isset($options['template'])) {
            $this->template = ($enclosedByLabel) ? $this->checkEnclosedTemplate : $this->checkTemplate;
        } else {
            $this->template = $options['template'];
            unset($options['template']);
        }
        if ($this->form->layout === 'horizontal') {
            Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
        }

        if ($enclosedByLabel) {
            if (isset($options['label'])) {
                $this->parts['{labelTitle}'] = $options['label'];
            }
        }

        return parent::checkbox($options, false);
    }

    /**
     * {@inheritdoc}
     */
    public function radio($options = [], $enclosedByLabel = false)
    {
        Html::removeCssClass($options, 'form-control');
        Html::addCssClass($options, 'form-check-input');
        Html::addCssClass($this->labelOptions, 'form-check-label');

        if (!isset($options['template'])) {
            $this->template = ($enclosedByLabel) ? $this->checkEnclosedTemplate : $this->checkTemplate;
        } else {
            $this->template = $options['template'];
            unset($options['template']);
        }
        if ($this->form->layout === 'horizontal') {
            Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
        }

        if ($enclosedByLabel) {
            if (isset($options['label'])) {
                $this->parts['{labelTitle}'] = $options['label'];
            }
        }

        return parent::radio($options, false);
    }

    /**
     * {@inheritdoc}
     */
    public function checkboxList($items, $options = [])
    {
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
        $encode = ArrayHelper::getValue($options, 'encode', true);
        $wrapperOptions = ['class' => ['form-check']];
        if ($this->inline) {
            Html::addCssClass($wrapperOptions, 'form-check-inline');
        }
        $options['item'] = function ($i, $label, $name, $checked, $value) use ($itemOptions, $encode, $wrapperOptions) {
            $options = array_merge([
                'class' => 'form-check-input',
                'label' => $encode ? Html::encode($label) : $label,
                'labelOptions' => ['class' => 'form-check-label'],
                'value' => $value
            ], $itemOptions);

            return
                Html::beginTag('div', $wrapperOptions) .
                Html::checkbox($name, $checked, $options) .
                Html::endTag('div');
        };

        parent::checkboxList($items, $options);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function radioList($items, $options = [])
    {
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
        $encode = ArrayHelper::getValue($options, 'encode', true);
        $wrapperOptions = ['class' => ['form-check']];
        if ($this->inline) {
            Html::addCssClass($wrapperOptions, 'form-check-inline');
        }
        $options['item'] = function ($i, $label, $name, $checked, $value) use ($itemOptions, $encode, $wrapperOptions) {
            $options = array_merge([
                'class' => 'form-check-input',
                'label' => $encode ? Html::encode($label) : $label,
                'labelOptions' => ['class' => 'form-check-label'],
                'value' => $value
            ], $itemOptions);

            return
                Html::beginTag('div', $wrapperOptions) .
                Html::radio($name, $checked, $options) .
                Html::endTag('div');
        };

        parent::radioList($items, $options);
        return $this;
    }

    /**
     * Renders Bootstrap static form control.
     * @param array $options the tag options in terms of name-value pairs. These will be rendered as
     * the attributes of the resulting tag. There are also a special options:
     *
     * - encode: bool, whether value should be HTML-encoded or not.
     *
     * @return $this the field object itself
     * @see https://getbootstrap.com/docs/4.1/components/forms/#readonly-plain-text
     */
    public function staticControl($options = [])
    {
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeStaticControl($this->model, $this->attribute, $options);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function label($label = null, $options = [])
    {
        if (is_bool($label)) {
            $this->enableLabel = $label;
            if ($label === false && $this->form->layout === 'horizontal') {
                Html::addCssClass($this->wrapperOptions, $this->horizontalCssClasses['offset']);
            }
        } else {
            $this->enableLabel = true;
            $this->renderLabelParts($label, $options);
            parent::label($label, $options);
        }
        return $this;
    }

    /**
     * @param bool $value whether to render a inline list
     * @return $this the field object itself
     * Make sure you call this method before [[checkboxList()]] or [[radioList()]] to have any effect.
     */
    public function inline($value = true)
    {
        $this->inline = (bool)$value;
        return $this;
    }

    /**
     * @param array $instanceConfig the configuration passed to this instance's constructor
     * @return array the layout specific default configuration for this instance
     */
    protected function createLayoutConfig($instanceConfig)
    {
        $config = [
            'hintOptions' => [
                'tag' => 'small',
                'class' => ['form-text', 'text-muted'],
            ],
            'errorOptions' => [
                'tag' => 'div',
                'class' => 'invalid-feedback',
            ],
            'inputOptions' => [
                'class' => 'form-control'
            ]
        ];

        $layout = $instanceConfig['form']->layout;

        if ($layout === 'horizontal') {
            $config['template'] = "{label}\n{beginWrapper}\n{input}\n{error}\n{hint}\n{endWrapper}";
            $config['wrapperOptions'] = [];
            $config['labelOptions'] = [];
            $config['options'] = [];
            $cssClasses = [
                'offset' => '',
                'label' => 'col-md-2 col-form-label',
                'wrapper' => 'col-md-10',
                'error' => '',
                'hint' => '',
                'field' => 'form-group row'
            ];
            if (isset($instanceConfig['horizontalCssClasses'])) {
                $cssClasses = ArrayHelper::merge($cssClasses, $instanceConfig['horizontalCssClasses']);
            }
            $config['horizontalCssClasses'] = $cssClasses;

            Html::addCssClass($config['wrapperOptions'], $cssClasses['wrapper']);
            Html::addCssClass($config['labelOptions'], $cssClasses['label']);
            Html::addCssClass($config['errorOptions'], $cssClasses['error']);
            Html::addCssClass($config['hintOptions'], $cssClasses['hint']);
            Html::addCssClass($config['options'], $cssClasses['field']);
        } elseif ($layout === 'inline') {
            Html::addCssClass($config['labelOptions'], 'sr-only');
            $config['enableError'] = false;
        }

        return $config;
    }

    /**
     * @param string|null $label the label or null to use model label
     * @param array $options the tag options
     */
    protected function renderLabelParts($label = null, $options = [])
    {
        $options = array_merge($this->labelOptions, $options);
        if ($label === null) {
            if (isset($options['label'])) {
                $label = $options['label'];
                unset($options['label']);
            } else {
                $attribute = Html::getAttributeName($this->attribute);
                $label = Html::encode($this->model->getAttributeLabel($attribute));
            }
        }
        if (!isset($options['for'])) {
            $options['for'] = Html::getInputId($this->model, $this->attribute);
        }
        $this->parts['{beginLabel}'] = Html::beginTag('label', $options);
        $this->parts['{endLabel}'] = Html::endTag('label');
        if (!isset($this->parts['{labelTitle}'])) {
            $this->parts['{labelTitle}'] = $label;
        }
    }
}
