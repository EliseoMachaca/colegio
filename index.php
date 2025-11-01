<?php
session_start();
if(!empty($_SESSION['active'])){
    if($_SESSION['nombre-rol']=="Administrador"){
        header('Location: administrador/');
    }else if($_SESSION['nombre-rol']=="Profesor"){
        header('Location: profesor/');
    }else if($_SESSION['nombre-rol']=="Estudiante"){
        header('Location: alumno/');
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al sistema</title>
    <Link rel="stylesheet" href="css/bootstrap.min.css">
    <Link rel="stylesheet" href="bootstrap-icons-1.11.3/font/bootstrap-icons.css">
    <style>
        body{
            background: #ffe259;
            background: linear-gradient(to right,#ffa751,#ffe259);
        }
        .bg{
            background-image: url(images/school.svg);
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="container w-75 bg-primary mt-5 rounded shadow">
        <div class="row aling-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded" >

            </div>
            <div class="col bg-white rounded-end">
                <div class="text-end">
                    <img src="images/" width="48" alt="">
                </div>
                <h2 class="fw-bold text-center py-5">Bienvenido</h2>
                <form action="#">
                    <div class="mb-4">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    
                    <div id="messageUsuario"></div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" id="loginUsuario" autofocus>Ingresar</button>
                    </div>
                    <div class="my-3">
                        <span>¿No tienes cuenta?<a href="#">Registrate</a></span> <br>
                        <span><a href="#">Recuperar password</a></span>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>