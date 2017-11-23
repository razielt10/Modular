$( document ).ready(function() {

  $('#operations .icon-user,.icon-module').tooltipster({
    theme: ['tooltipster-light'],  animation: 'fade',  delay: 200,
    trigger: 'hover',  onlyOne: false, position: ['top'],
  });
  $('#back-item').tooltipster({
    theme: ['tooltipster-light'],   animation: 'fade',  delay: 300,
    trigger: 'hover', position: ['bottom'], distance: 3, 'content': 'Volver'});

  $('#operations .icon-module').tooltipster( 'content', 'Editar Modulos Acceso');
  $('#operations .icon-user').tooltipster( 'content', 'Editar Usuario');

  $( "#generarPassword" ).on( "click", function() {
    var pass = RandomPassword(8, true, true, true);
    $( "#claveUsuario" ).val(pass);
    $( "#claveUsuario-confirm" ).val(pass);
  });

  $( "#verPassword" ).on( "mousedown", function() {
    $( "#claveUsuario" ).attr('type', 'text');
  });

  $( "#verPassword" ).on( "mouseup", function() {
    $( "#claveUsuario" ).attr('type', 'password');
  });


  //configure the validation
  $('#add-form').validate({
	   debug: true,
		rules: {
			"loginUsuario": {	required: true },
			"emailUsuario": { required: true, email: true	},
      "claveUsuario": { required: true, minlength: 6 },
      "claveUsuario_confirmation": { minlength: 6, equalTo: "#claveUsuario" },
      "avatar": { extension: "jpg|png|gif" }
		},
		messages: {
			"loginUsuario": "Ingresa el login."	,
			"emailUsuario": "Email invalido." ,
      "claveUsuario": { required :"Password requerido",
        minlength: jQuery.validator.format("Al menos {0} caracteres requiere!")
     },
      "claveUsuario_confirmation": {
        minlength: jQuery.validator.format("Al menos {0} caracteres requiere!"),
        equalTo: "Password no coinciden." },
      "avatar": { extension: "Solo puede subir archivos de tipo imagen (jpg, png, gif)" }
		},

    submitHandler: function(form){
      var validator = this;
      console.log('ejecutando...');
      $.ajax({
        type : 'GET',
        url : '/Logistica/security/users/validateNewDuplicated',
        beforeSend: function () {
          $("#send-button").prop("disabled", true);
        },
        data : {
         "loginUsuario" : $('#loginUsuario').val(),
         "emailUsuario" : $('#emailUsuario').val()
       }
      })
      .done(function(response){ // What to do if we succeed
        //console.log(response);
        console.log('registrando');
        form.submit();
        $("#send-button").prop("disabled", false);
      })
      .fail(function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        //capturo el error de las validaciones de Laravel
         if(jqXHR.status==422){
           var errores = JSON.parse(jqXHR.responseText);
           //console.log(errores.errors);
           validator.showErrors( errores.errors );
           $("#send-button").prop("disabled", false);
         }else{
          //otros errores;
          console.log(JSON.stringify(jqXHR));
          console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
      });
      }
  });

});
