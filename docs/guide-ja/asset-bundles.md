アセットバンドル
================

Bootstrap は、CSS、JavaScript、フォントなどを含む複雑なフロントエンドソリューションです。
Bootstrap コンポーネントに対する最大限の柔軟な制御を可能にするために、このエクステンションはアセットバンドルをいくつかに分けて提供しています。
すなわち、

- [[yii\bootstrap\BootstrapAsset|BootstrapAsset]] - メインの CSS ファイルのみを含みます。
- [[yii\bootstrap\BootstrapPluginAsset|BootstrapPluginAsset]] - [[yii\bootstrap\BootstrapAsset]] に依存し、javascript ファイルを含みます。
- [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] - [[yii\bootstrap\BootstrapAsset]] に依存し、Bootstrap のデフォルトテーマの CSS を含みます。

個々のアプリケーションは、その要求に応じて、異なるバンドル (またはバンドルの組み合わせ) を必要とするでしょう。
CSS のスタイルだけが必要なのであれば、[[yii\bootstrap\BootstrapAsset]] だけで十分です。
しかし、Bootstrap の JavaScript を必要とする場合は、[[yii\bootstrap\BootstrapPluginAsset]] を登録しなければなりません。

> Tip: ほとんどのウィジェットは [[yii\bootstrap\BootstrapPluginAsset]] を自動的に登録します。
