<!--MODAL NOTA-->
<div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Cargar Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formNota" name="formNota">
          <input type="hidden" name="ideventrega" id="ideventrega" value="<?=$ev_entregada;?>" >
          
          <div class="form-group">
            <label for="control-label" >Nota</label>
            <select class="form-control" name="nota" id="nota">
              <option value="1">C</option>
              <option value="2">B</option>
              <option value="3">A</option>
              <option value="4">AD</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="control-label" >Nota:</label>
            <p>Los cambios no podran ser editados</p>
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