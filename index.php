<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validacion.js"></script>
	<title>Inicio - Control de visitas</title>
</head>
<body>
	<header>
		<div class="container">
			<a href="/infocentro" style="text-decoration: none; color: #fff;"><h1><img src="img/logo1.png" width="70"> Inicio</a></h1>
		</div>
	</header>
<?php

	error_reporting(0);
	session_start();

	if ($_SESSION['usuario']) {
		header("Status: 301 Moved Permanently", false, 301);
		header("Location: tablero.php");
	}

?>

<div class="container principal">
<a href="#"><div class="caja-boton-registro">INGRESO</div></a>

<div class="container contenedor">
	<div class="ingreso">
		<div class="col-md-8 col-md-offset-2">
			<form method="post" action="ingreso.php" autocomplete="off">
				<div class="form-group">
					<label for="usuario">Correo Electrónico: </label>
					<input type="usuario" class="form-control" id="usuario_ingreso" placeholder="Correo Electrónico" name="usuario_ingreso" required>
				</div>
				<div class="form-group">
					<label for="contraseña">Contraseña: </label>
					<input type="password" class="form-control" id="contraseña" placeholder="Contraseña" name="contraseña_ingreso" required>
				</div>
				<button type="submit" class="btn btn-default" id="Enviar" name="enviar_ingreso">Ingresar </button>
			</form>
		</div>
	</div>
</div>
</div>

<footer>
	<div class="container-fluid">
		<img src="img/logo2.png" width="250" style="margin-left:5%;">
	</div>
</footer>

</body>
</html>