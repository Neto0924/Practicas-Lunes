function entrando(){
    window.location='../inicio/index.php';
}

function verRegistros(){
    
    $("#cuerpo").hide();
    $("#registros").show();
    $("#cambiarContra").hide();
    var pass = $("#matricula").val();
    
    $("#noControl").focus();
    
}


function cambioContra(){

    $("#cambiarContra").fadeIn('slow');
    $("#cuerpo").hide();
    $("#registros").hide();
    alertify.warning("Debes de cambiar tu contraseña , ya que es tu primer ingreso al sistema",3);
    $("#vContra1").val('');
    $("#vContra2").val('');
    $("#vContra1").focus();
    var usuario = $("#username").val();
    var contra = $("#pass").val();
    // alertify.warning(contra);
    // $("#btnActualizar").attr("disabled","disabled");




//Cambiar contraseña

$("#frmCambiar").submit(function(e){
   
    var usuario = $("#username").val();
    var pass = $("#pass").val();
    var contra1 = $("#vContra1").val();
    var vcontra  = $("#vContra2").val();
    var idE = $("#usuario").val();
    var action = "cambiarPass";
    // var passMD5 = md5($("#vContra1"));
    // alertify.warning(idE);

    if (contra1 == pass) {
        alertify.warning("La contraseña es igual a la anterior");
        $("#vContra1").val('');
        $("#vContra2").val('');
        $("#vContra1").focus();
        $("#btnActualizar").attr("disabled","disabled");
    }
    

        
             else{
                        $.ajax({
                    url:"update.php",
                    type:"POST",
                    dateType:"html",
                    data:{
                            'vContra1': contra1,                            
                            'usuario': idE
                         },
                    success:function(respuesta){
                        console.log(respuesta);
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Se ha actualizado la contraseña');
                        entrando();
                    },
                    error:function(xhr,status){
                        alert(xhr);
                    },
                });
             }
        
    
        e.preventDefault();
        return false;
});

}




function Validar() {
    var contra,contraV;

  contra =  $("#vContra1").val();
  contraV = $("#vContra2").val();
    

     if(contra == ''){
        $("#btnActualizar").attr("disabled","disabled");
   }
    else if (contra == contraV ) {
       
        $("#btnActualizar").removeAttr("disabled");
    }
    else if(contra != contraV){
        $("#btnActualizar").attr("disabled","disabled");
    }
}






$("#frmIngreso").submit(function(e){
    var usuario,contra;
    var usuario = $("#username").val();
    var contra  = $("#pass").val();
    var usuario=usuario.trim();
    
    // contra=contra.trim();
    if(usuario=='' || contra==''){
        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

        alertify.alert()
        .setting({
            'title':'Acceso denegado',
            'label':'Aceptar',
            'message': 'Debes de colocar nombre de usuario y contraseña' ,
            'onok': function(){ 
                alertify.message('Gracias !');
                $("#username").val('');
                $("#pass").val('');
                $("#username").focus();
            }
        }).show();
        return false;    
    }else{
        $.ajax({
            url:"verificar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'usuario':usuario,
                    'contra':contra
                 },
            success:function(respuesta){
              console.log(respuesta);
              respuesta=parseInt(respuesta);
              switch(respuesta){
                  case 0 :
                        alertify.dialog('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();

                        alertify.alert()
                        .setting({
                            'title':'Acceso denegado',
                            'label':'Aceptar',
                            'message': 'Nombre de usuario o contraseña incorrectos' ,
                            'onok': function(){ 
                                alertify.message('Gracias !');
                                $("#username").val('');

                            }
                        }).show();   
                    break;
                  case 1 :
                        var valorChk=$('#chkContra').val();
                        if(valorChk=='si'){
                            cambioContra();
                            $("#usuario").val(usuario);                       
                        }else{
                            alertify.success('Ingresando....') ; 
                            preCarga(2000,2);
                            setInterval(entrando, 2000);
                    }
                    break;
                  case 2 :
                        cambioContra();
                        $("#usuario").val(usuario);

                    break;
              }

            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
    } 
        e.preventDefault();
        return false;
});

function evaluarCheck(valor){
    
    if(valor=='no'){
        $('#chkContra').val('si');
    }else{
        $('#chkContra').val('no');
    }

    console.log(valor);
   
}

function cancelar(){
        // console.log("Saliendo del sistema...")
        alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
        alertify.confirm(
            'Sistema de Registro de Alumnos', 
            '¿ Deseas cancelar el cambio de contraseña?', 
            function(){ 
                $("#cuerpo").fadeIn();
                $("#cambiarContra").hide('low'); 
                $("#frmIngreso")[0].reset();   
                $("#frmCambiar")[0].reset();    
                $("#username").focus();      
                }, 
            function(){ 
                    alertify.error('Cancelar') ; 
                    console.log('cancelado')}
        ).set('labels',{ok:'Si',cancel:'No'});
}



function llenar_matricula(){

    var matricula = $("#noControl").val();

    if (matricula != "") {
        $.ajax({
        url: 'validarMatricula.php',
        data : {'matricula':matricula},
        type : 'POST',
        dateType : 'html',
        success : function(respuesta){
            console.log(respuesta);
            
            if (respuesta != 0) {
                var array = eval(respuesta);
                 $("#alumno").val(array[0])
                 $("#persona").val(array[1]);
                 $("#nomCarrera").val(array[2]);
                $("#imagen").attr('src', array[3]);
                       Altaregistro();
            } else {
                alertify.warning("La matricula no existe");
            }
           
        },
        error : function(xhr, status){
            alertify.warning("La matricula no es valida");
        },
    });
    } else {
        alertify.warning("Escribe una matricula");
    }    
}
function Altaregistro(){
	var noControl = $("#noControl").val();
	var ide = $("#alumno").val();

	 $.ajax({
                    url:"AltaRegistro.php",
                    type:"POST",
                    dateType:"html",
                    data:{
                    		'ide' : ide,
                            'noControl': noControl,                            
                            
                         },
                    success:function(respuesta){
                        console.log(respuesta);
                        alertify.set('notifier','position', 'bottom-right');
                        alertify.success('Se ha registrado una entrada');
                        // entrando();
                    },
                    error:function(xhr,status){
                        alert(xhr);
                    },
                });

}
