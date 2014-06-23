<?php if ($is_linked && isset($friends_permission_ok)): ?>
<div class="alert alert-info alert-dismissable">
    <i class="fa fa-info"></i>
	Sua conta já está totalmente vinculada ao Facebook!
</div>
<?php endif; ?>
<!-- Esquerda -->
<section class="col-lg-6">
	<!-- Perfil -->
	<div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Vincular conta ao Facebook</h3>
		</div>
		<div class="box-body">
			<p>
				Ao vincular sua conta do Magic RS com o Facebook você ganha acesso ao
				<strong>login com o facebook</strong>. Você não precisará mais
				autenticar-se no Magic RS caso já esteja autenticado no Facebook.
			</p>
			
			<p>
				Clique no botão abaixo para vincular sua conta.
			</p>
			
			<?php if (!$is_linked): ?>
			<p>
				<a href="/facebook/link" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Vincular conta com o Facebook</a>
			</p>
			<?php else: ?>
			<p>
				<a href="#" class="btn btn-block btn-social btn-facebook disabled"><i class="fa fa-facebook"></i> Sua conta já está vinculada com o Facebook</a>
			</p>
			<?php endif; ?>
		</div>
	</div>
</section>	

<!-- Direita -->
<section class="col-lg-6">
	<!-- Perfil -->
	<div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Amigos do Facebook</h3>
		</div>
		<div class="box-body">
			<p>
				Após vincular sua conta Magic RS ao Facebook, você pode permitir
				que o Magic RS acesse sua lista de amigos. Assim você poderá encontrar
				mais facilmente seus amigos que também estão aqui!
			</p>
			
			<?php if (!$is_linked): ?>
			<p>
				<a href="#" class="btn btn-block btn-social btn-facebook disabled"><i class="fa fa-facebook"></i> Você deve primeiro vincular sua conta ao Facebook</a>
			</p>
			<?php elseif (!isset($friends_permission_ok)): ?>
			<p>
				<a href="<?php echo $friends_permission_link; ?>" class="btn btn-block btn-social btn-facebook"><i class="fa fa-facebook"></i> Liberar permissão de acesso à lista de amigos</a>
			</p>
			<?php else: ?>
			<p>
				<a href="#" class="btn btn-block btn-social btn-facebook disabled"><i class="fa fa-facebook"></i> Você já liberou o acesso à sua lista de amigos</a>
			</p>
			<?php endif; ?>

		</div>
	</div>
</section>	
		