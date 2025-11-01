<?php
require_once "../../../includes/config.php";


$sql='SELECT pe.periodoevaluacion_id AS periodo_id, pe.nombre_periodo AS nombre, pe.inicio,
pe.fin, pl.nombre_periodo AS nombre_pl, pe.estado FROM periodo_evaluacion AS pe INNER JOIN
 periodo_lectivo AS pl ON pe.periodolectivo_id=pl.periodolectivo_id WHERE pe.estado!=0';
$query=$pdo->prepare($sql);
$query->execute();

$consulta=$query->fetchAll(PDO::FETCH_ASSOC);

for($i=0;$i<count($consulta); $i++){
    if($consulta[$i]['estado']==1){
        $consulta[$i]['estado']='<span class="badge bg-success">Activo</span>';
    }else{
        $consulta[$i]['estado']='<span class="badge bg-danger">Inactivo</span>';
    }
    $consulta[$i]['acciones']='
        <button class="btn btn-primary" title="Editar" onclick="editarPeriodoEvaluacion('.$consulta[$i]['periodo_id'].')" ><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger" title="Eliminar" onclick="eliminarPeriodoEvaluacion('.$consulta[$i]['periodo_id'].')" ><i class="bi bi-trash"></i></button>
    ';

}
echo json_encode($consulta,JSON_UNESCAPED_UNICODE);
