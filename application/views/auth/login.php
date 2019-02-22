







<!-- Contact -->
	<div class="agilecontactw3ls" id="agilecontactw3ls">
		<div class="container">
			<h3><?php echo lang('login_heading');?></h3>
			<p><?php echo lang('login_subheading');?></p>
			<div id="infoMessage"><?php echo $message;?></div>

            <?php echo form_open("usuario/login");?>
            
              <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1">
                <?php echo lang('login_identity_label', 'identity');?>
                <?php echo form_input($identity);?>
              </div>
            
              <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1">
                <?php echo lang('login_password_label', 'password');?>
                <?php echo form_input($password);?>
              </div>
            
              <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1">
                <?php echo lang('login_remember_label', 'remember');?>
                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
              </div>
            
            
              <div class="col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1"><?php echo form_submit('submit', lang('login_submit_btn'));?></div>
            
            <?php echo form_close();?>
            
            <p><a href="<?=site_url('usuario/forgot_password')?>"><?php echo lang('login_forgot_password');?></a></p>
		</div>
	</div>
	<!-- //Contact -->