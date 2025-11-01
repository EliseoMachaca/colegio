<?php
  include "../includes/config.php";
  include "layout/parte1.php";
  require_once "includes/modals/modal_competencia.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Listado de competencias</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                  <h3 class="card-title">Competencias registradas</h3>
                  <div class="card-tools">
                  <button class="btn btn-success" type="button" onclick="openModalCompetencias()"><i class="bi bi-plus-square"></i> Nueva Competencia</button>
                  </div>
              </div>
              <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-hover table-bordered table-sm" id="tablecompetencias">
                        <thead>
                          <tr>
                          <th>ACCIONES</th>
                          <th>ID</th>
                          <th>NOMBRE</th>
                          <th>AREA</th>
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