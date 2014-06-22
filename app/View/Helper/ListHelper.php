<?php

App::uses('AppHelper', 'View/Helper');

class ListHelper extends AppHelper {
	
	public $helpers = array('Mtg');
	
	/**
	 * Cria uma tabela ordenável a partir de uma card list
	 */
	public function table($card_list) {
		ob_start();
		?>
        <div class="box-body table-responsive">
            <table id="cardslist" class="table table-bordered table-striped">
                <thead>
                    <tr>
						<th width="120">&nbsp;</th>
                        <th>Carta</th>
                        <th>Raridade</th>
						<th>Tipo</th>
                        <th width="80">Coleção</th>
                        <th>CMC</th>
                    </tr>
                </thead>
                <tbody>
					<!-- Optei por colocar valores invisíveis para auxiliar na ordenação -->
					<?php
						// Listagem das cartas
						foreach ($card_list as $c) {
					?>
                    <tr>
						<td class="text-center">
							<a href="/cards/view/<?php echo $c['Card']['id']; ?>">
								<img src="<?php echo $this->Mtg->imageByMultiverseId($c['Card']['multiverseid']); ?>" width="100">
							</a>
						</td>
                        <td>
							<a href="/cards/view/<?php echo $c['Card']['id']; ?>"><strong><?php echo $c['Card']['name']; ?></strong></a> <small class="text-muted">(<?php echo ($c['Card']['name_en']); ?>)</small>
							<span class="pull-right"><?php echo $this->Mtg->manaCost($c['Card']['mana_cost']); ?> (<?php echo $c['Card']['cmc']; ?>)</span>
							<p>
							<small><?php echo nl2br($this->Mtg->manaCostInText($c['Card']['text'])); ?></small>
							</p>
						</td>
						<!-- Raridade -->
                        <td><?php echo $this->Mtg->rarity($c['Card']['rarity']); ?></td>
						<!-- Tipo -->
						<td><?php echo $c['Card']['type']; ?></td>
						<!-- Coleção -->
                        <td class="text-center">
							<span class="hide"><?php echo $c['Set']['release']; ?></span>
							<?php
								// Várias impressões?
								if (isset($c[0]['multi_codes'])) {
									$sets = explode(';', $c[0]['multi_codes']);
									foreach ($sets as $s) {
										$s = explode(',', $s);
										?>
										<img src="/img/sets_icons/<?php echo $s[0]; ?>.gif" title="<?php echo $s[1]; ?>">
										<?php
									}
								} else {
									?>
									<img src="/img/sets_icons/<?php echo $c['Set']['code']; ?>.gif" title="<?php echo $c['Set']['set_name']; ?>">
									<?php
								}
							?>
						</td>
						<td><?php echo $c['Card']['cmc']; ?></td>
                    </tr>
					<?php
						}
					?>	

                </tbody>
                <tfoot>
                    <tr>
						<th>&nbsp;</th>
                        <th>Carta</th>
                        <th>Raridade</th>
						<th>Tipo</th>
                        <th>Coleção</th>
                        <th>CMC</th>
                    </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
		<?php
		$out = ob_get_contents();
		ob_end_clean();
		
		return $out;
	}
	
	/**
	 * Cria uma tabela ordenável com variações para mostrar quantidade 
	 */
	public function tableProfile($card_list, $show_notes = false) {
		ob_start();
		?>
        <div class="box-body table-responsive">
            <table id="cardslist" class="table table-bordered table-striped">
                <thead>
                    <tr>
						<th width="120">&nbsp;</th>
                        <th>Carta</th>
                        <th>Quantidade</th>
                        <th>Raridade</th>
						<th>Coleção</th>
						<?php if ($show_notes): ?><th>Observações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
					<!-- Optei por colocar valores invisíveis para auxiliar na ordenação -->
					<?php
						// Listagem das cartas
						foreach ($card_list as $c) {
					?>
                    <tr>
						<td class="text-center">
							<a href="/cards/view/<?php echo $c['Card']['id']; ?>">
								<img src="<?php echo $this->Mtg->imageByMultiverseId($c['Card']['multiverseid']); ?>" width="100">
							</a>
						</td>
                        <td>
							<a href="/cards/view/<?php echo $c['Card']['id']; ?>"><strong><?php echo $c['Card']['name']; ?></strong></a> <small class="text-muted">(<?php echo ($c['Card']['name_en']); ?>)</small>
							<span class="pull-right"><?php echo $this->Mtg->manaCost($c['Card']['mana_cost']); ?> (<?php echo $c['Card']['cmc']; ?>)</span>
						</td>
						<td>
							<?php
								if (isset($c['UserCard']['quantity']))
									echo $c['UserCard']['quantity'];
								else
									echo $c['WantList']['quantity'];
							?>
						</td>
                        <td><?php echo $this->Mtg->rarity($c['Card']['rarity']); ?></td>
                        <td><span class="hide"><?php echo $c['Set']['release']; ?></span><?php echo $c['Set']['code']; ?> <small class="pull-right"><img src="/img/sets_icons/<?php echo $c['Set']['code']; ?>.gif" width="20"></small></td>
						<?php if ($show_notes): ?><td><?php echo $c['WantList']['note']; ?></td><?php endif; ?>
                    </tr>
					<?php
						}
					?>	

                </tbody>
                <tfoot>
                    <tr>
						<th>&nbsp;</th>
                        <th>Carta</th>
                        <th>Quantidade</th>
                        <th>Raridade</th>
                        <th>Coleção</th>
						<?php if ($show_notes): ?><th>Observações</th><?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
		<?php
		$out = ob_get_contents();
		ob_end_clean();
		
		return $out;
	}
	
	/**
	 * Cria uma tabela ordenável mais simples a partir de uma card list
	 */
	public function simpleTable($card_list) {
		ob_start();
		?>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Carta</th>
                        <th>Raridade</th>
                        <th>Coleção</th>
						<th width="5%">Qtd.</th>
                    </tr>
                </thead>
                <tbody>
					<!-- Optei por colocar valores invisíveis para auxiliar na ordenação -->
					<?php
						// Listagem das cartas
						foreach ($card_list as $c) {
					?>
                    <tr>
                        <td>
							<a href="/cards/view/<?php echo $c['Card']['id']; ?>"><strong><?php echo $c['Card']['name']; ?></strong></a> <small class="text-muted">(<?php echo ($c['Card']['name_en']); ?>)</small>
							<span class="pull-right"><?php echo $this->Mtg->manaCost($c['Card']['mana_cost']); ?> (<?php echo $c['Card']['cmc']; ?>)</span>
						</td>
                        <td><?php echo $this->Mtg->rarity($c['Card']['rarity']); ?></td>
                        <td><?php echo $c['Set']['code']; ?> <small class="pull-right"><img src="/img/sets_icons/<?php echo $c['Set']['code']; ?>.gif" width="20"></small></td>
						<td>
							<?php
								if (isset($c['UserCard']['quantity']))
									echo $c['UserCard']['quantity'];
								else
									echo $c['WantList']['quantity'];
							?>
						</td>
                    </tr>
					<?php
						}
					?>	

                </tbody>
            </table>
        </div><!-- /.box-body -->
		<?php
		$out = ob_get_contents();
		ob_end_clean();
		
		return $out;
	}
	
}