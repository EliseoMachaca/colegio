<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idinstrumento=$_POST['idinstrumento'];
        $nombre=$_POST['nombre'];
        $estado=$_POST['listEstado'];

       
       
        $sql='SELECT * FROM instrumento_ev WHERE nombre=? AND instrumento_ev_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idinstrumento));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El Instrumento ya existe');
            
        }else{
            
            if($idinstrumento==""){
                
                $sqlInsert='INSERT INTO instrumento_ev(nombre,estado) VALUES(?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE instrumento_ev SET nombre=?, estado=? WHERE instrumento_ev_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$estado,$idinstrumento));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El instrumento ha sido creado correctamente');
                }elseif($accion==2){
                    $respuesta=array('status'=>true,'msg'=>'Instrumento actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}