Yii widgets
===========

Die komplexesten Bootstrap Komponenten sind umgesetzt mittels Yii-Widget zur vereinfachten Verwendung und Integration 
von Framework-Funktionen. Alle Widgets gehören zum `\yii\bootstrap4` Namespace:

- [[yii\bootstrap4\Accordion|Accordion]]
- [[yii\bootstrap4\ActiveField|ActiveField]]
- [[yii\bootstrap4\ActiveForm|ActiveForm]]
- [[yii\bootstrap4\Alert|Alert]]
- [[yii\bootstrap4\Button|Button]]
- [[yii\bootstrap4\ButtonDropdown|ButtonDropdown]]
- [[yii\bootstrap4\ButtonGroup|ButtonGroup]]
- [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]]
- [[yii\bootstrap4\Carousel|Carousel]]
- [[yii\bootstrap4\Collapse|Collapse]] *deprecated* (siehe [[yii\bootstrap4\Accordion|Accordion]])
- [[yii\bootstrap4\Dropdown|Dropdown]]
- [[yii\bootstrap4\Modal|Modal]]
- [[yii\bootstrap4\Nav|Nav]]
- [[yii\bootstrap4\NavBar|NavBar]]
- [[yii\bootstrap4\Progress|Progress]]
- [[yii\bootstrap4\Tabs|Tabs]]
- [[yii\bootstrap4\ToggleButtonGroup|ToggleButtonGroup]]


## Anpassen der Widget CSS-Klassen <span id="customizing-css-classes"></span>

Die Widgets erlauben die schnelle Erstellung von HTML-Markup der Bootstrap Komponenten.
Die Standard-CSS-Klassen einer bestimmten Komponente wird automatisch vom Widget hinzugefügt. Alle weiteren (optionalen)
Klassen können Sie mittels der Attribute des Widgets anpassen.

Verwenden Sie z.B. [[yii\bootstrap4\Button::options]] zur Anpassung des Aussehens des Buttons. Die Klasse `btn`, welche
benötigt vom Button Widget benötigt wird, wird automatisch hinzugefügt. Sie müssen lediglich die besondere Button-Klasse
hinzufügen:

```php
echo Button::widget([
    'label' => 'Action',
    'options' => ['class' => 'btn-primary'], // produces class "btn btn-primary"
]);
```

Manchmal möchte man aber die Standard-Klasse ersetzen.
Das [[yii\bootstrap4\ButtonGroup]]-Widget beispielsweise verwendet standardmässig die 'btn-group' Klasse für den Container,
es müsste aber 'btn-group-vertical' erhalten zur vertikalen Ausrichtung.
Würden Sie wie oben nur die 'class'-Option verwenden, würde die 'btn-group-vertical'-Klasse zur 'btn-group'-Klasse hinzugefügt.
Zum Überschreiben der Standard-Klassen eines Widgets, müssen Sie die 'class'-Option unter dem Array-Schlüssel 'widget' angeben:

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
