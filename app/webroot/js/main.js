$(function(){
	options = {
		serviceUrl:'/cards/ajax',
		minChars: 3,
		onSelect: function() { $('#quickform').submit(); }
	};
	a = $('#quicksearch').autocomplete(options);
});