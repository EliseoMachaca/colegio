<?php
require_once '../../../includes/config.php';
if(!empty($_GET)){


    $idcompetencia=$_GET['idcompetencia'];

    $sql='SELECT * FROM competencias WHERE competencia_id=?';
    $query=$pdo->prepare($sql);
    $query->execute(array($idcompetencia));
    $result=$query->fetch(PDO::FETCH_ASSOC);



    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}