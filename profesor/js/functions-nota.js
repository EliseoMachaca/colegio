document.addEventListener('DOMContentLoaded',function(){

    var formNota=document.querySelector('#formNota');
    
   if(formNota!=null){
        formNota.onsubmit=function(e){
            e.preventDefault();
            
            var identrega=document.querySelector('#identrega').value;
            var nota=document.querySelector('#nota').value;



            if(nota.trim()==''){
                Swal.fire({
                    icon: "error",
                    title: "Atencion",
                    text: "Todos los campos son necesarios!"               
                });
                        
                return false;
            }

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/nota/ajax-nota.php';
            
            var form=new FormData(formNota);
            request.open('POST',url,true);
            request.send(form);
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    if(data.status){
                        Swal.fire({
                            title: "Crear Nota",
                            icon: "success",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar",
                            cancelButtonText: "No, Cancelar!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                
                                    $('#modalNota').modal('hide');
                                    location.reload();
                                    formNota.reset();

                                }
                            });
                        
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
function modalNota(){
    $('#modalNota').modal('show');
}
