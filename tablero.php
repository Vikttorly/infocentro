<?php
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
	<link href="css/simple-sidebar.css" rel="stylesheet">
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/validacion.js"></script>
    <script language="JavaScript" src="calendario/javascripts.js"></script>

	<title>Tablero - Control de visitas</title>
</head>
<body>

	<header>
		<div class="container">
			<a href="/infocentro" style="text-decoration: none; color: #fff;"><h1><img src="img/logo1.png" width="70"> Tablero</a></h1>
		</div>
	</header>

<?php

include ("calendario/calendario.php");
session_start();

if ($_SESSION['usuario']) {
	
?>

<div id="wrapper">

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                       <h4 style="color:white;">Menú</h4>
                </li>

                <li>
                    <a href="#" id="ClickMostrarInicio"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a>
                </li>
                <li>
                    <a href="#" id="ClickMostrarRegistro"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Registro</a>
                </li>
                <li>
                    <a href="#" id="ClickMostrarHistorial"><i class="fa fa-history" aria-hidden="true"></i> Historial</a>
                </li>
                
                <br><br><br>
                <script> 
                    function cerrarSesion(){ 
                    document.cerrar_sesion.submit()
                    } 
                </script>

                <li>
                        <form method="post" action="tablero.php" name="cerrar_sesion">
                            <input type="hidden" name="cerrar" value="1">
                        </form>

                        <a href="javascript:cerrarSesion()"><i class="fa fa-key"></i> Cerrar Sesion</a> 
                </li>
            </ul>
        </div>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                        

                        <!--Seccion para el inicio (formulario de búsqueda)-->
               
                        <div class="MostrarInicio">

                            <form accept-charset="utf-8" method="POST">
                                <center><h1><i class="fa fa-search" aria-hidden="true"></i> <input type="text" name="busqueda" id="busqueda" maxlength="30" autocomplete="off" onKeyUp="buscar();" style=" font-size: 1em;"></h1></center>
                            </form>
                        
                        <div id="resultadoBusqueda"></div>
                        </div>

                            <script>
                                $(document).ready(function() {
                                    $("#resultadoBusqueda").html('<center><p>Sin instrucciones de busqueda</p></center>');
                                });

                                function buscar() {
                                    var textoBusqueda = $("input#busqueda").val();
 
                                    if (textoBusqueda != "") {
                                        $.post("buscarpersona.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
                                            $("#resultadoBusqueda").html(mensaje);
                                        }); 
                                    } else { 
                                         $("#resultadoBusqueda").html('<center><p>Sin instrucciones de busqueda</p></center>');
                                        };
                                };
                            </script>
                            


                        <!--Seccion para el registro (formulario de registro)-->
               
                        <div class="MostrarRegistro">

        <div class="container contenedor2">
            <center><h1><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Registro de usuario</h1><br></center>
            <form method="post" class="form" role="form" name="registroUsuario" autocomplete="off" id="registrarUsuarios">
            <input type="hidden" name="registrador" value="<?php echo $_SESSION['usuario']; ?>">
            <div class="row">
            <legend></legend>
                <div class="col-xs-4">
                    <label for="sel1">Cédula</label>
                    <input type="text" class="form-control centrarTexto" maxlength="8" onkeypress="return soloNumeros(event);" name="cedula"> 
                </div>
                <div class="col-xs-4">
                    <label for="sel1">Nombres</label>
                    <input type="text" class="form-control centrarTexto" maxlength="45" onkeypress="return soloLetras(event);" 
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="nombres" id="nombres">
                </div>
                <div class="col-xs-4">
                    <label for="sel1">Apellidos</label>
                    <input type="text" class="form-control centrarTexto" maxlength="45" onkeypress="return soloLetras(event);"
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="apellidos" id="apellidos">
                </div>
            </div>
           <br>
            <div class="row">
            <legend></legend>
               <div class="col-xs-4">
               <label for="sel1">Fecha de Nacimiento</label>
                    <?php
                    escribe_formulario_fecha_vacio("fecha1","registroUsuario");
                    ?>
                </div>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="sel1">Género</label>
                        <select class="form-control" name="genero">
                            <option>MASCULINO</option>
                            <option>FEMENINO</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-4">
                <label for="sel1">Dirección</label>
                    <input type="text" class="form-control centrarTexto" 
                    style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" name="direccion">
                </div>
             </div>
             <div class="row">
                 <legend></legend>
             <br>
            <button class="btn btn-lg btn-danger btn-block" id="registrarUsuario">Registrar Usuario</button>
            </div>
            </form>
        </div>                 
        <!--Validación de formulario-->

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

        <!--Envio de formulario en ajax-->



        <script>   

            $("#registrarUsuario").click(function() {  
                if($("#nombres").val().length < 1) {  
                    alert("El nombre es obligatorio");  
                    return false;  
                }else if($("#apellidos").val().length < 1){  
                    alert("El apellido es obligatorio");  
                    return false;  
                }else if($("#fechaNacimiento").val().length < 1){  
                    alert("La fecha es obligatoria");  
                    return false;  
                }else{
                    var url = "registrarusuario.php"; // El script a dónde se realizará la petición.
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#registrarUsuarios").serialize(), // Adjuntar los campos del formulario enviado.
                    success: function(data)
                    {
                        $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
                        $('.MostrarRegistro').hide();
                    }
                    });
                }
                return false;  
            });  

            
        </script>

        <!--

        <script type="text/javascript">
            $('document').ready(function(){
                $('#registrarUsuario').click(function(){

                    var cedula = $('#cedula').val();
                    var nombres = $('#nombres').val();
                    var apellidos = $('#apellidos').val();
                    var fechaNacimiento = $('#fechaNacimiento').val();
                    var genero = $('#genero').val();
                    var direccion = $('#direccion').val();
                    var registrador = $('#registrador').val();

                    jQuery.post("registrarusuario.php", {
                        cedula:cedula,
                        nombres:nombres,
                        apellidos:apellidos,
                        fechaNacimiento:fechaNacimiento,
                        genero:genero,
                        direccion:direccion,
                        registrador:registrador
                    }, function(data, textStatus){
                    });
                });        
            });
        </script>

        -->

                        </div>

                            <div id="respuesta"></div>
                        <!--Seccion para el historial (formulario de historial)-->
               
                            <div class="MostrarHistorial">

                                Eso es el contenido del Historial
                                
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
     $("#flecha_menu").toggleClass("fa fa-chevron-left");
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

     <script>
        $(document).ready(function(){
            $('.MostrarRegistro').hide();
            $('.MostrarHistorial').hide();
        $("#ClickMostrarInicio").click(function(){
            $('.MostrarInicio').show();
            $('.MostrarRegistro').hide();
            $('.MostrarHistorial').hide();
         });
        $("#ClickMostrarRegistro").click(function(){
            $('.MostrarRegistro').show();
            $('.MostrarHistorial').hide();
            $('.MostrarInicio').hide();
         });
        $("#ClickMostrarHistorial").click(function(){
            $('.MostrarHistorial').show();
            $('.MostrarRegistro').hide();
            $('.MostrarInicio').hide();
         });
    });
    </script>

</body>
</html>

<?php

}else{
	header("Status: 301 Moved Permanently", false, 301);
	header("Location: /infocentro/");
}

if (isset($_POST['cerrar'])) {
	session_destroy();
	header("Status: 301 Moved Permanently", false, 301);
	header("Location: /infocentro/");
    ?>

    <?php
}

ob_end_flush();

?>
