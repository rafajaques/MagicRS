<!-- Profile -->
<!-- Esquerda -->
<section class="col-lg-4">
	<!-- Perfil -->
	<div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo $profile['full_name']; ?></h3>
        </div>
        <div class="box-body text-center">
			<img src="<?php echo $profile['avatar_path'] ?>" class="avatar">
		</div>
        <div class="box-body text-center">
			<?php if ($is_mine) { ?>
			<a class="btn btn-primary btn-block" href="#editAvatar" data-toggle="modal"><i class="fa fa-camera"></i> Trocar minha foto</a>
			<a class="btn btn-primary btn-block" href="#editProfile" data-toggle="modal"><i class="fa fa-edit"></i> Editar meu perfil</a>
			<?php } else { ?>
			
			<?php

				// Botão de amizade
				switch($friendship) {
					case 'friend':
					?>
					<span class="btn btn-success space-under btn-block"><i class="fa fa-check"></i> Amigos</span>
					<?php
					break;
					
					case 'received':
					?>
					<a class="btn btn-warning space-under btn-block" href="/friends/add/<?php echo $profile['id']; ?>"><i class="fa fa-check"></i> Aceitar pedido de amizade</a>
					<?php
					break;
					
					case 'sent':
					?>
					<a class="btn btn-danger space-under btn-block" href="/friends/add/<?php echo $profile['id']; ?>"><i class="fa fa-times"></i> Cancelar pedido de amizade</a>
					<?php
					break;
										
					case false:
					?>
					<a class="btn btn-info space-under btn-block" href="/friends/add/<?php echo $profile['id']; ?>"><i class="fa fa-plus"></i> Enviar pedido de amizade</a>
					<?php
					break;
				}
			?>
			
			
			
			<a class="btn btn-primary btn-block" href="#" onclick="chatWith('<?php echo $profile['username'];?>')"><i class="fa fa-envelope"></i> Enviar uma mensagem</a>
			<?php } ?>
		</div>
		<div class="box-body no-padding">
		    <table class="table">
		        <tr>
		            <th width="30%" class="text-right">Cidade</th>
					<td><?php echo $profile['city']; ?></td>
		        </tr>
		        <tr>
		            <th class="text-right">Coleção pessoal</th>
					<td>
						<?php
							echo ($profile['collec_count'] == 1) ?
							'1 carta única' :
							"{$profile['collec_count']} cartas únicas";
						?>
					</td>
		        </tr>
		        <tr>
		            <th class="text-right">Cores preferidas</th>
					<td>&lt;Falta implementação&gt;</td>
		        </tr>
		        <tr>
		            <th class="text-right">Membro desde</th>
					<td>&lt;Falta implementação&gt;</td>
		        </tr>
		        <tr>
		            <th class="text-right">Última atividade</th>
					<td>&lt;Falta implementação&gt;</td>
		        </tr>
			</table>
		</div>
    </div>
</section>
<!-- Direita -->
<section class="col-lg-8">
	<!-- Have list -->
	<div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Have list</h3>
        </div>
		<div class="box-body text-center">
			<?php if (!count($profile['have_cards'])): ?>
			
			Não existem cartas na have list de <strong><?php echo $profile['name']; ?></strong>.
			
			<?php else: ?>
			<label>Últimas cartas adicionadas</label>
			<?php echo $this->List->simpleTable($profile['have_cards']); ?>
			<a href="/profile/have/<?php echo $profile['id']; ?>" class="btn btn-block"><i class="fa fa-eye"></i> Visualizar lista completa</a>
			<?php endif; ?>
		</div>
	</div>
	
	<!-- Want list -->
	<div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Want list</h3>
        </div>
		<div class="box-body text-center">
			<?php if (!count($profile['want_cards'])): ?>
			
			Não existem cartas na want list de <strong><?php echo $profile['name']; ?></strong>.
			
			<?php else: ?>
			<label>Últimas cartas adicionadas</label>
			<?php echo $this->List->simpleTable($profile['want_cards']); ?>
			<a href="/profile/want/<?php echo $profile['id']; ?>" class="btn btn-block"><i class="fa fa-eye"></i> Visualizar lista completa</a>
			
			<?php endif; ?>
		</div>
	</div>
	
	
	<!-- Coleção -->
	<div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Coleção pessoal</h3>
        </div>
		<div class="box-body text-center">
			<!--A coleção de <strong><?php echo $profile['name']; ?></strong> é privada.-->
			<!-- Contagem de cartas -->
			<?php if ($profile['collec_count'] == 1): ?>
			Existe <strong>1</strong> carta única
			<?php else: ?>
			Existem <strong><?php echo $profile['collec_count']; ?></strong> cartas únicas
			<?php endif;?>
			na coleção de <strong><?php echo $profile['name']; ?></strong>.
			<br>
			Veja algumas cartas:
		</div>
		<div class="box-body text-center">
			<?php
				foreach ($profile['sample_cards'] as $c) {
					?>
					<a href="/cards/view/<?php echo $c['Card']['id']; ?>">
					<img width="130" src="<?php echo $this->Mtg->imageByMultiverseId($c['Card']['multiverseid']); ?>"
					alt="<?php echo $c['Card']['name']; ?>" title="<?php echo $c['Card']['name']; ?>">
					</a>
					<?php
				}
			?>
		</div>
			<a href="/profile/cards/<?php echo $profile['id']; ?>" class="btn btn-block"><i class="fa fa-eye"></i> Visualizar lista completa</a>
		<br>
	</div>
	
</section>

<?php if ($is_mine): ?>
<!-- Editar avatar -->
<div class="modal fade" id="editAvatar" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Trocar minha foto</h4>
    </div>
    <form method="post" enctype="multipart/form-data" action="/avatar">
	<div class="modal-body">
		<p>Para trocar a foto de seu perfil, envie uma imagem <strong>JPG</strong> ou <strong>PNG</strong>.</p>
		<p>Não exagere no tamanho do arquivo ou ele poderá ser negado!</p>
		<p><?php echo $this->Form->file('avatar'); ?></p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <input type="submit" class="btn btn-primary" value="Enviar foto">
	</form>
    
	</div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Editar perfil -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Editar meu pefil</h4>
    </div>
    <div class="modal-body">
		Serviço ainda não implementado :(
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <!--input type="submit" class="btn btn-primary" value="Buscar"-->
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>