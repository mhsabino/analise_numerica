$(function() {
	var gRuleSelect = $('select[name="rule"]'),
			gFunc = $('input[name="funcao"]'),
			gA = $('input[name="a"]'),
			gB = $('input[name="b"]'),
			gN = $('input[name="n"]');

	gRuleSelect.on('change', function() {
	  $.post(
	  	'controllers/funcoes.php',
	  	{
	  		funcao: gFunc.val(),
	  		a: gA.val(),
	  		b: gB.val(),
	  		n: gN.val(),
	  		rule: gRuleSelect.val()
	  	},
	  	function (aData) {
	  		$("#results").html(aData);
	  	}
	  );
	});

	$('input').focusout(function(){
		if ((gA.val() !== '') && (gB.val() !== '') &&
			  (gN.val() !== '') && (gFunc.val() !== '')) {
			gRuleSelect.prop( "disabled", false );
		} else {
			gRuleSelect.prop( "disabled", true );
			gRuleSelect.val('0');
		}
	});

	gA.keyup(function() {
		var valor = $(this).val().replace(/[^0-9.]+/g,'');
		$(this).val(valor);
	});

	gB.keyup(function() {
		var valor = $(this).val().replace(/[^0-9.]+/g,'');
		$(this).val(valor);
	});

	gN.keyup(function() {
		var valor = $(this).val().replace(/[^0-9.]+/g,'');
		$(this).val(valor);
	});		

});