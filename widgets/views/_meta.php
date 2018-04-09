<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.04.2018
 * Time: 16:27
 */
//\yii\helpers\VarDumper::dump($text, 10, true);die();
?>
<address>

    <a class="contact" href="tel:<?= $text->value('phone'); ?>">
        <i class="icon-phone"></i>
        <?= $text->value('phone'); ?>
    </a>
    <a class="contact" href="mailto:<?= $text->value('email'); ?>">
        <i class="icon-mail"></i>
        <?= $text->value('email'); ?>
    </a>
</address>

