Виджеты Yii
===========

Большинство сложных Bootstrap компонентов обернуты в виджеты Yii, чтобы обеспечить более надежный синтаксис и интеграцию с особенностями фреймворка. Все виджеты относятся к пространству имен `\yii\bootstrap`:

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


## Настройка CSS классов виджетов <span id="customizing-css-classes"></span>

Виджеты позволяют быстро создавать HTML Bootstrap компоненты, которые требуют CSS классы Bootstrap. Классы по умолчанию, для конкретного компонента, будут добавлены автоматически виджетом, и необязательные классы, которые вы можете настроить, как правило, поддерживаются через свойства виджета.

Например, вы можете использовать [[yii\bootstrap\Button::options]] чтобы настроить внешний вид кнопки. Класс `btn`, который требуется для кнопки, будет добавлен автоматически чтобы вы не беспокоились об этом. Все, что вам нужно, это указать конкретный класс кнопки:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // создаст класс "btn btn-primary"
]);
```

Тем не менее, иногда вам может понадобиться заменить классы по умолчанию альтернативными. Например, виджет [[yii\bootstrap\ButtonGroup]] использует класс `btn-group` для контейнера `div` по умолчанию, но вам, возможно, прийдется использовать `btn-group-vertical` чтобы выровнять кнопки по вертикали.
С помощью опции `class` просто добавить `btn-group-vertical` к `btn-group`, которая даст не правильный результат. Для того, чтобы переопределить классы виджета по умолчанию, необходимо указать параметр `class` как массив, содержащий определение класса настроенное в ключе `widget`:

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
