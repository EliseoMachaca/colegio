<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    
    if(empty($_POST['nombre'])||empty($_POST['direccion'])||empty($_POST['dni'])||empty($_POST['telefono'])||empty($_POST['correo'])||empty($_POST['fecha_nac'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
        
    }else{
        
        $idalumno=$_POST['idalumno'];
        $nombre=$_POST['nombre'];
        $edad=$_POST['edad'];
        $direccion=$_POST['direccion'];
        $dni=$_POST['dni'];
        $telefono=$_POST['telefono'];
        $correo=$_POST['correo'];
        $fecha_nac=$_POST['fecha_nac'];
        $fecha_reg=$_POST['fecha_reg'];
        $estado=$_POST['listEstado'];

        $sql="SELECT rol_id FROM rol WHERE nombre_rol='Estudiante'";
        $query=$pdo->prepare($sql);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_ASSOC);
        $rol=$result['rol_id'];

       
       
        $sql='SELECT * FROM alumnos WHERE dni=? AND alumno_id!=? AND estado!=0';
        
        $query=$pdo->prepare($sql);
        $query->execute(array($dni,$idalumno));
        $result=$query->fetch(PDO::FETCH_ASSOC);
        
        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El alumno ya existe');
            
        }else{
            
            if($idalumno==""){
                
                ////

                $pdo->beginTransaction();
                ////////// INSERTAR A LA TABLA USUARIOS//////
                $clave=password_hash($_POST['dni'],PASSWORD_DEFAULT);
                $sqlInsert='INSERT INTO usuarios(usuario, clave, rol, estado) VALUES(?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                $result=$queryInsert->execute(array($correo,$clave,$rol,$estado));
                
                $usuario_id=$pdo->lastInsertId();

                ////////// INSERTAR A LA TABLA ALUMNOS//////
                
                $sqlInsert='INSERT INTO alumnos(nombre_alumno,edad, direccion,dni,telefono,correo,fecha_nac,fecha_registro, estado,usuario_id) VALUES(?,?,?,?,?,?,?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                
                $result=$queryInsert->execute(array($nombre,$edad,$direccion,$dni,$telefono,$correo,$fecha_nac,$fecha_reg,$estado,$usuario_id));
                if($result){
                    $accion=1;
                    $pdo->commit();

                }else{
                    $pdo->rollBack();

                }
                /////
                
            }else{

                
                    $sqlUpdate='UPDATE alumnos SET nombre_alumno=?,edad=?, direccion=?,dni=?,telefono=?,correo=?,fecha_nac=?,fecha_registro=?, estado=? WHERE alumno_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    
                    $result=$queryUpdate->execute(array($nombre,$edad,$direccion,$dni,$telefono,$correo,$fecha_nac,$fecha_reg,$estado,$idalumno));
                    
                    $accion=2;
                    
                    
                
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El alumno ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Alumno actualizado correctamente');
                }
            }
        }
    
    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

    }
}