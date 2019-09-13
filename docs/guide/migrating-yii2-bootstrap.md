Migrating from yii2-bootstrap
=============================

yii2-bootstrap4 is a major rewrite of the entire project (according Bootstrap 4 to Bootstrap 3 migration guide).
The most notable changes are summarized below:

## General

* The namespace is `yii\bootstrap4` instead of `yii\bootstrap`
* `npm` package is used instead of `bower`
* There is no theme asset any more
* No `popper.js` is needed any more (gets delivered with bootstrap js bundle) 

## Widgets / Classes

* [[yii\bootstrap\Collapse|Collapse]] was renamed to [[yii\bootstrap4\Accordion|Accordion]]
* [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] was removed
* [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]] was added (Bootstrap 4 implementation of [[yii\widgets\Breadcrumbs]])
* [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]] was added (https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar)

### BaseHtml

Removed method `icon`. Since there are no glyphicons bundled any more, this method makes no sense. Consider using
[Font Awesome Widget](https://github.com/rmrevin/yii2-fontawesome) or 
[Font Awesome Inline Widget](https://github.com/Thoulah/yii2-fontawesome-inline) as alternative.

### ActiveField

Following properties were renamed:
* `$checkboxTemplate` became `$checkTemplate`,
* `$horizontalCheckboxTemplate` became `$checkHorizontalTemplate`,
* `$horizontalRadioTemplate` became `$radioHorizontalTemplate`

The properties `$inlineCheckboxListTemplate` and `$inlineRadioListTemplate` were removed. There is a new template called
`$checkEnclosedTemplate`. In bootstrap 4 the checkboxes are not enclosed any more (by default).

### ActiveForm

There are some new constants [[yii\bootstrap4\ActiveForm::LAYOUT_DEFAULT]], [[yii\bootstrap4\ActiveForm::LAYOUT_HORIZONTAL]]
and [[yii\bootstrap4\ActiveForm::LAYOUT_INLINE]]. They're supposed to make layout selection easier and refactoring more 
failsafe if the strings change at any time.

### Breadcrumbs

This class got introduced to render breadcrumbs with correct classes and attributes to fulfill bootstrap needs. It's 
fully compatible with [[yii\widgets\Breadcrumbs]]

### ButtonDropdown

There is a new property called `$direction` which makes it possible to open the menu at e.g. the right side of the button.
There are some new constants [[yii\bootstrap4\ButtonDropdown::DIRECTION_DOWN]], [[yii\bootstrap4\ButtonDropdown::DIRECTION_LEFT]], 
[[yii\bootstrap4\ButtonDropdown::DIRECTION_RIGHT]] and [[yii\bootstrap4\ButtonDropdown::DIRECTION_UP]] to make direction
selection easier.
There is a new property called `$renderContainer`. If it's set to `false`, the dropdown wrapping div will not be rendered.

Following properties were renamed:
* `$containerOptions` became `$options`,
* `$options` became `$buttonOptions`

### ButtonToolbar

This new class makes it possible to render a button toolbar. See https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar
for more information.

### Carousel

There is a new property called `$crossfade`. It controls the animation between slides. If it's set to `true`, there will
be an crossfade animation instead of a slide animation.

### LinkPager

This new class is the bootstrap version of [[yii\widgets\LinkPager]]. It renders a pagination in bootstrap style. See
https://getbootstrap.com/docs/4.3/components/pagination/ for more information.

### Modal


Following properties were renamed:
* `$header` became `$title`,
* `$headerOptions` became `$titleOptions`

It isn't necessary to write the `<h2 class="modal-title></h2>` any more. It will be rendered automatically.

### Nav

The `$dropdDownCaret` property was removed. This is only controllable via (S)CSS now. See 
https://getbootstrap.com/docs/4.3/getting-started/theming/#sass-options

### NavBar

Following properties were renamed:
* `$containerOptions` became `$collapseOptions`

Removed property `$headerContent`. There is no navbar header any more. The toggler is now customizable so the properties 
`$togglerContent` and `$togglerOptions` were introduced.

### Tabs

Introduces property `$panes`. It makes it possible to define pane contents via separate property instead of 
`$items[0]['content']`. The index of the panes array corresponds to the index of the items. E.g. `$items[0]` belongs
to `$panes[0]`.

### ToggleButtonGroup

There are some new constants [[yii\bootstrap4\ToggleButtonGroup::TYPE_CHECKBOX]] and
[[yii\bootstrap4\ToggleButtonGroup::TYPE_RADIO]] to make type selection easier and refactoring more failsafe if the
strings change at any time.
