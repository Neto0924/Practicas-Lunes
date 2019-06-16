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
                 $("#persona").val(respuesta);
            } else {

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
function ValidarMat(){
    var matricula = $("#noControl").val();

    if (matricula != "") {
        $.ajax({
        url: 'llenarCarrera.php',
        data : {'matricula':matricula},
        type : 'POST',
        dateType : 'html',
        success : function(respuesta){
            console.log(respuesta);
            if (respuesta != 0) {
                 $("#nomCarrera").val(respuesta);
            } else {

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