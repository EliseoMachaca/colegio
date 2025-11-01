document.addEventListener('DOMContentLoaded',function(){

    var formActividad=document.querySelector('#formActividad');
    
   if(formActividad!=null){
        formActividad.onsubmit=function(e){
            e.preventDefault();
            
            var idactividad=document.querySelector('#idactividad').value;
            var titulo=document.querySelector('#titulo').value;
            var descripcion=document.querySelector('#descripcion').value;
            var material=document.querySelector('#file').value;

            if(titulo==''|| descripcion=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/actividades/ajax-actividad.php';
            
            var form=new FormData(formActividad);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalActividad').modal('hide');
                        formActividad.reset();
                        Swal.fire({
                            title: "Crear/Actualizar!",
                            text:data.msg,
                            icon: "success",
                            timer:5000
                          
                          });
                          
                          location.reload();
                          
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Atencion",
                            text: data.msg               
                        });
                    }
    
                }
            }
        }
   }
       
})
function openModalActividad(){
    document.querySelector('#idactividad').value="";
    document.querySelector('#tituloModal').innerHTML="Nueva Actividad";
    document.querySelector('#action').innerHTML="Guardar";
    document.querySelector('#formActividad').reset();
    $('#modalActividad').modal('show');
}
function editarActividad(id){
    var idactividad=id;
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Contenido';
    document.querySelector('#action').innerHTML='Actualizar';
    
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/actividades/edit-actividad.php?idactividad='+idactividad;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idactividad').value=data.data.actividad_id;
                    document.querySelector('#titulo').value=data.data.titulo;
                    document.querySelector('#descripcion').value=data.data.descripcion;
                    document.querySelector('#listCompetencia').value=data.data.competencia_id;
                    document.querySelector('#listInstrumento').value=data.data.instrumento_ev_id;
                    document.querySelector('#evidencia').value=data.data.evidencia;
                    document.querySelector('#fecha').value=data.data.fecha;

                    $('#modalActividad').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Atencion",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarActividad(id){
    var idactividad=id;
    Swal.fire({
        title: "Desea eliminar?",
        text: "no se podra revertir la accion!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
        cancelButtonText: "No, Cancelar!"
      }).then((result) => {
        if (result.isConfirmed) {
            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/actividades/delet-actividad.php';
            
            request.open('POST',url,true);
            var strData="idactividad="+idactividad;
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            request.send(strData);
            
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        Swal.fire({
                            title: "Eliminado!",
                            text:data.msg,
                            icon: "success"
                          });
                          location.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Atencion",
                            text: data.msg
                               
                        });
                    }
                }
            }

          
        }
      });
}