Html helper
===========

Bootstrap introduces many consistent HTML constructions and skeletons, which allow creating different visual effects.
Only the most complex of them are covered by the widgets provided with this extension. The rest should be composed manually
using direct HTML composition.
However, several special Bootstrap markup cases are covered by [[\yii\bootstrap4\Html]] helper.
[[\yii\bootstrap4\Html]] is an enhanced version of the regular [[\yii\helpers\Html]] dedicated to the Bootstrap needs.
It provides several useful methods:

 - `icon()` - allows rendering of Glyphicon icons
 - `staticControl()` - allows rendering of form "static controls"

[[\yii\bootstrap4\Html]] inherits all functionality available at [[\yii\helpers\Html]] and can be used as a substitute,
so you don't need them both inside your view files.
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
