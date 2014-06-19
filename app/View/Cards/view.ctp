<!-- Esquerda -->
<section>
	<h4><a href="/cards"><i class="fa fa-arrow-circle-left"></i> Voltar para a busca</a></h4>
	<br>
</section>
<section class="col-lg-6">
	<div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"><?php echo $card['name']; ?> <small><?php echo $card['name_en']; ?></small></h3>
        </div>
		<div class="box-body text-center">
			<img id="card" src="<?php echo $this->Mtg->imageByMultiverseId($card['multiverseid']); ?>" height="450">
		</div>
        <div class="box-body text-center">
			<button id="rotate" class="btn btn-block btn-primary"><i class="fa fa-rotate-right"></i>&nbsp; Rotacionar visualização da carta</button>
		</div>
    </div>
	<div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Cartas relacionadas</h3>
        </div>
        <div class="box-body text-center">
			&lt;Falta implementação&gt;
		</div>
    </div>
</section>
<!-- Direita -->
<section class="col-lg-6">
	<div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Opções da carta</h3>
        </div>
		<div class="box-body">
			<div class="text-center">
			<?php if ($logedin) { ?>
				<!-- Botões para autenticados -->
				
				<!-- Tem a carta -->
				<?php if ($hasCard) { ?>
				<a class="btn btn-app bg-green" href="/mycards"><i class="fa fa-check"></i> Você tem essa carta</a>
				<?php } else { ?>
				<a class="btn btn-app" data-toggle="modal" href="#myCards"><i class="fa fa-plus"></i> Minha coleção</a>
				<?php } ?>
				
				<!-- Want List -->
				<?php if ($wantCard) { ?>
				<a class="btn btn-app bg-red" href="/mycards"><i class="fa fa-check"></i> Carta na sua want list</a>
				<?php } else { ?>
				<a class="btn btn-app" data-toggle="modal" href="#wantList"><i class="fa fa-plus"></i> Minha want list</a>
				<?php } ?>
				
				<!-- Encontrar carta -->
				<a class="btn btn-app" data-toggle="modal" href="#findNearby"><?php if ($c_haves = count($haves)) echo '<span class="badge bg-red">'.$c_haves.'</span>'?><i class="fa fa-male"></i> Encontrar alguém que tenha</a>
				
			<?php } else { ?>
				<!-- Botões para não autenticados -->
				<p>Para poder utilizar todos os recursos de cartas, você deve estar <a href="/users/login">autenticado</a>.</p>
				<br>
			<?php } ?>
			</div>
			<a class="btn btn-block btn-social btn-facebook" href="#" id="fbshare">
                <i class="fa fa-facebook"></i> Compartilhar carta no Facebook
            </a>
			<a class="btn btn-block btn-warning" data-toggle="modal" href="#reportCard">
                <i class="fa fa-warning"></i>&nbsp; Notificar algo de errado com essa carta
            </a>
		</div>
	</div>
	
	<div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Dados da carta</h3>
        </div>
		<div class="box-body no-padding">
		    <table class="table">
		        <tr>
		            <td width="30%" class="text-right"><strong>Suas anotações</strong></td>
					<td>&lt;Falta implementação&gt;</td>
		        </tr>
		        <tr>
		            <td class="text-right"><strong>Valor médio</strong></td>
					<td>
						<?php
						if (is_numeric($avg_price) && $avg_price > 0) {
							echo 'R$ ' . number_format($avg_price, 2, ',', '.');
						} else {
							echo 'Indisponível';
						}
						?>
					</td>
		        </tr>
		        <tr>
		            <td width="30%" class="text-right"><strong>Raridade</strong></td>
					<td><?php echo $this->Mtg->rarity($card['rarity']); ?></td>
		        </tr>
		        <tr>
		            <td width="30%" class="text-right"><strong>Coleção</strong></td>
					<td><img src="/img/sets_icons/<?php echo $set['code']; ?>.gif"> <?php echo $set['set_name']; ?></td>
		        </tr>
		        <tr>
		            <td class="text-right"><strong>Custo de mana</strong></td>
					<td><?php echo $this->Mtg->manaCost($card['mana_cost']); ?> &nbsp;&nbsp;&nbsp; <small>Convertido: <?php echo $card['cmc']; ?></td>
		        </tr>
		        <!--tr>
		            <td class="text-right"><strong>Custo de mana convertido</strong></td>
					<td><?php echo $card['cmc']; ?></td>
		        </tr-->
		        <tr>
		            <td class="text-right"><strong>Tipo</strong></td>
					<td><?php echo $card['type']; ?></td>
		        </tr>
				<?php if (isset($card['power']) && isset($card['toughness'])) { ?>
		        <tr>
		            <td class="text-right"><strong>Poder / Resistência</strong></td>
					<td><?php echo "{$card['power']} / {$card['toughness']}"; ?></td>
		        </tr>
				<?php } ?>
				<?php if (isset($card['loyalty'])) { ?>
		        <tr>
		            <td class="text-right"><strong>Lealdade</strong></td>
					<td><?php echo $card['loyalty']; ?></td>
		        </tr>
				<?php } ?>
				
				<?php if (strlen($card['text'])): ?>
		        <tr>
		            <td class="text-right"><strong>Texto</strong></td>
					<td><?php echo nl2br($this->Mtg->manaCostInText($card['text'])); ?></td>
		        </tr>
				<?php endif; ?>
				
				<?php if (strlen($card['flavor'])): ?>
		        <tr>
		            <td class="text-right"><strong>Flavor</strong></td>
					<td><em><?php echo nl2br($card['flavor']); ?></em></td>
		        </tr>
				<?php endif; ?>
				
		        <tr>
		            <td class="text-right"><strong>Artista</strong></td>
					<td><?php echo $card['artist']; ?></td>
		        </tr>
		    </table>
		</div><!-- /.box-body -->

		<div class="box-body text-center">
			<?php
			if ($card['uptodate'] == 0) {
				echo '<small class="badge bg-navy">Esta carta ainda não foi consolidada no banco de dados</small>';
			} else if ($card['uptodate'] == 1) {
				echo '<small class="badge bg-navy">A imagem desta carta ainda não está consolidada no banco de dados</small>';
			}
			?>
		</div>
    </div>
</section>
<!-- Button trigger modal -->

<!-- Modal - reportCard -->
<div class="modal fade" id="reportCard" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Notificar algo de errado com <strong><?php echo $card['name']; ?></strong></h4>
    </div>
    <div class="modal-body">
		<p>Obrigado por dedicar um tempo para me ajudar a aperfeiçoar nossa enciclopédia de cartas.</p>
		<p>Para enviar uma notificação de problema com a carta, preencha o formulário abaixo e clica em <strong>Enviar notificação</strong>.</p>
		<p>Marque todas as opções que se aplicam ao caso:</p>
		<form method="post" action="/cards/report">
		<?php
			echo $this->Form->input('id_card', array('type' => 'hidden', 'value' => $card['id']));
			echo $this->Form->input('nome_pt', array(
				'type' => 'checkbox',
				'label' => ' O nome não está em português',
			));
			echo $this->Form->input('dois_nomes', array(
				'type' => 'checkbox',
				'label' => ' A carta deveria ter dois nomes',
			));
			echo $this->Form->input('nome_errado', array(
				'type' => 'checkbox',
				'label' => ' O nome está errado',
			));
			echo $this->Form->input('sem_imagem', array(
				'type' => 'checkbox',
				'label' => ' A imagem da carta não aparece',
			));
			echo $this->Form->input('imagem_errada', array(
				'type' => 'checkbox',
				'label' => ' Esta imagem não é dessa carta',
			));
			echo $this->Form->input('outro', array(
				'label' => 'Comentários ou outro tipo de erro',
				'placeholder' => 'Utilize este espaço para detalhar a notificação, se necessário.',
				'class' => 'form-control',
				'div' => array(
					'class' => 'form-group',
				),
			));
		?>
	</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      <input type="submit" class="btn btn-warning" value="Enviar notificação">
  	  </form>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if ($logedin) { # Modais apenas para autenticados ?>

<!-- Modal - myCards -->
<div class="modal fade" id="myCards" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Adicionar carta à coleção</h4>
    </div>
    <div class="modal-body">
		<p>Deseja adicionar <strong><?php echo $card['name']; ?></strong> à sua coleção?</p>
		<br>
		<div class="col-lg-3">
			<img src="<?php echo $this->Mtg->imageByMultiverseId($card['multiverseid']); ?>" height="150">
		</div>
		<div class="col-lg-9">
			<form method="post" action="/mycards/add">
				<?php
				echo $this->Form->input('id_card', array(
					'type' => 'hidden',
					'value' => $card['id'],
				));
				?>
				<!-- Quantidade -->
				<?php
				echo $this->Form->input('quantity', array(
					'label' => 'Quantas cartas você tem?',
					'class' => 'form-control',
					'type' => 'number',
					'pattern' => '\d*',
					'value' => 1,
				));
				?>
				<br>
				<!-- Anotações -->
			    <label for="note">Anotações</label>
				<?php
				echo $this->Form->textarea('note', array(
					'class' => 'form-control',
					'placeholder' => 'Essas anotações são visíveis somente para você. Elas ficam disponibilizadas junto com a carta na sua coleção pessoal. As anotações são opcionais.',
					'rows' => 4,
				));
				?>
				<br>
				<!-- Have list -->
	            <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="have_list" value="1" />
	                    Disponibilizar essa carta na minha <strong>have list</strong>.
	                </label> 
	 			   <br><small>Sua have list é sempre pública. Colocar a carta nessa lista indica que ela está disponível para venda ou troca.</small>
	            </div>
		</div>
		<div class="clear">&nbsp;</div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <input type="submit" class="btn btn-primary" value="Gravar">
	</form>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal - wantList -->
<div class="modal fade" id="wantList" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Adicionar à want list</h4>
    </div>
    <div class="modal-body">
		<p>Deseja adicionar <strong><?php echo $card['name']; ?></strong> à sua want list?</p>
		<br>
		<div class="col-lg-3">
			<img src="<?php echo $this->Mtg->imageByMultiverseId($card['multiverseid']); ?>" height="150">
		</div>
		<div class="col-lg-9">
			<form method="post" action="/mycards/addwant">
				<?php
				echo $this->Form->input('id_card', array(
					'type' => 'hidden',
					'value' => $card['id'],
				));
				?>
				<!-- Quantidade -->
				<?php
				echo $this->Form->input('quantity', array(
					'label' => 'Quantas cartas você procura?',
					'class' => 'form-control',
					'type' => 'number',
					'pattern' => '\d*',
					'value' => 1,
				));
				?>
				<br>
				<!-- Anotações -->
			    <label for="note">Anotações</label>
				<?php
				echo $this->Form->textarea('note', array(
					'class' => 'form-control',
					'placeholder' => 'Essas anotações são visíveis para todos que acessarem sua want list. Utilize, se necessário, para fornecer informações complementares.',
					'rows' => 4,
				));
				?>
				<br>
		</div>
		<div class="clear">&nbsp;</div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <input type="submit" class="btn btn-primary" value="Gravar">
    </div>
	</form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal - findNearby -->
<div class="modal fade" id="findNearby" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Encontrar alguém que tenha <strong><?php echo $card['name']; ?></strong></h4>
    </div>
    <div class="modal-body">
		Aqui encontram-se listadas todas as pessoas que possuem a carta em sua
		coleção marcada na <strong>have list</strong>.
    </div>
	<?php if (count($haves)): ?>
	<div class="box-body no-padding">
        <table class="table table-striped">
            <tbody>
			<tr>
				<th width="10%">&nbsp;</th>
		        <th>Quem</th>
				<th>Quantas</th>
				<th>Coleção</th>
		        <th>Onde</th>
            </tr>
			<?php foreach ($haves as $c): ?>
            <tr>
                <td style="text-center"><img src="<?php echo $this->User->getAvatar($c['UserCard']['id_user']); ?>" width="30"></td>
                <td><a href="/profile/view/<?php echo $c['UserCard']['id_user']; ?>"><?php echo $c[0]['full_name'] ?></a></td>
                <td><?php echo $c['UserCard']['quantity']; ?></td>
                <td><img src="/img/sets_icons/<?php echo $c['Set']['set_code']; ?>.gif"></td>
                <td><?php echo $c['City']['city_name']; ?></td>
            </tr>
			<?php endforeach; ?>
        </tbody></table>
    </div>
	<?php else: ?>
    <div class="modal-body">
		Não foram encontradas pessoas com essa carta no sistema! :(
    </div>
	<?php endif; ?>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      <!--input type="submit" class="btn btn-primary" value="Buscar"-->
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php } ?>
<script src="/js/cards.js" type="text/javascript"></script>
<script src="/js/facebook.js"></script>
<script type="text/javascript">
$(function() {
	$("#fbshare").click(function(){
		fbShare(
			window.location,
			"<?php echo $projectName.' | '.$title_for_layout; ?>",
			"Página de compra/troca/venda de cartas de Magic no Rio Grande do Sul",
			"<?php echo $this->Mtg->imageByMultiverseId($card['multiverseid']); ?>");
	});
});
</script>