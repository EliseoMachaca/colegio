$('#tableCalificaciones').DataTable();

$('#listActividades').change(function(){
        var actividad_id=this.value;

        var tablecalificaciones;
        tablecalificaciones=$('#tableCalificaciones').DataTable({
        "aProcessing":true,
        "aServerSide": true,
        "language":{
                 
            //"url":"//cdn.datatables.net/plug-ins/2.0.5/i18n/es-AR.json"
            "url":"./../js/datatable/es-AR.json"
            
        },
        "ajax":{
            "url":"./models/calificaciones/table_calificaciones.php?actividad_id="+actividad_id,
            "dataSrc":""
        },
        "columns":[
            {"data":"nombre_alumno"},
            {"data":"valor_nota"}

        ],
        "responsive":true,
        "lengthChange":true,
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"asc"]]
    });

        /*var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/calificaciones/ajax-calificaciones.php?actividad_id='+actividad_id;
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    
                    data.forEach(function(valor){
                        data+='<tr><td>'+valor.nombre_alumno+'</td><td>'+valor.valor_nota+'</td></tr>';
                    });
                    document.querySelector('#tbodyCalificaciones').innerHTML=data;
                    //alert(data.toString());
                }
            }
                */
    });  