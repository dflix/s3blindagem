$(function(){
	debuga = $('.resposta');
	enviar = $('form[name="insert"]');
	action = 'insert.php';

	
	function resposta(datas){
		//alert(datas);
		debuga.empty().html('<p>'+datas+'</p>');
	}
	

	
	enviar.submit(function(){
		var postar = $.post(action,$(this).serialize());
		postar.progress( resposta('<img src="images/load.gif" width="20"> Carregando...') );
		postar.done( resposta );
		postar.fail(function(){
			resposta('Erro ao enviar');
		});
		return false;	
	});

        

});


