<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['listProfesor'])||empty($_POST['listGrado'])||empty($_POST['listAula'])||empty($_POST['listArea'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idprofesorarea=$_POST['idprofesorarea'];
        $profesor=$_POST['listProfesor'];
        $grado=$_POST['listGrado'];
        $aula=$_POST['listAula'];
        $area=$_POST['listArea'];
        $status=$_POST['listEstado'];

        //CONSULTA PARA INSERTAR
       
        $sql='SELECT * FROM profesor_area WHERE  profesor_id=? AND grado_id=? AND aula_id=? AND area_id=? AND estadopa!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($profesor,$grado,$aula,$area));
        $resultInsert=$query->fetch(PDO::FETCH_ASSOC);

         //CONSULTA PARA ACTUALIZAR
       
         $sql2='SELECT * FROM profesor_area WHERE  profesor_id=? AND grado_id=? AND aula_id=? AND area_id=? AND  estadopa!=0 AND pa_id!=?';
        
         $query2=$pdo->prepare($sql2);
         $query2->execute(array($profesor,$grado,$aula,$area,$idprofesorarea));
         $resultUpdate=$query2->fetch(PDO::FETCH_ASSOC);
        
        if($resultInsert>0){
            $arrResponse=array('status'=>false,'msg'=>'El grado, aula, materia y el profesor ya existen, seleccione otro');
         }else{
            if($idprofesorarea==""){
                $sql_insert="INSERT INTO profesor_area(profesor_id,grado_id,aula_id,area_id,estadopa) VALUES (?,?,?,?,?)";
                $query_insert=$pdo->prepare($sql_insert);
                $request=$query_insert->execute(array($profesor,$grado,$aula,$area,$status));
                if($request){
                    $arrResponse=array('status'=>true,'msg'=>'Proceso creado correctamente'); 
                }
            }

        }

        if($resultUpdate>0){
            $arrResponse=array('status'=>false,'msg'=>'El grado, aula, materia y el profesor ya existen, seleccione otro');
         }else{
            if($idprofesorarea>0){
                $sql_update="UPDATE profesor_area SET profesor_id=? ,grado_id=?,aula_id=?,area_id=?,estadopa=? WHERE pa_id=?";
                $query_update=$pdo->prepare($sql_update);
                $request2=$query_update->execute(array($profesor,$grado,$aula,$area,$status,$idprofesorarea));
                if($request2){
                    $arrResponse=array('status'=>true,'msg'=>'Proceso actualizado correctamente'); 
                }
            }

        }
    }

    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

}