<?php
require '../../../includes/config.php';
if(!empty($_GET)){
    $idactividad=$_GET['idactividad'];
    $sql="SELECT * FROM actividades WHERE actividad_id=?";
    $query=$pdo->prepare($sql);
    $query->execute(array($idactividad));
    $result=$query->fetch(PDO::FETCH_ASSOC);

    if(empty($result)){
        $respuesta=array('status'=>false,'msg'=>'datos no encontrados');
    }else{
        $respuesta=array('status'=>true,'data'=>$result);
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}