<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/fragmentos/public_header'); 
?>

<?php echo $the_view_content;?>

<?php $this->load->view('templates/fragmentos/public_footer');?>