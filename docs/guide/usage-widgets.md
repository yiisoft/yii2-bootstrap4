Yii widgets
===========

Most complex bootstrap components are wrapped into Yii widgets to allow more robust syntax and integrate with
framework features. All widgets belong to `\yii\bootstrap` namespace:

- [[yii\bootstrap\ActiveForm|ActiveForm]]
- [[yii\bootstrap\Alert|Alert]]
- [[yii\bootstrap\Button|Button]]
- [[yii\bootstrap\ButtonDropdown|ButtonDropdown]]
- [[yii\bootstrap\ButtonGroup|ButtonGroup]]
- [[yii\bootstrap\Carousel|Carousel]]
- [[yii\bootstrap\Collapse|Collapse]]
- [[yii\bootstrap\Dropdown|Dropdown]]
- [[yii\bootstrap\Modal|Modal]]
- [[yii\bootstrap\Nav|Nav]]
- [[yii\bootstrap\NavBar|NavBar]]
- [[yii\bootstrap\Progress|Progress]]
- [[yii\bootstrap\Tabs|Tabs]]


## Customize widget CSS classes <span id="widgets-customize-css-classes"></span>

Widgets allow quick composition of the HTML for particular Bootstrap components, which requires usage of the
Bootstrap CSS classes. Those classes are added automatically by the widgets. However usually widget provides
fields or properties, which allow customization of the CSS styles for particular HTML tags.

For example: you may use [[yii\bootstrap\Button::options]] to customize appearance of the rendered button.
Class 'btn' will be added automatically, so you don't need to worry about it. All you need is specify particular
button class:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

However, sometimes you may need to replace standard class, added by the widget, with alternative one.
For example: widget [[yii\bootstrap\ButtonGroup]] uses 'btn-group' class for the container div, but you may
need to use 'btn-group-vertical', which allows vertical-style layout for the buttons. Using plain 'class' option
simply adds 'btn-group-vertical' to 'btn-group', which produces incorrect result.
In order to actually replace class added by widget, you need to specify 'class' option as array, containing
needed class name under the 'widget' key:

```php
echo ButtonGroup::widget([
    'options' => [
        'class' => ['widget' => 'btn-group-vertical'] // replace 'btn-group' with 'btn-group-vertical'
    ],
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
    ]
]);
```
