$('#tablealumnos').DataTable();
var tablealumnos;
document.addEventListener('DOMContentLoaded',function(){
    tablealumnos=$('#tablealumnos').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/alumnos/table_alumnos.php",
            "dataSrc":""
        },
        "columns":[
            {"data":"acciones"},
            {"data":"dni"},
            {"data":"nombre_alumno"},
            {"data":"fecha_nac"},
            {"data":"edad"},
            {"data":"telefono"},
            {"data":"correo"},
            {"data":"direccion"},
            {"data":"estado"},
            {"data":"fecha_registro"},
            

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

    var formAlumno=document.querySelector('#formAlumno');
    
   if(formAlumno!=null){
        formAlumno.onsubmit=function(e){
            e.preventDefault();
            
            var idalumno=document.querySelector('#idalumno').value;
            var nombre=document.querySelector('#nombre').value;
            var edad=document.querySelector('#edad').value;
            var direccion=document.querySelector('#direccion').value;
            var dni=document.querySelector('#dni').value;
            
            var telefono=document.querySelector('#telefono').value;
            var correo=document.querySelector('#correo').value;
            var fecha_nac=document.querySelector('#fecha_nac').value;
            var fecha_reg=document.querySelector('#fecha_reg').value;
            var estado=document.querySelector('#listEstado').value;

            if(nombre==''|| direccion=='' || dni=='' || telefono=='' || correo=='' || fecha_nac=='' || fecha_reg=='' ){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }
            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/alumnos/ajax-alumnos.php';
            
            var form=new FormData(formAlumno);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        $('#modalAlumno').modal('hide');
                        formAlumno.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Alumno",
                            text: data.msg               
                        });
                        tablealumnos.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Alumno",
                            text: data.msg               
                        });
                    }
                }
            }
        }
   }
   

    
})


function openModalAlumnos(){
    document.querySelector('#idalumno').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Alumno';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formAlumno').reset();
    $('#modalAlumno').modal('show');
}

function editarAlumno(id){
   
    document.querySelector('#tituloModal').innerHTML='Actualizar Alumno';
    document.querySelector('#action').innerHTML='Actualizar';
    var idalumno=id;
    
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/alumnos/edit-alumnos.php?idalumno='+idalumno;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idalumno').value=data.data.alumno_id;
                    document.querySelector('#nombre').value=data.data.nombre_alumno;
                    document.querySelector('#edad').value=data.data.edad;
                    document.querySelector('#direccion').value=data.data.direccion;
                    document.querySelector('#dni').value=data.data.dni;
                    document.querySelector('#telefono').value=data.data.telefono;
                    document.querySelector('#correo').value=data.data.correo;
                    document.querySelector('#fecha_nac').value=data.data.fecha_nac;
                    document.querySelector('#fecha_reg').value=data.data.fecha_registro;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalAlumno').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Alumno",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarAlumno(id){
    var idalumno=id;
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
            var url='./models/alumnos/delet-alumnos.php';
            
            request.open('POST',url,true);
            var strData="idalumno="+idalumno;
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
                          tablealumnos.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Alumno",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}