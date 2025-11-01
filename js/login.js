$(document).ready(function(){
    $('#loginUsuario').on('click',function(){
        loginUsuario();
    });
})
function loginUsuario(){
    var login=$('#usuario').val();
    var pass=$('#password').val();
    $.ajax({
        url:'./includes/loginUsuario.php',
        method:'POST',
        data:{
            login:login,
            pass:pass
        },
        success:function(data){
            $('#messageUsuario').html(data);
            if(data.indexOf('Administrador')>=0){
                window.location='administrador/';
            }else if(data.indexOf('Profesor')>=0){
                window.location='profesor/';
            }
        }
    })
}

