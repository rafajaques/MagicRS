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

		var have = $.trim($("#orig-have-"+id_card).html()) ? ' checked="checked"' : '';

		var note = $.trim($("#orig-note-"+id_card).html());
		
		// Conteúdo da janela de edição
		var content	=	'<tr class="edit-card" id="edit_'+id_card+'">';
		content	+=		'<td colspan="7" style="padding:20px">';
		
		content	+=		'<div class="col-xs-6">';
		content	+=		' <div class="form-group">';
		content	+=		'  <label for="quantity_'+id_card+'">Quantidade</label>';
		content	+=		'  <input type="number" class="form-control" id="quantity_'+id_card+'" class="input-sm" value="'+quantity+'">';
		content	+=		' </div>';
		content	+=		' <div class="checkbox form-group" style="margin-top:10px;">';
		content	+=		'  <label><input type="checkbox" id="have_'+id_card+'"'+have+'>';
		content	+=		'  Mostrar na have list (está disponível para negócio)</label>';
		content	+=		' </div>';

		content	+=		' <div class="form-group" style="display:block;margin-top:10px">';
		content	+=		' <button id="save_'+id_card+'" rel="'+id_card+'" class="btn btn-success"><i class="fa fa-pencil"></i> Gravar atualização</button>';
		content	+=		' </div>';
		content	+=		'</div>';
		
		content	+=		'<div class="col-xs-6">';
		content	+=		' <div class="form-group">';
		content	+=		'  <label for="note_'+id_card+'">Anotações</label>';
		content	+=		'  <input type="text" class="form-control" id="note_'+id_card+'" class="input-sm" value="'+note+'">';
		content	+=		' </div>';
		content	+=		' <div class="form-group pull-right" style="margin-top:95px">';
		content	+=		' <button id="remove_'+id_card+'" rel="'+id_card+'" class="btn btn-danger"><i class="fa fa-times"></i> Remover da coleção</button>';
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
				"have_list": $("#have_"+id).is(":checked")
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
		
		$("#remove_"+id_card).click(function(){
			var id = $(this).attr("rel");
			alert("Não implementado "+id);
		});
		
		return false;
	});
});