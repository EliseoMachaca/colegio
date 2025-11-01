<?php
session_start();
if(!empty($_POST)){
    if(empty($_POST['login']) || empty($_POST['pass'])){
            echo '<div class="alert alert-danger"><button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>Todos los campos son necesarios</div>';


    }else{
        require_once 'config.php';
        $login=$_POST['login'];
        $pass=$_POST['pass'];

        $sql='SELECT * FROM usuarios as u INNER JOIN rol as r ON u.rol=r.rol_id WHERE u.usuario=? AND u.estado!=0';
        $query=$pdo->prepare($sql);
        $query->execute(array($login));
        $result=$query->fetch(PDO::FETCH_ASSOC);

        

        if($query->rowCount()>0){
            if(password_verify($pass,$result['clave'])){
             //if($pass==$result['clave']){
                if($result['estado']==1){
                    $_SESSION['active']=true;
                    $_SESSION['id_usuario']=$result['usuario_id'];
                    $_SESSION['usuario']=$result['usuario'];
                    $_SESSION['rol']=$result['rol_id'];
                    $_SESSION['nombre-rol']=$result['nombre_rol'];

                    if($result['nombre_rol']=='Profesor'){

                        $sql="SELECT * FROM profesor WHERE usuario_id=?";
                        $query=$pdo->prepare($sql);
                        $query->execute(array($result['usuario_id']));
                        $data=$query->fetch();

                        $_SESSION['profesor_id']=$data['profesor_id'];
                        $_SESSION['profesor_nombre']=$data['nombre'];
                    }
                     echo '<div class="alert alert-success"><button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"> </button>Redireccionando a '.$_SESSION['nombre-rol'].' </div>';

                }else{
                    
                    echo '<div class="alert alert-warning"><button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"> </button>Usuario inactivo,comuniquese con el administrador</div>';
                }
                
            }else{
                echo '<div class="alert alert-danger"><button type="button" class="btn-close" aria-label="Close"     data-bs-dismiss="alert"></button>Clave incorrecto</div>';

                }

         }else{
            echo '<div class="alert alert-danger"><button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"> </button> El usuario no existe</div>';
        }
    }
}