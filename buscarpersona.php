<?php

error_reporting(0);
session_start();
include("conexion.php");
include ("calendario/calendario.php");

?>

<input type="hidden" id="funcionario" value="<?php echo $_SESSION['usuario']?>">

<?php

$anioActual = date("Y");

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
            $direccion = $resultados['direccion'];
            $sexo = $resultados['sexo'];

			$consultaFecha = mysqli_fetch_assoc(mysqli_query($conexion,"SELECT DATE_FORMAT(fEntrada,'%d/%m/%Y') AS fecha_sola FROM visitas WHERE usuario=$id ORDER BY fEntrada DESC"));
			$ultimaVisita = $consultaFecha['fecha_sola'];
			$nVisitas = mysqli_fetch_assoc(mysqli_query($conexion,"SELECT count(*) AS nVisitas FROM visitas WHERE usuario=$id"));


$añoActual = date("Y");
$mesActual = date("m");
$diaActual = date("d");
$horaActual = date("G");
$minutoActual = date("i");
$segundoActual = date("s");

$consulta2 = mysqli_fetch_assoc(mysqli_query($conexion,"SELECT fEntrada FROM visitas WHERE usuario=$id ORDER BY fEntrada DESC"));
$visita = $consulta2['fEntrada'];

$fechaIni = $visita;
$fechaFin = $añoActual.'-'.$mesActual.'-'.$diaActual.' '.$horaActual.':'.$minutoActual.':'.$segundoActual;

//e.e las partes de cada fecha
list($iniDia, $iniHora) = split(" ", $fechaIni);
list($anyo, $mes, $dia) = split("-", $iniDia);
list($hora, $min, $seg) = split(":", $iniHora);
$tiempoIni = mktime($hora + 0, $min + 0, $seg + 0, $mes + 0, $dia + 0, $anyo);

//el $tiempoFin
list($finDia, $finHora) = split(" ", $fechaFin);
list($anyo, $mes, $dia) = split("-", $finDia);
list($hora, $min, $seg) = split(":", $finHora);
$tiempoFin = mktime($hora + 0, $min + 0, $seg + 0, $mes + 0, $dia + 0, $anyo);

//resto los valores y tengo segundos
$difSegundos = $tiempoFin - $tiempoIni;
//transformo a horas los segundos

if ($difSegundos < 600) {
	$addVisita = '';
}else{

	$addVisita = '<i class="fa fa-plus-square" aria-hidden="true" id="visitado"></i>';
}

$anioNacimiento = substr($fNacimiento, -10, 4);
$mesNacimiento = substr($fNacimiento, -5, 2);
$diaNacimiento = substr($fNacimiento, -2, 2);

			//Output
			$mensaje .= '  
			<tr><td><div><input type="hidden" id="idUsuario" value="'.$id.'">'.$ci.'</div></td><td>'.$nombre.'</td><td>'.$edad.'</td><td>'.$nVisitas['nVisitas'].'</td><td>'.$ultimaVisita.'</td><td>'.$addVisita.'</td><td><button type="button" data-toggle="modal" data-target="#myModal">Editar</button></td>
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
					<td>Acción</td>
				</tr>
					<?php
						echo $mensaje;
					?>
			</table>

            <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-lg">
    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">EDITAR DATOS DE <b><?php echo $nombre; ?></b></h4>
                        </div>
                        <div class="modal-body">
                            <div id="respuestaActualizar" align="center">

            <form class="form" role="form" autocomplete="off" id="actualizarUsuarios">
            <input type="hidden" name="id" value="<?php echo $id; ?>" id="idUsuario2">
            <input type="hidden" name="anioActual" value="<?php echo $anioActual; ?>" id="anioActual">
            <div class="row">
            <br>
                <div class="col-xs-4">
                    <label for="sel1">Cédula</label>
                    <input type="text" class="form-control centrarTexto" maxlength="8" onkeypress="return soloNumeros(event);" id="cedula" placeholder="<?php echo $ci; ?>"> 
                </div>
                <div class="col-xs-8">
                    <label for="sel1">Nombres y Apellidos</label>
                    <input type="text" class="form-control centrarTexto" maxlength="45" onkeypress="return soloLetras(event);" 
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="nombres" placeholder="<?php echo $nombre; ?>">
                </div>
            </div>
           <br>
            <div class="row">
               <div class="col-xs-4">
               <label for="sel1">Fecha de Nacimiento</label>
                           <table>
                        <tr>
                            <td>
                            <input type="text" class="form-control centrarTexto" maxlength="2" onkeypress="return soloNumeros(event);" name="dia" size="1" id="calendarioDia" value="<?php echo $diaNacimiento; ?>"> 
                            </td>
                            <td>
                                <select class="form-control" name="mes" id="calendarioMes">

                                <?php

                                    if ($mesNacimiento == 1) {
                                        echo '<option value="1" selected>Enero</option>';
                                    }else{
                                        echo '<option value="1">Enero</option>';
                                    }

                                    if ($mesNacimiento == 2) {
                                        echo '<option value="2" selected>Febrero</option>';
                                    }else{
                                        echo '<option value="2">Febrero</option>';
                                    }

                                    if ($mesNacimiento == 3) {
                                        echo '<option value="3" selected>Marzo</option>';
                                    }else{
                                        echo '<option value="3">Marzo</option>';
                                    }

                                    if ($mesNacimiento == 4) {
                                        echo '<option value="4" selected>Abril</option>';
                                    }else{
                                        echo '<option value="4">Abril</option>';
                                    }

                                    if ($mesNacimiento == 5) {
                                        echo '<option value="5" selected>Mayo</option>';
                                    }else{
                                        echo '<option value="5">Mayo</option>';
                                    }

                                    if ($mesNacimiento == 6) {
                                        echo '<option value="6" selected>Junio</option>';
                                    }else{
                                        echo '<option value="6">Junio</option>';
                                    }

                                    if ($mesNacimiento == 7) {
                                        echo '<option value="7" selected>Julio</option>';
                                    }else{
                                        echo '<option value="7">Julio</option>';
                                    }

                                    if ($mesNacimiento == 8) {
                                        echo '<option value="8" selected>Agosto</option>';
                                    }else{
                                        echo '<option value="8">Agosto</option>';
                                    }

                                    if ($mesNacimiento == 9) {
                                        echo '<option value="9" selected>Septiembre</option>';
                                    }else{
                                        echo '<option value="9">Septiembre</option>';
                                    }

                                    if ($mesNacimiento == 10) {
                                        echo '<option value="10" selected>Octubre</option>';
                                    }else{
                                        echo '<option value="10">Octubre</option>';
                                    }

                                    if ($mesNacimiento == 11) {
                                        echo '<option value="11" selected>Noviembre</option>';
                                    }else{
                                        echo '<option value="11">Noviembre</option>';
                                    }

                                    if ($mesNacimiento == 12) {
                                        echo '<option value="12" selected>Diciembre</option>';
                                    }else{
                                        echo '<option value="12">Diciembre</option>';
                                    }

                                ?>
                                </select> 
                            </td>
                            <td>
                                <input type="text" class="form-control centrarTexto" maxlength="4" onkeypress="return soloNumeros(event);" name="anio" size="2" id="calendarioAnio" value="<?php echo $anioNacimiento; ?>"> 
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="sel1">Género</label>
                        <select class="form-control" name="genero" id="genero">
                            <?php

                                if ($sexo == 'M') {
                                    echo '<option selected>MASCULINO</option>';
                                }else{
                                    echo '<option>MASCULINO</option>';
                                }

                                if ($sexo == 'F') {
                                    echo '<option selected>FEMENINO</option>';
                                }else{
                                    echo '<option>FEMENINO</option>';
                                }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                <label for="sel1">Dirección</label>
                    <input type="text" class="form-control centrarTexto" 
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="direccion" id="direccion" placeholder="<?php echo $direccion; ?>">
                </div>
             </div>
             <div class="row">
             <br>
            <button class="btn btn-lg btn-danger btn-block" id="actualizarUsuario">Actualizar Usuario</button>
            </div>
            </form>


                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="cerrarModal" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
      
                    </div>
                </div>

			<?php

		};

	}; 

?>

 <script type="text/javascript">
            function soloNumeros(e){

            var keynum = window.event ? window.event.keyCode : e.which;
            if ((keynum == 8) || (keynum == 46))
            return true;
         
            return /\d/.test(String.fromCharCode(keynum));

        }
        </script>


        <script>
            function soloLetras(e){
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
            for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    }
                }

                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                    return false;
                }
            }
        </script>

        <script>   

            $("#actualizarUsuario").click(function() {
                var idUsuario = $('#idUsuario2').val();
                var cedula = $('#cedula').val();
                var nombres = $('#nombres').val();
                var calendarioDia = $('#calendarioDia').val();
                var calendarioMes = $('#calendarioMes').val();
                var calendarioAnio = $('#calendarioAnio').val();
                var genero = $('#genero').val();
                var direccion = $('#direccion').val();
                var anioActual = $("#anioActual").val();
                var anioMaximo = anioActual - 2;
                var anioMinimo = anioActual - 100;
                var c1 = false;
                var c2 = false;
                var c3 = false;
                var c4 = false;
                var c5 = false;

                if ($("#cedula").val().length > 0) { //Validando campo de cedula
                    if ($("#cedula").val().length < 7) {
                        $("#cedula").css("border-color", "#d23737"); 
                        c1 = false;
                    }else if ($("#cedula").val().length > 7) {
                        $("#cedula").css("border-color", "#92c54f");
                        c1 = true;
                    }
                }else{
                    $("#cedula").css("border-color", "#ccc");
                        c1 = true;
                }

                if ($("#nombres").val().length > 0) { //Validando campo de nombres
                    if ($("#nombres").val().length < 8) {
                        $("#nombres").css("border-color", "#d23737"); 
                        c2 = false;
                    }else if ($("#nombres").val().length >= 8) {
                        $("#nombres").css("border-color", "#92c54f");
                        c2 = true;
                    }
                }else{
                    $("#nombres").css("border-color", "#ccc");
                        c2 = true;
                }

                if ($("#calendarioDia").val().length > 0) { //Validando campo de calendarioDia
                    if (($("#calendarioDia").val() < 1) || ($("#calendarioDia").val() > 31)) {
                        $("#calendarioDia").css("border-color", "#d23737"); 
                        c3 = false;
                    }else{
                        $("#calendarioDia").css("border-color", "#92c54f");
                        c3 = true;
                    }
                }else{
                    $("#calendarioDia").css("border-color", "#ccc");
                        c3 = true;
                }

                if ($("#calendarioAnio").val().length > 0) { //Validando campo de calendarioAnio
                    if (($("#calendarioAnio").val() > anioMaximo) || ($("#calendarioAnio").val() < anioMinimo)) {
                        $("#calendarioAnio").css("border-color", "#d23737"); 
                        c4 = false;
                    }else{
                        $("#calendarioAnio").css("border-color", "#92c54f");
                        c4 = true;
                    }
                }else{
                    $("#calendarioAnio").css("border-color", "#ccc");
                        c4 = true;
                }

                if ($("#direccion").val().length > 0) { //Validando campo de direccion
                    if ($("#direccion").val().length < 10) {
                        $("#direccion").css("border-color", "#d23737"); 
                        c5 = false;
                    }else if ($("#direccion").val().length > 7) {
                        $("#direccion").css("border-color", "#92c54f");
                        c5 = true;
                    }
                }else{
                    $("#direccion").css("border-color", "#ccc");
                        c5 = true;
                }

                if ((c1 == true) && (c2 == true) && (c3 == true) && (c4 == true) && (c5 == true)) {

                var url = "actualizarusuario.php"; 
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        idUsuario,
                        cedula,
                        nombres,
                        calendarioDia,
                        calendarioMes,
                        calendarioAnio,
                        genero,
                        direccion
                    }, 
                    success: function(data)
                    {
                        setTimeout(function() {
                        $("#respuestaActualizar").html(data); 
                        },400);

                        setTimeout(function() {
                        $( "#cerrarModal" ).trigger( "click" );
                        },5000);

                        setTimeout(function() {
                        buscar();
                        },5500);
                        
                    }
                    });
                }
                 return false;
            });  

        </script>

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