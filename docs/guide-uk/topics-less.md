Використання .less файлів в Bootstrap
=====================================

Якщо ви хочете включити [CSS Bootstrap напряму до ваших less файлів](http://getbootstrap.com/getting-started/#customizing)
вам необхідно відключити завантаження оригінальних bootstrap css файлів.
Ви можете зробити це, встановивши CSS властивість [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] порожньою.
Для цього вам необхідно налаштувати [компонент додатка](structure-application-components.md) `assetManager` наступним чином:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```