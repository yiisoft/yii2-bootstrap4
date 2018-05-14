Html ヘルパ
===========

Bootstrap は、一貫性の高い多数の HTML 構文ないしはスケルトンを導入して、さまざまな視覚的効果の生成を可能にしています。
このエクステンションによって提供されるウィジェットがカバーしているのは、その中の最も複雑なものだけです。
残りのものは、直接に HTML 構文を使って、手作業で構築しなければなりません。
ただし、いくつかの特別な Bootstrap マークアップについては、[[\yii\bootstrap4\Html]] によってカバーされています。
[[\yii\bootstrap4\Html]] は通常の [[\yii\helpers\Html]] の拡張版であり、Bootstrap の要求に特化して、
いくつかの便利なメソッドを提供するものです。

 - `icon()` - Glyphicon のアイコンのレンダリングを可能にする
 - `staticControl()` - フォームの "static controls" のレンダリングを可能にする

[[\yii\bootstrap4\Html]] は [[\yii\helpers\Html]] で利用できる全ての機能を継承しており、
その代替物として使うことが出来ますので、ビュー・ファイルの中で両方を使う必要はありません。
例えば、

```php
<?php
use yii\bootstrap4\Html;
?>
<?= Button::widget([
    'label' => Html::icon('approve') . Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>
```

> 注意: [[\yii\bootstrap4\Html]] と [[\yii\helpers\Html]] を混同してはいけません。
  ビューの中でどちらのクラスを使っているのかに注意してください。
