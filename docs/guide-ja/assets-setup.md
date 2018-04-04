アセットのセットアップ
======================

このパッケージは、アセットのインストールについて、[Bower](http://bower.io/) および/または [NPM](https://www.npmjs.org/) のパッケージに依存しています。
このパッケージを使う前に、これらのパッケージをあなたのプロジェクトにインストールする方法を決定しなければなりません。


## asset-packagist レポジトリを使う

[asset-packagist.org](https://asset-packagist.org) を Bootstrap アセットのソース・パッケージとしてセットアップすることが出来ます。

あなたのプロジェクトの `composer.json` に下記の行を追加して下さい。

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

そして、アプリケーション構成で `@npm` と `@bower` を設定します。

```php
return [
    //...
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //...
];
```


## composer アセット・プラグインを使う

次のコマンドを使って [composer アセット・プラグイン](https://github.com/francoispluchino/composer-asset-plugin/) をグローバルにインストールします。

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Yii を使ってアセットを発行したい場合は、あなたのプロジェクトの `composer.json` に下記の行を追加して、インストールされるパッケージが置かれるディレクトリを設定します。

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

これで、`composer install/update` コマンドを実行すると、Bootstrap のアセットを取得することが可能になります。

> Note: `fxp/composer-asset-plugin` は asset-packagist に比べると、`composer update` コマンドを著しく遅くさせます。


## Bower/NPM クライアントを直接に使う

Bower または NPM のクライアントを直接に使って Bootstrap のアセットをインストールすることが出来ます。
あなたのプロジェクトの `package.json` に次の行を追加して下さい。

```json
{
    ...
    "dependencies": {
        "bootstrap": "3.3.5",
        ...
    }
    ...
}
```

あなたのプロジェクトの `package.json` に次の行を追加して、Bootstrap アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```


## CDN を使う

[公式 CDN](https://www.bootstrapcdn.com) から Bootstrap アセットを使うことが出来ます。.

あなたのプロジェクトの `package.json` に次の行を追加して、Bootstrap アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```

'assetManager' アプリケーション・コンポーネントを構成して、Bootstrap アセット・バンドルを CDN のリンクでオーバーライドします。

```php
return [
    'components' => [
        'assetManager' => [
            // バンドルをオーバーライドして CDN を使う
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7',
                    'js' => [
                        'js/bootstrap.min.js'
                    ],
                ],
                'yii\bootstrap\BootstrapThemeAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7',
                    'css' => [
                        'css/bootstrap-theme.min.css'
                    ]
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```


## .less ファイルからコンパイルする

Bootstrap CSS ソースを直接にカスタマイズしたい場合、*.less ファイルから CSS をコンパイルしたいと思うことがあるでしょう。
そのような場合は、Bootstrap アセットを Composer や Bower/NPM からインストールすることは合理的ではありません。
なぜなら、`vendor` ディレクトリ内のファイルは変更できないからです。
Bootstrap アセットを手作業でダウンロードし、プロジェクト・ソース・コード内のどこか、例えば `assets/source/bootstrap` フォルダに置かなければなりません。

あなたのプロジェクトの `package.json` に次の行を追加して、Bootstrap アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```

'assetManager' アプリケーション・コンポーネントを構成して、Bootstrap アセット・バンドルをオーバーライドし、CSS ファイルのためのコンパイラを指定します。

```php
return [
    'components' => [
        'assetManager' => [
            // *.less ファイルのためのアセット・コンバータを設定する
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color'],
                ],
            ],
            // バンドルをオーバーライドし、ローカル・プロジェクト・ファイルを使う
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                    'css' => [
                        'css/bootstrap.less'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
                'yii\bootstrap\BootstrapThemeAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```


## .sass ファイルからコンパイルする

Bootstrap CSS ソースを直接にカスタマイズしたい場合、*.sass ファイルから CSS をコンパイルしたいと思うことがあるでしょう。
そのための *.sass ファイルは [Bootstrap ported from Less to Sass](https://github.com/twbs/bootstrap-sass) から得ることが出来ます。

そのような場合は、Bootstrap アセットを Composer や Bower/NPM からインストールすることは合理的ではありません。
なぜなら、`vendor` ディレクトリ内のファイルは変更できないからです。
Bootstrap アセットを手作業でダウンロードし、プロジェクト・ソース・コード内のどこか、例えば `assets/source/bootstrap` フォルダに置かなければなりません。

あなたのプロジェクトの `package.json` に次の行を追加して、Bootstrap アセットの冗長なインストールを防止します。

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```
'assetManager' アプリケーション・コンポーネントを構成して、Bootstrap アセット・バンドルをオーバーライドし、CSS ファイルのためのコンパイラを指定します。

```php
return [
    'components' => [
        'assetManager' => [
            // *.sass ファイルのためのアセット・コンバータを設定する
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'scss' => ['css', 'sass {from} {to} --sourcemap']
                ],
            ],
            // バンドルをオーバーライドし、ローカル・プロジェクト・ファイルを使う
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                    'css' => [
                        'css/bootstrap.scss'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
                'yii\bootstrap\BootstrapThemeAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap',
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```
