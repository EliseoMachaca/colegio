<?php

  include "../includes/config.php";
  include "layout/parte1.php";
  
//  $idprofesor=$_SESSION['profesor_id'];

  $sql="SELECT * FROM profesor_area as pa INNER JOIN grados as g ON pa.grado_id=g.grado_id INNER JOIN aulas as a ON pa.aula_id=a.aula_id INNER JOIN profesor as p ON pa.profesor_id=p.profesor_id INNER JOIN areas as ar ON pa.area_id=ar.area_id  WHERE pa.estadopa!=0 AND pa.profesor_id='$idprofesor'";
  $query=$pdo->prepare($sql);
  $query->execute();
  $row=$query->rowCount();
  
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-md-12 border shadow p-2 bg-info text-white">
            <h1>SISTEMA ESCOLAR</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 tex-center mt-3 p-4 bg-light">
            <h4 >MIS CURSOS</h4>
          </div>
        </div>

        <div class="row">
        <?php
        
          if($row>0){
              while($data=$query->fetch()){
        ?>
                <div class="col-md-4 text-center border mt-3 p-4 bg-light">
                  <div class="card " style="width: 18rem;">
                    <img src="images/card-mat.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h4 class="card-title font-weight-bold"><?=$data['nombre_area'];?></h4>
                      <h5 class="card-title">Grado <kbd class="bg-info"><?=$data['nombre_grado'];?></kbd>-Aula <kbd class="bg-info"><?=$data['nombre_aula'];?></kbd> </h5>
                      <a href="actividades.php?profesor_area=<?=$data['pa_id'];?>"  class="btn btn-primary">Acceder</a>
                      <a href="alumnos.php?profesor_area=<?=$data['pa_id'];?>&area=<?=$data['nombre_area'];?>&grado=<?=$data['nombre_grado'];?>" class="btn btn-warning">Ver Alumnos</a>
                  
                    </div>

                  </div>
                </div>  
        <?php          
              }
          }
        ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include "layout/parte2.php";
?>
