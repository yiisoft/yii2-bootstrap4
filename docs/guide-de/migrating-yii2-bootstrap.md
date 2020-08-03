Migration von yii2-bootstrap
============================

yii2-bootstrap4 ist eine komplette Überarbeitung des Projekts (siehe den Bootstrap 4 von Bootstrap 3 Migrationsguide).
Die grössten Änderungen finden Sie hier zusammengefasst:

## Allgemein

* Der Namespace ist nun `yii\bootstrap4` anstatt `yii\bootstrap`
* Es wird das `npm` Paket verwendet anstatt das `bower` Paket
* Es gibt kein Theme Asset mehr
* `popper.js` muss nicht mehr extra installiert werden (wird vom Bootstrap JS Bundle mitgeliefert) 

## Widgets / Klassen

* [[yii\bootstrap\Collapse|Collapse]] wurde umbenannt zu [[yii\bootstrap4\Accordion|Accordion]]
* [[yii\bootstrap\BootstrapThemeAsset|BootstrapThemeAsset]] wurde entfernt
* [[yii\bootstrap4\Breadcrumbs|Breadcrumbs]] wurde hinzugefügt (Bootstrap 4 Implementation von [[yii\widgets\Breadcrumbs]])
* [[yii\bootstrap4\ButtonToolbar|ButtonToolbar]] wurde hinzugefügt (https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar)


### BaseHtml

Die Methode `icon` wurde entfernt. Sie macht keinen Sinn mehr, da Bootstrap 4 keine Icons mehr mit sich bringt. Eine
mögliche Alternative wäre das [Font Awesome Widget](https://github.com/rmrevin/yii2-fontawesome) oder aber das
[Font Awesome Inline Widget](https://github.com/YiiRocks/yii2-fontawesome-inline).

### ActiveField

Folgende Properties wurden umbenannt:
* `$checkboxTemplate` zu `$checkTemplate`,
* `$horizontalCheckboxTemplate` zu `$checkHorizontalTemplate`,
* `$horizontalRadioTemplate` zu `$radioHorizontalTemplate`

Die Properties `$inlineCheckboxListTemplate` und `$inlineRadioListTemplate` wurden entfernt. Dafür gibt es ein neues 
Template mit dem Namen `$checkEnclosedTemplate`. In Bootstrap 4 sind Checkboxen standardmässig nicht mehr von Labeln 
eingeschlossen.

### ActiveForm

Hier wurden die Konstanten [[yii\bootstrap4\ActiveForm::LAYOUT_DEFAULT]], [[yii\bootstrap4\ActiveForm::LAYOUT_HORIZONTAL]]
und [[yii\bootstrap4\ActiveForm::LAYOUT_INLINE]] eingeführt. Sie sollen die Verwendung der Layout vereinfachen und bei
allfälligen Änderungen der Werte Folgefehler verhindern.

### Breadcrumbs

Dieses Widget wurde neu eingeführt um die Korrekte Darstellung von Breadcrumbs im Bootstrap 4 Design zu gerwährleisten.
Es ist vollständig komptibel mit [[yii\widgets\Breadcrumbs]].

### ButtonDropdown

Dieses Widget hat ein neues Property mit Namen `$direction` erhalten. Es ermöglicht die Anzeige des Menüs auf z.B. der
rechten Seite des Buttons. Des weiteren gibt es die Konstanten  [[yii\bootstrap4\ButtonDropdown::DIRECTION_DOWN]], 
[[yii\bootstrap4\ButtonDropdown::DIRECTION_LEFT]], [[yii\bootstrap4\ButtonDropdown::DIRECTION_RIGHT]] und 
[[yii\bootstrap4\ButtonDropdown::DIRECTION_UP]] um die Richtungsselektion zu vereinfachen.
Es wurde ein weiteres Property eingeführt mit dem Namen `$renderContainer`. Falls dieses auf `false` gestellt wird, wird
das rendern des das Dropdown umfassenden DIVs verhindert.

Folgende Properties wurden umbenannt:
* `$containerOptions` zu `$options`,
* `$options` zu `$buttonOptions`

### ButtonToolbar

Dieses Widget wurde eingeführt um einfach Button-Toolbars zu erstellen. Weitere Informationen erhalten Sie unter
https://getbootstrap.com/docs/4.3/components/button-group/#button-toolbar.

### Carousel

Dieses Widget hat das Property `$crossfade` erhalten. Es erlaubt das Ändern der Animation zwischen den Slides auf ein Fade,
anstatt eines Slided wenn es auf `true` gestellt wird.

### LinkPager

Dieses neue Widget repräsentiert die Bootstrap Version von [[yii\widgets\LinkPager]]. Es rendert eine Pagination im Bootstrap
Stil. Weitere Informationen erhalten Sie unter https://getbootstrap.com/docs/4.3/components/pagination/.

### Modal

Folgende Properties wurden umbenannt:
* `$header` zu `$title`,
* `$headerOptions` zu `$titleOptions`

Des Weiteren ist es nicht mehr von nöten, beim `$title` die Titel-Tags `<h2 class="modal-title></h2>` anzugeben. Diese
werden nun automatisch gerendert.

### Nav

Das `$dropdDownCaret` Property wurde entfernt. Dies ist nur noch über (S)CSS steuerbar. Weitere Informationen erhalten Sie
unter https://getbootstrap.com/docs/4.3/getting-started/theming/#sass-options

### NavBar

Folgende Properties wurden umbenannt:
* `$containerOptions` zu `$collapseOptions`

Das Property `$headerContent` wurde entfernt. Der "Toggler" ist nun anpassbar. Dazu gibt es neu die Properties 
`$togglerContent` sowie `$togglerOptions`.

### Tabs

Es gibt neu das Property `$panes`. Es ermöglicht das Definieren der Tabinhalte via separatem Property anstatt über
`$items[0]['content']`. Der Index des panes-Arrays korrespondiert mit dessen des items-Arrays. Z.B. gehört `$items[0]`
zu `$panes[0]`.

### ToggleButtonGroup

Dieses Widget hat die Konstanten [[yii\bootstrap4\ToggleButtonGroup::TYPE_CHECKBOX]] und
[[yii\bootstrap4\ToggleButtonGroup::TYPE_RADIO]] erhalten zur vereinfachten Selektion des Typs und bei allfälligen 
Änderungen der Werte zur Verhinderung von Folgefehlern.
