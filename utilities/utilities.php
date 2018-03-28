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
  <body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="../index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="listadoJuego.php">Juegos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listadoPlat.php">Plataformas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listadoStaff.php">Staff</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listadoCompany.php">Compañías</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listadoUsuarios.php">Usuarios</a>
      </li>';
      if(isset($_SESSION["tipo"]))
      {
      $cabecera.='
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Añadir</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="addJuego.php">Juego</a>
            <a class="dropdown-item" href="addStaff.php">Staff</a>
            <a class="dropdown-item" href="addCompany.php">Compañía</a>
            <a class="dropdown-item" href="addPlataforma.php">Plataforma</a>
        </div>
      </li>';
      }
      $cabecera.='      
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
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/cr-1.4.1/datatables.min.css"/>
<link rel="stylesheet" href="../css/css01.css">
<link rel="stylesheet" href="../css/css02.css">
<script type="text/javascript" src="../js/utilities.js"></script>
<title>'.$titulo.'</title>
</head>';
    echo $cabecera;
}

function navBarIndex()
{
  $cabecera='
  <body>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="index.php">Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="pages/listadoJuego.php">Juegos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/listadoPlat.php">Plataformas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/listadoStaff.php">Staff</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/listadoCompany.php">Compañías</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pages/listadoUsuarios.php">Usuarios</a>
      </li>';   
      if(isset($_SESSION["tipo"]))
      {
      $cabecera.='
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Añadir</a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="pages/addJuego.php">Juego</a>
            <a class="dropdown-item" href="pages/addStaff.php">Staff</a>
            <a class="dropdown-item" href="pages/addCompany.php">Compañía</a>
            <a class="dropdown-item" href="pages/addPlataforma.php">Plataforma</a>
        </div>
      </li>';
      }
      $cabecera.='      
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
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/css01.css">
<link rel="stylesheet" href="css/css02.css">
<script type="text/javascript" src="js/utilities.js"></script>
<title>'.$titulo.'</title>
</head>';
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