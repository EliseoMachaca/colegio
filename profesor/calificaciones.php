  <?php
if(!empty($_GET['profesor_area'])){
  //session_start();
    //$_SESSION['profesor_area_id']=$_GET['profesor_area'];
    $idpa=$_GET['profesor_area'];
       
}else{
    header("Location: profesor/");    
}
include "../includes/config.php";
include "layout/parte1.php";

//require_once "../includes/funciones.php";
//require_once "includes/modals/modal_actividades.php";

$idprofesor=$_SESSION['profesor_id'];

$sql="SELECT * FROM actividades where pa_id='$idpa'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->rowCount();
?>

<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Calificaciones del area</h1>
        
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              
              <div class="card-header">
                  <div class="card-tools">
                    <span>Actividad:</span><br/>
                    <select name="" id="listActividades">
                      <option value="">--Seleccione--</option>
                      <?php
                      if($row>0){
                          $data=$query->fetchAll(PDO::FETCH_ASSOC);
                          foreach($data as $dt):
                      ?>
                      <option value="<?php echo $dt['actividad_id']; ?>"><?php echo $dt['titulo']; ?></option>
                      <?php
                          endforeach;
                      }
                      ?>
                    </select>
                  </div>
                                 
              </div>
              <div class="card-body">
                
                    <div class="table-responsive">
                        <table class="table table-striped -hover table-bordered table-sm" id="tableCalificaciones" style="width:100% "> 
                          <thead>
                              <tr>
                              <th>ALUMNO</th>
                              <th>NIVEL DE LOGRO</th>
                              </tr>
                          </thead>
                          <tbody >
                            

                          </tbody>
                        </table>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 pb-3 text-center">
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