Asset Bundles
=============

Bootstrap is a complex front-end solution, which includes CSS, JavaScript, fonts and so on.
In order to allow you the most flexible control over Bootstrap components, this extension provides several asset bundles.
They are:

- [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] - contains only the main CSS files.
- [[yii\bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - depends on [[yii\bootstrap4\BootstrapAsset]], contains the javascript files.
- [[yii\bootstrap4\BootstrapThemeAsset|BootstrapThemeAsset]] - depends on [[yii\bootstrap4\BootstrapAsset]], contains the Bootstrap default theme CSS.

Particular application needs may require different bundle (or bundle combination) usage.
If you need only CSS styles, [[yii\bootstrap4\BootstrapAsset]] will be enough for you. However, if
you want to use Bootstrap JavaScript, you need to register [[yii\bootstrap4\BootstrapPluginAsset]].

> Tip: most of the widgets register [[yii\bootstrap4\BootstrapPluginAsset]] automatically.
