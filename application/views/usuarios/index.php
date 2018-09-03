<h2><?php echo $title; ?></h2>
<?php foreach ($usuarios as $usuario): ?>
	<h3><?php echo $usuario['email'];?></h3>
	<div class="main">
		<?php echo $usuario['nombre']?>
	</div>
	<p><a href="<?php echo site_url('usuarios/'.$usuario['email']); ?>">Ver Usuario</a></p>
	
<?php endforeach;?>