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



// Procesamiento del formulario PARA ELIMINAR ESTUDIANTE
if ( isset($_GET['codigoEli'])){ ?>


   <div id="mensaje" title="Atencion...">
    <p> ¿Seguro que desea borrar el Cargo?
    <form method="POST" action="agregarCargo.php">

      <a href="agregarCargo.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_POST['codigoEli2'])){

   $rs1 = mysql_query("DELETE FROM cargos
   WHERE id_cargo= {$_POST['codigoEli2']}");
    
     header('location:agregarCargo.php');
        
  }          
 // Procesamiento del formulario
if (!empty($_POST['cargo'])) {

    $registrar_cargo = mysql_query("INSERT INTO 
                        cargos(cargo,estatus) 
                        VALUES ('{$_POST['cargo']}','1')");
    
    if (!$registrar_cargo )
        die('Query no valida error en registrar_cargo' . mysql_error());
    else
      $mensaje = '¡REGISTRO EXITOSO!';
        
}

?>

</head>
<body>

  <div id="container-fluid"> 

<nav id="menu">
<?php include "../../menu/menu_portal.php"; ?>

 </nav>

 <ol class="breadcrumb">
     <li><a href="../index.php">Home</a></li>
      <li> <a href="index.php">Colegio</a></li>
      <li> <a href="agregarColegio.php">Gestionar Colegio</a></li>
      <li class="active">Agregar Cargo</li>
      </ol>

<!-- MENSAJE PARA PROCESAMIENTO DE FORMULARIO -->

<?php if (!empty($mensaje)){ ?>
         <div id="mensaje" title="RESULTADO...">
    <?php 
    echo $mensaje;} ?>
    </div>   

<article id="menu_lateral">

  <!--<li><a href="../Categorias/index.php"> <span class="glyphicon glyphicon-star-empty"> 
</span>Generar Carnet </a> </li>-->
  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
   <li><a href="#"> <span class="glyphicon glyphicon-plus"> </span>Agregar Cargos </a> </li>

  <!--<li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-gift"> 
</span> Administrar</a> </li>-->
   

</article>



<div id="contenidoCentral">

<!-- Button trigger modal -->
<figure id="boton_agregar">
<button type="button" class="btn btn-primary btn-small" data-toggle="modal" 
data-target="#myModal">
<span class="glyphicon glyphicon-plus">
 </span> [ Agregar Cargo] 

</button>
</figure><!-- FIN BOTON AGREGAR -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Agregar Cargo para Colegio</h4>
      </div>
      <div class="modal-body">

<form class="form-horizontal" role="form" action="#" method="post" id="reg_presentacion" name="reg_presentacion">

  <div class="form-group">
    <label for="Nombre de colegio" class="col-lg-4 control-label">Nombre del Cargo</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="cargo" name="cargo"
             placeholder="Nombre del Cargo" autofocus required>    
    </div>

   

  
      </div><!--   FIN FORM GROUP -->
  <hr>
  <div class="form-group" >
    <div class="col-lg-offset-2 col-lg-8">
   <button type="submit" class="btn btn-default">
    Registrar Cargo</button>
    <button  class="btn btn-default" type="reset" >Restablecer</button>
   
    </div>
  
 </div><!--   FIN FORM GROUP -->
  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>

<!-- incio edicion de colegio -->

<?php if(!empty($_GET['codigoEdi']))
{

$codigoCargo=$_GET['codigoEdi'];

$registros= mysql_query("SELECT id_cargo,cargo FROM cargos 
                         WHERE id_cargo = $codigoCargo", $enlace) or
                         die("Problemas en el select 2:".mysql_error());

   $row=mysql_fetch_array($registros);

  ?>
<!-- VENTANA MODAL PARA EDITAR CARGO -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Agregar Cargo</h4>
      </div>
      <div class="modal-body">
 
<form class="form-horizontal" role="form" action="#" method="post" id="actualizarCole" 
name="actualizarCole">
 
  <div class="form-group">
    <label for="Nombre de colegio" class="col-lg-4 control-label">Nombre del Cargo</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="cargo" name="cargo"
             placeholder="Nombre del Cargo" value="<?php echo $row['cargo'] ?>"
              autofocus required>    
    </div>

    

      </div><!--   FIN FORM GROUP -->
  
  <hr>
  <div class="form-group" >
    <div class="col-lg-offset-2 col-lg-8">
   <button type="submit" class="btn btn-default">
    Actualizar</button>
    <button  class="btn btn-default" type="reset" >Restablecer</button>
   
    </div>
  
 </div><!--   FIN FORM GROUP -->
  
  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>

<?php } ?>
<!--Fin ventana modal para actualizar cargo-->

<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-lg-6">
          <input type="text" class="form-control" autofocus placeholder="Buscar colegio" 
          name="buscar_cargo">
          </div>
        </div>

        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
</div><!-- FIN DEL DEIV QUE ENCIERRA EL INPUT TEXT DE BUSQUEDA-->
<article>
<table class="table table-hover" >
    <thead>
           <tr class="active">
            <th>ITEMS</th>
            <th>CARGO</th>
            <th>ESTATUS</th>
           <th>OPCIONES</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
	$cont=0;
	if(empty($_POST["buscar_cargo"])){
		
	$cargos= mysql_query ("SELECT id_cargo,cargo,estatus FROM cargos ", $enlace) or
                            die("Problemas en el select:".mysql_error());

	} else {
		$buscar_cargo = addslashes($_POST['buscar_cargo']);
		$cargos = mysql_query ("SELECT id_cargo,cargo,estatus 
                            FROM cargos             
                            WHERE cargo LIKE '%$buscar_cargo%' ", $enlace) or
                            die("Problemas en el select:".mysql_error());
			}
			
	$total_cargo= mysql_num_rows($cargos);
	
	if($total_cargo>0){							 
	while ($cargo=mysql_fetch_array($cargos)){ 
	$cont++;
	?>
    <tr>
    <td><?php echo $cont ?></td>
     <td><?php echo $cargo["cargo"] ?></td>
    
       <td > 
		<?php if (($cargo["estatus"])==1)
		 {?>
  <a class="btn btn-mini" href="desactivarCargo.php?codigo=<?php echo $cargo['id_cargo']; ?>"> 
   <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($cargo["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activarCargo.php?codigo=<?php echo $cargo['id_cargo']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton>   </a>
           </buton><?php } ?></td>           

<td>

<a class="btn btn-mini" href="agregarCargo.php?codigoEli=<?php echo $cargo['id_cargo']; ?>">
<span class=" glyphicon glyphicon-trash"></span>
</a>
</td>



</tr>
          <?php  }} else {
			  ?>
         </tbody>
           </table>
 </article>
			  <div align="center"> NO SE ENCONTRARÓN COINCIDENCIAS</div>
			  <?php
			  }?>

 </div> <!-- FIN CONTENIDO CENTRAL -->
</body>
</html>