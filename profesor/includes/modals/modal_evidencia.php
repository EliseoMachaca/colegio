<!--MODAL Evidencia-->
<div class="modal fade" id="modalEvidencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Evidencia</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form action="" id="formEvidencia" name="formEvidencia">
          
          <input type="hidden" name="identrega" id="identrega" value="" >
          <input type="hidden" name="idactividad" id="idactividad" value="<?=$idactividad;?>" >
          
          <div class="form-group">
              <label for="listAlumnoArea">Seleccione el estudiante</label>
              <select class="form-control" name="listAlumnoArea" id="listAlumnoArea">
              
                <?php
                if($row_alumnos>0){
                                         
                        while($data1=$query_alumnos->fetch()){
                          ?>
                          <option value="<?=$data1['alumno_id'];?>"><?=$data1['nombre_alumno'];?></option> 
                          <?php 
                        }
                      }  
                ?>
              </select>
          </div>

          <div class="form-group">
            <label for="control-label" >Adjuntar Evidencia</label>
            <input type="file" class="form-control" name="file" id="file">
          </div>
          <div class="form-group row">
              <label class="control-label col-md-3">Observaciones</label>
              <div class="col-md-8">
                  <textarea name="observacion" id="observacion" rows="4" class="form-control" placeholder="observaciones"></textarea>
              </div>
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