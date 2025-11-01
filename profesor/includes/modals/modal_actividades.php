<!-- MODAL Actividades-->
<div class="modal fade" id="modalActividad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Nueva Actividad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formActividad" name="formActividad" enctype="multipart/form-data">
          <input type="hidden" name="idactividad" id="idactividad" value="" >
          <input type="hidden" name="idprofesorarea" id="idprofesorarea" value="<?=$idpa;?>" >
          <div class="form-group">
            <label for="control-label" >Titulo de la actividad</label>
            <input type="text" class="form-control" name="titulo" id="titulo">
          </div>
          <div class="form-group">
            <label for="control-label" >Descripcion de la actividad</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
          </div>
          
          <div class="form-group">
            <label for="control-label" >Adjuntar Material</label>
            <input type="file" class="form-control" name="file" id="file">
          </div>
          
          <fieldset >
            <legend>EVALUACION:</legend>
            <div class="form-group">
              <label for="listCompetencia">Seleccione la Competencia</label>
              <select class="form-control" name="listCompetencia" id="listCompetencia">
                  <!-- CONTENIDO AJAX -->
              </select>
            </div>
            <div class="form-group">
              <label for="control-label" >Evidencia de Aprendizaje</label>
              <input type="text" class="form-control" name="evidencia" id="evidencia">
            </div>
            <div class="form-group">
              <label for="listInstrumento">Seleccione el Instrumento de Evaluacion</label>
              <select class="form-control" name="listInstrumento" id="listInstrumento">
                  <!-- CONTENIDO AJAX -->
              </select>
            </div>
            <div class="form-group">
              <label for="control-label" >Fecha Limite  de Entrega</label>
              <input type="date" class="form-control" name="fecha" id="fecha">
            </div>
          </fieldset>
          
          
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button  class="btn btn-primary" type="submit" id="action">Guardar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>