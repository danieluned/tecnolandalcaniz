<?php defined('BASEPATH') OR exit('No direct script access allowed');?> 


<?php $this->load->view('templates/fragmentos/public_header');?>
<?php $this->load->view('templates/fragmentos/cookie-message')?>
<?php echo $the_view_content;?>

<?php $this->load->view('templates/fragmentos/public_footer');?>