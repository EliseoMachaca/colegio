$('#tableareas').DataTable();
var tableareas;
document.addEventListener('DOMContentLoaded',function(){

    tableareas=$('#tableareas').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/areas/table_areas.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"area_id"},
            {"data":"nombre_area"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formArea=document.querySelector('#formArea');
    
   if(formArea!=null){
        formArea.onsubmit=function(e){
            e.preventDefault();
            
            var idarea=document.querySelector('#idarea').value;
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
            var url='./models/areas/ajax-areas.php';
            
            var form=new FormData(formArea);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalArea').modal('hide');
                        formArea.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Area",
                            text: data.msg               
                        });
                        tableareas.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Area",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
    
})


function openModalAreas(){
    document.querySelector('#idarea').value="";
    document.querySelector('#tituloModal').innerHTML='Nueva Area';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formArea').reset();
    $('#modalArea').modal('show');
}

function editarArea(id){
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Area';
    document.querySelector('#action').innerHTML='Actualizar';
    var idarea=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/areas/edit-areas.php?idarea='+idarea;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idarea').value=data.data.area_id;
                    document.querySelector('#nombre').value=data.data.nombre_area;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalArea').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Area",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarArea(id){
    var idarea=id;
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
            var url='./models/areas/delet-areas.php';
            
            request.open('POST',url,true);
            var strData="idarea="+idarea;
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
                          tableareas.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Area",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}