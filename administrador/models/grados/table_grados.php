<?php
require_once "../../../includes/config.php";


$sql='SELECT * FROM grados as g INNER JOIN periodo_lectivo as pl ON g.periodolectivo_id=pl.periodolectivo_id WHERE g.estado!=0';
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
        <button class="btn btn-primary" title="Editar" onclick="editarGrado('.$consulta[$i]['grado_id'].')" ><i class="bi bi-pencil"></i></button>
        <button class="btn btn-danger" title="Editar" onclick="eliminarGrado('.$consulta[$i]['grado_id'].')" ><i class="bi bi-trash"></i></button>
    ';

}
echo json_encode($consulta,JSON_UNESCAPED_UNICODE);
