<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idcompetencia=$_POST['idcompetencia'];
        $nombre=$_POST['nombre'];
        $area=$_POST['listArea'];
        $estado=$_POST['listEstado'];
       
       
        $sql='SELECT * FROM competencias WHERE nombre=? AND competencia_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idcompetencia));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El area ya existe');
            
        }else{
            
            if($idcompetencia==""){
                
                $sqlInsert='INSERT INTO competencias(nombre,area_id, estado) VALUES(?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$area,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE competencias SET nombre=?, area_id=?, estado=? WHERE competencia_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$area,$estado,$idcompetencia));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'La competencia ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}