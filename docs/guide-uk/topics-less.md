Використання .less файлів в Bootstrap
=====================================

Якщо ви хочете включити [CSS Bootstrap напряму до ваших less файлів](http://getbootstrap.com/getting-started/#customizing)
вам необхідно відключити завантаження оригінальних css файлів bootstrap.
Ви можете зробити це, встановивши CSS властивість [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] порожньою.
Для цього вам необхідно налаштувати [компонент додатка](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md)
`assetManager` наступним чином:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
