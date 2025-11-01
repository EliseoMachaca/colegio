<?php
require_once '../../../includes/config.php';
if($_POST){

    $idcompetencia=$_POST['idcompetencia'];

    //$sql='UPDATE usuarios SET estado=0 WHERE usuario_id=?';
    $sql='DELETE FROM competencias WHERE competencia_id=?';
    $query=$pdo->prepare($sql);
    $result=$query->execute(array($idcompetencia));
    

    if($result){
        $respuesta=array('status'=>true,'msg'=>'Eliminado correctamente');
    }else{
        $respuesta=array('status'=>false,'data'=>'Error al eliminar');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}