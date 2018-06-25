Bootstrap の .sass ファイルを直接に使う
=======================================

あなたが [Bootstrap CSS をあなたの less ファイルに直接含める](http://getbootstrap.com/getting-started/#customizing) ことを望む場合は、
オリジナルの CSS ファイルがロードされないように無効化する必要があります。
[[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] の `css` プロパティを空に設定することによって、そうすることが出来ます。
そのためには、`assetManager` [アプリケーション・コンポーネント](https://github.com/yiisoft/yii2/blob/master/docs/guide-ja/structure-application-components.md) を以下のように構成します。

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
