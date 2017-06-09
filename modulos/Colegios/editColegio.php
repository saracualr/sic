<?php include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Editar Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../../bootstrap-3.3.7-dist/css/bootstrap.css">

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

//INSERTANDO FORMULARIO PARA UPDATE COLEGIO//

if(!empty($_REQUEST["nombre_colegio"]) && isset($_POST['codigoEdi']) && isset($_FILES['imgCarnet']['tmp_name']))
{
	
		// obtenemos los datos del archivo
			$tipo = $_FILES["imgCarnet"]['type'];
			$tamano = $_FILES["imgCarnet"]['size'];
			$archivo = $_FILES["imgCarnet"]['name'];
			$extension = substr ($archivo, -4);

			// Valido formato de archivo
			if ((($tipo =="image/png") or ($tipo =="image/jpeg")) and (($tamano < 1000000)))
			{         
				//Seteo de Variable para llevar a destino
				if (isset($archivo)) 
				{
					// guardamos el archivo a la carpeta subidas
					$destino = "disCarnet/".$_REQUEST['nombre_colegio']."_".$extension;
					$nombreFoto = $_REQUEST['nombre_colegio']."_".$extension;

						if (copy($_FILES['imgCarnet']['tmp_name'],$destino))
						{   		
	

            $edit_empleado= mysql_query("UPDATE colegios SET 
            colegio='$_REQUEST[nombre_colegio]',direccion='$_REQUEST[direccion]',
            telefono='$_REQUEST[telefono]',representante='$_REQUEST[representante]',
            seguro='$_REQUEST[seguro]',codSeguro='$_REQUEST[codSeguro]',imgCarnet='$nombreFoto'
             WHERE id_colegio='$_POST[codigoEdi]'", $enlace)
            or die("Problemas en el UPDATE".mysql_error());
               
            $mensaje='¡Colegio actualizado con exitó!';

          //header("location:adminEmpleado.php");


                        }
 
				}
				
			}	


}			
//Selecciono datos a editar
if(isset($_GET['codigoEdi'])){
  $codigoCole=addslashes($_GET['codigoEdi']);

$registros= mysql_query("SELECT * FROM colegios AS Cole 
                         WHERE id_colegio = $codigoCole", $enlace) or
                        die("Problemas en el select 2:".mysql_error());

   $row=mysql_fetch_array($registros);
   

      ?>

 </head>

 <body>


 
    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>

     
     <ol class="breadcrumb">
     <li><a href="../index.php">Home</a></li>
       <li><a href="index.php">Colegio</a></li>
      <li class="active">Editar Empleado</li>
      </ol>

<!-- MENSAJE PARA PROCESAMIENTO DE FORMULARIO -->

<?php if (isset($mensaje)){ ?>
         <div id="mensaje" title="RESULTADO...">
    <?php 
    echo $mensaje;} ?>
    </div>   


<article id="menu_lateral">

  <!--<li><a href="../Categorias/index.php"> <span class="glyphicon glyphicon-star-empty"> 
</span>Generar Carnet </a> </li>-->
  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
  

</article>
     
 <div id="formulario"> 
         
         <h4>Complete el siguiente formulario</h4>


<!--- Aqui inicia el formulario -->
<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">

<div id="formEmpleado">


      <!-- INICIO FORMULARIO REGISTRO PARA EMPLEADOS-->  
 
     
  <form class="form-horizontal" role="form" action="#" method="post" id="reg_presentacion" name="reg_presentacion">

<div class="col-sm-10">
  <div class="form-group">
    <label for="Nombre de colegio" class="col-lg-4 control-label">Nombre del Colegio</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="nombre_colegio" name="nombre_colegio"
             placeholder="Nombre de colegio" autofocus  value="<?php echo $row['colegio'] ?>" required>    
    </div>

    <label class="col-lg-4 control-label">Dirección</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="direccion" name="direccion"
             placeholder="Dirección" value="<?php echo $row['direccion'] ?>" required>    
    </div>

    <label class="col-lg-4 control-label">Representante</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="Representante" name="representante"
             placeholder="Representante" value="<?php echo $row['representante'] ?>"  >   
    </div>

      <label class="col-lg-4 control-label">Teléfono</label>
    <div class="col-lg-5">
      <input type="number" class="form-control" id="telefono" name="telefono"
             placeholder="Teléfono" value="<?php echo $row['telefono'] ?>">    
    </div>

    <label class="col-lg-4 control-label">Nombre del Seguro</label>
    <div class="col-lg-5">
      <input type="text" class="form-control"  name="seguro"
             placeholder="Nombre del Seguro" value="<?php echo $row['seguro'] ?> " >    
    </div>

    <label class="col-lg-4 control-label">Codigo del Seguro</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="codSeguro" name="codSeguro"
             placeholder="Codigo del Seguro" value="<?php echo $row['codSeguro'] ?> ">    
    </div>
	
	<label class="col-lg-4 control-label">Imagen del Carnet</label>
    <div class="col-lg-7">
      <input type="file" class="form-control" id="imgCarnet" name="imgCarnet" required
             placeholder="Imagen del Carnet">    
    </div>

	
	
	
<input type="hidden" name="codigoEdi" value="<?php echo $_GET['codigoEdi']?>" /> 
      </div><!--   FIN FORM GROUP -->
<div>
 <button type="submit" class="btn btn-default"  name="registrar">Actualizar</button>
  </div>     
</form>  <!-- FIN FORMULARIO ACTUALIZACION PARA EMPLEADOS-->  
<?php }?>

</body>
</html>