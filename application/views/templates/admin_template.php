<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('templates/fragmentos/admin_cabecera'); ?>

<?php $this->load->view('templates/fragmentos/cookie-message')?>
<div class="pageContentWrapper">
	<?php echo $the_view_content;?>
</div>

<?php $this->load->view('templates/fragmentos/admin_piedepagina');?>