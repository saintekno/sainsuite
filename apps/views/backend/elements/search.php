<!-- Search form -->
<div class="input-group mb-3">
    <input type="text" name="searchKeyword" class="form-control" placeholder="Search by keyword..." value="<?php echo $this->session->userdata('searchKeyword');?>">
    <div class="input-group-append">
        <input type="submit" name="submitSearch" class="btn btn-outline-secondary" value="Search">
        <input type="submit" name="submitReset" class="btn btn-outline-secondary" value="Reset">
    </div>
</div>