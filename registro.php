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
	<title>EnanoFTP - Registro</title>
</head>
<body>
	<header>
		<div class="container">
			<a href="/enanoftp" style="text-decoration: none; color: #fff;"><h1><i class="fa fa-cloud-download"></i> EnanoFTP</a></h1>
		</div>
	</header>

<?php
error_reporting(0);
include('conexion.php');

$email = $_POST['email_registro'];
$contraseña_uno = $_POST['contraseña_uno'];
$contraseña_dos = $_POST['contraseña_dos'];

if (isset($_POST['enviar_registro'])) {

	//Comprobando sí el usuario está registrado.
	
	$sql = "SELECT * FROM usuarios WHERE email='$email'";
	$consulta = mysqli_query($conexion,$sql);
	$datos = mysqli_fetch_assoc($consulta);

	if ($email == $datos["email"]) {
		echo '

		<div class="container">
  			<div class="">
  				<div align="center" style="margin-top: 14%;">
    				<h1 class="text-sm-center text-danger"> <i class="fa fa-times fa-2x"></i> Este usuario ya está registrado</h1>
    					<div align="center">
    						<a href="/enanoftp" style="text-decoration:none;"><div class="boton-estandar">INTENTAR DE NUEVO</div></a>
    					</div>
    			</div>
  			</div>
		</div>

		';


	//De no existir...
	
	}else{
		$sql = "INSERT INTO usuarios (email,contrasena) VALUES ('$email','$contraseña_uno')";
		$consulta = mysqli_query($conexion, $sql) or die (mysqli_error($conexion));

		echo '

		<div class="container">
  			<div class="">
  				<div align="center" style="margin-top: 16%;">
    				<h1 class="text-sm-center text-success"> <i class="fa fa-check fa-2x"></i> Registro exitoso</h1>
    				<meta http-equiv="Refresh" content="3;url=/enanoFTP">
    			</div>
  			</div>
		</div>>

		';
	}
}else{

	/*En caso de que no se halla ingresado por el formulario sino que se halla entrado al documento registro.php directamente desde el navegador, se muestra en siguiente error: */

		echo '

		<div class="container">
  			<div class="">
  				<div align="center" style="margin-top: 16%;">
    				<h1 class="text-sm-center text-danger"> <i class="fa fa-chain-broken fa-2x"></i> Error de página</h1>
    				<meta http-equiv="Refresh" content="3;url=/enanoFTP">
    			</div>
  			</div>
		</div>>

		';
}

?>

<footer>
	<div class="container-fluid">
		<h3>Víctor Laya</h3>
	</div>
</footer>

</body>
</html>