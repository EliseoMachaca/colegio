<?php
require_once '../../../includes/config.php';



if(!empty($_GET)){
    $id_actividad=$_GET['actividad_id'];
    
    $sql="select a.nombre_alumno, n.valor_nota from ev_entregadas ee inner join notas  as n on ee.ev_entregadas_id=n.ev_entregadas_id inner join alumnos as a on ee.alumno_id=a.alumno_id where ee.actividad_id='$id_actividad'";
    $query=$pdo->prepare($sql);
    $query->execute();

    $data=$query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}