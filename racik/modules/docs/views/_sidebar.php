<?php if (empty($docs) || ! is_array($docs)) : ?>
<p class="text-center"><?php echo lang('docs_not_found'); ?></p>
<?php
else :
    foreach ($docs as $file => $name) :
        if (is_array($name)) :
?>
<h5 class="duik-sidebar__heading"><?php echo $file; ?></h5>
<ul class="duik-sidebar__nav">
    <?php foreach ($name as $line => $namer) : ?>
    <li class="duik-sidebar__item"><?php echo anchor($docsDir . '/' . str_replace($docsExt, '', $line), $namer, 'class="duik-sidebar__link"'); ?></li>
    <?php endforeach; ?>
</ul>
<?php else : ?>
<h5 class="duik-sidebar__heading"><?php echo anchor($docsDir . '/' . str_replace($docsExt, '', $file), $name); ?></h5>
<?php
        endif;
    endforeach;
endif;

// Module-specific docs.
if (empty($module_docs) || ! is_array($module_docs)) :
?>
<h5 class="duik-sidebar__heading"><?php echo anchor(site_url($docsDir . '/' . str_replace($docsExt, '', $module)), ucwords(str_replace('_', ' ', $module)), 'class="duik-sidebar__link"'); ?></h5>
<?php else : ?>
<h5 class="duik-sidebar__heading"><?php e(lang('docs_title_modules')); ?></h5>
<?php
    foreach ($module_docs as $module => $mod_files) :
        if (count($mod_files)) :
?>
<h5 class="duik-sidebar__heading"><?php echo $module; ?></h5>
<ul class="duik-sidebar__nav">
    <?php foreach ($mod_files as $fileName => $title) : ?>
    <li class="duik-sidebar__item"><?php echo anchor($docsDir . '/' . str_replace($docsExt, '', $fileName), ucwords($title), 'class="duik-sidebar__link"'); ?></li>
    <?php endforeach; ?>
</ul>
<?php
        endif;
    endforeach;
endif;
?>