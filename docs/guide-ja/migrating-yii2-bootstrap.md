yii2-bootstrap からの移行
=========================

yii2-bootstrap4 は、Bootstrap 3 から Bootstrap 4 への移行ガイドに従って、yii-bootstrap プロジェクト全体を大きく書き換えたものです。
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

### BaseHtml

`icon` メソッドは削除されました。グリフアイコンがもうバンドルされておらず、このメソッドが無意味になったためです。
代りに、[Font Awesome Widget](https://github.com/rmrevin/yii2-fontawesome) または
[Font Awesome Inline Widget](https://github.com/Thoulah/yii2-fontawesome-inline) を使うことを検討して下さい。

### ActiveField

以下のプロパティの名前が変りました。
* `$checkboxTemplate` は `$checkTemplate` に変更。
* `$horizontalCheckboxTemplate` は `$checkHorizontalTemplate` に変更。
* `$horizontalRadioTemplate` は `$radioHorizontalTemplate` に変更。

プロパティ `$inlineCheckboxListTemplate` および `$inlineRadioListTemplate` は削除されました。`$checkEnclosedTemplate` と呼ばれる新しいテンプレートが追加されています。
bootstrap 4 では、チェックボックスはラベルに包まれないのがデフォルトになりました。

### ActiveForm

新しい定数 [[yii\bootstrap4\ActiveForm::LAYOUT_DEFAULT]]、[[yii\bootstrap4\ActiveForm::LAYOUT_HORIZONTAL]]
および [[yii\bootstrap4\ActiveForm::LAYOUT_INLINE]] が追加されました。
これらによって、レイアウトの選択が容易になり、文字列がいつ何時変っても、リファクタリングが安全に出来るようになることが期待されます。

### Breadcrumbs

このクラスは bootstrap の要求を満たす正しいクラスと属性でパンくずリストをレンダリングするために導入されました。
これは [[yii\widgets\Breadcrumbs]] と完全に互換です。

### ButtonDropdown

`$direction` という新しいプロパティが導入され、メニューを開く方向を選ぶ（例えばボタンの右側に開く）ことが可能になりました。
方向の選択をより容易にするために、[[yii\bootstrap4\ButtonDropdown::DIRECTION_DOWN]]、[[yii\bootstrap4\ButtonDropdown::DIRECTION_LEFT]]、
[[yii\bootstrap4\ButtonDropdown::DIRECTION_RIGHT]] そして
[[yii\bootstrap4\ButtonDropdown::DIRECTION_UP]] という定数が導入されました。
`$renderContainer` という新しいプロパティもあります。これが `false` に設定されると、ドロップダウンを包む div は描画されません。

次のプロパティは名前が変更されました。
* `$containerOptions` は `$options` に変更。
* `$options` はe `$buttonOptions` に変更。

### ButtonToolbar

この新しいクラスを使うとボタン・ツールバーを描画することが出来ます。
詳細は https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar を参照して下さい。

### Carousel

スライド間のアニメーションを制御する `$crossfade` というプロパティが導入されました。
これが `true` に設定されると、スライド・アニメーションの代りにクロスフェイド・アニメーションが実行されます。

### LinkPager

この新しいクラスは [[yii\widgets\LinkPager]] のブートストラップ・バージョンです。
詳細は https://getbootstrap.com/docs/4.3/components/pagination/ を参照して下さい。

### Modal


次のプロパティの名前が変りました。
* `$header` は `$title` に変更。
* `$headerOptions` は `$titleOptions` に変更。

もう `<h2 class="modal-title></h2>` と書く必要はありません。自動的にそのようにレンダリングされます。

### Nav

`$dropdDownCaret` プロパティは削除されました。キャレットは (S)CSS によってのみ制御可能となりました。
https://getbootstrap.com/docs/4.3/getting-started/theming/#sass-options を参照して下さい。

### NavBar

次のプロパティの名前が変りました。
* `$containerOptions` は `$collapseOptions` に変更。

`$headerContent` プロパティは削除されました。NavBar のヘッダはもう有りません。
トグラーがカスタマイズ可能になり、プロパティ `$togglerContent` および `$togglerOptions` が導入されました。

### Tabs

プロパティ `$panes` が導入されました。これによって、ペインの内容を `$items[0]['content']` ではなく、独立したプロパティによって定義することが出来るようになりました。
ペインの配列のインデックスがアイテムのインデックスに対応します。
例えば、`$items[0]` は `$panes[0]` に属します。

### ToggleButtonGroup

新しい定数 [[yii\bootstrap4\ToggleButtonGroup::TYPE_CHECKBOX]] および
[[yii\bootstrap4\ToggleButtonGroup::TYPE_RADIO]] が導入され、選択がより容易になり、
いつ文字列が変ってもリファクタリングがより安全に出来るようになりました。
