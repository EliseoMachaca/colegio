window.addEventListener('load',function(){
    
    showProfesor();
    showGrado();
    showAula();
    showArea();
    showPeriodo();
    showAProfesor();
    showAlumno();
    showCompetencia();
},false)

function showProfesor(){

    if(document.querySelector('#listProfesor')!=null){

        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-profesor.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.profesor_id+'">'+valor.nombre+'</option>';
                    });
                    document.querySelector('#listProfesor').innerHTML=data;
                }
            }
    }

}
    

function showAula(){

    if(document.querySelector('#listAula')!=null){
        
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-aula.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.aula_id+'">'+valor.nombre_aula+'</option>';
                    });
                    document.querySelector('#listAula').innerHTML=data;
                }
            }
    }
}
function showArea(){
    

    if(document.querySelector('#listArea')!=null){

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-area.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.area_id+'">'+valor.nombre_area+'</option>';
                    });
                    document.querySelector('#listArea').innerHTML=data;
                }
            }
    }
}

function showCompetencia(){
    

    if(document.querySelector('#listCompetencia')!=null){

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-competencia.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.competencia_id+'">'+valor.nombre+'</option>';
                    });
                    document.querySelector('#listCompetencia').innerHTML=data;
                }
            }
    }
}
function showGrado(){
    if(document.querySelector('#listGrado')!=null){

        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-grado.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.grado_id+'">'+valor.nombre_grado+'</option>';
                    });
                    document.querySelector('#listGrado').innerHTML=data;
                }
            }
    }
}
function showPeriodo(){
    if(document.querySelector('#listPeriodo')!=null){

            var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-periodo.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.periodolectivo_id+'">'+valor.nombre_periodo+'</option>';
                    });
                    document.querySelector('#listPeriodo').innerHTML=data;
                }
            }
    }
}

function showAProfesor(){

    if(document.querySelector('#listAProfesor')!=null){
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-aprofesor.php';
            
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.pa_id+'">Profesor:'+valor.nombre+', Grado:'+valor.nombre_grado+', Aula:' +valor.nombre_aula+', Area:'+valor.nombre_area+'</option>';
                    });
                    document.querySelector('#listAProfesor').innerHTML=data;
                }
            }

    }
    
    
}
function showAlumno(){

    if(document.querySelector('#listAlumno')!=null){
        var request=(window.XMLHttpRequest)?new XMLHttpRequest:new ActiveXObject('Microsoft.XMLHTTP');
            var url='./models/options/options-alumno.php';
            
            request.open('GET',url,true);
            request.send();
            request.onreadystatechange=function(){
                if(request.readyState==4 && request.status==200){
                    var data=JSON.parse(request.responseText);
                    data.forEach(function(valor){
                        data+='<option value="'+valor.alumno_id+'">'+valor.nombre_alumno+'</option>';
                    });
                    document.querySelector('#listAlumno').innerHTML=data;
                }
            }

    }
        
}
