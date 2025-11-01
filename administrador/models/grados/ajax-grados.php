<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idgrado=$_POST['idgrado'];
        $nombre=$_POST['nombre'];
        $periodo=$_POST['listPeriodo'];
        $estado=$_POST['listEstado'];

       
       
        $sql='SELECT * FROM grados WHERE nombre_grado=? AND grado_id!=? AND periodolectivo_id=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idgrado,$periodo));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El grado ya existe');
            
        }else{
            
            if($idgrado==""){
                
                $sqlInsert='INSERT INTO grados(nombre_grado,periodolectivo_id, estado) VALUES(?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$periodo,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE grados SET nombre_grado=?,periodolectivo_id=?, estado=? WHERE grado_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$periodo,$estado,$idgrado));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El grado ha sido creado correctamente');
                }elseif($accion==2){
                    $respuesta=array('status'=>true,'msg'=>'Grado actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}