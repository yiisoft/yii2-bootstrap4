Использование .less файлов Bootstrap напрямую
===========================================

Если вы хотите включить [Bootstrap CSS непосредственно в ваши less файлы](http://getbootstrap.com/getting-started/#customizing), вам может понадобится отключить исходные css bootstrap файлы из загрузки. Вы можете сделать это установив [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] свойство пустым. Для этого вам необходимо настроить [компонент приложения](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) `assetManager` следующим образом:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
