<?php  include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="@rssystem">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/sicColegio.css">
 
 <!-- JS -->
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery-ui.min.js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 <style>

#modulos{
text-align:center; 
margin-top:13%;

}

#modulos span{

padding:5%;

}
#modulos span a{

  text-decoration: none;
}
#modulos span a img:hover{
  border: solid 3px rgba(228, 228, 228, 0.97);


}

</style>




<?php
include '../../conexion/db.php';

//Conexión a la base de datos
$enlace = conectar();
?>

 </head>

 <body>


 
    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>

<ol class="breadcrumb">
   <?php if($_SESSION['id_rol_usuario']<3 ){?>
      <li> <a href="../index.php">Home</a></li>
      <li> <a href="index.php">Colegio</a></li>
  <?php } ?>
      <li class="active">Administrar</li>
      </ol>
     

<div class="container">
 <p><h4>Seleccione una opción para administrar </h4><p>


<div id="modulos">

<span>
<a href="adminEstudiante.php" class="img-circle" > 
<img src="../../img/estudiantes.png" alt="..." class="img-circle">

  </a>
</span>

<span>
  <a href="adminEmpleado.php" class="img-circle" > 
<img src="../../img/empleado.png" alt="..." class="img-circle">
  </a>
</span >

</div><!-- Fin Modulos -->

</div><!-- Fin container -->



</body>
</html>
