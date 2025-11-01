$('#tableprofesoresareas').DataTable();
var tableprofesoresareas;
document.addEventListener('DOMContentLoaded',function(){
    tableprofesoresareas=$('#tableprofesoresareas').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/profesor-area/table_profesor_area.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"pa_id"},
            {"data":"nombre"},
            {"data":"nombre_grado"},
            {"data":"nombre_aula"},
            {"data":"nombre_area"},
            {"data":"nombre_periodo"},
            {"data":"estadopa"}

        ],
        "responsive":true,
        "lenghtChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formProfesorArea=document.querySelector('#formProfesorArea');
    
   if(formProfesorArea!=null){
        formProfesorArea.onsubmit=function(e){
            e.preventDefault();
            
            var idprofesorarea=document.querySelector('#idprofesorarea').value;
            var nombre=document.querySelector('#listProfesor').value;
            var grado=document.querySelector('#listGrado').value;
            var aula=document.querySelector('#listAula').value;
            var area=document.querySelector('#listArea').value;
            
            var estado=document.querySelector('#listEstado').value;

            if(nombre==''|| grado=='' || aula=='' || area=='' ||  estado=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }
            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/profesor-area/ajax-profesor-area.php';
            
            var form=new FormData(formProfesorArea);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalProfesorArea').modal('hide');
                        formProfesorArea.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Asignar Area",
                            text: data.msg               
                        });
                        tableprofesoresareas.ajax.reload();
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
function openModalProfesorArea(){
    document.querySelector('#idprofesorarea').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Asignacion de Area';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formProfesorArea').reset();
    $('#modalProfesorArea').modal('show');
}

function editarProfesorArea(id){
    
    //alert('HOLA');
    document.querySelector('#tituloModal').innerHTML='Actualizar Asignacion de area';
    document.querySelector('#action').innerHTML='Actualizar';
    var idprofesorarea=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/profesor-area/edit-profesor-area.php?id='+idprofesorarea;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idprofesorarea').value=data.data.pa_id;
                    document.querySelector('#listProfesor').value=data.data.profesor_id;
                    document.querySelector('#listGrado').value=data.data.grado_id;
                    document.querySelector('#listAula').value=data.data.aula_id;
                    document.querySelector('#listArea').value=data.data.area_id;
                    document.querySelector('#listEstado').value=data.data.estadopa;

                    $('#modalProfesorArea').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Asignar Area",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarProfesorArea(id){
    var idprofesorarea=id;
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
            var url='./models/profesor-area/delet-profesor-area.php';
            
            request.open('POST',url,true);
            var strData="id="+idprofesorarea;
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
                          tableprofesoresareas  .ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Profesor Materia",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}