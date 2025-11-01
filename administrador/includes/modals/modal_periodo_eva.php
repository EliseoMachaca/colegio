<!-- MODAL USUARIO-->
<div class="modal fade" id="modalPeriodoEvaluacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Periodo de Evaluacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formPeriodoEvaluacion" name="formPeriodoEvaluacion">
          <input type="hidden" name="idperiodo" id="idperiodo" value="" >
          <div class="form-group">
            <label for="control-label" >Nombre del Periodo:</label>
            <input type="text" class="form-control" name="nombre" id="nombre">
          </div>
          <div class="form-group">
            <label for="control-label" >Inicio:</label>
            <input type="date" class="form-control" name="inicio" id="inicio">
          </div>
          <div class="form-group">
            <label for="control-label" >Fin:</label>
            <input type="date" class="form-control" name="fin" id="fin">
          </div>
          <div class="form-group">
            <label for="listPeriodo">Seleccione el Periodo Lectivo:</label>
            <select class="form-control" name="listPeriodo" id="listPeriodo">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listEstado">Estado</label>
            <select class="form-control" name="listEstado" id="listEstado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button  class="btn btn-primary" type="submit" id="action">Guardar</button>
          </div>
          
        </form>
      </div>
      
    </div>
  </div>
</div>