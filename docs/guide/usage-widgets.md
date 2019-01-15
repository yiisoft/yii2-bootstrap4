Yii widgets
===========

Most complex bootstrap components are wrapped into Yii widgets to allow more robust syntax and integrate with
framework features. All widgets belong to `\yii\bootstrap4` namespace:

- [[yii\bootstrap4\Accordion|Accordion]]
- [[yii\bootstrap4\ActiveField|ActiveField]]
- [[yii\bootstrap4\ActiveForm|ActiveForm]]
- [[yii\bootstrap4\Alert|Alert]]
- [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]]
- [[yii\bootstrap4\Button|Button]]
- [[yii\bootstrap4\ButtonDropdown|ButtonDropdown]]
- [[yii\bootstrap4\ButtonGroup|ButtonGroup]]
- [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]]
- [[yii\bootstrap4\Carousel|Carousel]]
- [[yii\bootstrap4\Dropdown|Dropdown]]
- [[yii\bootstrap4\Modal|Modal]]
- [[yii\bootstrap4\Nav|Nav]]
- [[yii\bootstrap4\NavBar|NavBar]]
- [[yii\bootstrap4\Progress|Progress]]
- [[yii\bootstrap4\Tabs|Tabs]]
- [[yii\bootstrap4\ToggleButtonGroup|ToggleButtonGroup]]


## Customizing widget CSS classes <span id="customizing-css-classes"></span>

The widgets allow quick composition of the HTML for the bootstrap components that require the bootstrap CSS classes.
The default classes for a particular component will be added automatically by the widget, and the optional classes that you may want to customize are usually supported through the properties of the widget.

For example, you may use [[yii\bootstrap4\Button::options]] to customize the appearance of a button.
The class 'btn' which is required for a button will be added automatically, so you don't need to worry about it.
All you need is specify a particular button class:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

However, sometimes you may need to replace the default classes with the alternative ones.
For example, the widget [[yii\bootstrap4\ButtonGroup]] uses 'btn-group' class for the container div by default,
but you may need to use 'btn-group-vertical' instead to align the buttons vertically.
Using a plain 'class' option simply adds 'btn-group-vertical' to 'btn-group', which will produce an incorrect result.
In order to override the default classes of a widget, you need to specify the 'class' option as an array that contains the customized class definition under the 'widget' key:

```php
echo ButtonGroup::widget([
    'options' => [
        'class' => ['widget' => 'btn-group-vertical'] // replaces 'btn-group' with 'btn-group-vertical'
    ],
    'buttons' => [
        ['label' => 'A'],
        ['label' => 'B'],
    ]
]);
```

## Navbar widget <span id="navbar-widget"></span>

The navbar widget has its peculiarities. You should define at which breakpoint the navbar collapses and the generic
style of navbar (color scheme).

You can change the color scheme and the collapse breakpoint with css classes. If not defined, the scheme defaults to 
`navbar-light bg-light` and the breakpoint to `navbar-expand-lg`. For more information, see [Bootstrap documentation](https://getbootstrap.com/docs/4.2/components/navbar/):
```php
Navbar::begin([
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]);
    [...]
Navbar::end();
``` 

If you'd like to flip the brand (icon) and toggle button positions in mobile navigation, you can do this like this:
```php
Navbar::begin([
	'brandOptions' => [
		'class' => ['order-1']
	],
	'togglerOptions' => [
		'class' => ['order-0']
	]
]);
    [...]
Navbar::end();
```
