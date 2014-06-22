<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Importar lista de cartas do Deckbox</h3>
        </div><!-- /.box-header -->
		<form method="post" action="/mycards/import" enctype="multipart/form-data">
        <div class="box-body">

			<p>
				Aqui você pode importar sua lista de cartas do <a href="http://deckbox.org" target="_blank">deckbox.org</a>.<br>
				Envie o arquivo exportado e aguarde até que a importação esteja pronta. Depois apenas confirme a gravação dos dados.<br>
				Caso alguma edição não seja encontrada no banco de dados, a edição mais recente será tomada como padrão.
			</p>
			<p>
				<span class="danger-text">Importante:</span> Terrenos não são importados e os valores de condição e promo da carta são desprezados. Cartas iguais mas de línguas diferentes serão agrupadas.
			</p>
			<p>
				<?php
					echo $this->Form->input('import', array(
						'type' => 'file',
						'label' => 'Arquivo CSV',
					));
				?>
			</p>

		</div>
		<div class="clear">&nbsp;</div>
		<div class="box-footer">
			<div><input type="submit" class="btn btn-success" value="Enviar arquivo" id="send-csv" onclick="$('#loading').modal('show');" /></div>
			<div class="clear"></div>			
		</div>
		</form>
	</div>
</div>

<!-- Modal - Loading -->
<div class="modal fade" id="loading" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-body">
		<div id="progress">
		    <ul class="loading">
		        <li class="msg">Aguarde</li>
		        <li class="dot one"></li>
		        <li class="dot two"></li>
		        <li class="dot three"></li>
		    </ul>
		</div>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
