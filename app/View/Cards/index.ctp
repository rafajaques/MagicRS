<!-- card/index.ctp -->
<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><i class="fa fa-search"></i> Busca de cartas</h3>
    </div><!-- /.box-header -->
	<form role="form" action="/cards" method="post">
        <div class="box-body">
			<div class="input-group input-group-lg">
				<?php
					echo $this->Form->input('text', array(
						'class' => 'form-control input-lg',
						'placeholder' => 'Digite o nome da carta...',
						'label' => false,
					));
				?>
			    <span class="input-group-btn">
			        <input type="submit" class="btn btn-primary btn-flat" value="Buscar cartas">
			    </span>
			</div><!-- /input-group -->
			<div class="form-group"><?php echo $this->Form->input('set', array(
															'options' => $sets,
															'empty' => 'Todas as coleções',
															'label' => '',
															'class' => 'form-control',
														)); ?>
			</div>
		    <div class="form-group"> 
	           <div class="checkbox">
				   <label>
	                   <input type="checkbox" name="have" value="1"<?php if (isset($sHave)) echo $sHave; ?> />
	                   Buscar apenas cartas que estejam em <strong>have lists</strong> da região
	               </label>                                                
	           </div>
		    </div>
		    <div class="form-group"> 
	           <div class="checkbox">
	               <label>
	                   <input type="checkbox" name="colors[]" value="white" <?php if (isset($sWhite)) echo $sWhite; ?>>
	                   <img src="http://mtgimage.com/symbol/mana/w/16.png"> Brancas
	               </label>
				   &nbsp;                                                
	               <label>
	                   <input type="checkbox" name="colors[]" value="blue" <?php if (isset($sBlue)) echo $sBlue; ?>>
	                   <img src="http://mtgimage.com/symbol/mana/u/16.png"> Azuis
	               </label>
				   &nbsp;                                                
	               <label>
	                   <input type="checkbox" name="colors[]" value="black" <?php if (isset($sBlack)) echo $sBlack; ?>>
	                   <img src="http://mtgimage.com/symbol/mana/b/16.png"> Pretas
	               </label>
				   &nbsp;                                                
	               <label>
	                   <input type="checkbox" name="colors[]" value="red" <?php if (isset($sRed)) echo $sRed; ?>>
	                   <img src="http://mtgimage.com/symbol/mana/r/16.png"> Vermelhas
	               </label>
				   &nbsp;                                                
	               <label>
	                   <input type="checkbox" name="colors[]" value="green" <?php if (isset($sGreen)) echo $sGreen; ?>>
	                   <img src="http://mtgimage.com/symbol/mana/g/16.png"> Verdes
	               </label>
	           </div>
			    <div class="form-group"> 
		           <div class="checkbox">
		               <label>
					   <?php
			   			echo $this->Form->checkbox('all_mana', array(1));
						?>
						Buscar apenas cartas que contenham todas as manas selecionadas
		               </label>                                                
		           </div>
			    </div>
		   </div>
		   <p>Se nenhuma cor de mana for marcada, serão listadas cartas de qualquer cor.</p>
		</div>
	</form>
</div>
<?php if (isset($card_list)) { ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Resultado da sua busca por <strong><?php echo $this->request->data['text'];?></strong></h3>		
    </div><!-- /.box-header -->
	<div class="box-body">
		<?php if (($count = count($card_list)) == 100) { ?>
		<p>Foram encontrados <strong>100 resultados ou mais</strong>. No período de testes esse é o máximo disponibilizado na busca para não sobrecarregar o servidor.</p>
		<?php } elseif ($count == 1) { ?>
		<p>Foi encontrado <strong>1</strong> resultado:</p>
		<?php } else { ?>
		<p>Foram encontrados <strong><?php echo $count; ?></strong> resultados:</p>
		<?php } ?>
		
        <?php
			// Helper que usa a $card_list para montar a lista ordenada
			echo $this->List->table($card_list);
		?>
	</div>
</div>
<script src="/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="/js/cards.js" type="text/javascript"></script>
<?php } ?>