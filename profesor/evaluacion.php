<?php
if(!empty($_GET['pa'])|| !empty($_GET['act'])){
    $idpa=$_GET['pa'];
    $idactividad=$_GET['act'];
       
}else{
    header("Location: profesor/");    
}
include "../includes/config.php";
include "layout/parte1.php";
require_once "includes/modals/modal_evaluacion.php";


$idprofesor=$_SESSION['profesor_id'];


$sql="SELECT * , date_format(fecha,'%d/%m/%Y') as fecha FROM evaluaciones WHERE actividad_id='$idactividad'";
$query=$pdo->prepare($sql);
$query->execute();
$row=$query->rowCount();

?>
<div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-12 tex-center mt-3 p-4 bg-light">  
            <h2><i class="bi bi-speedometer"></i>Asignar Evaluacion</h2>
            <button class="btn btn-success" type="button" onclick="openModalEvaluacion()">Nueva Evaluacion</button>
          </div>
        </div>
        <div class="row ">
        <?php
            if($row>0){
                while($data=$query->fetch()){

                
        ?>
        <div class="col-md-12 shadow p-3 mb-5 bg-white rounded">
                <div class="row">
                    <div class="col-md-8">
                      <div>
                        <h3 class=""><?=$data['titulo'];?></h3>
                      </div>
                      <div>
                        <p>
                          <?=$data['descripcion'];?>
                        </p>
                      </div>
                      <div class="">
                       Fecha de entrega:<kbd class="bg-info"><?=$data['fecha'];?></kbd>
                          
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="p-2">
                        <button class="btn btn-info icon-btn" onclick="editarEvaluacion(<?=$data['evaluacion_id'];?>)"><i class="bi bi-pencil"></i>Editar</button>
                        <button class="btn btn-danger icon-btn" onclick="eliminarEvaluacion(<?=$data['evaluacion_id'];?>)"><i class="bi bi-trash"></i>Eliminar</button>
                      </div>
                      <div class="p-2">
                        <a class="btn btn-warning icon-btn" href="entregas.php?pa=<?=$idpa;?>&act=<?=$data['actividad_id'];?>&eva=<?=$data['evaluacion_id'];?>"><i class="bi bi-search"></i>Ver Evidencias</a> 
                      </div>
                        
                        
                    </div>
                    
                </div>
                
                
          
        </div>
        <?php
                }
            }
        ?>
      </div>
      
    <div class="row">
      <div class="col-md-12 ">
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