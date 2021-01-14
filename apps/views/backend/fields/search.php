<!-- Search form -->
<div class="input-group mb-3">
    <input type="text" name="searchKeyword" class="form-control" placeholder="Search by keyword..." value="<?php echo $this->session->userdata('searchKeyword');?>">
    <div class="input-group-append">
        <input type="submit" name="submitSearch" class="btn btn-outline-secondary" value="Search">
        <input type="submit" name="submitReset" class="btn btn-outline-secondary" value="Reset">
    </div>
</div>

<?php
// If search request submitted
if($this->input->post('submitSearch')){
    $inputKeywords = $this->input->post('searchKeyword');
    $searchKeyword = strip_tags($inputKeywords);
    if(!empty($searchKeyword)){
        $this->session->set_userdata('searchKeyword',$searchKeyword);
    }else{
        $this->session->unset_userdata('searchKeyword');
    }
}elseif($this->input->post('submitReset')){
    $this->session->unset_userdata('searchKeyword');
}