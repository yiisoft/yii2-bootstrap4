Asset Bundles
=============

Bootstrap ist eine komplexe Front-End-Lösung, welche CSS, Javascript, Schriften usw. beinhaltet.
Um Ihnen die flexibelste Kontrolle über die einzelnen Komponenten zu ermöglichen enthält diese Erweiterung verschiedene Asset Bundles.

Das sind:
- [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] - enthält nur das hauptsächliche CSS.
- [[yii\bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - enthält das Javascript. Abhängig von [[yii\bootstrap4\BootstrapAsset]].

Verschiedene Anwendunganforderungen erfordern verschiedene Bundles (bzw. Kombinationen).
Falls Sie nur auf das CSS angewiesen sind, reicht es wenn Sie [[yii\bootstrap4\BootstrapAsset]] laden.
Wenn Sie das Javascript verwenden möchten, müssen Sie [[yii\bootstrap4\BootstrapPluginAsset]] auch laden.

> Tipp: Die meisten Widgets laden [[yii\bootstrap4\BootstrapPluginAsset]] automatisch.
