<?php

include("conexion.php");

$cedula = $_POST['cedula'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$nombre = $nombres.' '.$apellidos;
$fechaNacimiento = $_POST['fecha1'];
$genero = $_POST['genero'];
$direccion = $_POST['direccion'];
$registrador = $_POST['registrador'];

if ($_POST['nombres']) {

		$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE ci=$cedula");

			if (mysqli_num_rows($consulta) > 0) {

				?>

				<br><br><br><br>
				<div align="center" class="cargando"><img src="img/cargando.gif"/><br><center>Enviado...</center></div>
				<div align="center" class="mensaje" style="display:none;"><center>Error: la cédula <b><?php echo $cedula; ?></b> ya está registrada</center></div>

				<script type="text/javascript">
					$(document).ready(function() {
    					setTimeout(function() {
        				$(".cargando").fadeOut(800);
    					},1000);
					});

					$(document).ready(function() {   
   			 			setTimeout(function() {
        				$(".mensaje").fadeIn(1200);
    					},2000);
					});

					$(document).ready(function() {   
   			 			setTimeout(function(){
   			  			location.reload();
   						}, 8000);
					});
				</script>

				<?php

			}else{
					mysqli_query($conexion,"INSERT INTO usuarios(ci,nombre,fNacimiento,sexo,direccion,registrador) 
					VALUES ('$cedula','$nombre','$fechaNacimiento','$genero','$direccion','$registrador')");

				?>

				<br><br><br><br>
				<div align="center" class="cargando"><img src="img/cargando.gif"/><br><center>Enviado...</center></div>
				<div align="center" class="mensaje" style="display:none;"><center>Se ha introducido los datos</center></div>

				<script type="text/javascript">
					$(document).ready(function() {
    					setTimeout(function() {
        				$(".cargando").fadeOut(800);
    					},1000);
					});

					$(document).ready(function() {   
   			 			setTimeout(function() {
        				$(".mensaje").fadeIn(1200);
    					},2000);
					});

					$(document).ready(function() {   
   			 			setTimeout(function(){
   			  			location.reload();
   						}, 4000);
					});
				</script>

				<?php
			}
}


?>