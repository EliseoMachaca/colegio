<?php
require_once '../../../includes/config.php';
if(!empty($_GET)){


    $idperiodo=$_GET['idperiodo'];

    $sql='SELECT * FROM periodo_evaluacion WHERE periodoevaluacion_id=?';
    $query=$pdo->prepare($sql);
    $query->execute(array($idperiodo));
    $result=$query->fetch(PDO::FETCH_ASSOC);



    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}