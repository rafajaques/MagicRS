<!-- app/View/Users/add.ctp -->
<p><?php echo __('Para ter acesso total ao sistema, você precisa criar um cadastro. Preencha o formulário abaixo e em poucos instantes você já estará conectado!'); ?></p>
<section class="col-lg-6">
<div class="users form">
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Registre-se!'); ?></legend>
        <?php
			echo $this->Form->input('name', array(
				'label' => 'Nome',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
			echo $this->Form->input('surname', array(
				'label' => 'Sobrenome',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
			echo $this->Form->input('email', array(
				'label' => 'E-mail',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
			echo $this->Form->input('username', array(
				'label' => 'Nome de usuário',
				'placeholder' => 'Este nome é visível para a comunidade',
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
			echo $this->Form->input('id_city', array(
				'options' => $cidades,
				'empty' => '-- Selecione a cidade que você mora --',
				'label' => 'Cidade',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
    ?>
    </fieldset>
	<br>
<?php
	echo $this->Form->end(array(
		'label' => __('Efetuar cadastro'),
		'class' => 'btn btn-primary',
	));
?>
</div>
<br>
<p><?php echo __('Já é cadastrado?'); ?> <a href="/users/login"><?php echo __('Clique aqui'); ?></a>.</p>
<br>
</section>