Asset-Konfiguration
===================

Diese Erweiterung beruht auf [Bower](https://bower.io/) und/oder [NPM](https://www.npmjs.org/) Packages für die Asset Installation.
Bevor Sie diese Erweiterung einsetzen, sollten Sie entscheiden, auf welche Weise Sie diese Packages installieren möchten.

## Verwendung des asset-packagist Repository

Sie können [asset-packagist.or](https://asset-packagist.org) als Package-Quelle für die Bootstrap-Assets angeben.
Fügen Sie dazu folgende Zeilen zur `composer.json`-Datei ihres Projekts hinzu:

```json
"repositories": [
    {
        "type": "composer",
        "url": "https://asset-packagist.org"
    }
]
```

Passen Sie `@npm` und `@bower` in der Konfiguration ihrer Applikation wie folgt an:

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


## Verwendung des composer asset Plugins

Installieren Sie das [composer asset plugin](https://github.com/francoispluchino/composer-asset-plugin/) global durch das Ausführen folgendes Befehls: 

```
composer global require "fxp/composer-asset-plugin:^1.4.0"
```

Fügen Sie folgende Zeilen zur `composer.json`-Datei ihres Projekts hinzu um das Verzeichnis der Installation von Assets anzupassen
falls Sie möchten, das Yii sie verwaltet:

```json
"extra": {
    "asset-installer-paths": {
        "npm-asset-library": "vendor/npm",
        "bower-asset-library": "vendor/bower"
    }
}
```

Daraufhin können Sie den composer install bzw. update Befehl ausführen um die Boostrap Assets zu installieren.

> Warnung: Das Plugin `fxp/composer-asset-plugin` verlangsamt den `composer update` Befehl signifikant verglichen zur 
  "asset-packagist"-Methode.

## Direkte Verwendung des Bower/NPM Clients

Sie kännen die Bootstrap Assets direkt via Bower oder NPM Client installieren.
Fügen Sie dafür folgende Zeilen zur `package.json`-Datei Ihres Projekts hinzu:

```json
{
    ...
    "dependencies": {
        "bootstrap": "4.2.1",
        ...
    }
    ...
}
```

Fügen Sie zur `composer.json`-Datei Ihres Projekts folgende Zeilen hinzu zum Verhindern von redundanten Bootstrap-Installationen:

```json
"replace": {
    "npm-asset/bootstrap": ">=4.2.1"
},
```

## Verwendung des CDN

Sie können die Bootstrap Assets vom [offiziellen CDN](https://www.bootstrapcdn.com) laden.

Fügen Sie zur `composer.json`-Datei Ihres Projekts folgende Zeilen hinzu zum Verhindern von redundanten Bootstrap-Installationen:

```json
"replace": {
    "npm-asset/bootstrap": ">=4.2.1"
},
```

Konfigurieren Sie die 'assetManager'-Komponente wie folgt (überschreibt die Bootstrap Asset mit den CDN Links):

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use CDN :
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://stackpath.bootstrapcdn.com/bootstrap/4.2.1',
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1',
                    'js' => [
                        'js/bootstrap.bundle.min.js'
                    ],
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```


## Kompilieren von den .sass Dateien

Falls Sie den Bootstrap Quelltext direkt anpassen möchten, können Sie das CSS direkt von den Quell *.sass-Dateien kompilieren.
In diesem Fall macht die Installation der Bootstrap Assets via composer bzw. Bower/NPM kein Sinn, da Sie keine Dateien innerhalb 
des 'vendor'-Verzeichnisses bearbeiten können.
Sie müssen die Bootstrap-Assets manuell herunterladen und sie irgendwo in Ihrem Projekt platzieren (z.B. 'assets/source/bootstrap').

Fügen Sie zur `composer.json`-Datei Ihres Projekts folgende Zeilen hinzu zum Verhindern von redundanten Bootstrap-Installationen:

```json
"replace": {
    "npm-asset/bootstrap": ">=4.2.1"
},
```

Konfigurieren Sie die 'assetManager'-Komponente wie folgt (überschreibt die Bootstrap Assets):

```php
return [
    'components' => [
        'assetManager' => [
            // override bundles to use local project files :
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'sourcePath' => '@app/assets/source/bootstrap/dist',
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ],
            ],
        ],
        // ...
    ],
    // ...
];
```

Nach dem Verändern des Bootstrap Quellcodes, stellen Sie sicher, dass sie neu [kompiliert werden](https://getbootstrap.com/docs/4.1/getting-started/build-tools/), z.B. mittels `npm run dist`. 
