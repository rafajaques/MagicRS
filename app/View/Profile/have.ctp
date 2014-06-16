<!-- Coleção -->
<section>
	<!-- Coleção -->
	<div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Have list de <?php echo $profile['full_name']; ?></h3>
        </div>
		<div class="box-body no-margin">
			<a href="/profile/view/<?php echo $profile['id']; ?>" class="btn btn-block btn-primary">
				<i class="fa fa-user"></i> Ir ao perfil
			</a>
		</div>
		<div class="box-body">
	        <?php
				// Helper que usa a $card_list para montar a lista ordenada
				echo $this->List->tableProfile($card_list);
			?>
		</div>
	</div>
	
</section>

<script src="/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="/js/cards.js" type="text/javascript"></script>