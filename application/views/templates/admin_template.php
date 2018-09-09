<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php $this->load->view('templates/fragmentos/admin_cabecera'); ?>

<div class="container">
	<div class="main-content" style="padding-top:40px;">
		<?php echo $the_view_content;?>
	</div>
</div>


<?php $this->load->view('templates/fragmentos/admin_piedepagina');?>