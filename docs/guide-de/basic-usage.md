Grundlegende Verwendung
=======================

Yii verpackt die Bootstrap Basics nicht in PHP Code, da dass HTML selbst sehr einfach aufgebaut ist. Sie finden mehr 
Informationen zur Verwendung der Basics unter [bootstrap documentation website](http://getbootstrap.com/css/). Yii bietet
aber eine einfache Methode zur Einbindung der Bootstrap Assets in Ihre Seite durch das Hinzufügen einer Zeile zu `AppAsset.ph`
im `@app/assets` Verzeichnis:

```php
public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset', // Diese Zeile
];
```

Die Verwendung von Bootstrap mittels des Yii Asset Manager erlaubt die Komprimierung und Kombinierung der Bootstrapressourcen
mit den Applikationsressourcen (falls nötig).
