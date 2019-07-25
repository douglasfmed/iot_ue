$(function(){
	$("#tabela_busca input").keyup(function(){

		var index = $(this).parent().index();
		var nth = "#tabela td:nth-child("+(index+1).toString()+")";
		var valor = $(this).val().toUpperCase();
		$("#tabela tbody tr").show();
		$(nth).each(function(){
			if($(this).text().toUpperCase().indexOf(valor) < 0){
				$(this).parent().hide();
			}
		});

	});

	$("#planta_busca input").keyup(function(){

		var index = $(this).parent().index();
		var nth = "#nome_planta";
		var valor = $(this).val().toUpperCase();

		var i;
		for(i = 1; i<=3; i++){
			$("#planta_"+i).show();

			$(nth).each(function(){

				if($(nth).text().toUpperCase().indexOf(valor) < 0){
					$("#planta_"+i).hide();
				} else{
					$("#planta_"+i).show();
				}
			});
		}



	});

	$("#tabela input").blur(function(){
		$(this).val("");
	});

	$("#planta_busca input").blur(function(){
		$(this).val("");
	});

});
