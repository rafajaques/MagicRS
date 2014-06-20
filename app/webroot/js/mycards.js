$(function() {
    $('#mycardslist').dataTable({
        "paging":   false,
    });
	
	$("#card_list a").click(function() {
		
		// Já foi aberto?
		var next = $(this).parent().parent().next();
		if (next.hasClass("edit-card")) {
			next.toggle();
			return false;
		}
		
		var id_card = $(this).attr("rel");
		
		var data = $(this).parent();
		
		var quantity = $.trim(data.next().html());

		var have = $.trim($("#orig-have-"+id_card).html());

		var note = $.trim($("#orig-note-"+id_card).html());
		
		var foil = $(this).parent().find(".fa-star").length == 1;
		
		// Conteúdo da janela de edição
		var content	=	'<tr class="edit-card" id="edit_'+id_card+'">';
		content	+=		'<td colspan="7" style="padding:20px">';
		
		content	+=		'<div class="col-xs-4">';
		content	+=		' <div class="form-group">';
		content	+=		'  <label for="quantity_'+id_card+'">Quantidade</label>';
		content	+=		'  <input type="number" class="form-control" id="quantity_'+id_card+'" class="input-sm" value="'+quantity+'">';

		content	+=		'  <label for="have_'+id_card+'">Quantidade disponível para negócio</label>';
		content	+=		'  <input type="number" class="form-control" id="have_'+id_card+'" class="input-sm" value="'+have+'">';
		content	+=		' </div>';


		content	+=		' <div class="form-group" style="display:block;margin-top:10px">';
		content	+=		' <button id="save_'+id_card+'" rel="'+id_card+'" class="btn btn-success"><i class="fa fa-pencil"></i> Gravar atualização</button>';
		content	+=		' </div>';
		content	+=		'</div>';
		
		content	+=		'<div class="col-xs-8">';
		content	+=		' <div class="form-group">';
		content	+=		'  <label for="note_'+id_card+'">Anotações</label>';
		content	+=		'  <input type="text" class="form-control" id="note_'+id_card+'" class="input-sm" value="'+note+'">';
		content	+=		' </div>';
		
		if (foil) {
			content	+=		'<div class="clear">&nbsp;</div> <div class="form-group"><i class="fa fa-star"></i> Carta Foil</div>';
		}
		
		// Formulário de remoção
		content	+=		' <div class="clear">&nbsp;</div><div class="form-group" style="margin-top:10px">';
		content += 		'  <form action="/mycards/remove/" method="post" onsubmit="return confirm(\'Tem certeza que deseja remover esta carta da sua coleção?\')">';
		content +=		'  <input type="hidden" name="id_card" value="'+id_card+'">';
		content +=		'  <input type="hidden" name="foil" value="'+(foil ? "1" : "0")+'" id="foil_'+id_card+'">';
		content	+=		'  <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Remover da coleção</button>';
		content	+=		'  </form>';
		content	+=		' </div>';
		content	+=		'</div>';
		
		content	+=		'</td>';
		content	+=		'</tr>';
			
		$(this).parent().parent().after(content);
		
		// Anexa os eventos na hora de gravar e apagar
		$("#save_"+id_card).click(function(){
			var id = $(this).attr("rel");
			
			sData = {
				"id_card": id,
				"quantity": $("#quantity_"+id).val(),
				"note": $("#note_"+id).val(),
				"have_list": $("#have_"+id).val(),
				"foil": $("#foil_"+id).val()
			};
			
			$.post("/mycards/update", sData, function(data) {
				if (data == 1) {
					alert("Dados salvos. Esta é uma implementação básica de edição. Por enquanto você só poderá ver as atualizações após atualizar a página.");
					$("#edit_"+sData["id_card"]).remove();
				} else {
					alert("Ops! Ocorreu algum erro. Tente novamente.");
				}
			});
		});
				
		return false;
	});
});