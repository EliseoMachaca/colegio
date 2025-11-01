<?php
  include "../includes/config.php";
  include "layout/parte1.php";
  require_once "includes/modals/modal_periodo.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <h1>Listado de periodos lectivos</h1>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                  <h3 class="card-title">periodos registrados</h3>
                  <div class="card-tools">
                  <button class="btn btn-success" type="button" onclick="openModalPeriodoLectivo()"><i class="bi bi-plus-square"></i> Nuevo periodo</button>
                  </div>
              </div>
              <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped-hover table-bordered table-sm" id="tableperiodosl">
                        <thead>
                          <tr>
                          <th>ACCIONES</th>
                          <th>ID</th>
                          <th>NOMBRE DEL PERIODO</th>
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