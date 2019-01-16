Migration von yii2-bootstrap
============================

yii2-bootstrap4 ist eine komplette Überarbeitung des Projekts (sowie Bootstrap 4 für Bootstrap 3).
Die grössten Änderungen finden Sie hier zusammengefasst:

## Allgemein

* Der Namespace ist nun `yii\boostrap4` anstatt `yii\bootstrap`
* Es wird das `npm` Paket verwendet anstatt das `bower` Paket
* Es gibt kein Theme Asset mehr
* `popper.js` muss nicht mehr extra installiert werden (wird vom Bootstrap JS Bundle mitgeliefert) 

## Widgets / Klassen

* [[yii\bootstrap\Collapse|Collapse]] wurde umbenannt zu [[yii\bootstrap4\Accordion|Accordion]]
* [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] wurde entfernt
* [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]] wurde hinzugefügt (Bootstrap 4 Implementation von [[yii\widgets\Breadcrumbs]])
* [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]] wurde hinzugefügt (https://getbootstrap.com/docs/4.2/components/button-group/#button-toolbar)


