<?php 
// Conexion a la base de datos
include'../conexion/conexion.php';

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT 
usuarios.id_usuario,
CONCAT (personas.nombre,' ',personas.ap_paterno,' ',personas.ap_materno),
usuarios.usuario,
usuarios.fecha_registro,
usuarios.activo
FROM usuarios
INNER JOIN personas ON personas.id_persona = usuarios.id_persona
ORDER BY usuarios.id_usuario DESC",$conexion) or die (mysql_error());
// $row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Nombre</th>
				                        <th>Usuario</th>
				                        <th>Fecha Resgitro</th>
				                        <th>Editar</th>
																<th>Restablecer</th>
				                        <th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
				                    $n=1;
				                    while ($row=mysql_fetch_row($consulta)) {
										$idUsuario   = $row[0];
										$nombre  = $row[1];
										$usuario = $row[2];
										$fecha_reg  = $row[3];
										$activo  = 		$row[4];			
										// $sexo=($sexo=='M')?'<i class="fas fa-male fa-lg"></i>':'<i class="fas fa-female fa-lg"></i>';
										$checado=($activo==1)?'checked':'';		
										$desabilitar=($activo==0)?'disabled':'';
										$claseDesabilita=($activo==0)?'desabilita':'';
															?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tNombre".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nombre; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tUsuario".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $usuario; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tFecha_reg".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $fecha_reg; ?>
				                          </p>
				                        </td>
				                       
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
				                          							'<?php echo $persona ?>',
				                          							'<?php echo $ap_paterno ?>',
				                          							'<?php echo $ap_materno ?>',
				                          							'<?php echo $direccion ?>',
				                          							'<?php echo $telefono ?>',
				                          							'<?php echo $fecha_nac ?>',
				                          							'<?php echo $correo ?>',
																								'<?php echo $tipoPersona ?>',
																								'<?php echo $genero ?>',
																								'<?php echo $idPersona ?>'
				                          							);">
				                          	<i class="fa fa-edit"></i>
				                          </button>
				                        </td>
																<td>
																	<button type="button" class="btn btn-login btn-sm">
																			<i class="fa fa-sync-alt"></i>
																	</button>
																
																</td>
				                        <td>
											<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idUsuario; ?>);">
				                        </td>
				                      </tr>
				                      <?php
				                      $n++;
				                    }
				                     ?>

				                    </tbody>

				                    <tfoot align="center">
				                      <tr class="info">
																<th>#</th>
				                        <th>Nombre</th>
				                        <th>Usuario</th>
				                        <th>Fecha Resgitro</th>
				                        <th>Editar</th>
																<th>Restablecer</th>
				                        <th>Estatus</th>
				                      </tr>
				                    </tfoot>
				                </table>
				            </div>
			
      <script type="text/javascript">
        $(document).ready(function() {
              $('#example1').DataTable( {
                 "language": {
                         // "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                          "url": "../plugins/datatables/langauge/Spanish.json"
                      },
                 "order": [[ 0, "asc" ]],
                 "paging":   true,
                 "ordering": true,
                 "info":     true,
                 "responsive": true,
                 "searching": true,
                 stateSave: false,
                  dom: 'Bfrtip',
                  lengthMenu: [
                      [ 10, 25, 50, -1 ],
                      [ '10 Registros', '25 Registros', '50 Registros', 'Todos' ],
                  ],
                 columnDefs: [ {
                      // targets: 0,
                      // visible: false
                  }],
                  buttons: [
                            {
                                extend: 'pageLength',
                                text: 'Registros',
                                className: 'btn btn-default'
                            },
                          {
                              extend: 'excel',
                              text: 'Exportar a Excel',
                              className: 'btn btn-default',
                              title:'Bajas-Estaditicas',
                              exportOptions: {
                                  columns: ':visible'
                              }
                          },
                         {
                              text: 'Nuevo Alumno',
                              action: function (  ) {
                                      ver_alta();
                              },
                              counter: 1
                          },
                  ]
              } );
          } );

      </script>
      <script>
            $(".interruptor").bootstrapToggle('destroy');
            $(".interruptor").bootstrapToggle();
      </script>
    
    
