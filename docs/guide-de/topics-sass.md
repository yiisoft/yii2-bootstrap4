Direkte Verwendung der .sass Dateien von Bootstrap
==================================================

Falls Sie das [Bootstrap CSS direkt in Ihre SASS-Dateien integerieren](https://getbootstrap.com/docs/4.1/getting-started/theming/#sass)
möchten, müssen Sie unter Umständen das Laden der Orginal Bootstrap-CSS-Dateien verhindern.
Dies können Sie durch das Leeren des `css`-Property in der [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]]-Datei bewerkstelligen.
Konfigurieren Sie dazu die `assetManager`-[Komponente](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) wie folgt:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
