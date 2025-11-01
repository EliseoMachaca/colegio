$('#tableUsuarios').DataTable();
var tableusuarios;

document.addEventListener('DOMContentLoaded', function () {
    tableusuarios = $('#tableUsuarios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url": "./../js/datatable/es-AR.json"
        },
        "ajax": {
            "url": "./models/usuarios/table_usuarios.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "acciones" },
            { "data": "usuario_id" },
            { "data": "usuario" },
            { "data": "nombre_rol" },
            { "data": "estado" }
        ],
        "responsive": true,
        "lengthChange":true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]]
    });

    var formUsuario = document.querySelector('#formUsuario');
    if(formUsuario!=null){
        
        formUsuario.onsubmit = function (e) {
            e.preventDefault();
    
            var idusuario = document.querySelector('#idusuario').value;
            var usuario = document.querySelector('#usuario').value;
            
            var clave = document.querySelector('#clave').value;
            var rol = document.querySelector('#listRol').value;
            var estado = document.querySelector('#listEstado').value;
    
            if (usuario == '') {
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios si!"
                });
    
                return false;
            }
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microsoft.XMLHTTP');
            var url = './models/usuarios/ajax-usuarios.php';
            var form = new FormData(formUsuario);
            request.open('POST', url, true);
            request.send(form);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var data = JSON.parse(request.responseText);
                    if (data.status) {
                        $('#modalUsuario').modal('hide');
                        formUsuario.reset();
                        Swal.fire({
                            icon: "success",
                            title: "Usuario",
                            text: data.msg
                        });
                        tableusuarios.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Usuario",
                            text: data.msg
                        });
                    }
                }
            };
        };

    }
    
});
function openModal(){
    document.querySelector('#idusuario').value="";
    document.querySelector('#tituloModal').innerHTML='Nuevo Usuario';
    document.querySelector('#action').innerHTML='Guardar';
    document.querySelector('#formUsuario').reset();
    $('#modalUsuario').modal('show');
}

function editarUsuario(id){
    //alert('HOLA');
    document.querySelector('#tituloModal').innerHTML='Actualizar Usuario';
    document.querySelector('#action').innerHTML='Actualizar';
    var idusuario=id;
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
        var url='./models/usuarios/edit-usuarios.php?idusuario='+idusuario;
        request.open('GET',url,true);
        request.send();
        request.onreadystatechange=function(){
            if(request.readyState==4 && request.status==200){
                var data=JSON.parse(request.responseText);
                if(data.status){
                    document.querySelector('#idusuario').value=data.data.usuario_id;
                    document.querySelector('#usuario').value=data.data.usuario;
                    
                    document.querySelector('#listRol').value=data.data.rol;
                    document.querySelector('#listEstado').value=data.data.estado;

                    $('#modalUsuario').modal('show');
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Usuario",
                        text: data.msg               
                      });
                }
            }
        }
}

function eliminarUsuario(id){
    var idusuario=id;
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
            var url='./models/usuarios/delet-usuario.php';
            
            request.open('POST',url,true);
            var strData="idusuario="+idusuario;
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
                          tableusuarios.ajax.reload();
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Usuario",
                            text: data.msg               
                        });
                    }
                }
            }

          
        }
      });
}