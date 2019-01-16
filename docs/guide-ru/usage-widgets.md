Виджеты Yii
===========

Большинство сложных Bootstrap компонентов обернуты в виджеты Yii, чтобы обеспечить более надежный синтаксис и интеграцию с особенностями фреймворка. Все виджеты относятся к пространству имен `\yii\bootstrap4`:

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


## Настройка CSS классов виджетов <span id="customizing-css-classes"></span>

Виджеты позволяют быстро создавать HTML Bootstrap компоненты, которые требуют CSS классы Bootstrap. Классы по умолчанию, для конкретного компонента, будут добавлены автоматически виджетом, и необязательные классы, которые вы можете настроить, как правило, поддерживаются через свойства виджета.

Например, вы можете использовать [[yii\bootstrap4\Button::options]] чтобы настроить внешний вид кнопки. Класс `btn`, который требуется для кнопки, будет добавлен автоматически. Все, что вам нужно, это указать конкретный класс кнопки:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // создаст класс "btn btn-primary"
]);
```

Тем не менее, иногда вам может понадобиться заменить классы по умолчанию альтернативными. Например, виджет [[yii\bootstrap4\ButtonGroup]] использует класс `btn-group` для контейнера `div` по умолчанию, но вам, возможно, придётся использовать `btn-group-vertical` чтобы выровнять кнопки по вертикали. Добавление `btn-group-vertical` в параметр `class` приведет к неправильному результату. Для того, чтобы переопределить классы виджета по умолчанию, необходимо указать параметр `class` как массив, содержащий определение класса, настроенное в ключе `widget`:

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
