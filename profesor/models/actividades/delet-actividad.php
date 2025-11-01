<?php

require '../../../includes/config.php';
if($_POST){
    
    $idactividad=$_POST['idactividad'];

    $sql="SELECT * FROM actividades WHERE actividad_id=?";
    $query=$pdo->prepare($sql);
    $query->execute(array($idactividad));
    $data=$query->fetch(PDO::FETCH_ASSOC);

    $sqle="SELECT * FROM ev_entregadas WHERE actividad_id=?";
    $querye=$pdo->prepare($sqle);
    $querye->execute(array($idactividad));
    $data2=$querye->fetch(PDO::FETCH_ASSOC);

    if(empty($data2)){
        $sql_update="DELETE FROM actividades WHERE actividad_id=?";
        $query_update=$pdo->prepare($sql_update);
        $result=$query_update->execute(array($idactividad));

        if($result){
            if($data['material']!=''){
                unlink($data['material']);
            }
            $arrResponse=array('status'=>true,'msg'=>'eliminado correctamente');
         
        }else{
            $arrResponse=array('status'=>false,'msg'=>'error al eliminar');

        }
        
    }else{
        $arrResponse=array('status'=>false,'msg'=>'No se puede eliminar,ya tiene evaluacion asignada');
    }
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

}