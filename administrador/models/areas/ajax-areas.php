<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idarea=$_POST['idarea'];
        $nombre=$_POST['nombre'];
        $estado=$_POST['listEstado'];
       
       
        $sql='SELECT * FROM areas WHERE nombre_area=? AND area_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idarea));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El area ya existe');
            
        }else{
            
            if($idarea==""){
                
                $sqlInsert='INSERT INTO areas(nombre_area, estado) VALUES(?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE areas SET nombre_area=?, estado=? WHERE area_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$estado,$idarea));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El area ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Area actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}