<?php 
// Conexion a la base de datos
include '../conexion/conexion.php';

// Codificacion de lenguaje
mysql_query("SET NAMES utf8");

// Consulta a la base de datos
$consulta=mysql_query("SELECT 
id_registro,
(SELECT 
	CONCAT(p.nombre,' ',p.ap_paterno,' ',ap_materno)
FROM alumnos
INNER JOIN personas p ON p.id_persona = alumnos.id_persona WHERE alumnos.id_alumno  = registros.id_alumno) AS Alumno,
matricula,
fecha_ingreso,
hora_ingreso,
activo
FROM  registros
WHERE registros.activo = 1",$conexion) or die (mysql_error());
//$row=mysql_fetch_row($consulta)
 ?>
				            <div class="table-responsive">
				                <table id="example1" class="table table-responsive table-condensed table-bordered table-striped">

				                    <thead align="center">
				                      <tr class="info" >
				                        <th>#</th>
				                        <th>Nombre</th>
				                        <th>Matricula</th>
				                        <th>Fecha Registro</th>
				                        <th>Hora</th>
				                        <th>Editar</th>
				                        <th>Estatus</th>
				                      </tr>
				                    </thead>

				                    <tbody align="center">
				                    <?php 
				                    $n=1;
				                    while ($row=mysql_fetch_row($consulta)) {
															$idAlumno          = $row[0];
															$nomCarrera        = $row[3];
															$activo            = $row[5];
															$nomAlumnoCompleto = $row[1];
															$idPersona         = $row[1];
															$idCarrera         = $row[2]; 
															$noControl         = $row[2];
															$registro          = $row[4];
															$checado           = ($activo == 1)?'checked' : '';		
															$desabilitar       = ($activo == 0)?'disabled': '';
															$claseDesabilita   = ($activo == 0)?'desabilita':'';
															?>
				                      <tr>
				                        <td >
				                          <p id="<?php echo "tConsecutivo".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo "$n"; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tAlumno".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nomAlumnoCompleto; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tNoControl".$n; ?>" class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $noControl; ?>
				                          </p>
				                        </td>
				                        <td>
																<p id="<?php echo "tCarrera".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $nomCarrera; ?>
				                          </p>
				                        </td>
				                       <td>
																<p id="<?php echo "tCarrera".$n; ?>"  class="<?php echo $claseDesabilita; ?>">
				                          	<?php echo $registro; ?>
				                          </p>
				                        </td>
				                        <td>
				                          <button id="<?php echo "boton".$n; ?>" <?php echo $desabilitar ?>  type="button" class="btn btn-login btn-sm" 
				                          onclick="abrirModalEditar(
																								'<?php echo $idAlumno ?>',
				                          							'<?php echo $idPersona ?>',
				                          							'<?php echo $idCarrera ?>',
				                          							'<?php echo $noControl ?>'
				                          							);">
				                          	<i class="far fa-edit"></i>
				                          </button>
				                        </td>
				                        <td>
											<input  data-size="small" data-style="android" value="<?php echo "$valor"; ?>" type="checkbox" <?php echo "$checado"; ?>  id="<?php echo "interruptor".$n; ?>"  data-toggle="toggle" data-on="Desactivar" data-off="Activar" data-onstyle="danger" data-offstyle="success" class="interruptor" data-width="100" onchange="status(<?php echo $n; ?>,<?php echo $idAlumno; ?>);">
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
				                        <th>Matricula</th>
				                        <th>Fecha</th>
				                        <th>Hora</th>
				                        <th>Editar</th>
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
                              text: 'Pantalla 1',
                              action: function (  ) {
                                      ver_lista1();
                                      // llenar_carrera();
                                      // llenar_persona();

                              },
                              counter: 1
                          },
                          {
                              text: 'Pantalla 2',
                              action: function (  ) {
                                      ver_lista2();
                                      // llenar_carrera();
                                      // llenar_persona();

                              },
                              counter: 1
                          },
                          {
                              text: 'Pantalla 3',
                              action: function (  ) {
                                      ver_lista3();
                                      // llenar_carrera();
                                      // llenar_persona();

                              },
                              counter: 1
                          },
                          {
                              text: 'Pantalla 4',
                              action: function (  ) {
                                      ver_lista4();
                                      // llenar_carrera();
                                      // llenar_persona();

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
    
    
