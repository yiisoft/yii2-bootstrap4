Bootstrap introduz construções HTML mais consistentes e esqueletos, que permitem a criação de diferentes efeitos visuais. Apenas o mais complexos deles são cobertos por os widgets fornecidos com esta extensão . O restante deverá ser escrito manualmente usando escrita HTML direta. No entanto, vários casos especiais de marcação Bootstrap são cobertos pelo helper [[\yii\bootstrap4\Html]]. [[\yii\bootstrap4\Html]] é uma versão melhorada de [[\yii\helpers\Html]] dedicada à quem precisa do Bootstrap. Ele fornece vários métodos úteis :

    icon() - allows rendering of Glyphicon icons
    staticControl() - allows rendering of form "static controls"

[[\yii\bootstrap4\Html]] herda toda funcionalidade disponível em [[\yii\helpers\Html]] e pode ser usado como um substituto , para que você não precisa de ambos dentro de seus arquivos de views . Por exemplo:


<?php
use yii\bootstrap4\Html;
?>
<?= Button::widget([
    'label' => Html::icon('approve') . Html::encode('Save & apply'),
    'encodeLabel' => false,
    'options' => ['class' => 'btn-primary'],
]); ?>

    Atenção: Não confunda [[\yii\bootstrap4\Html]] e [[\yii\helpers\Html]], tenha o cuidado de que classe você está usando dentro de seus arquivos de views.
