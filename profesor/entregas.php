<?php
if(!empty($_GET['pa'])|| !empty($_GET['act'])){
  $idpa=$_GET['pa'];
  $idactividad=$_GET['act'];
     
}else{
  header("Location: profesor/");    
}
include "../includes/config.php";
include "layout/parte1.php";
//require_once "../includes/funciones.php";



$idprofesor=$_SESSION['profesor_id'];

$sql_alumnos="SELECT a.alumno_id, a.nombre_alumno FROM alumno_profesor as ap 
INNER JOIN profesor_area as pa ON ap.pa_id=pa.pa_id
INNER JOIN alumnos as a ON ap.alumno_id=a.alumno_id
WHERE pa.pa_id='$idpa'";
$query_alumnos=$pdo->prepare($sql_alumnos);
$query_alumnos->execute();
$row_alumnos=$query_alumnos->rowCount();


$sqla="SELECT * FROM ev_entregadas  as ev INNER JOIN alumnos as a ON ev.alumno_id=a.alumno_id
INNER JOIN actividades as ac ON ev.actividad_id=ac.actividad_id
WHERE ev.actividad_id=?";
$querya=$pdo->prepare($sqla);
$querya->execute(array($idactividad));
$rowa=$querya->rowCount();


require_once "includes/modals/modal_evidencia.php";
?>

<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-12 tex-center mt-3 p-4 bg-light">  
            <h2><i class="bi bi-speedometer"></i>Evidencias entregadas</h2>
            <button class="btn btn-success" type="button" onclick="openModalEvidencia()">Registrar Evidencia</button>         
          </div>
          
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <div class="">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Acciones</th>
                    <th>Alumno</th>
                    <th>Observacion</th>
                    <th>Material</th>
                    <th>Estatus</th>
                    <th>Cargar Nota</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                    if($rowa>0){
                      
                      while($data2=$querya->fetch()){
                        
                        $valor='';
                        $cargar='';
                        $alumno=$data2['alumno_id'];
                        $ev_entregada=$data2['ev_entregadas_id'];
                        //var_dump($ev_entregada);
                        $sqln="SELECT * FROM notas WHERE ev_entregadas_id='$ev_entregada'";
                        
                        $queryn=$pdo->prepare($sqln);
                        $queryn->execute();
                        $datan=$queryn->rowCount();
                        

                        if($datan>0){
                          $valor='<kbd class="bg-success">Calificado</kbd>';
                          $cargar='';
                        }else{
                          require_once "includes/modals/modal-nota.php";
                          $valor='<kbd class="bg-danger">Sin Calificar</kbd>';
                          $cargar='<button class="btn btn-warning" onclick="modalNota()">Cargar Nota</button>';
                        }
                    
                  ?>
                              <tr>
                                <td>
                                  <button class="btn btn-primary" title="Editar" onclick="editarEntrega(<?=$data2['ev_entregadas_id'];?>)" ><i class="bi bi-pencil"></i></button>
                                  <button class="btn btn-danger" title="Eliminar" onclick="eliminarEntrega(<?=$data2['ev_entregadas_id'];?>)" ><i class="bi bi-trash"></i></button>
                                </td>
                                <td><?=$data2['nombre_alumno']?></td>
                                <td><?=$data2['observacion']?></td>
                                <td>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-download"></i></div>
                                      </div>
                                        <a class="btn btn-primary" href="BASE_URL<?=$data2['material_alumno'];?>" target="_blank">Material</a>
                                
                                    </div>

                                </td>
                                <td><?=$valor?></td>
                                <td><?=$cargar?></td>
                              </tr>
                            
                  <?php
                    }
                  }else{
                    ?>
                    <tr>
                      <td >No hay registros</td>
                    </tr>
                      
                    
                    <?php
                  }

                  ?>
              </tbody>
            </table>  
           </div>
          </div>
        </div>
      
    <div class="row">
      <div class="col-md-12 pb-3 text-center">
        <a href="actividades.php?profesor_area=<?=$idpa?>" class="btn btn-info"><< Volver Atras</a>
      </div>
    </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
<!--

<?php

include "layout/parte2.php";
?>