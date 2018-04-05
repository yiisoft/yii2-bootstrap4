Asset Bundles
=============

Bootstrap es una completa solución front-end, que incluye CSS, JavaScript, fuentes y mucho más.
Con el fin de permitir un control más flexible sobre los componentes de Bootstrap, esta extensión proporciona
varios asset bundles.
Ellos son:

- [[yii\bootstrap4\BootstrapAsset|BootstrapAsset]] - contiene unicamente los ficheros CSS principales.
- [[yii\bootstrap4\BootstrapPluginAsset|BootstrapPluginAsset]] - depende de [[yii\bootstrap4\BootstrapAsset]], contiene ficheros javascript.
- [[yii\bootstrap4\BootstrapThemeAsset|BootstrapThemeAsset]] - depende de [[yii\bootstrap4\BootstrapAsset]], contiene el tema CSS por defecto de Bootstrap.

Particularmente las aplicaciones pueden necesitar requerir diferentes usos de bundle (o combinación de bundle).
Si necesitas unicamente estilos CSS, [[yii\bootstrap4\BootstrapAsset]] será suficiente para ti. Sin embargo, si
quieres usar el JavaScript de Bootstrap, necesitas registrar [[yii\bootstrap4\BootstrapPluginAsset]].

> Consejo: la mayoría de los widgets registran automaticamente [[yii\bootstrap4\BootstrapPluginAsset]].
