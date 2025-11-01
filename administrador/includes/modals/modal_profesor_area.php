<!-- MODAL PROFESOR-AREA-->
<div class="modal fade" id="modalProfesorArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Asignacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formProfesorArea" name="formProfesorArea">
          <input type="hidden" name="idprofesorarea" id="idprofesorarea" value="" >
          
          <div class="form-group">
            <label for="listProfesor">Seleccione el profesor</label>
            <select class="form-control" name="listProfesor" id="listProfesor">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listGrado">Seleccione el Grado</label>
            <select class="form-control" name="listGrado" id="listGrado">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listAula">Seleccione el Aula</label>
            <select class="form-control" name="listAula" id="listAula">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listArea">Seleccione el Area</label>
            <select class="form-control" name="listArea" id="listArea">
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