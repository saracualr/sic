<?php include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="description" content="">
    <meta name="author" content="@rssystem">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../../css/redmond/jquery-ui.css">
 <link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/sicColegio.css">

<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery.scrollUp.min.js"></script> 
<script src="../../js/jquery-ui.min.js"></script> 

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
    <form method="GET" action="adminEstudiante.php">
   
   <a href="adminEstudiante.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_GET['codigoEli2'])){

   $codigo= addslashes ($_GET['codigoEli2']);
     
   $rs1 = mysql_query("DELETE FROM estudiantes
   WHERE id_estudiante= $codigo");
       
        
     header('location:adminEstudiante.php');
  
        
  }          
                
       ?>


 </head>

 <body>
 
    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>

<ol class="breadcrumb">
  <?php if($_SESSION['id_rol_usuario']<3 ){?>
      <li <a href="../index.php">Home </a></li>
      <li> <a href="index.php">Colegio</a></li>
      <?php } ?>
      <li> <a href="adminSelect.php">Administrar </a></li>  
      <li class="active">Administrar Estudiantes</li>
  </ol>





<form class="form-horizontal" action="#" method="post">

<div style="padding:1%;">

<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-sm-6">
          <input type="text" class="form-control" autofocus 
          placeholder="Puede filtrar Estudiante por, cédula, colegio o grado." 
          name="buscar_estudiante">
          </div>
        </div>

        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
</div><!-- FIN DEL DIV QUE ENCIERRA EL INPUT TEXT DE BUSQUEDA-->

<article style="padding:2%;">
<table class="table table-hover" class="table table-responsive" >
    <thead>
           <tr class="active">
            <th>ITEMS</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>CÉDULA</th>
            <th>COLEGIO</th>
            <th>GRADO</th>
            <th>SECCION</th>
            <th>ESTATUS</th>
            <th>OPCIONES</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
  $cont=0;
  if(empty($_POST["buscar_estudiante"])){
    
  $estudiantes = mysql_query ("SELECT id_estudiante,est.id_colegio,nombre,apellido,cedula,grado,
                              seccion,est.estatus,cole.colegio,descargado
                            FROM estudiantes AS est LEFT JOIN colegios AS cole 
                            ON est.id_colegio = cole.id_colegio ORDER BY seccion ASC ", $enlace) or
                            die("Problemas en el select:".mysql_error());
  

  } else {
$buscar_estudiante = addslashes($_POST['buscar_estudiante']);
$estudiantes = mysql_query ("SELECT id_estudiante,est.id_colegio,nombre,apellido,cedula,grado,
                              seccion,est.estatus,cole.colegio,descargado 
                            FROM estudiantes AS est LEFT JOIN colegios AS cole ON est.id_colegio
                            = cole.id_colegio  

WHERE cole.colegio LIKE '%$buscar_estudiante%' or cedula='$buscar_estudiante' 
or grado LIKE '%$buscar_estudiante%' ORDER BY grado ASC"); 



         }
      
  $total_estudiante= mysql_num_rows($estudiantes);
  
  if($total_estudiante>0){               
  while ($estudiante=mysql_fetch_array($estudiantes)){ 
  $cont++;
   

  ?>
<?php
  if (($estudiante["descargado"])==1){ /*valido si ya se descargo el carnet*/?> 
    <tr class="descargado">
      <?php } else {?> 
    <tr>
      <?php } ?> <!-- fin validacion descarga de carnet -->

    <td><?php echo $cont ?></td>
     <td><?php echo $estudiante["nombre"] ?></td>
     <td><?php echo $estudiante["apellido"] ?></td>
     <td><?php  echo number_format($estudiante['cedula'], 0,",","."); ?></td>
     <td><?php echo $estudiante["colegio"] ?></td>
     <td align="center"><?php echo $estudiante["grado"] ?></td>
     <td><?php echo $estudiante["seccion"] ?></td>

    
       <td align="center"> 


    <?php if (($estudiante["estatus"])==1)
     {?>
          <a class="btn btn-mini" href="desactivarEstudiante.php?codigo=<?php echo $estudiante['id_estudiante']; ?>"> 
           <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>  </td>  
          <?php } else if (($estudiante["estatus"])==0) { ?>
                 
           <a class="btn btn-mini" href="activarEstudiante.php?codigo=<?php echo $estudiante['id_estudiante']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton></a>
           </buton><?php } ?></td>           
      
     
   <td >

    <?php if($_SESSION['id_rol_usuario']<3){?>
   
        <a class="btn btn-mini" href="adminEstudiante.php?codigoEli=<?php echo $estudiante['id_estudiante']; ?>">
        <span class=" glyphicon glyphicon-trash"></span>
        </a>


    <a class="btn btn-mini" 
        href="editEstudiante.php?codigoEdi=<?php echo $estudiante['id_estudiante']; ?>">
        <span class=" glyphicon glyphicon-pencil"></span>
        </a>

 

        <a  class="btn btn-mini" href="carnet.php?seleccionCarnet=<?php echo $estudiante['id_estudiante']; ?>" 
        target="_blank" alt="Generar Carnet"> 

        <span class="glyphicon glyphicon-picture"></span>
        </a> 
<?php } ?>
        <a  class="btn btn-mini" href="fichaAlumno.php?seleccionCarnet=<?php echo $estudiante['id_estudiante']; ?>" 
        target="_blank"> 

        <span class="glyphicon glyphicon-eye-open"></span>
        </a>



</td>
    
    </tr>    
   

<?php
}}else {?>
 </tbody>
  </table>

 <div align="center"> NO SE ENCONTRARÓN ESTUDIANTES</div>
 
<?php } ?>


 </article>



</div> <!-- FIN FORMULARIO -->
 
<!-- JS -->


<script src="../../js/scriptSic.js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 

</body>
</html>
