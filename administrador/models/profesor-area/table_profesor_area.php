<?php
require_once "../../../includes/config.php";


$sql='SELECT * FROM profesor_area as pa INNER JOIN profesor as p ON pa.profesor_id=p.profesor_id INNER JOIN grados as g ON pa.grado_id=g.grado_id INNER JOIN aulas as au ON pa.aula_id=au.aula_id INNER JOIN areas as a ON pa.area_id=a.area_id INNER JOIN periodo_lectivo as pl ON g.periodolectivo_id=pl.periodolectivo_id WHERE pa.estadopa!=0';
$query=$pdo->prepare($sql);
$query->execute();

$consulta=$query->fetchAll(PDO::FETCH_ASSOC);

for($i=0;$i<count($consulta); $i++){
    if($consulta[$i]['estadopa']==1){
        $consulta[$i]['estadopa']='<span class="badge bg-success">Activo</span>';
    }else{
        $consulta[$i]['estadopa']='<span class="badge bg-danger">Inactivo</span>';
    }
    $consulta[$i]['acciones']='
        <button class="btn btn-primary" title="Editar" onclick="editarProfesorArea('.$consulta[$i]['pa_id'].')" ><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger" title="Editar" onclick="eliminarProfesorArea('.$consulta[$i]['pa_id'].')" ><i class="bi bi-trash"></i></button>
    ';

}
echo json_encode($consulta,JSON_UNESCAPED_UNICODE);
