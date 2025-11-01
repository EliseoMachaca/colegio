<?php
require_once '../../../includes/config.php';

if(!empty($_GET)){
    $idpa=$_GET['idpa'];
    
    $sql="SELECT * FROM alumno_profesor as ap
    INNER JOIN profesor_area as pa ON ap.pa_id=pa.pa_id
    INNER JOIN alumnos as a ON ap.alumno_id=a.alumno_id
    WHERE pa.pa_id='$idpa'";
    $query=$pdo->prepare($sql);
    $query->execute();

    $data=$query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}