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
	<title>Tablero - Control de visitas</title>
</head>
<body>

	<header>
		<div class="container">
			<a href="/infocentro" style="text-decoration: none; color: #fff;"><h1><span class="glyphicon glyphicon-copy" aria-hidden="true"></span> Tablero</a></h1>
		</div>
	</header>

<?php

session_start();

if ($_SESSION['usuario']) {
	
?>

<div id="wrapper">

        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                       <h4>Menú</h4>
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

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                        

                        <!--Seccion para el inicio (formulario de búsqueda)-->
               
                        <div class="MostrarInicio">

                            <form accept-charset="utf-8" method="POST">
                                <center><h1><i class="fa fa-search" aria-hidden="true"></i> Buscar <input type="text" name="busqueda" id="busqueda" value="" placeholder="" maxlength="30" autocomplete="off" onKeyUp="buscar();" style=" font-size: 1em;"></h1></center>
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
                <button type="submit" class="btn btn-default" id="Enviar" name="enviar_ingreso">Enviar </button>
            </form>
        </div>
    </div>
</div>
</div>
                                
                            </div>

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
	header("Location: index.php");
}

if (isset($_POST['cerrar'])) {
	session_destroy();
	header("Status: 301 Moved Permanently", false, 301);
	header("Location: index.php");
}

?>
