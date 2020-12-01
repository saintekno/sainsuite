<!-- Search form -->
<?php
$attr = riake('content', $_item); ?>
<div class="input-group mb-3">
    <input type="text" name="<?php echo $attr['name'];?>" class="form-control" placeholder="Search by keyword..." value="<?php echo $attr['value'];?>">
    <div class="input-group-append">
        <input type="submit" name="<?php echo $attr['search'];?>" class="btn btn-outline-secondary" value="Search">
        <input type="submit" name="<?php echo $attr['reset'];?>" class="btn btn-outline-secondary" value="Reset">
    </div>
</div>