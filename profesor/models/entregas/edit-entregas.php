<?php
require '../../../includes/config.php';
if(!empty($_GET)){

    $identrega=$_GET['identrega'];
    $sql="SELECT * FROM ev_entregadas WHERE ev_entregadas_id=?";
    $query=$pdo->prepare($sql);
    $query->execute(array($identrega));
    $result=$query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}