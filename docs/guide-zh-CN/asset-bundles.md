资源包
=============

Bootstrap是一个复杂的前端解决方案，其中包括 CSS ， JavaScript ，字体等。
为了灵活的控制 Bootstrap 组件，此扩展提供了多个资源包。
如下:

- [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] - 只包含主要的 CSS 文件.
- [[yii\bootstrap\BootstrapPluginAsset|BootstrapPluginAsset]] - 包含 javascript 文件, 依赖于 [[yii\bootstrap\BootstrapAsset]] .
- [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] - 包含 Bootstrap 默认样式 CSS, 依赖于 [[yii\bootstrap\BootstrapAsset]].

特定的应用可能需要加载不同的资源包，（或者资源包组合）.
如果只需要 CSS 文件, 引入 [[yii\bootstrap\BootstrapAsset]] 即可. 但是, 如果需要使用 Bootstrap 的 JavaScript, 则需要引入 [[yii\bootstrap\BootstrapPluginAsset]].

> 提示：大多数小部件会自动注册到 [[yii\bootstrap\BootstrapPluginAsset]] 。