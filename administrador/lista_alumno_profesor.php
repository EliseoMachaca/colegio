<?php
  include "../includes/config.php";
  include "layout/parte1.php";
  require_once "includes/modals/modal_alumno_profesor.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Listado de estudiantes asignados a sus areas y profesores </h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                  <h3 class="card-title">Asignaciones registradas</h3>
                  <div class="card-tools">
                  <button class="btn btn-success" type="button" onclick="openModalAlumnoProfesor()"><i class="bi bi-plus-square"></i> Nueva Asinacion</button>
                  </div>
              </div>
              <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-hover table-bordered table-sm" id="tablealumnoprofesor">
                        <thead>
                          <tr>
                          <th>ACCIONES</th>
                          <th>ID</th>
                          <th>NOMBRE DEL ALUMNO</th>
                          <th>AREA</th>
                          <th>GRADO</th>
                          <th>NOMBRE DEL PROFESOR</th>
                          <th>PERIODO</th>
                          <th>ESTADO</th>
                          </tr>
                      </thead>
                          <tbody>
                            
                          </tbody>
                        </table>
                    </div>
              </div>
            </div>
          </div>
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