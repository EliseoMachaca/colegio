<?php
require_once '../../../includes/config.php';


    $idpa=$_GET['idpa'];
    
    $sql="SELECT * FROM actividades where pa_id='$idpa'";
    $query=$pdo->prepare($sql);
    $query->execute();

    $data=$query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
