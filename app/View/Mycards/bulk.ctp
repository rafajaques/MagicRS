<?php if (isset($bulk)) { ?>
<div class="col-xs-12">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Importação de cartas</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
			<p>
			<?php if ($bulk['errors'] == 1) { ?>
			Foi encontrada <strong>1</strong> inconsistência na sua lista.
			Você pode corrigí-la no final desta página ou confirmar
			a importação e adicionar apenas as cartas reconhecidas.
			<?php } elseif ($bulk['errors'] > 1) { ?>
			Foram encontradas <strong><?php echo $bulk['errors']; ?></strong>
			inconsistências na sua lista. Você pode corrigí-las no final desta
			página ou confirmar a importação e adicionar apenas as cartas reconhecidas.
			<?php } else { ?>
			Não foram encontradas inconsistências na sua lista. Ela está pronta para
			ser adicionada à sua coleção. Verifique a lista abaixo e clique em
			<strong>Confirmar importação</strong>.
			<?php } ?>
			</p>
			<p>É importante ressaltar que nosso banco de dados não compreende todas
				as cartas de Magic, portanto é possível que algumas não sejam
				reconhecidas devido à sua ausência no site.</p>
			<p><strong>Importante:</strong> se alguma dessas já estiver em sua coleção,
				ela será ignorada.</p>
		</div>
        <div class="box-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Carta</th>
						<th>Quantidade</th>
						<th>Coleção</th>
						<th>Raridade</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$cards_ids = array();
					foreach ($bulk['cards'] as $c) {
						// A carta está aqui
						if (isset($c['Card'])) {
							$cards_ids[] = array(
								'id' => $c['Card']['id'],
								'quantity' => $c['Card']['quantity'],
							);
						?>
						<tr>
							<td><?php echo $this->Mtg->manaImagesByColors($c['Card']['colors']) . ' ' . $c['Card']['name']; ?></td>
							<td><?php echo $c['Card']['quantity']; ?></td>
							<td><?php echo $c['Set']['set_name']; ?></td>
							<td><?php echo $this->Mtg->rarity($c['Card']['rarity']); ?></td>
						</tr>
						<?php
						} else {
						?>
						<tr class="bg-error">
							<td colspan="4"><?php echo $c['text']; ?></td>
						</tr>
						<?php
						}
					}
				?>
			</tbody>
		</table>
		<br>
		<p>Você indicou que essas cartas
			<strong><?php if (!$this->request->data('have_list')) echo 'não'; ?>
			estarão</strong> na sua have list.</p>
		</div>

		<!-- Envio final -->
		<form method="post" action="/mycards/bulkadd">
			<input type="hidden" name="have" value="<?php echo $this->request->data('have_list'); ?>">
		<?php
			foreach ($cards_ids as $id) {
				?>
				<input type="hidden" name="id_card[]" value="<?php echo $id['id']; ?>">
				<input type="hidden" name="quantity[]" value="<?php echo $id['quantity']; ?>">
				<?php
			}
			echo $this->Form->end(array(
				'label' => 'Confirmar importação',
				'class' => 'btn btn-success',
				'div' => array(
					'class' => 'box-body text-center',
				),
			));
		?>
	</div>
</div>
<?php } ?>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Adicionar várias cartas à coleção</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
			<p>Você pode utilizar essa tela para adicionar várias cartas de uma vez só à sua coleção. São aceitos nomes de cartas tanto em português quanto em inglês. Também é possível indicar a quantidade das cartas, sempre antes do nome da mesma. Indique apenas uma carta por linha.</p>
			<p>Também é possível adicionar cartas à sua coleção a partir da página da carta. Existe um botão <strong>+ Minha coleção</strong> que adiciona cartas e permite incluir comentários.</p>
			<br>
			<div class="col-xs-6">
				<form method="post" action="/mycards/bulk">
				<?php
					echo $this->Form->input('cards', array(
						'class' => 'form-control',
						'placeholder' => 'Digite suas cartas...',
						'rows' => 10,
						'type' => 'textarea',
						'label' => 'Cartas',
					));

					echo $this->Form->input('have_list', array(
						'class' => 'form-control',
						'type' => 'checkbox',
						'label' => ' Marcar essas cartas como disponíveis na minha have list.',
					));
				?>
			</div>
			<div class="col-xs-6">
				<p>Exemplo de utilização dessa ferramenta:</p>
				<p class="text-muted">
					Érebo, Deus dos Mortos<br>
					2 Artesão das Formas<br>
					campeao do labirinto<br>
					Bow of Nylea<br>
					3 Archetype of Aggression
				</p>
				<small>Esse exemplo contempla nomes exatos, cartas com contagem, nomes sem acentuação e nomes em inglês.</small>
			</div>
		</div>
		<div class="clear">&nbsp;</div>
		<div class="box-footer">
			<div><input type="submit" class="btn btn-success pull-right" value="Gravar cartas" /></div>
			<div class="clear"></div>			
		</div>
		</form>
	</div>
</div>