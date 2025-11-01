<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    if(trim($_POST['nota'])==''){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
    }else{
        
        $identrega=$_POST['ideventrega'];
        $nota=$_POST['nota'];
        

        $sqlInsert='INSERT INTO notas(ev_entregadas_id,valor_nota) VALUES(?,?)';
        $queryInsert=$pdo->prepare($sqlInsert);
        
        $request=$queryInsert->execute(array($identrega,$nota));
        
            
        if($request>0){
            
                $respuesta=array('status'=>true,'msg'=>'Evaluacion creada correctamente');
            
        }
        
    
         echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

    }
}