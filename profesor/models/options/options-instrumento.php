<?php

require_once '../../../includes/config.php';

$sql="SELECT instrumento_ev_id, instrumento_nombre FROM instrumento_ev WHERE estado=1";
$query=$pdo->prepare($sql);
$query->execute();

$data=$query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);