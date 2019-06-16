function llenar_lista(){
     // console.log("Se ha llenado lista");
    preCarga(1000,4);
    $.ajax({
        url:"llenarLista.php",
        type:"POST",
        dateType:"html",
        data:{},
        success:function(respuesta){
            $("#lista").html(respuesta);
            $("#lista").slideDown("fast");
        },
        error:function(xhr,status){
            alert("no se muestra");
        }
    });	
}
function imprimir(){

    var titular = "Lista de Alumnos";
    var mensaje = "¿Deseas generar un archivo con PDF oon la lista de alumnos activos";
    // var link    = "pdfListaPersona.php?id="+idPersona+"&datos="+datos;
    var link    = "pdf/index.php?";

    alertify.confirm('alert').set({transition:'zoom',message: 'Transition effect: zoom'}).show();
    alertify.confirm(
        titular, 
        mensaje, 
        function(){ 
            window.open(link,'_blank');
            }, 
        function(){ 
                alertify.error('Cancelar') ; 
                // console.log('cancelado')
              }
    ).set('labels',{ok:'Generar PDF',cancel:'Cancelar'}); 
  }

function ver_alta(){
    preCarga(800,4);
    $("#lista").slideUp('low');
    $("#alta").slideDown('low');
    $("#nombre").focus();
}

function ver_lista(){
    $("#alta").slideUp('low');
    $("#lista").slideDown('low');
}

$('#btnLista').on('click',function(){
    llenar_lista();
    ver_lista();
});

$("#frmAlta").submit(function(e){
  
    var noControl    = $("#noControl").val();
    var idPersona   = $("#idPersona").val();
    var idCarrera   = $("#idCarrera").val();

    //Validar matricula mayor a 5 digitos
    if (noControl.length < 5) {
        alertify.dialog('alert').set({transition :'zoom', message: 'Transition efect: zoom'}).show();

        alertify.alert()
        .setting({
            'title' : 'Información',
            'label' : 'Salir',
            'message' : 'El número de control debe de contener al menos 5 caracteres.',
            'onok' : function() {alertify.message('Gracias!');}
        }).show();
        return false;
    }
    if (idPersona == 0) {
        alertify.dialog('alert').set({transition :'zoom', message: 'Transition efect: zoom'}).show();

        alertify.alert()
        .setting({
            'title' : 'Información',
            'label' : 'Salir',
            'message' : 'Debe seleccionar el dato de una persona.',
            'onok' : function() {alertify.message('Gracias!');}
        }).show();
        return false;   
    }
    if (idCarrera == 0) {
        alertify.dialog('alert').set({transition :'zoom', message: 'Transition efect: zoom'}).show();

        alertify.alert()
        .setting({
            'title' : 'Información',
            'label' : 'Salir',
            'message' : 'Debe seleccionar una carrera.',
            'onok' : function() {alertify.message('Gracias!');}
        }).show();
        return false;   
    }
        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'noControl' : noControl,
                    'idPersona' : idPersona,
                    'idCarrera' : idCarrera
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            llenar_carrera();
            llenar_persona();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(idAlumno,idPersona,idCarrera,noControl){
    
    
    $("#frmActuliza")[0].reset();
    // $("#alumnoE").val(alumno);
    // $("#matriculaE").val(noControl);
    // $("#idCarreraE").val(carrera);
    llenar_personaA(idPersona);
    llenar_carreraA(idCarrera);    

    $("#idE").val(idAlumno);

    $("#matriculaE").val(noControl);

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#matriculaE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    //var alumno    = $("#alumnoE").val();
    var noControl   = $("#matriculaE").val();
    var carrera   = $("#idCarreraE").val();
    var ide       = $("#idE").val();


    if (noControl.length < 5) {
        alertify.dialog('alert').set({transition :'zoom', message: 'Transition efect: zoom'}).show();

        alertify.alert()
        .setting({
            'title' : 'Información',
            'label' : 'Salir',
            'message' : 'El número de control debe de contener al menos 5 caracteres.',
            'onok' : function() {alertify.message('Gracias!');}
        }).show();
        return false;
    }
    if (carrera == 0) {
        alertify.dialog('alert').set({transition :'zoom', message: 'Transition efect: zoom'}).show();

        alertify.alert()
        .setting({
            'title' : 'Información',
            'label' : 'Salir',
            'message' : 'Debe seleccionar una carrera.',
            'onok' : function() {alertify.message('Gracias!');}
        }).show();
        return false;
    }

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    
                    'noControl':noControl,
                    'carrera':carrera,
                    'ide':ide
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza")[0].reset();
            $("#modalEditar").modal("hide");
            console.log(respuesta);
            llenar_lista();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function status(concecutivo,id){
    var nomToggle = "#interruptor"+concecutivo;
    var nomBoton  = "#boton"+concecutivo;
    var numero    = "#tConsecutivo"+concecutivo;
    var alumno   = "#tAlumno"+concecutivo;
    var numcontrol    = "#tNoControl"+concecutivo;
    var carrera  = "#tCarrera"+concecutivo;
    // var sexo      = "#tSexo"+concecutivo;

    if( $(nomToggle).is(':checked') ) {
        console.log("activado");
        var valor=0;
        alertify.success('Registro habilitado' );
        $(nomBoton).removeAttr("disabled");
        $(numero).removeClass("desabilita");
        $(alumno).removeClass("desabilita");
        $(numcontrol).removeClass("desabilita");
        $(carrera).removeClass("desabilita");
        // $(sexo).removeClass("desabilita");
    }else{
        console.log("desactivado");
        var valor=1;
        alertify.error('Registro deshabilitado' );
        $(nomBoton).attr("disabled", "disabled");
        $(numero).addClass("desabilita");
        $(alumno).addClass("desabilita");
        $(numcontrol).addClass("desabilita");
        $(carrera).addClass("desabilita");
        // $(sexo).addClass("desabilita");
    }
    // console.log(concecutivo+' | '+id);
    $.ajax({
        url:"status.php",
        type:"POST",
        dateType:"html",
        data:{
                'valor':valor,
                'id':id
             },
        success:function(respuesta){
            // console.log(respuesta);
        },
        error:function(xhr,status){
            alert(xhr);
        },
    });
}

function llenar_carrera(){
    $.ajax({
        url: 'comboCarreras.php',
        //data : {'id':id},
        type : 'POST',
        dateType : 'html',
        success : function(respuesta){
            
            $("#idCarrera").empty();
            $("#idCarrera").html(respuesta);
        },
        error : function(xhr, status){
            alert('Disculpe, hubo un problema');
        },
    });
}

function llenar_persona(){
    $.ajax({
        url: 'comboPersonas.php',
        //data : {'id':id},
        type : 'POST',
        dateType : 'html',
        success : function(respuesta){
            console.log(respuesta);
            $("#idPersona").empty();
            $("#idPersona").html(respuesta);
        },
        error : function(xhr, status){
            alert('Disculpe, hubo un problema');
        },
    });
}
function llenar_personaA(idPersona){
    $.ajax({
        url: 'comboPersonasA.php',
        type: 'POST',
        dateType: 'html',
        success : function(respuesta){
            console.log(respuesta);
            $("#alumnoE").empty();
            $("#alumnoE").html(respuesta);
            $("#alumnoE").val(idPersona);
            $(".select2").select2();
        },
        error : function(xhr, status){
            alert('Disculpe, hubo un problema');
        },
    });
}
function llenar_carreraA(idCarrera){
    $.ajax({
        url: 'comboCarrerasA.php',
        type: 'POST',
        dateType: 'html',
        success : function(respuesta){
            console.log(respuesta);
            $("#idCarreraE").empty();
            $("#idCarreraE").html(respuesta);
            $("#idCarreraE").val(idCarrera);
            $(".select2").select2();
        },
        error : function(xhr, status){
            alert('Disculpe, hubo un problema');
        },
    });
}