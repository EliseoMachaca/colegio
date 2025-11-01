$('#tableperiodose').DataTable();
var tableperiodose;
document.addEventListener('DOMContentLoaded',function(){

    tableperiodose=$('#tableperiodose').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/periodose/table_periodose.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"periodo_id"},
            {"data":"nombre"},
            {"data":"inicio"},
            {"data":"fin"},
            {"data":"nombre_pl"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lenghtChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formPeriodoEvaluacion=document.querySelector('#formPeriodoEvaluacion');
    
   if(formPeriodoEvaluacion!=null){
        formPeriodoEvaluacion.onsubmit=function(e){
            e.preventDefault();
            
            var idperiodo=document.querySelector('#idperiodo').value;
            var nombre=document.querySelector('#nombre').value;
            var inicio=document.querySelector('#inicio').value;
            var fin=document.querySelector('#fin').value;
            var periodol=document.querySelector('#listPeriodo').value;
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
            var url='./models/periodose/ajax-periodose.php';
            
            var form=new FormData(formPeriodoEvaluacion);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalPeriodoEvaluacion').modal('hide');
                        formPeriodoEvaluacion.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Periodo",
                            text: data.msg               
                        });
                        tableperiodose.ajax.reload();
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


function openModalPeriodoEvaluacion(){
    document.querySelector('#idperiodo').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Periodo de Evaluacion';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formPeriodoEvaluacion').reset();
    $('#modalPeriodoEvaluacion').modal('show');
}

function editarPeriodoEvaluacion(id){
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Periodo';
    document.querySelector('#action').innerHTML='Actualizar';
    var idperiodo=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/periodose/edit-periodose.php?idperiodo='+idperiodo;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idperiodo').value=data.data.periodoevaluacion_id;
                    document.querySelector('#nombre').value=data.data.nombre_periodo;
                    document.querySelector('#inicio').value=data.data.inicio;
                    document.querySelector('#fin').value=data.data.fin;
                    document.querySelector('#listPeriodo').value=data.data.periodolectivo_id;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalPeriodoEvaluacion').modal('show');
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

function eliminarPeriodoEvaluacion(id){
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
            var url='./models/periodose/delet-periodose.php';
            
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
                          tableperiodose.ajax.reload();
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