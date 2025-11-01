$('#tablecomptetencias').DataTable();
var tablecompetencias;
document.addEventListener('DOMContentLoaded',function(){

    tablecompetencias=$('#tablecompetencias').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/competencias/table_competencias.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"competencia_id"},
            {"data":"nombre"},
            {"data":"nombre_area"},
            {"data":"estado"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formCompetencia=document.querySelector('#formCompetencia');
    
   if(formCompetencia!=null){
        formCompetencia.onsubmit=function(e){
            e.preventDefault();
            
            var idcompetencia=document.querySelector('#idcompetencia').value;
            var nombre=document.querySelector('#nombre').value;
            var area=document.querySelector('#listArea').value;
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
            var url='./models/competencias/ajax-competencias.php';
            
            var form=new FormData(formCompetencia);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalCompetencia').modal('hide');
                        formCompetencia.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Competencia",
                            text: data.msg               
                        });
                        tablecompetencias.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Competencia",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
    
})


function openModalCompetencias(){
    document.querySelector('#idcompetencia').value="";
    document.querySelector('#tituloModal').innerHTML='Nueva Competencia';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formCompetencia').reset();
    $('#modalCompetencia').modal('show');
}

function editarCompetencia(id){
    
    document.querySelector('#tituloModal').innerHTML='Actualizar Competencia';
    document.querySelector('#action').innerHTML='Actualizar';
    var idcompetencia=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/competencias/edit-competencias.php?idcompetencia='+idcompetencia;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idcompetencia').value=data.data.competencia_id;
                    document.querySelector('#nombre').value=data.data.nombre;
                    document.querySelector('#listArea').value=data.data.area_id;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalCompetencia').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Competencia",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarCompetencia(id){
    var idcompetencia=id;
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
            var url='./models/competencias/delet-competencias.php';
            
            request.open('POST',url,true);
            var strData="idcompetencia="+idcompetencia;
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
                          tablecompetencias.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Competencia",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}