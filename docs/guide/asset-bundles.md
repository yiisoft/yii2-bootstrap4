Asset Bundles
=============

Bootstrap is a complex front-end solution, which includes CSS, JavaScript, fonts and so on.
In order to allow you most flexible control over Bootstrap components, this extension provides several asset bundles.
They are:

- [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] - contains only main CSS files.
- [[yii\bootstrap\BootstrapPluginAsset|BootstrapPluginAsset]] - depends on [[yii\bootstrap\BootstrapAsset]], contains javascript files.
- [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] - depends on [[yii\bootstrap\BootstrapAsset]], contains Bootstrap default theme CSS.

Particular application needs may require different bundle (or bundle combination) usage.
If you need only CSS styles, [[yii\bootstrap\BootstrapAsset]] will be enough for you. However, if
you want to use Bootstrap JavaScript, you need to register [[yii\bootstrap\BootstrapPluginAsset]].

> Tip: most of the widgets register [[yii\bootstrap\BootstrapPluginAsset]] automatically.
