<?php include '../conexion/sesion.php' ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.css.map"> 
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap-theme.css"> 
<link rel="stylesheet" type="text/css" href="../css/sicColegio.css">

<link rel="stylesheet" type="text/css" href="../css/redmond/jquery-ui.css">
 
 <!-- JS -->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery-ui.min.js"></script> 
<script src="../js/scriptSic.js"></script> 
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 
<style>

#modulos{
text-align:center; 
margin-top:13%;
}

#modulos span{

	padding:5%
}
#modulos span a{

	text-decoration: none;
}
#modulos span a img:hover{
	border: solid 3px rgba(228, 228, 228, 0.97);


}

</style>

 </head>

 <body>


 
 
    <nav id="menu">
       <?php include "../menu/menu_index.php" ?>
     </nav>

<ol class="breadcrumb">
      <li class="active">Home</li>
      </ol>
     

<div class="container-fluid">
 <p><h4>¡Bienvenido! seleccione una opción para iniciar </h4><p>


<div id="modulos">

<span>
<a href="Colegios/" class="img-circle" > 
<img src="../img/Colegios.png" alt="..." class="img-circle">

	</a>
</span>

<span>
	<a href="#" class="img-circle" > 
<img src="../img/empresas.png" alt="..." class="img-circle">
	</a>
</span >

</div><!-- Fin Modulos -->

 
</div><!-- Fin container -->



</body>
</html>
