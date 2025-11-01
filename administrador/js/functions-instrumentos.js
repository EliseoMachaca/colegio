$('#tableinstrumentos').DataTable();
var tableinstrumentos;
document.addEventListener('DOMContentLoaded',function(){

    tableinstrumentos=$('#tableinstrumentos').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/instrumentos/table_instrumentos.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"instrumento_ev_id"},
            {"data":"instrumento_nombre"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formInstrumento=document.querySelector('#formInstrumento');
    
   if(formInstrumento!=null){
        formInstrumento.onsubmit=function(e){
            e.preventDefault();
            
            var idgrado=document.querySelector('#idinstrumento').value;
            var nombre=document.querySelector('#nombre').value;
            var estado=document.querySelector('#listEstado').value;

            if(nombre=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }
            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/instrumentos/ajax-instrumentos.php';
            
            var form=new FormData(formInstrumento);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalInstrumento').modal('hide');
                        formInstrumento.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Grado",
                            text: data.msg               
                        });
                        tableinstrumentos.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Grado",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
  
    
})


function openModalInstrumentos(){
    document.querySelector('#idinstrumento').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Instrumento';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formInstrumento').reset();
    $('#modalInstrumento').modal('show');
}

function editarInstrumento(id){
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Instrumento';
    document.querySelector('#action').innerHTML='Actualizar';
    var idinstrumento=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/instrumentos/edit-instrumentos.php?idinstrumento='+idinstrumento;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idinstrumento').value=data.data.instrumento_ev_id;
                    document.querySelector('#nombre').value=data.data.nombre;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalInstrumento').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Instruemento",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarInstrumento(id){
    var idinstrumento=id;
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
            var url='./models/instrumentos/delet-instrumentos.php';
            
            request.open('POST',url,true);
            var strData="idinstrumento="+idinstrumento;
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
                          tableinstrumentos.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Instrumento",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}