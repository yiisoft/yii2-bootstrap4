使用
===========

Yii不会将 bootstrap 合并到PHP代码中，因为HTML本身是非常简单的。猛击 [bootstrap 文档页](http://getbootstrap.com/css/) 查看如何使用 bootstrap. 但是 Yii 还是提供了在框架中更为方便的管理和使用 bootstrap的方式，在 `@app/assets` 路径下的 `AppAsset.php` 文件中，添加如下代码即可：

```php
public $depends = [
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset', // this line
];
```

通过 Yii 的资源管理器（asset manager）引入 bootstrap ，可最小化的引入 bootstrap 并在需要时合并自定义资源文件一起使用。