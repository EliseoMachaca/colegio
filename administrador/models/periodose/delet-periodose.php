<?php
require_once '../../../includes/config.php';
if($_POST){

    $idperiodo=$_POST['idperiodo'];

    //$sql='UPDATE usuarios SET estado=0 WHERE usuario_id=?';
    $sql='DELETE FROM periodo_evaluacion WHERE periodoevaluacion_id=?';
    $query=$pdo->prepare($sql);
    $result=$query->execute(array($idperiodo));
    

    if($result){
        $respuesta=array('status'=>true,'msg'=>'Eliminado correctamente');
    }else{
        $respuesta=array('status'=>false,'data'=>'Error al eliminar');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}