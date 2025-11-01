<?php



require_once '../../../includes/config.php';
$sql="SELECT periodolectivo_id, nombre_periodo FROM periodo_lectivo WHERE estado=1";
$query=$pdo->prepare($sql);
$query->execute();

$data=$query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);