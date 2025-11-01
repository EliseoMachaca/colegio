$('#tableaulas').DataTable();
var tableaulas;
document.addEventListener('DOMContentLoaded',function(){

    tableaulas=$('#tableaulas').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/aulas/table_aulas.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"aula_id"},
            {"data":"nombre_aula"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formAula=document.querySelector('#formAula');
    
   if(formAula!=null){
        formAula.onsubmit=function(e){
            e.preventDefault();
            
            var idaula=document.querySelector('#idaula').value;
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
            var url='./models/aulas/ajax-aulas.php';
            
            var form=new FormData(formAula);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalAula').modal('hide');
                        formAula.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Aula",
                            text: data.msg               
                        });
                        tableaulas.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Aula",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
    
})


function openModalAulas(){
    document.querySelector('#idaula').value="";
    document.querySelector('#tituloModal').innerHTML='Nueva Aula';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formAula').reset();
    $('#modalAula').modal('show');
}

function editarAula(id){
    
    //alert('HOLA');
    document.querySelector('#tituloModal').innerHTML='Actualizar Aula';
    document.querySelector('#action').innerHTML='Actualizar';
    var idaula=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/aulas/edit-aulas.php?idaula='+idaula;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idaula').value=data.data.aula_id;
                    document.querySelector('#nombre').value=data.data.nombre_aula;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalAula').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Aula",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarAula(id){
    var idaula=id;
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
            var url='./models/aulas/delet-aulas.php';
            
            request.open('POST',url,true);
            var strData="idaula="+idaula;
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
                          tableaulas.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Aula",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}