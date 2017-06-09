<?php include '../../conexion/sesion.php' ?>

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
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../../css/sicColegio.css">

<link rel="stylesheet" type="text/css" href="../../css/redmond/jquery-ui.css">
 
 <!-- JS -->
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery-ui.min.js"></script> 
<script src="../../js/scriptSic.js"></script> 
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
    <p> ¿Seguro que desea borrar el empleado?
    <form method="GET" action="adminEmpleado.php">

      <a href="adminEmpleado.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_GET['codigoEli2'])){

   $rs1 = mysql_query("DELETE FROM empleadosColegios
   WHERE id_empleado= {$_GET['codigoEli2']}");
    

        
     header('location:adminEmpleado.php');
  
        
  }          
                
       ?>
 </head>

 <body>


 
 
    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>

<ol class="breadcrumb">
  <?php if($_SESSION['id_rol_usuario']<3 ){?>
      <li>Home</li>
      <li> <a href="index.php">Colegio</a></li>
      <?php } ?>
      <li> <a href="adminSelect.php">Administrar </a></li>   
      <li class="active">Administrar Empleados</li>
      </ol>

     <!--<article id="menu_lateral">

  <li><a href="../Categorias/index.php"> <span class="glyphicon glyphicon-star-empty"> 
</span>Generar Carnet </a> </li>
  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> 
</span>Gestionar Colegio </a> </li>
<li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-wrench"> 
</span> Administrar  </a> </li>
  
</article>-->

<div style="padding:1%;">

<form class="form-horizontal" action="#" method="post">

<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-sm-6">
          <input type="text" class="form-control" autofocus placeholder="Cedula de Empleado" 
          name="buscar_empleado">
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
            <th>CARGO</th>
            <th>ESTATUS</th>
            <th>OPCIONES</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
  $cont=0;
  if(empty($_POST["buscar_empleado"])){
    
  $empleados = mysql_query ("SELECT id_empleado,empCole.id_colegio,nombre,apellido,cedula,
                            carg.cargo,empCole.estatus,cole.colegio,descargado
                            FROM empleadoscolegios AS empCole
                            LEFT JOIN colegios AS cole ON empCole.id_colegio=cole.id_colegio
                            LEFT JOIN cargos AS carg ON empCole.id_cargo = carg.id_cargo
                            ORDER BY cedula", 
                            $enlace) or die("Problemas en el select 1:".mysql_error());


  } else {
$buscar_empleado = addslashes($_POST['buscar_empleado']);

$empleados = mysql_query ("SELECT id_empleado,empCole.id_colegio,nombre,apellido,cedula,
                            carg.cargo,empCole.estatus,cole.colegio,descargado
                            FROM empleadoscolegios AS empCole
                            LEFT JOIN colegios AS cole ON empCole.id_colegio=cole.id_colegio
                            LEFT JOIN cargos AS carg ON empCole.id_cargo = carg.id_cargo
                           WHERE cedula = '$buscar_empleado'
						   ORDER BY cedula", 
                            $enlace) or die("Problemas en el select 2:".mysql_error());

         }
      
  $total_empleados= mysql_num_rows($empleados);
  
  if($total_empleados>0){               
  while ($empleado=mysql_fetch_array($empleados)){ 
  $cont++;

  if (($empleado["descargado"])==1){ /*valido si ya se descargo el carnet*/?> 
    <tr class="descargado">
      <?php } else {?> 
    <tr>
      <?php } ?>

    <td><?php echo $cont ?></td>
     <td><?php echo $empleado["nombre"]; ?></td>
     <td><?php echo $empleado["apellido"]; ?></td>
     <td><?php  echo number_format($empleado['cedula'], 0,",","."); ?></td>
     <td width="150px"><?php echo $empleado["colegio"]; ?></td>
     <td><?php echo $empleado["cargo"]; ?></td>
   
       <td> 
    <?php if (($empleado["estatus"])==1)
     {?>
          <a class="btn btn-mini" href="desactivarEmpleado.php?codigo=<?php echo $empleado['id_empleado']; ?>"> 
           <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($empleado["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activarEmpleado.php?codigo=<?php echo $empleado['id_empleado']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton></a>
           </buton><?php } ?></td>           
         
           <td width="18%">
              <!-- OPCION ELIMINAR -->


    <?php if($_SESSION['id_rol_usuario']<3){?>
         
<a class="btn btn-mini" href="adminEmpleado.php?codigoEli=<?php echo $empleado['id_empleado']; ?>">
<span class=" glyphicon glyphicon-trash"></span>
</a>
      <!-- OPCION EDITAR -->         
<a class="btn btn-mini" href="editEmpleado.php?codigoEdi=<?php echo $empleado['id_empleado']; ?>">
<span class=" glyphicon glyphicon-pencil"></span>
</a>
  <!-- OPCION CARNET -->
<a  class="btn btn-mini" href="carnetEmpleado.php?seleccionCarnet=<?php echo $empleado['id_empleado']; ?>" 
target="_blank"> 

<span class="glyphicon glyphicon-picture"></span>
</a>

    <?php } ?>


    <a  class="btn btn-mini" href="fichaEmpleado.php?seleccionCarnet=<?php echo $empleado['id_empleado']; ?>" 
        target="_blank"> 

        <span class="glyphicon glyphicon-eye-open"></span>
        </a>
</td>


<?php
}}else {?>
           
    </tbody>
  </table>
 </article>
 <div align="center"> NO SE ENCONTRARÓN EMPLEADOS</div>
 
<?php }  ?>

</div><!--Fin padding-->
</body>
</html>
