<?php

session_start();
require('conexion.php');

?>

<input type="hidden" id="funcionario" value="<?php echo $_SESSION['usuario']?>">

<?php

//Variable de búsqueda
$consultaBusqueda = $_POST['valorBusqueda'];

//Filtro anti-XSS
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/");
$caracteres_buenos = array("& lt;", "& gt;", "& quot;", "& #x27;", "& #x2F;", "& #060;", "& #062;", "& #039;", "& #047;");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

//Variable vacía (para evitar los E_NOTICE)
$mensaje = "";

$dia = date("d");
$mes = date("m");
$año = date("Y");
$hoy = $dia.'/'.$mes.'/'.$año;


//Comprueba si $consultaBusqueda está seteado
if (isset($consultaBusqueda)) {

	//Selecciona todo de la tabla mmv001 
	//donde el nombre sea igual a $consultaBusqueda, 
	//o el apellido sea igual a $consultaBusqueda, 
	//o $consultaBusqueda sea igual a nombre + (espacio) + apellido
	$consulta = mysqli_query($conexion, "SELECT *, YEAR(CURDATE())-YEAR(fNacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(fNacimiento,'%m-%d'), 0, -1) AS edadActual FROM usuarios 
	WHERE ci LIKE '%$consultaBusqueda%' 
	OR nombre LIKE '%$consultaBusqueda%'
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
		while($resultados = mysqli_fetch_assoc($consulta)) {
			$id = $resultados['id'];
			$ci = $resultados['ci'];
			$nombre = $resultados['nombre'];
			$fNacimiento = $resultados['fNacimiento'];
			$edad = $resultados['edadActual'];

			$consultaFecha = mysqli_fetch_assoc(mysqli_query($conexion,"SELECT DATE_FORMAT(fEntrada,'%d/%m/%Y') AS fecha_sola FROM visitas WHERE usuario=$id ORDER BY fEntrada ASC"));
			$ultimaVisita = $consultaFecha['fecha_sola'];
			$nVisitas = mysqli_fetch_assoc(mysqli_query($conexion,"SELECT count(*) AS nVisitas FROM visitas WHERE usuario=$id"));
			
			if ($hoy == $ultimaVisita) {
				$ultimaVisita = 'Hoy';
			}

			//Output
			$mensaje .= '  
			<tr><td><div><input type="hidden" id="idUsuario" value="'.$id.'">'.$ci.'</div></td><td>'.$nombre.'</td><td>'.$edad.'</td><td>'.$nVisitas['nVisitas'].'</td><td>'.$ultimaVisita.'</td><td><i class="fa fa-plus-square" aria-hidden="true" id="visitado"></i></td>
			</tr>
			';
}
			?>

			<table class="table table-condensed">
				<tr bgcolor= "#8299af" style="color:white;">
					<td><strong>Cédula</strong></td>
					<td><strong>Nombres y Apellidos</strong></td>
					<td><strong>Edad</strong></td>
					<td><strong>Nº Visitas</strong></td>
					<td><strong>Última Visita</strong></td>
					<td><strong>Visitó</strong></td>
				</tr>
					<?php
						echo $mensaje;
					?>
			</table>

			<?php

		};

	}; 

?>

<script type="text/javascript">
			$('document').ready(function(){
				$('#visitado').click(function(){
				var visita = 1;
				var idUsuario = $('#idUsuario').val();
				var funcionario = $('#funcionario').val();

					jQuery.post("nuevavisita.php", {
					visita:visita,
					idUsuario:idUsuario,
					funcionario: funcionario

				}, function(data, textStatus){
						buscar();
					});
				});
			});
</script>

<script>
	$("#ClickMostrarRegistro2").click(function(){
            $('.MostrarRegistro').show();
            $('.MostrarHistorial').hide();
            $('.MostrarInicio').hide();
         });
</script>