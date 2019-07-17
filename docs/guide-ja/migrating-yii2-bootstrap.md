yii2-bootstrap からの移行
=========================

yii2-bootstrap4 は、Bootstrap 3 から Bootstrap 4 への移行に応じて、yii-bootstrap 全体を大きく書き換えたものです。
最も注目すべき変更点を要約すると以下の通りです。

## 一般

* 名前空間は `yii\bootstrap` から `yii\bootstrap4` に変更
* `bower` ではなく `npm` パッケージを使用
* テーマ・アセットは廃止
* `popper.js` は不要になった (bootstrap js バンドルによって供給される) 

## ウィジェット / クラス

* [[yii\bootstrap\Collapse|Collapse]] の名前は [[yii\bootstrap4\Accordion|Accordion]] に変更
* [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] は廃止
* [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]] を追加 ([[yii\widgets\Breadcrumbs]] の Bootstrap 4 による実装)
* [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]] を追加 (https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar)

