Класс-помощник Html
===================

Bootstrap предоставляет множество последовательных HTML конструкции и каркасов, которые позволяют создавать различные визуальные эффекты. Только самые сложные из них передставлены виджетами, поставляемые с данным расширением. Остальные должны быть собраны вручную, используя HTML напрямую. Тем не менее, несколько специальных Bootstrap разметок предоставляются в помощнике [[\yii\bootstrap4\Html]]. [[\yii\bootstrap4\Html]] является расширенной версией [[\yii\helpers\Html]], удовлетворяющей потребности Bootstrap. Он предоставляет несколько полезных методов:

 - `staticControl()` - позволяет отображать "статические элементы управления" формы

[[\yii\bootstrap4\Html]] наследует все функциональные возможности, доступные в [[\yii\helpers\Html]], и может быть использован в качестве замены в ваших представлениях. Например:

```php
<?php
use yii\bootstrap4\Html;
?>
<?= Button::widget([
    'label' => Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>
```

> Attention: не путайте [[\yii\bootstrap4\Html]] и [[\yii\helpers\Html]]! Следите за тем какой класс вы используете в своих представлениях.
