$('#tableperiodosl').DataTable();
var tableperiodosl;
document.addEventListener('DOMContentLoaded',function(){

    tableperiodosl=$('#tableperiodosl').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/periodosl/table_periodosl.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"periodolectivo_id"},
            {"data":"nombre_periodo"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lenghtChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formPeriodoLectivo=document.querySelector('#formPeriodoLectivo');
    
   if(formPeriodoLectivo!=null){
        formPeriodoLectivo.onsubmit=function(e){
            e.preventDefault();
            
            var idperiodo=document.querySelector('#idperiodo').value;
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
            var url='./models/periodosl/ajax-periodosl.php';
            
            var form=new FormData(formPeriodoLectivo);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalPeriodoLectivo').modal('hide');
                        formPeriodoLectivo.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Periodo",
                            text: data.msg               
                        });
                        tableperiodosl.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Periodo",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
    
})


function openModalPeriodoLectivo(){
    document.querySelector('#idperiodo').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Periodo';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formPeriodoLectivo').reset();
    $('#modalPeriodoLectivo').modal('show');
}

function editarPeriodoLectivo(id){
    
    //alert('HOLA');
    document.querySelector('#tituloModal').innerHTML='Actualizar Periodo';
    document.querySelector('#action').innerHTML='Actualizar';
    var idperiodo=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/periodosl/edit-periodosl.php?idperiodo='+idperiodo;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idperiodo').value=data.data.periodolectivo_id;
                    document.querySelector('#nombre').value=data.data.nombre_periodo;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalPeriodoLectivo').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Periodo",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarPeriodoLectivo(id){
    var idperiodo=id;
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
            var url='./models/periodosl/delet-periodosl.php';
            
            request.open('POST',url,true);
            var strData="idperiodo="+idperiodo;
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
                          tableperiodosl.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Periodo",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}