Usando directamente los ficheros .less de Bootstrap
===================================================

Si deseas incluir el [css de Bootstrap directamente en tus ficheros less](http://getbootstrap.com/getting-started/#customizing) puedes necesitar deshabilitar los ficheros css de bootstrap originales para ser cargados.
Puedes hacer esto mediante la configuración de la propiedad css de [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] asignando
un array vacio.
Para esto necesitas configurar el `assetManager` [componente de aplicación](https://github.com/yiisoft/yii2/blob/master/docs/guide-es/structure-application-components.md) como se muestra a continuación:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
