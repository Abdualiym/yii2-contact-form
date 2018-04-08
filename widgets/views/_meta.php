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
    <?php foreach ($text as $items):
        if($items->key=="phone"):
            ?>
    <a class="contact" href="tel:<?=$items->value; ?>">
        <i class="icon-phone"></i>
        <?=$items->value; ?>
    </a>
    <?php endif;
    endforeach; ?>


    <?php
    foreach ($text as $items):
        if($items->key=="email"):
            ?>
    <a class="contact" href="mailto:<?=$items->value; ?>">
        <i class="icon-mail"></i>
        <?=$items->value; ?>
    </a>
    <?php
        endif;
    endforeach;
    ?>
</address>

