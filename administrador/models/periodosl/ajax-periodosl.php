<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idperiodo=$_POST['idperiodo'];
        $nombre=$_POST['nombre'];
        $estado=$_POST['listEstado'];
       
       
        $sql='SELECT * FROM periodo_lectivo WHERE nombre_periodo=? AND periodolectivo_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idperiodo));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El periodo ya existe');
            
        }else{
            
            if($idperiodo==""){
                
                $sqlInsert='INSERT INTO periodo_lectivo(nombre_periodo, estado) VALUES(?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE periodo_lectivo SET nombre_periodo=?, estado=? WHERE periodolectivo_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$estado,$idperiodo));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El periodo ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Periodo actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}