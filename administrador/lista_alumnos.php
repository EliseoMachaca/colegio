<?php
  include "../includes/config.php";
  include "layout/parte1.php";
  require_once "includes/modals/modal_alumno.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Listado de alumnos</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                  <h3 class="card-title">Alumnos registrados</h3>
                  <div class="card-tools">
                  <button class="btn btn-success" type="button" onclick="openModalAlumnos()"><i class="bi bi-plus-square"></i> Nuevo Alumno</button>
                  </div>
              </div>
              <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-hover table-bordered table-sm" id="tablealumnos">
                          <thead>
                            <tr>
                            <th>ACCIONES</th>
                            <th>DNI</th>
                            <th>NOMBRE</th>
                            <th>FECHA DE NAC.</th>
                            <th>EDAD</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>DIRECCION</th>
                            <th>ESTADO</th>
                            <th>FECHA DE REG.</th>
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