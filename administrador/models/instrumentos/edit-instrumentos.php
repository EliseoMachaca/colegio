<?php
require_once '../../../includes/config.php';
if(!empty($_GET)){


    $idinstrumento=$_GET['idinstrumento'];

    $sql='SELECT * FROM instrumento_ev WHERE instrumento_ev_id=?';
    $query=$pdo->prepare($sql);
    $query->execute(array($idinstrumento));
    $result=$query->fetch(PDO::FETCH_ASSOC);



    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}