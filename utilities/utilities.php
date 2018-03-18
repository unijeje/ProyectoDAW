<?php

function iniciarSesion()
{
  /*Inicia sesión y comprueba las cookies, si existe cookie de "nombre" apunta la sesion y el tipo de cuenta en variables de sesion*/
  session_cache_limiter();
  session_name('login');
  session_start();
  if(isset($_COOKIE["nombre"]))
  {
    $_SESSION["tipo"]=$_COOKIE["tipo"];
    $_SESSION["nombre"]=$_COOKIE["nombre"];
    $_SESSION["id"]=$_COOKIE["id"];
  }
}
function navBar()
{
  $cabecera='
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="../index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>';
    if(!isset($_SESSION["tipo"]))
    {
      $cabecera.='
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="login.php">Conectarse</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="registrarse.php">Registrarse</a>
      </li>   
    </ul>';
    }
    else
    {
      $cabecera.='
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="logoff.php">Desconectarse</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="perfil.php">'.$_SESSION["nombre"].'</a>
      </li>   
    </ul>';
    }

    $cabecera.='
    </div>  
    </nav>
    <br> 
    <div class="container">';
    echo $cabecera;
}
function cabecera($titulo)
{


  $cabecera='<!DOCTYPE html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/css01.css">
<script type="text/javascript" src="../js/utilities.js"></script>
<title>'.$titulo.'</title>
</head>
<body>';
    echo $cabecera;
}

function navBarIndex()
{
  $cabecera='
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>    
    </ul>';
    if(!isset($_SESSION["tipo"]))
    {
      $cabecera.='
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="pages/login.php">Conectarse</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="pages/registrarse.php">Registrarse</a>
      </li>   
    </ul>';
    }
    else
    {
      $cabecera.='
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="pages/logoff.php">Desconectarse</a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="pages/perfil.php">'.$_SESSION["nombre"].'</a>
      </li>   
    </ul>';
    }

    $cabecera.='
    </div>  
    </nav>
    <br> 
    <div class="container">';
    echo $cabecera;
}

function cabeceraIndex($titulo)
{

 $cabecera='<!DOCTYPE html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/css01.css">
<script type="text/javascript" src="js/utilities.js"></script>
<title>'.$titulo.'</title>
</head>
<body>';
    echo $cabecera;
}

function pie()
{
  echo '
  </div>
  </body>
  </html>';
}

function fechaFormato($fecha)
{
  return date('d-m-Y',strtotime($fecha));
}

?>