Usando arquivos .less diretamente do Bootstrap
===========================================

Se você quiser incluir o [css do Bootstrap diretamente em seus arquivos less] (http://getbootstrap.com/getting-started/#customizing)
talvez você precise desativar os arquivos css do Bootstrap originais que são carregados.
Você pode fazer isso definindo a propriedade css do [[yii \ inicialização \ BootstrapAsset | BootstrapAsset]] e deixe estar vazio.
Para isso, você precisa configurar o `assetManager` [application component](https://github.com/yiisoft/yii2/blob/master/docs/guide/structure-application-components.md) 
do seguinte modo:

```php
    'assetManager' => [
        'bundles' => [
            'yii\bootstrap4\BootstrapAsset' => [
                'css' => [],
            ]
        ]
    ]
```
