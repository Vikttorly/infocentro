$(document).on("ready",inicio);

function inicio(){

	$("#email_registro").keyup(validar_email_registro);

	$("#email_ingreso").keyup(validar_email_ingreso);

	$("#contraseña_registro2").keyup(validar_contraseña);
}

//Validar el email del formulario de registro

function validar_email_registro(){

	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  
    if (regex.test($('#email_registro').val().trim())) {
        $("#icono_email_reg").remove();
        $("#email_registro").parent().attr("class","form-group has-success has-feedback");
        $("#email_registro").parent().append("<span id='icono_email_reg' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', false);
        return true;
    } else {
    	$("#icono_email_reg").remove();
       	$("#email_registro").parent().attr("class","form-group has-error has-feedback");
       	$("#email_registro").parent().append("<span id='icono_email_reg' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', true);
        return false;
   }
}

function validar_contraseña(){

    var c1= $("#contraseña_registro").val();
    var c2= $("#contraseña_registro2").val();
      
      if(c1==c2){
        $("#icono_contraseña_reg").remove();
        $("#contraseña_registro2").parent().attr("class","form-group has-success has-feedback");
        $("#contraseña_registro2").parent().append("<span id='icono_contraseña_reg' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', false);
        return true;
        }else {
        $("#icono_contraseña_reg").remove();
        $("#contraseña_registro2").parent().attr("class","form-group has-error has-feedback");
        $("#contraseña_registro2").parent().append("<span id='icono_contraseña_reg' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', true);
        return false;
        }   
}

//Validar el formulario de ingreso

function validar_email_ingreso(){
  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    // Se utiliza la funcion test() nativa de JavaScript
    if (regex.test($('#email_ingreso').val().trim())) {
        $("#icono_email_ing").remove();
        $("#email_ingreso").parent().attr("class","form-group has-success has-feedback");
        $("#email_ingreso").parent().append("<span id='icono_email_ing' class='glyphicon glyphicon-ok form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', false);
        return true;
    } else {
        $("#icono_email_ing").remove();
        $("#email_ingreso").parent().attr("class","form-group has-error has-feedback");
        $("#email_ingreso").parent().append("<span id='icono_email_ing' class='glyphicon glyphicon-remove form-control-feedback'></span>");
        $('#enviar_registro').attr('disabled', true);
        return false;
    }
}
