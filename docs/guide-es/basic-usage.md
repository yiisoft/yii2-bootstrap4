Uso Básico
==========

Yii no se ajusta a los conceptos básicos de bootstrap dentro del código PHP, desde el HTML es muy simple en si mismo
en este caso. Puedes encontrar los detalles sobre el uso de los conceptos básicos en la [web de bootstrap](http://getbootstrap.com/css/). Yii proporciona una manera de incluir los assets de bootstrap en tus páginas añadiendo una única linea a `AppAsset.php` localizado en tu
directorio `@app/assets`:

```php
public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset', // esta linea
];
```

Usando bootstrap a través de Yii asset manager permite que minimices los recursos y combinarlos con tus propios recursos
cuando lo necesites.
