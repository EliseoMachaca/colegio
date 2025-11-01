<?php
require_once "../../../includes/config.php";
if(!empty($_POST)){
    if(empty($_POST['usuario'])){
        $respuesta=array('status'=>false,'msg'=>'Todos los datos son necesarios');
    }else{
        $idusuario=$_POST['idusuario'];
        $usuario=$_POST['usuario'];
        
        $clave=$_POST['clave'];
        $rol=$_POST['listRol'];
        $estado=$_POST['listEstado'];
       

        $clave=password_hash($clave,PASSWORD_DEFAULT);

        $sql='SELECT * FROM usuarios WHERE usuario=? AND usuario_id!=?';
        $query=$pdo->prepare($sql);
        $query->execute(array($usuario,$idusuario));
        $result=$query->fetch(PDO::FETCH_ASSOC);

        if($result>0){
            $respuesta=array('status'=>false,'msg'=>'El usuario ya existe');
        }else{
            if($idusuario==""){
                $sqlInsert='INSERT INTO usuarios(usuario, clave, rol, estado) VALUES(?,?,?,?)';
                $queryInsert=$pdo->prepare($sqlInsert);
                $result=$queryInsert->execute(array($usuario,$clave,$rol,$estado));
                $accion=1;
            }else{
                if(empty($clave)){
                    $sqlUpdate='UPDATE usuarios SET usuario=?,rol=?, estado=? WHERE usuario_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    $result=$queryUpdate->execute(array($usuario,$rol,$estado,$idusuario));
                    $accion=2;
                }else{
                    $sqlUpdate='UPDATE usuarios SET usuario=?,clave=?,rol=?, estado=? WHERE usuario_id=?';
                    $queryUpdate=$pdo->prepare($sqlUpdate);
                    $result=$queryUpdate->execute(array($usuario,$clave,$rol,$estado,$idusuario));
                    $accion=3;
                }
            }
            
            
            if($result>0){
                if($accion==1){
                    $respuesta=array('status'=>true,'msg'=>'El usuario ha sido creado correctamente');
                }else{
                    $respuesta=array('status'=>true,'msg'=>'Usuario actualizado correctamente');
                }
            }
        }
        
    }

    echo json_encode($respuesta,JSON_UNESCAPED_UNICODE);

}