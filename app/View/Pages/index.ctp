<!-- Esquerda -->
<section class="col-lg-6">
	<!-- Bem-vindo -->
	<div class="box box-info">
        <div class="box-header">
            <i class="fa fa-envelope"></i>
            <h3 class="box-title">Seja bem-vindo ao <?php echo $projectName; ?></h3>
        </div>
        <div class="box-body">
			<p>
				O <?php echo $projectName; ?> é um site desenvolvido por Rafael Jaques
				com o intuito de simplificar a troca de cartas e socialização
				entre jogadores de Magic dentro do Rio Grande do Sul.
			</p>
			<p>
				Fique a vontade para explorar nossa
				<a href="/cards">Enciclopédia de Cartas</a> e para utilizar
				nosso gerencimento de coleções.
			</p>
			<p>
				Se você ainda não possui sua conta na página,
				<a href="/users/add">cadastre-se</a> agora mesmo!
			</p>
		</div>
    </div>
	
	<!-- Novidades -->
	<div class="box box-info">
        <div class="box-header">
            <i class="fa fa-bell-o"></i>
            <h3 class="box-title">Atualizações do sistema</h3>
        </div>
		<div class="box-body no-padding">
			<table class="table">
			    <tbody>
				<tr>
			        <th width="22%">Quando</th>
			        <th>O quê?</th>
			    </tr>
				<tr>
			        <th>17 de Junho</th>
			        <td>
			        	<ul>
							<li>Edição básica de cartas na coleção/want list.</li>
							<li>Opção de login persistente.</li>
							<li>Os perfis agora indicam se a pessoa está online.</li>
							<li>Implementadas informações adicionais sobre os usuários.</li>
						</ul>
					</td>
				</tr>
			    <tr>
			        <th>16 de Junho</th>
			        <td>
			        	<ul>
							<li><strong>Enciclopédia:</strong> traduzidas as cartas da M14 e do bloco de Theros.</li>
							<li>Sistema de consulta de preço médio em testes.</li>
							<li>Adicionados os ícones de mana nos textos das cartas.</li>
							<li>Os perfis, coleções, want e have lists agora são públicos.</li>
							<li>Os perfis agora são acessados com o username do jogador.</li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>13 de Junho</th>
			        <td>
			        	<ul>
							<li><strong>Enciclopédia:</strong> adicionadas M10, M11 e os blocos de Fragmentos de Alara e Zendikar.</li>
							<li>Implementada busca de pessoas na tela de amigos.</li>
							<li>Melhorada a apresentação da lista de amigos.</li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>12 de Junho</th>
			        <td>
			        	<ul>
							<li><strong>Enciclopédia:</strong> adicionadas Conspiracy, Jace vs. Vraska, M12 e o bloco de Cicatrizes de Mirrodin.</li>
							<li>Sistema de "Encontrar alguém que tenha esta carta"</li>
							<li>Corrigida a ordenação das tabelas de cartas</li>
							<li>Implementado o botão de "Notificar algo errado com essa carta"</li>
							<li>Implementado sistema de rotacionar a visualização da carta</li>
							<li>Liberado sistema de <strong>testes</strong> para bate-papo <strong>básico</strong></li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>11 de Junho</th>
			        <td>
			        	<ul>
							<li><strong>Enciclopédia:</strong> adicionadas M13, M14, Modern Masters e os blocos de Retorno a Ravnica e Innistrad.</li>
							<li>Cartas com dois nomes, por enquanto, só estão respondendo ao primeiro nome.</li>
							<li>Aumentado o limite de retorno da busca para 50 cartas. Ainda não é o ideal, mas é preciso para evitar sobrecargas enquanto eu otimizo o sistema.</li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>10 de Junho</th>
			        <td>
			        	<ul>
							<li>Sistema de notificações</li>
							<li>Sistema de amizades</li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>9 de Junho</th>
			        <td>
			        	<ul>
							<li>Domínio alterado para magicrs.com.br</li>
							<li>Aprimorado sistema de want e have list</li>
							<li>Sistema de perfis</li>
							<li>Adicionar foto aos perfis</li>
						</ul>
			        </td>
			    </tr>
				
			    <tr>
			        <th>8 de Junho</th>
			        <td>
			        	<ul>
							<li>Sistema vai ao ar no domínio magic.rpgbento.com.br</li>
							<li>Sistema de busca de cartas</li>
							<li>Compartilhamento de cartas no facebook</li>
							<li><strong>Enciclopédia:</strong> adicionado bloco de Theros</li>
						</ul>
			        </td>
			    </tr>
			</tbody></table>
		</div>
    </div>
</section>

<!-- Direita -->
<section class="col-lg-6 connectedSortable ui-sortable">
    <!-- Map box -->
    <div class="box box-primary">
        <div class="box-header">
            <i class="glyphicon glyphicon-star"> </i>
            <h3 class="box-title">
                Carta do Dia
            </h3>
        </div>
        <div class="box-body text-center" style="padding-top:0">
			<h3 style="margin-top:0;"><?php echo $cod['Card']['name']; ?></h3>
			<p><small class="text-muted"><?php echo $cod['Card']['name_en']; ?></small></p>
			<a href="/cards/view/<?php echo $cod['Card']['id']; ?>">
			<img src="<?php echo $this->Mtg->imageByMultiverseId($cod['Card']['multiverseid']); ?>" width="230" alt="<?php echo $cod['Card']['name']; ?>" title="<?php echo $cod['Card']['name']; ?>">
			</a>
        </div><!-- /.box-body-->
		<div class="box-body text-center">
			A carta do dia é escolhida aleatoriamente entre todas as cartas cadastradas
			em nossa <a href="/cards">Enciclopédia de Cartas</a>.
		</div>
    </div>
    <!-- /.box -->

</section>