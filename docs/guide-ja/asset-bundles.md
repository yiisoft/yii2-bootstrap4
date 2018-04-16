アセット・バンドル
==================

Bootstrap は、CSS、JavaScript、フォントなどを含む複雑なフロントエンド・ソリューションです。
Bootstrap コンポーネントに対する最大限の柔軟な制御を可能にするために、このエクステンションはアセット・バンドルをいくつかに分けて提供しています。
すなわち、

- [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] - メインの CSS ファイルのみを含みます。
- [[yii\bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - [[yii\bootstrap4\BootstrapAsset]] に依存し、javascript ファイルを含みます。
- [[yii\bootstrap4\BootstrapThemeAsset|BootstrapThemeAsset]] - [[yii\bootstrap4\BootstrapAsset]] に依存し、Bootstrap のデフォルト・テーマの CSS を含みます。

個々のアプリケーションは、その要求に応じて、異なるバンドル (またはバンドルの組み合わせ) を必要とするでしょう。
CSS のスタイルだけが必要なのであれば、[[yii\bootstrap4\BootstrapAsset]] だけで十分です。
しかし、Bootstrap の JavaScript を必要とする場合は、[[yii\bootstrap4\BootstrapPluginAsset]] を登録しなければなりません。

> Tip: ほとんどのウィジェットは [[yii\bootstrap4\BootstrapPluginAsset]] を自動的に登録します。
