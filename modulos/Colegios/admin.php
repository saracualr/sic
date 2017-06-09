<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap.css.map"> 
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.min.css"> 
<link rel="stylesheet" type="text/css" href="../../css/sicColegio.css">

<link rel="stylesheet" type="text/css" href="../../css/redmond/jquery-ui.css">
 
 <!-- JS -->
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery-ui.min.js"></script> 
<!--<script src="../../js/scriptSic.js"></script> -->
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 
<?php
include '../../conexion/db.php';

//Conexión a la base de datos
$enlace = conectar();
?>


<?php

// Procesamiento del formulario PARA ELIMINAR ESTUDIANTE
if ( isset($_GET['codigoEli'])){ ?>


   <div id="mensaje" title="Atencion...">
    <p> ¿Seguro que desea borrar el estudiante?
    <form method="GET" action="admin.php">
   
   <a href="admin.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_GET['seleccionEli'])){

   $rs1 = mysql_query("DELETE FROM estudiantes
   WHERE id_estudiante= {$_GET['codigoEli2']}");
       
        
     header('location:admin.php');
  
        
  }          
                
       ?>
 </head>

 <body>

<div class="container-fluid">
 
 
    <nav id="menu">
       <?php include "../../menu/menu_portal.html" ?>
     </nav>

<ol class="breadcrumb">
      <li class="#">Home</li>
      <li> <a href="index.php">Colegio</a></li>
  
      <li class="active">Administrar</li>
      </ol>

     <article id="menu_lateral">

  <!--<li><a href="../Categorias/index.php"> <span class="glyphicon glyphicon-star-empty"> 
</span>Generar Carnet </a> </li>-->
  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
  <li> <a href="admin.php"> <span class="glyphicon glyphicon-gift"> </span> Administrar  </a> </li>
   <!-- Button trigger modal -->
  <li style="color:#FFFFFF;background-color:blue"> <span  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-gift"> </span> 
    Capturar Foto </span> </li>

</article>

<div id="formulario"> 




<form class="form-horizontal" action="#" method="post">

<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-sm-6">
          <input type="text" class="form-control" autofocus placeholder="Cedula de Estudiante" 
          name="buscar_estudiante">
          </div>
        </div>

        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
</div><!-- FIN DEL DIV QUE ENCIERRA EL INPUT TEXT DE BUSQUEDA-->

<article>
<table class="table table-hover" >
    <thead>
           <tr class="active">
            <th>ITEMS</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>CÉDULA</th>
            <th>COLEGIO</th>
            <th>GRADO</th>
            <th>ESTATUS</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
  $cont=0;
  if(empty($_POST["buscar_estudiante"])){
    
  $estudiantes = mysql_query ("SELECT id_estudiante,id_colegio,nombre,apellido,cedula,grado,seccion,estatus 
                            FROM estudiantes", $enlace) or
                            die("Problemas en el select:".mysql_error());
  

  } else {
$buscar_estudiante = addslashes($_POST['buscar_estudiante']);
$estudiantes = mysql_query ("SELECT id_estudiante,id_colegio,nombre,apellido,cedula,grado,seccion,estatus 
                            FROM estudiantes WHERE cedula = '$buscar_estudiante'", $enlace) or
                            die("Problemas en el select:".mysql_error());

         }
      
  $total_estudiante= mysql_num_rows($estudiantes);
  
  if($total_estudiante>0){               
  while ($estudiante=mysql_fetch_array($estudiantes)){ 
  $cont++;
  ?>
    <tr>
    <td><?php echo $cont ?></td>
     <td><?php echo $estudiante["nombre"] ?></td>
     <td><?php echo $estudiante["apellido"] ?></td>
     <td><?php echo $estudiante["cedula"] ?></td>
     <td><?php echo $estudiante["id_colegio"] ?></td>
     <td><?php echo $estudiante["grado"] ?></td>
   
       <td> 
    <?php if (($estudiante["estatus"])==1)
     {?>
          <a class="btn btn-mini" href="desactivarEstudiante.php?codigo=<?php echo $estudiante['id_estudiante']; ?>"> 
           <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($estudiante["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activarEstudiante.php?codigo=<?php echo $estudiante['id_estudiante']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton></a>
           </buton><?php } ?></td>           
         
           <td>
                 <a class="btn btn-mini" href="admin.php?codigoEli=<?php echo $estudiante['id_estudiante']; ?>">
                <span class=" glyphicon glyphicon-trash"></span>
              </a>
<?php
}}else {?>

 <td align="center"> NO SE ENCONTRARÓN ESTUDIANTES</td>
 
<?php } ?>

              
              
    </tbody>
  </table>
 </article>


</div> <!-- FIN FORMULARIO -->


 </div> <!-- FIN CONTAINER -->
</body>
</html>
