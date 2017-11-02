jQuery(document).ready(function($) {
	$('#btnCargarFiguritas').on('click', function(){
		$.ajax({
			url : '/Figurettis/figuritas/leerCSV',
			type : 'POST',
			dataType : 'JSON',
			async: false
		})
		.done(function(response){
			if(response["error"] == "0"){
				var figuritas = response["content"];
				for(var i = 1; i < figuritas.length; i++){
					//console.log('/Figurettis/figuritas/agregarFigurita/' + figuritas[i]['numero'] + '/' + figuritas[i]['nombre'] + '/' + figuritas[i]['codigoPais']);
					$.ajax({
						url : '/Figurettis/figuritas/agregarFigurita/' + figuritas[i]['numero'] + '/' + figuritas[i]['nombre'] + '/' + figuritas[i]['codigoPais'],
						type : 'POST',
						async : false
					})
					.done(function(response){
						console.log(response);
					})
					.fail(function(error, err, e){
						console.log(e);
					})
				}
				$('#alert').slideDown();
			}
		})
		.fail(function(error, err, e){
			console.log(e);
		});
	})
});