<?php

require('conexion.php');

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	$consulta = mysqli_query($conexion, "SELECT * FROM personas
	WHERE ci LIKE '%$consultaBusqueda%' 
	OR nombres LIKE '%$consultaBusqueda%'
	OR apellidos LIKE '%$consultaBusqueda%'
	");

	//Obtiene la cantidad de filas que hay en la consulta
	$filas = mysqli_num_rows($consulta);

	//Si no existe ninguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
	if ($filas === 0) {

			?>
		<br><br><br>
		<center><p>No se ha encontrado ninguna persona relacionada con estos datos</p>
		 <button type="button" id="ClickMostrarRegistro2" class="btn btn-danger">Agregar Usuario</button></center>

			<?php

	} else {
		//Si existe alguna fila que sea igual a $consultaBusqueda, entonces mostramos el siguiente mensaje
		echo 'Resultados para <strong>'.$consultaBusqueda.'</strong>';

		//La variable $resultado contiene el array que se genera en la consulta, así que obtenemos los datos y los mostramos en un bucle
		while($resultados = mysqli_fetch_array($consulta)) {
			$ci = $resultados['ci'];
			$nombres = $resultados['nombres'];
			$apellidos = $resultados['apellidos'];
			$fNacimiento = $resultados['fNacimiento'];

			function calculaEdad($fNacimiento){
				list($ano,$mes,$dia) = explode("-",$fNacimiento);
				$ano_diferencia  = date("Y") - $ano;
				$mes_diferencia = date("m") - $mes;
				$dia_diferencia   = date("d") - $dia;
				if ($dia_diferencia < 0 || $mes_diferencia < 0)
					$ano_diferencia--;
				return $ano_diferencia;
			}

			$edad = calculaEdad($fNacimiento);

			//Output
			$mensaje .= '  
			<tr><td>'.$ci.'</td><td>'.$nombres.'</td><td>'.$apellidos.'</td><td>'.$edad.'</td><td><span class="glyphicon glyphicon-triangle-top" aria-hidden="true"></span></td><td><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></td>
			</tr>
			';

			?>

			<table class="table table-condensed">
				<tr class="info">
					<td><strong>Cédula</strong></td>
					<td><strong>Nombres</strong></td>
					<td><strong>Apellidos</strong></td>
					<td><strong>Edad</strong></td>
					<td><strong>Entrada</strong></td>
					<td><strong>Salida</strong></td>
				</tr>
					<?php
						echo $mensaje;
					?>
			</table>

			<?php

		};

	}; 

};

?>

<script>
	$("#ClickMostrarRegistro2").click(function(){
            $('.MostrarRegistro').show();
            $('.MostrarHistorial').hide();
            $('.MostrarInicio').hide();
         });
</script>