<?php if (isset($ignored_import)): ?>
<p>
<a data-toggle="modal" href="#ignored" class="btn btn-block btn-danger">Clique aqui para visualizar a lista de cartas ignoradas</a>
</p>
<?php endif; ?>

<!-- MyCards/index.ctp -->
<!-- Esquerda -->
<section class="col-lg-6">
	<div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Have list</h3>
        </div>
        <div class="box-body text-center">
			Você possui <strong><?php echo $have_list_count; ?></strong>
			cartas únicas de sua coleção listadas na have list.
		</div>
    </div>
	
	<div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Want list</h3>
        </div>
        <div class="box-body text-center">
			Você possui <strong><?php echo $want_list_count; ?></strong>
			cartas únicas em sua want list.
		</div>
    </div>
</section>
<!-- Direita -->
<section class="col-lg-6">
	<div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Gerenciar coleção</h3>
        </div>
        <div class="box-body text-center">
			<a href="/mycards/bulk" class="btn btn-block btn-primary"><i class="fa fa-plus-circle"></i> Adicionar várias cartas à coleção</a>
			<a href="/mycards/import" class="btn btn-block btn-primary"><i class="glyphicon glyphicon-import"></i> Importar lista de cartas do Deckbox</a>
			<a href="/mycards/want" class="btn btn-block btn-primary"><i class="fa fa-list-ul"></i> Gerenciar want list</a>
		</div>
    </div>
</section>
<!-- Baixo -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Minha coleção pessoal</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="mycardslist" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Carta</th>
								<th width="1%">Qtd</th>
								<th width="1%">Troca</th>
                                <th width="15%">Raridade</th>
                                <th>Coleção</th>
                                <th width="1%">CMC</th>
								<!--th>Cor</th-->
								<th width="1%">Anotações</th>
                            </tr>
                        </thead>
                        <tbody id="card_list">
							<!-- Optei por colocar valores invisíveis para auxiliar na ordenação -->
							<?php
								// Listagem das cartas
								foreach ($collec as $c) {
							?>
                            <tr>
                                <td>
									<a href="#" rel="<?php echo $c['Card']['id']; ?>"><i class="fa fa-edit"></i> <?php echo $c['Card']['name']; ?></a>
									<?php
									if ($c['UserCard']['foil']) echo '<i class="fa fa-star" title="Carta Foil" alt="Carta Foil"></i>';
									?>

									<small class="pull-right"><?php
										// Montagem do custo de mana
										$cost = preg_match_all('/\{(\w+|\d+)\}/',$c['Card']['mana_cost'],$saida);
										foreach($saida[1] as $custo) {
											$custo = str_replace('/', '', $custo);
											echo "<img src=\"http://mtgimage.com/symbol/mana/$custo/16.png\">";
										}
									?></small>
								</td>
								<td class="text-center">
									<?php echo $c['UserCard']['quantity']; ?>
								</td>
                                <td>
									<?php echo $c['UserCard']['have_list']; ?>
									<span class="hide" id="orig-have-<?php echo $c['Card']['id']; ?>"><?php echo $c['UserCard']['have_list']; ?></span>
								</td>
                                <td class="text-center"><?php echo $this->Mtg->rarity($c['Card']['rarity']) ?></td>
                                <td><span class="hide"><?php echo $c['Set']['release']; ?></span><?php echo $c['Set']['code']; ?> <small class="pull-right"><img src="/img/sets_icons/<?php echo $c['Set']['code']; ?>.gif" width="20" alt="<?php echo $c['Set']['set_name']; ?>" title="<?php echo $c['Set']['set_name']; ?>"></small></td>
								<td class="text-center"><?php echo $c['Card']['cmc']; ?></td>
                                <!--td>
                                	<?php
										/*// Dividir em "tags" de cores
										$cores = explode(',', $c['Card']['colors']);
										if (in_array('white', $cores))
											echo '<img src="http://mtgimage.com/symbol/mana/w/16.png">';
										if (in_array('blue', $cores))
											echo '<img src="http://mtgimage.com/symbol/mana/u/16.png">';
										if (in_array('black', $cores))
											echo '<img src="http://mtgimage.com/symbol/mana/b/16.png">';
										if (in_array('red', $cores))
											echo '<img src="http://mtgimage.com/symbol/mana/r/16.png">';
										if (in_array('green', $cores))
											echo '<img src="http://mtgimage.com/symbol/mana/g/16.png">';*/
									?>
                                </td-->
								<td class="text-center">
									<?php if (!empty($c['UserCard']['note'])) { ?>
									<span class="hide" id="orig-note-<?php echo $c['Card']['id']; ?>"><?php echo $c['UserCard']['note']; ?></span>
									<button class="btn btn-sm" data-toggle="tooltip" title="<?php echo $c['UserCard']['note']; ?>"><i class="fa fa-pencil"></i></button>
									<?php } ?>
								</td>
                            </tr>
							<?php
								}
							?>	

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Carta</th>
								<th>Qtd</th>
								<th>Troca</th>
                                <th>Raridade</th>
                                <th>Coleção</th>
                                <th>CMC</th>
								<!--th>Cor</th-->
								<th>Anotações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->

<?php if (isset($ignored_import)): ?>
<!-- Modal - ignored -->
<div class="modal fade" id="ignored" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title">Lista de cartas ignoradas na importação</h4>
    </div>
    <div class="modal-body">
		<ul>
		<?php foreach ($ignored_import as $c) echo "<li>{$c}</li>"; ?>
		</ul>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      <!--input type="submit" class="btn btn-primary" value="Buscar"-->
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<!-- DATA TABES SCRIPT -->
<script src="/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="/js/mycards.js" type="text/javascript"></script>