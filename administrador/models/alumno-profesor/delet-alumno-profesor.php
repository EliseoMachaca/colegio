<?php
require_once '../../../includes/config.php';
if($_POST){

    $idalumnoprofesor=$_POST['id'];

    //$sql='UPDATE usuarios SET estado=0 WHERE usuario_id=?';
    $sql='DELETE FROM alumno_profesor WHERE ap_id=?';
    $query=$pdo->prepare($sql);
    $result=$query->execute(array($idalumnoprofesor));
    

    if($result){
        $respuesta=array('status'=>true,'msg'=>'Eliminado correctamente');
    }else{
        $respuesta=array('status'=>false,'data'=>'Error al eliminar');
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}