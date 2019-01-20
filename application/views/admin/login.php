

<!-- Login -->
	<div class="agilecontactw3ls" id="agilecontactw3ls">
		<div class="container">
			<h3>Login</h3>
			<form action=""/>
				<div class="col-sm-offset-3 col-md-6 agilecontactw3ls-grid agilecontactw3ls-grid-1">
					<div style="color:red"><?php echo $this->session->flashdata('message');?></div>
					
					<input type="text" name="identity" placeholder="Usuario" required>
					<input type="password" name="password" placeholder="Contraseña" required>
					<input type="checkbox" name="remember" value="1" ><span style="color:darkgray"> Recordar</span>
					<div class="send-button">
						<input type="submit" value="ENTRAR">
					</div>
				</div>				
				
			 <?php echo form_close();?>
		</div>
	</div>
<!-- //Login -->