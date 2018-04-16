Asset Bundles
=============

Bootstrap это комплексное front-end решение, включающее CSS, JavaScript, шрифты и т.д.
Для того чтобы обеспечить вам самый гибкий контроль над компонентами Bootstrap, это расширение предоставляет несколькоо asset bundles.
Вот они:

- [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] - содержит CSS файлы.
- [[yii\bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - зависит от [[yii\bootstrap4\BootstrapAsset]], содержащий javascript файлы.
- [[yii\bootstrap4\BootstrapThemeAsset|BootstrapThemeAsset]] - зависит от [[yii\bootstrap4\BootstrapAsset]], содержащий Bootstrap CSS темы по умолчанию.

Конкретные приложения могут потребовать различного использования. Если вам нужны только CSS стили, то [[yii\bootstrap4\BootstrapAsset]] будет достаточным для вас. Тем не менее, если вы хотите использовать Bootstrap JavaScript, вам необходимо зарегистрировать [[yii\bootstrap4\BootstrapPluginAsset]].

> Tip: большинство виджетов регистрируются [[yii\bootstrap4\BootstrapPluginAsset]] автоматически.
