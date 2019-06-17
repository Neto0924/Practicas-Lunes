<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="../plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../plugins/fontawesome-free-5.8.1-web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<!-- Alertify	 -->
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../plugins/alertifyjs/css/themes/bootstrap.css">

	    <!-- bootstrap-toggle-master -->
			<link href="../plugins/bootstrap-toggle-master/css/bootstrap-toggle.css" rel="stylesheet">
    <link href="../plugins/bootstrap-toggle-master/stylesheet.css" rel="stylesheet">
</head>
<body class="login">
	<div class="container" style="display:none" id="cuerpo">
		<div class="row justify-content-md-center">
			<div class="col-md-auto login-box borde sombra">
				<h3 class="text-center titulo">Iniciar Sesión</h3>
				<hr>
				<form id="frmIngreso">
					<div class="form-row">
						<div class="col-md-12">
							<label for="" class="colorLetra">Nombre de usuario:</label>
					          <div class="form-group has-feedback salto">
					            <input type="text" id="username" placeholder="Usuario" class="form-control " autofocus>
					            <span class="glyphicon glyphicon-user form-control-feedback"></span>
					          </div>
						</div>
						<div class="col-md-12">
							<label for="" class="colorLetra">Contraseña:</label>
					          <div class="form-group has-feedback salto">
					            <input type="password" id="pass" placeholder="Usuario" class="form-control " >
					            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					          </div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-2">
								<button type="button" class="btn btn-default center-block" id="btnReg" onclick="verRegistros();">
									<i class="fa fa-users"></i>
									Registros
								</button>
			          		</div>	
							<div class="col-md-8">
								<center>
									<input id="chkContra"  onchange='evaluarCheck(this.value)' data-on="Si" data-off="No" type="checkbox" checked data-toggle="toggle" data-size="mini" value='no'><label class="colorLetra"> &nbsp; Cambiar Contraseña</label>	
								</center>
							</div>			
		              		<div class="col-md-2">
		              			<button type="submit" class="btn btn-login  btn-flat  pull-right" id="btnIngresar">
			              			<i class="fas fa-lock-open"></i>
			              			Ingresar
		              			</button>
		              		</div>
	              			
	            	 	</div><!-- /.col -->
					</div>
				</form>
			</div>			
		</div>
	</div>

	

	<div class="container" style="display:none" id="cambiarContra">
		<div class="row justify-content-md-center">
			<div class="col-md-auto login-box borde sombra">
				<h3 class="text-center titulo">Cambiar Contraseña</h3>
				<hr>
				<form id="frmCambiar">
					<div class="form-row">
						<div class="col-md-12">
							<input type="hidden" id="usuario" class="form-control">
						</div>
						<div class="col-md-12">
							<label for="" class="colorLetra">Contraseña:</label>
					          <div class="form-group has-feedback salto">
					            <input type="password" id="vContra1"  class="form-control " onKeyup="Validar();">
					            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					          </div>
						</div>
						<div class="col-md-12">
							<label for="" class="colorLetra">Verificar Contraseña:</label>
					          <div class="form-group has-feedback salto">
					            <input type="password" id="vContra2"  class="form-control" onKeyup="Validar();">
					            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					          </div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<button type="button" class="btn btn-login  btn-flat  pull-left" id="btnCancelar"  onclick="cancelar()">
			              			<i class="fas fa-times"></i>
			              			Cancelar
		              			</button>
		              			<button type="submit" class="btn btn-login  btn-flat  pull-right" id="btnActualizar" disabled>
			              			<i class="fas fa-lock-open"></i>
			              			Actualizar
		              			</button>
	            			</div><!-- /.col -->
						</div>
					</div>	
				</form>
			</div>			
		</div>
	</div>

	<div class="container" style="display:none" id="registros">
		<div class="row justify-content-md-center">
			<div class="col-md-auto login-box borde sombra">
				<button type="button" id="btnVolver" class="btn btn-login btn-flat" pull-left onclick="Volver();">Regresar al login </button>
				<h3 class="text-center titulo">Registros de entrada y salida</h3>
				<hr>
				<form id="frmAcceso">
						<div class="form-row">
							<div class="col-md-12">
								
							</div>
							
							<div class="col-md-12">
								
								<center>
									<label for="" class="colorLetra">Matricula:</label>
							          <div class="form-group has-feedback salto">
							            <input type="text" id="noControl"  class="form-control"  onkeyup="llenar_matricula();">
							          </div>
								</center>
							</div>
						</div>
					<div class="container-fluid">
							<div class="row">
								<div class="col-md-12" >
								<input type="hidden" id="alumno" class="form-control">
								<center><label for="" class="colorLetra">Alumno:</label></center>
						          <div class="form-group has-feedback " rowspan="2">
						            <img id="imagen" style="width: 130px;height: 150px;" alt="" class="pull-left">
						          </div>
											<div class="col-md-8" >
												<input type="text" class="form-control salto" id="persona" disabled>
												
											</div>
											<div class="col-md-3">
											
											</div>
											<div class="col-md-8" id="texto">
												<input type="hidden" id="regcarrera" class="form-control">
												<label for="">Carrera</label>
												<input type="text" id="nomCarrera" class="form-control salto" disabled="">
											</div>
								</div>
							</div>
					</div>
				</form>
			</div>			
		</div>
	</div>

	<script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="../plugins/Preloaders/jquery.preloaders.js"></script>

	<!-- alertify -->
	<script type="text/javascript" src="../plugins/alertifyjs/alertify.js"></script>
	<!-- bootstrap-toggle-master -->
	<script src="../plugins/bootstrap-toggle-master/doc/script.js"></script>
    <script src="../plugins/bootstrap-toggle-master/js/bootstrap-toggle.js"></script>
    <!-- Funciones propias -->
    <script src="funciones.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/precarga.js"></script>
<!--     <script src="../texto_audio/jquery-1.12.1.js"></script>
    <script src="../texto_audio/responsivevoice.js"></script> -->
    <!-- <script src="val/verificar.js"></script> -->

	<script>
		window.onload = function() {
			$("#cuerpo").fadeIn("slow");
			$("#username").focus();
		};	

		$('#chkContra').bootstrapToggle('off');
		$('#chkContra').val('no');

	</script>
<!-- <script>

	function hablar(){
	 		var textoAtraducir;

	 		textoAtraducir=$("#persona").val();
	 		if (textoAtraducir == '') {

	 		} else {
	 			responsiveVoice.speak(textoAtraducir + ' acaba de registrar una entrada',"Spanish Female");
	 		}

	 		 
	 		// alert(textoAtraducir);
	 	}
</script> -->


<script>
	function ver(){
		$("#cuerpo").hide();
		alertify.success("Ver nuevo modal");
	}
</script>

<script>
	function Volver(){
		$("#registros").hide();
		$("#cuerpo").fadeIn("slow");
	}
</script>

</body>
</html>