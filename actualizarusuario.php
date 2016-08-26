<?php

error_reporting(0);

include("conexion.php");

$var = 0;
$foo = 'NADA';
$id = $_POST['idUsuario'];
$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$dia = $_POST['calendarioDia'];
$mes = $_POST['calendarioMes'];
$anio = $_POST['calendarioAnio'];
$genero = $_POST['genero'];
$direccion = $_POST['direccion'];

$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id=$id");

if ($_POST['cedula']) {

	$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE ci=$cedula");

	while ($resultado = mysqli_fetch_assoc($consulta)) {
	$cedulaControl = $resultado['ci'];
	}

	if ($cedulaControl == $cedula) {
		$foo = 'NO';
	}else{
		mysqli_query($conexion,"UPDATE usuarios SET ci=$cedula WHERE id=$id");
		$var++;
		$foo = 'SI';
	}
}

if ($_POST['nombres']) {
	mysqli_query($conexion,"UPDATE usuarios SET nombre='$nombres' WHERE id=$id");
	$var++;
}

if ($_POST['calendarioDia']) {
	$fNacimiento = $anio.'-'.$mes.'-'.$dia;
	mysqli_query($conexion,"UPDATE usuarios SET fNacimiento='$fNacimiento' WHERE id=$id");
	$var++;
}

if ($_POST['calendarioMes']) {
	$fNacimiento = $anio.'-'.$mes.'-'.$dia;
	mysqli_query($conexion,"UPDATE usuarios SET fNacimiento='$fNacimiento' WHERE id=$id");
	$var++;
}

if ($_POST['calendarioAnio']) {
	$fNacimiento = $anio.'-'.$mes.'-'.$dia;
	mysqli_query($conexion,"UPDATE usuarios SET fNacimiento='$fNacimiento' WHERE id=$id");
	$var++;
}

if ($_POST['genero']) {
	mysqli_query($conexion,"UPDATE usuarios SET sexo='$genero' WHERE id=$id");
	$var++;
}

if ($_POST['direccion']) {
	mysqli_query($conexion,"UPDATE usuarios SET direccion='$direccion' WHERE id=$id");
	$var++;
}

if ($var > 0 AND $foo == 'SI') {
	echo "Datos introducidos correctamente";
}elseif ($var > 0 AND $foo == 'NADA') {
	echo "Datos introducidos correctamente";
}else{
	echo "Error: Esta cedula ya esta registrada";
}

?>