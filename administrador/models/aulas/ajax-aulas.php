<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idaula=$_POST['idaula'];
        $nombre=$_POST['nombre'];
        $estado=$_POST['listEstado'];
       
       
        $sql='SELECT * FROM aulas WHERE nombre_aula=? AND aula_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idaula));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El aula ya existe');
            
        }else{
            
            if($idaula==""){
                
                $sqlInsert='INSERT INTO aulas(nombre_aula, estado) VALUES(?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE aulas SET nombre_aula=?, estado=? WHERE aula_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$estado,$idaula));
                    
                    $accion=2;
                    
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El aula ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Aula actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}