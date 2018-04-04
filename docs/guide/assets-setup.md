Assets Setup
============

This extensions relies on [Bower](http://bower.io/) and/or [NPM](https://www.npmjs.org/) packages for the asset installation.
Before using this package you should decide in which way you will install those packages in your project.


## Using asset-packagist repository

You can setup [asset-packagist.org](https://asset-packagist.org) as package source for the Bootstrap assets.

In the `composer.json` of your project, add the following lines:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Adjust `@npm` and `@bower` in you application configuration:

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


## Using composer asset plugin

Install [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) globally, using following command:

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Add the following lines to `composer.json` of your project to adjust directories where the installed packages
will be placed, if you want to publish them using Yii:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

Then you can run composer install/update command to pick up Bootstrap assets.

> Note: `fxp/composer-asset-plugin` significantly slows down the `composer update` command in comparison
  to asset-packagist.


## Using Bower/NPM client directly

You can install Bootstrap assets directly via Bower or NPM client.
In the `package.json` of your project, add the following lines:

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

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```


## Using CDN

You may use Bootstrap assets from [official CDN](https://www.bootstrapcdn.com).

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```

Configure 'assetManager' application component, overriding Bootstrap assent bundles with CDN links:

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use CDN :
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


## Compiling from the .less files

If you want to customize the Bootstrap CSS source directly, you may want to compile it from source *.less files.
In such case installing Bootstrap assets from Composer or Bower/NPM makes no sense, since you can not modify files
inside 'vendor' directory.
You'll have to downloaded Bootstrap assets manually and place them somewhere inside you project source code,
for example at 'assets/source/bootstrap' folder.

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```

Configure 'assetManager' application component, overriding Bootstrap assent bundles and specifying compiler for CSS files:

```php
return [
    'components' => [
        'assetManager' => [
            // setup asset converter for *.less files :
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', 'lessc {from} {to} --no-color'],
                ],
            ],
            // override bundles to use local project files :
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


## Compiling from the .sass files

If you want to customize the Bootstrap CSS source directly, you may want to compile it from source *.sass files.
These can be obtained from [Bootstrap ported from Less to Sass](https://github.com/twbs/bootstrap-sass).

In such case installing Bootstrap assets from Composer or Bower/NPM makes no sense, since you can not modify files
inside 'vendor' directory.
You'll have to downloaded Bootstrap assets manually and place them somewhere inside you project source code,
for example at 'assets/source/bootstrap' folder.

In the `composer.json` of your project, add the following lines in order to prevent redundant Bootstrap asset installation:

```json
"replace": {
    "bower-asset/bootstrap": ">=3.3.0"
},
```

Configure 'assetManager' application component, overriding Bootstrap assent bundles and specifying compiler for CSS files:

```php
return [
    'components' => [
        'assetManager' => [
            // setup asset converter for *.sass files :
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'scss' => ['css', 'sass {from} {to} --sourcemap']
                ],
            ],
            // override bundles to use local project files :
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
