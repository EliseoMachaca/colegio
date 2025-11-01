<?php
require_once '../../../includes/config.php';


$sql='SELECT * FROM profesor_area as pa 
INNER JOIN profesor as p ON pa.profesor_id=p.profesor_id 
INNER JOIN grados as g ON pa.grado_id=g.grado_id 
INNER JOIN aulas as a ON pa.aula_id=a.aula_id 
INNER JOIN areas as area ON pa.area_id=area.area_id WHERE pa.estadopa=1';
$query=$pdo->prepare($sql);
$query->execute();

$data=$query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);