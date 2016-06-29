<!DOCTYPE html>
<html>
<body>

<?php

	$bd = "infocentro";
	$server = "localhost";
	$user = "root";
	$password= "";


	$conexion = @mysqli_connect($server, $user, $password, $bd);

	if( !$conexion ) die( '
		
	<div class="container">
  		<div class="">
  			<div align="center" style="margin-top: 16%;">
    			<h1 class="text-sm-center text-danger"> <i class="fa fa-database fa-2x"></i> Error al conectar con la base de datos</h1>
    		</div>
  		</div>
	</div>>

		
	<footer>
		<div class="container-fluid">
			<h3>Víctor Laya</h3>
		</div>
	</footer>
	
		');

?>



</body>
</html>