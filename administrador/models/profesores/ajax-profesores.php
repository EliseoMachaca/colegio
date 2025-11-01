<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])||empty($_POST['direccion'])||empty($_POST['dni'])||empty($_POST['telefono'])||empty($_POST['correo'])||empty($_POST['nivel_est'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idprofesor=$_POST['idprofesor'];
        $nombre=$_POST['nombre'];
        $direccion=$_POST['direccion'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $nivel_est=$_POST['nivel_est'];
        $estado=$_POST['listEstado'];
        
        $sql="SELECT rol_id FROM rol WHERE nombre_rol='Profesor'";
        $query=$pdo->prepare($sql);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_ASSOC);
        $rol=$result['rol_id'];
       
        $sql='SELECT * FROM profesor WHERE dni=? AND profesor_id!=?';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($dni,$idprofesor));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El profesor ya existe');
            
        }else{
            
            if($idprofesor==""){
                
                $pdo->beginTransaction();
                ////////// INSERTAR A LA TABLA USUARIOS//////
                $clave=password_hash($_POST['dni'],PASSWORD_DEFAULT);
                $sqlInsert='INSERT INTO usuarios(usuario, clave, rol, estado) VALUES(?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                $result=$queryInsert->execute(array($correo,$clave,$rol,$estado));
                
                $usuario_id=$pdo->lastInsertId();

                ////////// INSERTAR A LA TABLA PROFESORES//////
                
                $sqlInsert='INSERT INTO profesor(nombre, direccion,dni,telefono,correo,nivel_est, estado,usuario_id) VALUES(?,?,?,?,?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                $result=$queryInsert->execute(array($nombre,$direccion,$dni,$telefono,$correo,$nivel_est,$estado, $usuario_id));
                if($result){
                    $accion=1;
                    $pdo->commit();

                }else{
                    $pdo->rollBack();

                }
                

            }else{
                
                    
                    $sqlUpdate='UPDATE profesor SET nombre=?, direccion=?,dni=?,telefono=?,correo=?,nivel_est=?, estado=? WHERE profesor_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$direccion,$dni,$telefono,$correo,$nivel_est,$estado,$idprofesor));
                    
                    $accion=2;
                
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El profesor ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Profesor actualizado correctamente');
                }
            }
        }
        
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}