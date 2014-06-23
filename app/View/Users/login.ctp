<?php if ($flash = $this->Session->flash('auth')) { ?>
<div class="alert alert-danger alert-dismissable">
    <i class="fa fa-ban"></i>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <b><?php echo __('Erro!')?></b> <?php echo $flash; ?>
</div>
<?php } ?>

<section class="col-lg-6">
<div class="users form">

<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Forneça seu nome de usuário e senha'); ?></legend>
        <?php
			echo $this->Form->input('username', array(
				'label' => 'Nome de usuário',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
	        echo $this->Form->input('password', array(
				'label' => 'Senha',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
			
	        echo $this->Form->input('persist', array(
				'label' => ' Mantenha-me conectado <small>(não recomendado em computadores compartilhados)</small>',
				'type' => 'checkbox',
				'checked' => true,
				'div' => array(
					'class' => 'form-group checkbox',
				),
			));
    ?>
    </fieldset>
	<?php
		echo $this->Form->end(array(
			'label' => __('Acessar'),
			'class' => 'btn btn-primary',
		));
	?>
</div>
<br>
<p>
	<?php echo __('Não tem cadastro?'); ?> <a href="/users/add"><?php echo __('Clique aqui'); ?></a>.
</p>
</section>

<section class="col-lg-6">
	<div class="users form">
    <legend>Autenticação com o Facebook</legend>

	<p>
		Se você já vinculou sua conta do Magic RS com o Facebook, não é necessário
		preencher seus dados no formulário ao lado. Clique no botão abaixo e 
		utilize sua autenticação do Facebook.
	</p>
	<p>
		Caso você já esteja autenticado no Facebook e as contas estejam vinculadas,
		você será automaticamente redirecionado para a página inicial do Magic RS.
	</p>

	<p>
		<a href="/facebook/login" class="btn btn-block btn-social btn-facebook btn-lg">
			<i class="fa fa-facebook" style="padding-top:7px"></i> Entrar com o Facebook
		</a>
	</p>
</div>
</section>