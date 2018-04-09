<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.04.2018
 * Time: 16:27
 */
//\yii\helpers\VarDumper::dump($text, 10, true);die();
$phone = $text->value(9, 'phone');
$email = $text->value(9, 'email');
?>
<address>

    <a class="contact" href="tel:<?= $phone; ?>">
        <i class="icon-phone"></i>
        <?= $phone; ?>
    </a>
    <a class="contact" href="mailto:<?= $email; ?>">
        <i class="icon-mail"></i>
        <?= $email; ?>
    </a>

</address>

