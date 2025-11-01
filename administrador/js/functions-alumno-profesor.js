$('#tablealumnoprofesor').DataTable();
var tablealumnoprofesor;
document.addEventListener('DOMContentLoaded',function(){
    tablealumnoprofesor=$('#tablealumnoprofesor').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/alumno-profesor/table_alumno_profesor.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"pa_id"},
            {"data":"nombre_alumno"},
            {"data":"nombre_area"},
            {"data":"nombre_grado"},
            {"data":"nombre"},
            {"data":"nombre_periodo"},
            {"data":"estadop"}

        ],
        "responsive":true,
        "lenghtChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formAlumnoProfesor=document.querySelector('#formAlumnoProfesor');
    
   if(formAlumnoProfesor!=null){
        formAlumnoProfesor.onsubmit=function(e){
            e.preventDefault();
            
            var idalumnoprofesor=document.querySelector('#idalumnoprofesor').value;
            var alumno=document.querySelector('#listAlumno').value;
            var profesor=document.querySelector('#listAProfesor').value;
            var periodo=document.querySelector('#listPeriodo').value;
            var estado=document.querySelector('#listEstado').value;

            if(alumno==''|| profesor=='' || periodo=='' || estado=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }
            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/alumno-profesor/ajax-alumno-profesor.php';
            
            var form=new FormData(formAlumnoProfesor);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalAlumnoProfesor').modal('hide');
                        formAlumnoProfesor.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Asignar Area",
                            text: data.msg               
                        });
                        tablealumnoprofesor.ajax.reload();
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
function openModalAlumnoProfesor(){
    document.querySelector('#idalumnoprofesor').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Asignacion de Area';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formAlumnoProfesor').reset();
    $('#modalAlumnoProfesor').modal('show');
}

function editarAlumnoProfesor(id){
    var idalumnoprofesor=id;
    document.querySelector('#tituloModal').innerHTML='Actualizar Asignacion de area';
    document.querySelector('#action').innerHTML='Actualizar';
    
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/alumno-profesor/edit-alumno-profesor.php?id='+idalumnoprofesor;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idalumnoprofesor').value=data.data.ap_id;
                    document.querySelector('#listAlumno').value=data.data.alumno_id;
                    document.querySelector('#listAProfesor').value=data.data.pa_id;
                    document.querySelector('#listPeriodo').value=data.data.periodolectivo_id;
                    document.querySelector('#listEstado').value=data.data.estadop;

                    $('#modalAlumnoProfesor').modal('show');
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

function eliminarAlumnoProfesor(id){
    var idalumnoprofesor=id;
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
            var url='./models/alumno-profesor/delet-alumno-profesor.php';
            
            request.open('POST',url,true);
            var strData="id="+idalumnoprofesor;
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
                          tablealumnoprofesor.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Alumno Profesor",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}