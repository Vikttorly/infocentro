<?php

include("conexion.php");

$visita = $_POST['visita'];
$idUsuario = $_POST['idUsuario'];
$funcionario = $_POST['funcionario'];

if (isset($_POST['visita'])) {
	mysqli_query($conexion,"INSERT INTO visitas(usuario,registrador) VALUES ($idUsuario,$funcionario)");
}

?>