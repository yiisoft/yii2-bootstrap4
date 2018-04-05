Uso Básico
===========

O Yii Não registra os componentes básicos do bootstrap em código PHP visto que esse HTML é muito simples, por si só. 
Você pode encontrar detalhes sobre como usar o básico no [site documentação do Bootstrap] (http://getbootstrap.com/css/). O Yii ainda fornece uma
forma conveniente para incluir assets de bootstrap em suas páginas com uma única linha adicionado ao arquivo `AppAsset.php` localizado no seu 
diretório `@app/assets`:

```php
public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap4\BootstrapAsset', // this line
];
```

Usando bootstrap através Yii assets lhe permite minimizar os seus recursos/fontes e combinar com seus próprios recursos/fontes quando
necessário.
