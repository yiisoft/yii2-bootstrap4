基本的な使用方法
================

Yii は bootstrap の基礎を PHP コードでラップすることをしていません。なぜなら、この場合の HTML コードがそれ自体として非常にシンプルだからです。
bootstrap の基礎を使用することに関する詳細は、[bootstrap ドキュメント・ウェブ・サイト](http://getbootstrap.com/css/) で見ることが出来ます。
それでも、Yii はあなたのページに bootstrap のアセットをインクルードするための便利な方法を提供しています。
`@app/assets` ディレクトリに配置されている `AppAsset.php` に一行を加えるだけで大丈夫です。

```php
public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset', // この行です
];
```

Yii のアセットマネージャによって bootstrap を使うと、必要に応じて、bootstrap のリソースを最小化したり、
あなた自身のリソースと結合したりすることが出来ます。
