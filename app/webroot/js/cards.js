$(function() {
	// Se existe tabela de cartas
	if ($('#cardslist').length) {
	    $('#cardslist').dataTable({
	    	"oLanguage": {
				"sSearch": "Refinar nesta pesquisa:"
			},
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': [ 0 ] }
			]
	    });
	}
	
	// Se existe botão de rotação
	if ($('#rotate').length) {
		$('#rotate').click(function(){
			$("#card").toggleClass("rotate");
		});
	}
	
});