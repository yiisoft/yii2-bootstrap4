Migrating from yii2-bootstrap
=============================

yii2-bootstrap4 is a major rewrite of the entire project (according Bootstrap 4 to Bootstrap 3 migration guide).
The most notable changes are summarized below:

## General

* The namespace is `yii\bootstrap4` instead of `yii\bootstrap`
* `npm` package is used instead of `bower`
* There is no theme asset any more
* No `popper.js` is needed any more (gets delivered with bootstrap js bundle) 

## Widgets / Classes

* [[yii\bootstrap\Collapse|Collapse]] was renamed to [[yii\bootstrap4\Accordion|Accordion]]
* [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] was removed
* [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]] was added (Bootstrap 4 implementation of [[yii\widgets\Breadcrumbs]])
* [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]] was added (https://getbootstrap.com/docs/4.2/components/button-group/#button-toolbar)

## Changes in widgets

### Modal

The Modal has no `$header` property any more. It was renamed to `$title`. It isn't necessary to write the `<h2 class="modal-title>`
any more. It will be rendered automatically. 
