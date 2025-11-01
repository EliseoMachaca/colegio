<?php
include "../../../includes/config.php";
if(!empty($_POST)){
    
    if(trim($_POST['observacion'])==''||empty($_FILES['file'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{

        $identregas=$_POST['identrega'];
        $idactividad=$_POST['idactividad'];
        $idalumno=$_POST['listAlumnoArea'];
        $observacion=$_POST['observacion'];
       
        $material=$_FILES['file']['name'];
        $type=$_FILES['file']['type'];
        $url_temp=$_FILES['file']['tmp_name'];


        $directorio='../../../uploads/'.rand(1000,10000);
        
        if(!file_exists($directorio)){
            mkdir($directorio,0777, true);          
        
        }

        $destino=$directorio.'/'.$material;

        $sql="SELECT *FROM ev_entregadas WHERE ev_entregadas_id=?";
        $query=$pdo->prepare($sql);
        $query->execute(array($identregas));
        $data=$query->fetch(PDO::FETCH_ASSOC);

                
        if($_FILES['file']['size']>15000000){
            $respuesta=array('status'=>false,'msg'=>'Solo se permiten archivos hasta 15 MB');
        }else{
            if($identregas==""){
                $sqlInsert='INSERT INTO ev_entregadas(actividad_id,alumno_id,material_alumno,observacion) VALUES(?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $request=$queryInsert->execute(array($idactividad,$idalumno,$destino,$observacion));
                move_uploaded_file($url_temp,$destino);

                $accion=1;

            }else{
                $sqlUpdate='UPDATE ev_entregadas SET actividad_id=?,alumno_id=?, material_alumno=?,observacion=? WHERE ev_entregadas_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $request=$queryUpdate->execute(array($idactividad,$idalumno,$destino,$observacion,$identregas));
                    
                    
                    
                    if($data['material_alumno']!=''){
                        unlink($data['material_alumno']);
                    }
                    move_uploaded_file($url_temp,$destino);
                    
                    $accion=2;

            }
                
                
            if($request>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'Evidencia cargada correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'evidencia actualizada correctamente');
                }
                    
            }

            }          
    }
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);
}