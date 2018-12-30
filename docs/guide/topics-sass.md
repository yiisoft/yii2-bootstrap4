Using the .sass files of Bootstrap directly
===========================================

If you want to include the [Bootstrap css directly in your sass files](http://getbootstrap.com/getting-started/#customizing)
you may need to disable the bootstrap css files loaded by this extension.
You can do this by setting the css property of [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] to be empty.
For this, you need to configure the `assetManager` [application component](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) as follows:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
