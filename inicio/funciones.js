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
  
    var nombre    = $("#nombre").val();
    var paterno   = $("#paterno").val();
    var materno   = $("#materno").val();
    var direccion = $("#direccion").val();
    var sexo      = $("#sexo").val();
    var telefono  = $("#telefono").val();
    var fecha_nac = $("#fecha_nac").val();
    var correo    = $("#correo").val();
    var tipo      = $("#tipo").val();

        $.ajax({
            url:"guardar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'nombre':nombre,
                    'paterno':paterno,
                    'materno':materno,
                    'direccion':direccion,
                    'sexo':sexo,
                    'telefono':telefono,
                    'fecha_nac':fecha_nac,
                    'correo':correo,
                    'tipo':tipo
                 },
            success:function(respuesta){
              
            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha guardado el registro' );
            $("#frmAlta")[0].reset();
            $("#nombre").focus();
            // llenarLista();
            },
            error:function(xhr,status){
                alert(xhr);
            },
        });
        e.preventDefault();
        return false;
});

function abrirModalEditar(alumno,noControl,carrera,ide){
   
    $("#frmActuliza")[0].reset();
    $("#alumnoE").val(alumno);
    $("#matriculaE").val(noControl);
    $("#idCarreraE").val(carrera);
    
    $("#idE").val(ide);

    $(".select2").select2();

    $("#modalEditar").modal("show");

     $('#modalEditar').on('shown.bs.modal', function () {
         $('#alumnoE').focus();
     });   
}

$("#frmActuliza").submit(function(e){
  
    var alumno    = $("#alumnoE").val();
    var noControl   = $("#matricula").val();
    var carrera   = $("#idCarrera").val();
    // var direccion = $("#direccionE").val();
    // var sexo      = $("#sexoE").val();
    // var telefono  = $("#telefonoE").val();
    // var fecha_nac = $("#fecha_nacE").val();
    // var correo    = $("#correoE").val();
    // var tipo      = $("#tipoE").val();
    var ide       = $("#idE").val();

        $.ajax({
            url:"actualizar.php",
            type:"POST",
            dateType:"html",
            data:{
                    'alumno':alumno,
                    'noControl':noControl,
                    'carrera':carrera,
                    'ide':ide
                 },
            success:function(respuesta){

            alertify.set('notifier','position', 'bottom-right');
            alertify.success('Se ha actualizado el registro' );
            $("#frmActuliza")[0].reset();
            $("#modalEditar").modal("hide");
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