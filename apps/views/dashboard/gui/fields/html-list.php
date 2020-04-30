<ul class="list-group">
    <?php
    foreach (force_array(riake('options', $_item)) as $list_option) {
        $type =    riake('type', $list_option);
        $text =    riake('text', $list_option);
        ?>
    <li class="list-group-item list-group-item-<?php echo $type;?>"><?php echo $text;?></li>
    <?php
    }
    ?>
</ul>