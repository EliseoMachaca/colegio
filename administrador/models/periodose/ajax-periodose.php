<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idperiodo=$_POST['idperiodo'];
        $nombre=$_POST['nombre'];
        $inicio=$_POST['inicio'];
        $fin=$_POST['fin'];
        $periodol=$_POST['listPeriodo'];
        $estado=$_POST['listEstado'];
       
       
        $sql='SELECT * FROM periodo_evaluacion WHERE nombre_periodo=? AND periodoevaluacion_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($nombre,$idperiodo));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El periodo ya existe');
            
        }else{
            
            if($idperiodo==""){
                
                $sqlInsert='INSERT INTO periodo_evaluacion(nombre_periodo,inicio,fin,periodolectivo_id, estado) VALUES(?,?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$inicio,$fin,$periodol,$estado));
                
                $accion=1;
                
            }else{
                                 
                    $sqlUpdate='UPDATE periodo_evaluacion SET nombre_periodo=?,inicio=?,fin=?,periodolectivo_id=?, estado=? WHERE periodoevaluacion_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$inicio,$fin,$periodol,$estado,$idperiodo));
                    
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