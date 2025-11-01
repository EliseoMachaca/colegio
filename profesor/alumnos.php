<?php
if(!empty($_GET['profesor_area'])){
  $idpa=$_GET['profesor_area'];
  $area=$_GET['area'];
  $grado=$_GET['grado'];
       
}else{
    header("Location: profesor/");    
}
include "../includes/config.php";
include "layout/parte1.php";


$idprofesor=$_SESSION['profesor_id'];


$sql="SELECT a.dni, a.nombre_alumno FROM alumno_profesor as ap 
INNER JOIN profesor_area as pa ON ap.pa_id=pa.pa_id 
INNER JOIN alumnos as a ON ap.alumno_id=a.alumno_id 
WHERE pa.pa_id='$idpa'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->rowCount();

?>
////
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-12 tex-center mt-3 p-4 bg-light">  
            <h2><i class="bi bi-speedometer"></i>Lista de alumnos del area de <?= $area;?> del <?= $grado;?> grado</h2>
            
          </div>
        </div>
        <div class="row ">
          <div class="col-md-12 shadow p-3 mb-5 bg-white rounded" >
            <div class="table-responsive">
              <table class="table table-hover table-bordered" id="tablealumnos">
                <thead>
                    <tr>
                      <th>ALUMNO</th>
                      <th>DNI</th>
                      <th>ULTIMO ACCESO AL SISTEMA</th>
                    
                    </tr>
                </thead>
                <tbody>
                <?php
                      if($row>0){
                        while($data=$query->fetch()){
                              $idalumno=$data['alumno_id'];
                              $sql_acceso="SELECT u_acceso FROM alumnos WHERE alumno_id='$idalumno'";
                              $query_acceso=$pdo->prepare($sql_acceso);
                              $query_acceso->execute();
                              $res_acceso=$query_acceso->fetch();
                ?>
                      <tr>
                        <td><?=$data['nombre_alumno']?></td>
                        <td><?=$data['dni']?></td>
                        <td>
                            <?php
                              if($res_acceso['u_acceso']==null){
                                echo '<kbd class="badge badge-danger">NUNCA</kbd>';
                                }else{
                                  echo $res_acceso['u_acceso'];
                                }
                            ?>

                        </td>
                        
                      </tr>     
                <?php
                        }
                      }
                ?>
                </tbody>
              </table>
            </div>
          
          </div>
        </div>
        
      
    <div class="row">
      <div class="col-md-12 ">
        <a href="index.php" class="btn btn-info"><< Volver Atras</a>
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
