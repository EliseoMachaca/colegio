  <?php
if(!empty($_GET['profesor_area'])){
    $idpa=$_GET['profesor_area'];
    
       
}else{
    header("Location: profesor/");    
}
include "../includes/config.php";
include "layout/parte1.php";

//require_once "../includes/funciones.php";
require_once "includes/modals/modal_actividades.php";

$idprofesor=$_SESSION['profesor_id'];


$sql="SELECT *, date_format(fecha,'%d/%m/%Y') as fecha FROM actividades as ac INNER JOIN profesor_area as pa ON ac.pa_id=pa.pa_id
INNER JOIN competencias as c ON c.competencia_id=ac.competencia_id
INNER JOIN instrumento_ev as i ON i.instrumento_ev_id=ac.instrumento_ev_id WHERE pa.pa_id='$idpa'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->rowCount();

$sql_ag="SELECT nombre_area, nombre_grado FROM profesor_area as pa 
INNER JOIN areas as a ON pa.area_id=a.area_id 
INNER JOIN grados  as g ON g.grado_id=pa.grado_id where pa.pa_id='$idpa'";
$query_ag=$pdo->prepare($sql_ag);
$query_ag->execute();
$row_ag=$query_ag->rowCount();
if($row_ag>0){
  $data_ag=$query_ag->fetch();
 }

?>

<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-12 tex-center mt-3 p-4 bg-light">  
            <h2><i class="bi bi-speedometer"></i>Actividades del area de <?= $data_ag['nombre_area'];?> del <?= $data_ag['nombre_grado'];;?> grado</h2>
            <button class="btn btn-success" type="button" onclick="openModalActividad()">Nueva Actividad</button>
          </div>
        </div>
        <div class="row ">
        <?php
            if($row>0){
                while($data=$query->fetch()){

                
        ?>

          <div class="col-md-12 ">
              <div class="card ">
                  <h5 class="card-header text-center"><?=$data['titulo'];?></h5>
                  <div class="card-body">
                    <p class="card-text"><?=$data['descripcion'];?></p>
                    <p>Fecha de entrega:<kbd class="bg-info ml-2"><?=$data['fecha'];?></kbd></p>
                    <div class="input-group">
                                          <div class="input-group-prepend">
                                              <div class="input-group-text"><i class="bi bi-download"></i></div>
                                          </div>
                                          <a class="btn btn-primary" href="BASE_URL<?=$data['material'];?>" target="_blank">Material de Descarga</a>
                                          
                    </div>
                    
                  </div>
                  <div class="card-body">
                    
                    <p class="card-text">COMPETENCIA A EVALUAR:&nbsp<?=$data['nombre'];?></p>
                    <p class="card-text">EVIDENCIA DE APRENDIZAJE:&nbsp<?=$data['evidencia'];?></p>
                    <p class="card-text">INSTRUMENTO DE EVALUACION:&nbsp<?=$data['instrumento_nombre'];?></p>
                  </div>
                  <div class="card-body text-center">
                                        <button class="btn btn-info icon-btn" onclick="editarActividad(<?=$data['actividad_id'];?>)"><i class="bi bi-pencil"></i>Editar</button>
                                        <button class="btn btn-danger icon-btn" onclick="eliminarActividad(<?=$data['actividad_id'];?>)"><i class="bi bi-trash"></i>Eliminar</button>
                                        <a class="btn btn-warning icon-btn" href="entregas.php?pa=<?=$data['pa_id'];?>&act=<?=$data['actividad_id'];?>"><i class="bi bi-search"></i>Ver Evidencias</a> 
                  </div>
                </div>
          </div>
        
        <?php
                }
            }
        ?>
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