$('#tablegrados').DataTable();
var tablegrados;
document.addEventListener('DOMContentLoaded',function(){

    tablegrados=$('#tablegrados').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/grados/table_grados.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"grado_id"},
            {"data":"nombre_grado"},
            {"data":"nombre_periodo"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formGrado=document.querySelector('#formGrado');
    
   if(formGrado!=null){
        formGrado.onsubmit=function(e){
            e.preventDefault();
            
            var idgrado=document.querySelector('#idgrado').value;
            var nombre=document.querySelector('#nombre').value;
            var periodo=document.querySelector('#listPeriodo').value;
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
            var url='./models/grados/ajax-grados.php';
            
            var form=new FormData(formGrado);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalGrado').modal('hide');
                        formGrado.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Grado",
                            text: data.msg               
                        });
                        tablegrados.ajax.reload();
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


function openModalGrados(){
    document.querySelector('#idgrado').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Grado';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formGrado').reset();
    $('#modalGrado').modal('show');
}

function editarGrado(id){
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Grado';
    document.querySelector('#action').innerHTML='Actualizar';
    var idgrado=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/grados/edit-grados.php?idgrado='+idgrado;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idgrado').value=data.data.grado_id;
                    document.querySelector('#nombre').value=data.data.nombre_grado;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalGrado').modal('show');
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

function eliminarGrado(id){
    var idgrado=id;
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
            var url='./models/grados/delet-grados.php';
            
            request.open('POST',url,true);
            var strData="idgrado="+idgrado;
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
                          tablegrados.ajax.reload();
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
      });
}