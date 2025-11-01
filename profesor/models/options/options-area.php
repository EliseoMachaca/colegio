<?php

require_once '../../../includes/config.php';
$sql="SELECT area_id, nombre_area FROM areas WHERE estado=1";
$query=$pdo->prepare($sql);
$query->execute();

$data=$query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);