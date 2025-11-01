<?php

require '../../../includes/config.php';
if($_POST){
    
    $identrega=$_POST['identrega'];

    $sql_delet="DELETE FROM ev_entregadas WHERE ev_entregadas_id=?";
    $query_delet=$pdo->prepare($sql_delet);
    $result=$query_delet->execute(array($identrega));

        if($result){
           
            $arrResponse=array('status'=>true,'msg'=>'eliminado correctamente');
         
        }else{
            $arrResponse=array('status'=>false,'msg'=>'error al eliminar');

        }
        
    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

}