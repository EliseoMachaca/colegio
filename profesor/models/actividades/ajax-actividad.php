<?php
include "../../../includes/config.php";
if(!empty($_POST)){
    if(empty($_POST['titulo'])|| empty($_POST['descripcion'])|| empty($_POST['listCompetencia'])|| empty($_POST['evidencia']) || empty($_POST['listInstrumento'])|| empty($_POST['fecha'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
    }else{
        

        $idactividad=$_POST['idactividad'];
        $idprofesorarea=$_POST['idprofesorarea'];
        $titulo=$_POST['titulo'];
        $descripcion=$_POST['descripcion'];
        $idcompetencia=$_POST['listCompetencia'];
        $evidencia=$_POST['evidencia'];
        $idinstrumento=$_POST['listInstrumento'];
        $fecha=$_POST['fecha'];

        $sql="SELECT * FROM periodo_evaluacion WHERE estado=1";
        $query=$pdo->prepare($sql);
        $query->execute();
        $data=$query->fetch(PDO::FETCH_ASSOC);
        
        $idperiodoevaluacion=$data['periodoevaluacion_id'];
        

        $material=$_FILES['file']['name'];
        $type=$_FILES['file']['type'];
        $url_temp=$_FILES['file']['tmp_name'];


        $directorio='../../../uploads/'.rand(1000,10000);
        
        if(!file_exists($directorio)){
            mkdir($directorio,0777, true);          
        
        }

        $destino=$directorio.'/'.$material;

        $sql="SELECT *FROM actividades WHERE actividad_id=?";
        $query=$pdo->prepare($sql);
        $query->execute(array($idactividad));
        $data=$query->fetch(PDO::FETCH_ASSOC);


        
        if($_FILES['file']['size']>15000000){
            $respuesta=array('status'=>false,'msg'=>'Solo se permiten archivos hasta 15 MB');
        }else{
            if($idactividad==""){
                $sqlInsert='INSERT INTO actividades(titulo, descripcion,material,evidencia,fecha,pa_id,competencia_id,instrumento_ev_id,periodoevaluacion_id) VALUES(?,?,?,?,?,?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $request=$queryInsert->execute(array($titulo,$descripcion,$destino,$evidencia,$fecha,$idprofesorarea,$idcompetencia,$idinstrumento,$idperiodoevaluacion));
                move_uploaded_file($url_temp,$destino);
                
                $accion=1;

            }else{
                if(empty($_FILES['file']['name'])){
                    $sqlUpdate='UPDATE actividades SET titulo=?, descripcion=?,evidencia=?,fecha=?, pa_id=?,competencia_id=?,instrumento_ev_id=? WHERE actividad_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $request=$queryUpdate->execute(array($titulo,$descripcion,$evidencia,$fecha,$idprofesorarea,$idcompetencia,$idinstrumento,$idactividad));
                    
                    $accion=2;
                }else{
                    $sqlUpdate='UPDATE actividades SET titulo=?, descripcion=?,material=?,evidencia=?,fecha=?, pa_id=?,competencia_id=?,instrumento_ev_id=? WHERE actividad_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $request=$queryUpdate->execute(array($titulo,$descripcion,$destino,$evidencia,$fecha,$idprofesorarea,$idcompetencia,$idinstrumento,$idactividad));
                    
                    
                    
                    if($data['material']!=''){
                        unlink($data['material']);
                    }
                    move_uploaded_file($url_temp,$destino);
                    $accion=3;
                }
            }
        }

           
            
        if($request>0){
            if($accion==1){
                $respuesta=array('status'=>true,'msg'=>'Actividad creado correctamente');
            }else{
                $respuesta=array('status'=>true,'msg'=>'Actividad actualizado correctamente');
            }
        }
        
    
         echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

    }
}