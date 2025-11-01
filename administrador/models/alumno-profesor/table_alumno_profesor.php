<?php
require_once "../../../includes/config.php";


$sql='SELECT * FROM alumno_profesor as ap INNER JOIN alumnos as al ON ap.alumno_id=al.alumno_id
 INNER JOIN profesor_area  as parea ON ap.pa_id=parea.pa_id 
 INNER JOIN aulas as au ON parea.aula_id=au.aula_id 
 INNER JOIN areas as area ON parea.area_id=area.area_id 
 INNER JOIN periodo_lectivo as pel ON ap.periodolectivo_id=pel.periodolectivo_id
 INNER JOIN grados as g ON parea.grado_id=g.grado_id
 INNER JOIN profesor as p ON parea.profesor_id=p.profesor_id WHERE ap.estadop!=0;';
$query=$pdo->prepare($sql);
$query->execute();

$consulta=$query->fetchAll(PDO::FETCH_ASSOC);

for($i=0;$i<count($consulta); $i++){
    if($consulta[$i]['estadop']==1){
        $consulta[$i]['estadop']='<span class="badge bg-success">Activo</span>';
    }else{
        $consulta[$i]['estadop']='<span class="badge bg-danger">Inactivo</span>';
    }
    $consulta[$i]['acciones']='
        <button class="btn btn-primary" title="Editar" onclick="editarAlumnoProfesor('.$consulta[$i]['ap_id'].')" ><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger" title="Editar" onclick="eliminarAlumnoProfesor('.$consulta[$i]['ap_id'].')" ><i class="bi bi-trash"></i></button>
    ';

}
echo json_encode($consulta,JSON_UNESCAPED_UNICODE);
