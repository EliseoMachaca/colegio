document.addEventListener('DOMContentLoaded',function(){

    var formEvidencia=document.querySelector('#formEvidencia');
    
   if(formEvidencia!=null){
        formEvidencia.onsubmit=function(e){
            e.preventDefault();
            
            var idactividad=document.querySelector('#idactividad').value;
            var alumno=document.querySelector('#listAlumnoArea').value;
            var evidencia=document.querySelector('#file').value;
            var observacion=document.querySelector('#observacion').value;
            

            if(alumno==''|| evidencia=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/entregas/ajax-entregas.php';
            
            var form=new FormData(formEvidencia);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    
                    Swal.fire({
                        title: "Crear/Actualizar Evidencia",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Aceptar",
                        cancelButtonText: "No, Cancelar!"
                      }).then((result) => {
                        if (result.isConfirmed) {
                            if(data.status){
                                $('#modalEvidencia').modal('hide');
                                location.reload();
                                formEvidencia.reset();

                            }else{
                                Swal.fire({
                                    icon: "error",
                                    title: "Atencion2",
                                    text: data.msg               
                                });
                            }
                        }
                      });
                        
                }
            }
        }
   }
       
})
window.addEventListener('load',function(){
    
   
},false)

function openModalEvidencia(){
    document.querySelector('#tituloModal').innerHTML="Nueva Evidencia";
    document.querySelector('#action').innerHTML="Guardar";
    document.querySelector('#formEvidencia').reset();
    
    $('#modalEvidencia').modal('show');
}



function editarEntrega(id){
    var identrega=id;
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Evaluacion';
    document.querySelector('#action').innerHTML='Actualizar';
    
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/entregas/edit-entregas.php?identrega='+identrega;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#identrega').value=data.data.ev_entregadas_id;
                    document.querySelector('#idactividad').value=data.data.actividad_id;
                    document.querySelector('#listAlumnoArea').value=data.data.alumno_id;
                    document.querySelector('#observacion').value=data.data.observacion;
                    
                    $('#modalEvidencia').modal('show');
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

function eliminarEntrega(id){
    var identrega=id;
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
            var url='./models/entregas/delet-entregas.php';
            
            request.open('POST',url,true);
            var strData="identrega="+identrega;
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