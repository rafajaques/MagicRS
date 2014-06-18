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