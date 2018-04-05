Html 助手
===========

Bootstrap 引入了许多一致的 HTML 结构和骨架，允许创建不同的视觉效果。
只有最复杂的部分由此扩展提供的小部件覆盖。 其余应使用直接 HTML 手动组合。
但是, 有些特殊的 Bootstrap 标签被 [[\yii\bootstrap4\Html]] 重载.
[[\yii\bootstrap4\Html]] 是基于 Bootstrap 的 [[\yii\helpers\Html]] 增强版.
它提供了很多实用的方法，例如:

 - `icon()` - 生成Glyphicon图标
 - `staticControl()` - 生成表单静态组件 "static controls"

[[\yii\bootstrap4\Html]] 继承了 [[\yii\helpers\Html]] 的所有功能，所以不需要在视图文件中同时引入这两个文件，如果需要，仅使用 [[\yii\bootstrap4\Html]] 即可.
例如:

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

> 注意: 不要混淆 [[\yii\bootstrap4\Html]] 和 [[\yii\helpers\Html]], 一定注意你在视图中引入和使用的类.