<!-- MODAL PROFESOR-AREA-->
<div class="modal fade" id="modalAlumnoProfesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Asignacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAlumnoProfesor" name="formAlumnoProfesor">
          <input type="hidden" name="idalumnoprofesor" id="idalumnoprofesor" value="" >
          
          <div class="form-group">
            <label for="listAlumno">Seleccione el Alumno</label>
            <select class="form-control" name="listAlumno" id="listAlumno">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listAProfesor">Seleccione el Profesor</label>
            <select class="form-control" name="listAProfesor" id="listAProfesor">
                <!-- CONTENIDO AJAX -->
            </select>
          </div>
          <div class="form-group">
            <label for="listPeriodo">Seleccione el Periodo</label>
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