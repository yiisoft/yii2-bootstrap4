直接使用Bootstrap的.less文件
=======================================

如果引入 [直接使用Bootstrap的.less文件](http://getbootstrap.com/getting-started/#customizing)
则需要禁用原始加载的 css 文件.
通过设置 [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] 的 css 属性为空即可.
为此，需要配置 `assetManager` [应用组件](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) 为如下:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```