<!-- MODAL USUARIO-->
<div class="modal fade" id="modalProfesor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nuevo Profesor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formProfesor" name="formProfesor">
            <input type="hidden" name="idprofesor" id="idprofesor" value="" >

            <div class="form-group">
              <label for="control-label" >DNI:</label>
              <input type="text" class="form-control" name="dni" id="dni">
            </div>
            <div class="form-group">
              <label for="control-label" >Nombre:</label>
              <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
            <div class="form-group">
              <label for="control-label" >Nivel de Estudio:</label>
              <input type="text" class="form-control" name="nivel_est" id="nivel_est">
            </div>                    
            <div class="form-group">
              <label for="control-label" >Correo:</label>
              <input type="text" class="form-control" name="correo" id="correo">
            </div>
            <div class="form-group">
              <label for="control-label" >Telefono:</label>
              <input type="text" class="form-control" name="telefono" id="telefono">
            </div>
            <div class="form-group">
              <label for="control-label" >Direccion:</label>
              <input type="text" class="form-control" name="direccion" id="direccion">
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