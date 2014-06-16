<div class="callout callout-danger">
    <h4>Atenção!</h4>
    <p>
    	Esta área ainda está em implementação e parece ser mais instável do que as demais.
	</p>
	<p>
		Sugestões são bem-vindas. Tenha em mente que podem ocorrer situações inesperadas, mas não há com o que se preocupar! :)
    </p>
</div>
<!-- Esquerda -->
<section class="col-lg-5">
	<div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-male"></i> Buscar pessoas</h3>
        </div>
        <div class="box-body text-center">
			<form role="form" action="/friends" method="post">
				<div class="input-group input-group">
					<?php
						echo $this->Form->input('search', array(
							'class' => 'form-control',
							'placeholder' => 'Nome, sobrenome ou nickname',
							'label' => false,
						));
					?>
				    <span class="input-group-btn">
				        <input type="submit" class="btn btn-primary btn-flat" value="Buscar cartas">
				    </span>
				</div><!-- /input-group -->
			</form>
			
			<?php
				if (isset($s_result)):
			?>
			
			<div class="box-body">
				<?php
				$s_total = count($s_result);
				
				if ($s_total == 1)
					echo 'Encontrado <strong>1</strong> resultado para a sua pesquisa.';
				elseif ($s_total)
					echo 'Encontrados <strong>1</strong> resultado para a sua pesquisa.';
				else
					echo 'Nenhum resultado encontrado para a sua pesquisa.';
				?>
			</div>
			
			<?php if ($s_total) { ?>
			<div class="box-body no-padding">
	            <table class="table table-condensed">
	                <tbody><tr>
	                    <th style="width: 10px">&nbsp;</th>
	                    <th>Nome</th>
						<th>Cidade</th>
	                </tr>
					<?php
					foreach ($s_result as $f):
						$id = $f['User']['id'];
						$name = $f['User']['name'].' '.$f['User']['surname'];
						$city = $f['City']['city_name'];
						$nick = $f['User']['username'];
						?>

	                <tr>
	                    <td><img src="<?php echo $this->User->getAvatar($id); ?>" width="70"></td>
	                    <td>
							<a href="/profile/view/<?php echo $id; ?>">
								<?php echo $name; ?>
							</a> (<?php echo $nick; ?>)
						</td>
						<td><?php echo $city; ?></td>
	                </tr>
					<?php
					endforeach;
					?>
	            </tbody>
			</table>
	       </div>
			<?php
				}
			endif;
			?>
		</div>
    </div>
</section>
<!-- Direita -->
<section class="col-lg-7">
	<div class="box box-info">
        <div class="box-header">
            <h3 class="box-title"><i class="fa fa-users"></i> Lista de amigos</h3>
        </div>
		
		<?php if (count($friends)): ?>
		<div class="box-body no-padding">
            <table class="table table-condensed">
                <tbody><tr>
                    <th style="width: 10px">&nbsp;</th>
                    <th>Nome</th>
                    <th>Nickname</th>
					<th>Cidade</th>
                    <th style="width: 40px">&nbsp;</th>
                </tr>
				<?php
				foreach ($friends as $f):
					$id = $f['User']['id'];
					$name = $f['User']['name'].' '.$f['User']['surname'];
					$city = $f['City']['city_name'];
					$nick = $f['User']['username'];
					?>

                <tr>
                    <td><img src="<?php echo $this->User->getAvatar($id); ?>" width="70"></td>
                    <td>
						<a href="/profile/view/<?php echo $id; ?>">
							<?php echo $name; ?>
						</a>
					</td>
                    <td><?php echo $nick; ?></td>
					<td><?php echo $city; ?></td>
                    <td>
						<a href="#" class="btn btn-primary" onclick="chatWith('<?php echo $nick; ?>')">
							<i class="fa fa-comment"></i> Conversar
						</a>
					</td>
                </tr>
				<?php
				endforeach;
				?>
            </tbody>
		</table>
       </div>
	   <?php else: ?>
	   <div class="box-body text-center">
		   Você ainda não tem amigos :(
	   </div>
	   <?php endif; ?>
		
    </div>
</section>