<!DOCTYPE html>
<html>
<head>
	
	<base href="/Figurettis/">
	{include file="bs_js.tpl"}
	<title>{$location} - Figurettis</title>
	<script src = "js/cargarFiguritas.js"></script>
</head>
<body>
	<div class = "container">
		<center><h1>Carga de figuritas de álbum del mundial Road To Russia 2018</h1></center>
		<br><br>
		<center><button class = "btn btn-primary" id = "btnCargarFiguritas">Cargar figuritas</button></center>
		<br><br>
		<div class = "alert alert-success" id = "alert" style = "display: none">
			<center>Figuritas cargadas de manera correcta en la base de datos</center>
		</div>
	</div>
</body>
</html>