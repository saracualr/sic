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
    <p> ¿Seguro que desea borrar el Colegio?
    <form method="GET" action="agregarColegio.php">

      <a href="agregarColegio.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_GET['codigoEli2'])){

   $rs1 = mysql_query("DELETE FROM colegios
   WHERE id_colegio= {$_GET['codigoEli2']}");
    
     header('location:agregarColegio.php');
        
  }          
 // Procesamiento del formulario
if (!empty($_POST['nombre_colegio'])) {

    $registrar_colegio = mysql_query("INSERT INTO 
                        colegios(colegio,direccion,telefono,representante,seguro,codSeguro,estatus) 
                        VALUES ('{$_POST['nombre_colegio']}','{$_POST['direccion']}',
                          '{$_POST['telefono']}','{$_POST['representante']}',
                          '{$_POST['seguro']}','{$_POST['codSeguro']}','1')");
    
    if (!$registrar_colegio )
        die('Query no valida error en registrar_colegio' . mysql_error());
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
      <li class="active">Gestionar Colegio</li>
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
  <li><a href="#"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
  <li><a href="agregarCargo.php"> <span class="glyphicon glyphicon-plus"> </span>Agregar Cargos </a> </li>
  <!--<li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-gift"> 
</span> Administrar</a> </li>-->
   

</article>



<div id="contenidoCentral">

<!-- Button trigger modal -->
<figure id="boton_agregar">
<button type="button" class="btn btn-primary btn-small" data-toggle="modal" 
data-target="#myModal">
<span class="glyphicon glyphicon-plus">
 </span> [ Agregar Colegio] 

</button>
</figure><!-- FIN BOTON AGREGAR -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Agregar Colegio</h4>
      </div>
      <div class="modal-body">

<form class="form-horizontal" role="form" action="#" method="post" id="reg_presentacion" name="reg_presentacion">

  <div class="form-group">
    <label for="Nombre de colegio" class="col-lg-4 control-label">Nombre del Colegio</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="nombre_colegio" name="nombre_colegio"
             placeholder="Nombre de colegio" autofocus required>    
    </div>

    <label class="col-lg-4 control-label">Dirección</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="direccion" name="direccion"
             placeholder="Dirección">    
    </div>

    <label class="col-lg-4 control-label">Representante</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="Representante" name="representante"
             placeholder="Representante" >   
    </div>

      <label class="col-lg-4 control-label">Teléfono</label>
    <div class="col-lg-5">
      <input type="number" class="form-control" id="telefono" name="telefono"
             placeholder="Teléfono">    
    </div>

    <label class="col-lg-4 control-label">Nombre del Seguro</label>
    <div class="col-lg-5">
      <input type="text" class="form-control"  name="seguro"
             placeholder="Nombre del Seguro">    
    </div>

    <label class="col-lg-4 control-label">Codigo del Seguro</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="codSeguro" name="codSeguro"
             placeholder="Codigo del Seguro">    
    </div>

  
      </div><!--   FIN FORM GROUP -->
  <hr>
  <div class="form-group" >
    <div class="col-lg-offset-2 col-lg-8">
   <button type="submit" class="btn btn-default">
    Registrar colegio</button>
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

$codigoColegio=$_GET['codigoEdi'];

$registros= mysql_query("SELECT * FROM colegios AS cole
                         WHERE id_colegio = $codigoColegio", $enlace) or
                         die("Problemas en el select 2:".mysql_error());

   $row=mysql_fetch_array($registros);

  ?>
<!-- VENTANA MODAL PARA EDITAR COLEGIO -->
<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" 
aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Agregar Colegio</h4>
      </div>
      <div class="modal-body">
 
<form class="form-horizontal" role="form" action="#" method="post" id="actualizarCole" 
name="actualizarCole">
 
  <div class="form-group">
    <label for="Nombre de colegio" class="col-lg-4 control-label">Nombre del Colegio</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="nombre_colegio" name="nombre_colegio"
             placeholder="Nombre de colegio" value="<?php echo $row['colegio'] ?>"
              autofocus required>    
    </div>

    <label class="col-lg-4 control-label">Dirección</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="direccion" name="direccion"
             placeholder="Dirección" value="<?php echo $row['direccion'] ?>">    
    </div>

    <label class="col-lg-4 control-label">Representante</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="Representante" name="representante"
             placeholder="Representante" value="<?php echo $row['representante'] ?>" >    
    </div>

    <label class="col-lg-4 control-label">Teléfono</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="telefono" name="telefono"
             placeholder="Teléfono" value="<?php echo $row['telefono'] ?>">    
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
<!--Fin ventana modal para actualizar colegio-->

<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-lg-6">
          <input type="text" class="form-control" autofocus placeholder="Buscar colegio" 
          name="buscar_colegio">
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
            <th>COLEGIO</th>
            <th>RESPONSABLE</th>
            <th>TELÉFONO</th>
            <th>SEGURO</th>
            <th>ESTATUS</th>
            <th>OPCIONES</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
	$cont=0;
	if(empty($_POST["buscar_colegio"])){
		
	$colegios = mysql_query ("SELECT id_colegio,colegio,seguro,representante,telefono,estatus 
                            FROM colegios AS cole ", $enlace) or
                            die("Problemas en el select:".mysql_error());

	} else {
		$buscar_colegio = addslashes($_POST['buscar_colegio']);
		$colegios = mysql_query ("SELECT id_colegio,colegio,representante,telefono,estatus 
                            FROM colegios AS cole             
                            WHERE colegio LIKE '%$buscar_colegio%' ", $enlace) or
                            die("Problemas en el select:".mysql_error());
			}
			
	$total_colegios= mysql_num_rows($colegios);
	
	if($total_colegios>0){							 
	while ($colegio=mysql_fetch_array($colegios)){ 
	$cont++;
	?>
    <tr>
    <td><?php echo $cont ?></td>
     <td><?php echo $colegio["colegio"] ?></td>
     <td><?php echo $colegio["representante"] ?></td>
     <td><?php echo $colegio["telefono"] ?></td>
     <td><?php echo $colegio["seguro"] ?></td>
       <td > 
		<?php if (($colegio["estatus"])==1)
		 {?>
          <a class="btn btn-mini" href="desactivarColegio.php?codigo=<?php echo $colegio['id_colegio']; ?>"> 
           <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($colegio["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activarColegio.php?codigo=<?php echo $colegio['id_colegio']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton>   </a>
           </buton><?php } ?>

          </td>  
          <td>
          <a class="btn btn-mini" 
        href="editColegio.php?codigoEdi=<?php echo $colegio['id_colegio']; ?>">
        <span class=" glyphicon glyphicon-pencil"></span>
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