<?php
require_once '../../../includes/config.php';
if(!empty($_GET)){


    $idarea=$_GET['idarea'];

    $sql='SELECT * FROM areas WHERE area_id=?';
    $query=$pdo->prepare($sql);
    $query->execute(array($idarea));
    $result=$query->fetch(PDO::FETCH_ASSOC);



    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}