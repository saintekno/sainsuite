<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php $this->load->frontend_view('partials/header.php');?>

<?php $this->load->frontend_view('pages/'.$pages.'.php');?>

<?php $this->load->frontend_view('partials/footer.php');?>