Using the .sass files of Bootstrap directly
===========================================

If you want to include the [Bootstrap css directly in your less files](http://getbootstrap.com/getting-started/#customizing)
you may need to disable the original bootstrap css files to be loaded.
You can do this by setting the css property of the [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] to be empty.
For this you need to configure the `assetManager` [application component](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) as follows:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
