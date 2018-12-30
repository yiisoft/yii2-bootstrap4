Html helper
===========

Bootstrap introduces many consistent HTML constructions and skeletons, which allow creating different visual effects.
Only the most complex of them are covered by the widgets provided with this extension. The rest should be composed manually
using direct HTML composition.
However, several special Bootstrap markup cases are covered by the [[\yii\bootstrap4\Html]] helper.
[[\yii\bootstrap4\Html]] is an enhanced version of the regular [[\yii\helpers\Html]] dedicated to the Bootstrap needs.
It provides some useful methods like:

 - `staticControl()` - allows rendering of form "[static controls](https://getbootstrap.com/docs/4.1/components/forms/#readonly-plain-text)"

As [[\yii\bootstrap4\Html]] extends [[\yii\helpers\Html]], it can be used as a substitute, so you don't need them both
inside your view files.

For example:

```php
<?php
use yii\bootstrap4\Html;
?>
<?= Button::widget([
    'label' => Html::icon('approve') . Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>
```

> Attention: do not confuse [[\yii\bootstrap4\Html]] and [[\yii\helpers\Html]], be careful of which class
  you are using inside your views.
