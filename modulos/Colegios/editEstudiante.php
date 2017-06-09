<?php include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Editar Estudiante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="@ray_saracual">

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

//INSERTANDO FORMULARIO PARA ACTUALIZAR ESTUDIANTE//

if(isset($_REQUEST["cedula"])&& isset($_REQUEST["cedulaRepresentante"])
  && isset($_POST['codigoEdi']))
{
    //Variables Recibidas//   
    $codigoEdi= addslashes($_POST['codigoEdi']);
      
        $estudiantes_registro= mysql_query("SELECT cedula FROM estudiantes
        WHERE id_estudiante= $codigoEdi", $enlace) 
        or die("Problemas en el select 1:".mysql_error());

        $totalRows_estudiantes= mysql_num_rows($estudiantes_registro);
        $reg_estudiantes      = mysql_fetch_array($estudiantes_registro);

        if ($totalRows_estudiantes > 1)
        {        
        $mensaje='El Estudiante YA FUE REGISTRADO'; 
        }

        else if ($_FILES['foto']['tmp_name']) 
        {
          
        // obtenemos los datos del archivo
        $tipo = $_FILES["foto"]['type'];
        $tamano = $_FILES["foto"]['size'];
        $archivo = $_FILES["foto"]['name'];
        $extension = substr ($archivo, -4);
                  
        // Valido formato de archivo
        if ((($tipo =="image/png") or ($tipo =="image/jpeg")) and (($tamano < 1000000)))

          {         
                       
           // guardamos el archivo a la carpeta subidas
             $destino = "estudiantes_IMG/".$_REQUEST['cedula']."_".$extension;
             $nombreFoto = $_REQUEST['cedula']."_".$extension;

                //Valido paso anterior e inserto en base de datos

              if (copy($_FILES['foto']['tmp_name'],$destino))
               {   

  
        $edit_estudiante = mysql_query("UPDATE estudiantes SET
        nombre='$_REQUEST[nombre]',id_colegio='$_REQUEST[id_colegio]',
        apellido='$_REQUEST[apellido]',cedula='$_REQUEST[cedula]',grado='$_REQUEST[grado]',
        seccion='$_REQUEST[seccion]',foto='$nombreFoto', representante='$_REQUEST[representante]',
        apellidoRepresentante='$_REQUEST[apellidoRepresentante]',cedulaRepresentante = '$_REQUEST[cedulaRepresentante]',   telefono='$_REQUEST[telefono]',
        periodo='$_REQUEST[periodo]' WHERE id_estudiante ='$_POST[codigoEdi]' ", $enlace) or
        die("Problemas en el UPDATE".mysql_error());
  
   
       $mensaje='¡Actualización de datos éxitosa 111'; 
    
              }//Cierro If Copy imagen a destino.
           }//Cierro if tipo de imagen

       }//Cierro If validacion foto no vacia.
	   else { //foto vacia
	   
		    $edit_estudiante = mysql_query("UPDATE estudiantes SET
        nombre='$_REQUEST[nombre]',id_colegio='$_REQUEST[id_colegio]',
        apellido='$_REQUEST[apellido]',cedula='$_REQUEST[cedula]',grado='$_REQUEST[grado]',
        seccion='$_REQUEST[seccion]', representante='$_REQUEST[representante]',
        apellidoRepresentante='$_REQUEST[apellidoRepresentante]',cedulaRepresentante = '$_REQUEST[cedulaRepresentante]',   telefono='$_REQUEST[telefono]',
        periodo='$_REQUEST[periodo]' WHERE id_estudiante ='$_POST[codigoEdi]' ", $enlace) or
        die("Problemas en el UPDATE".mysql_error());
  
   
       $mensaje='¡Actualización de datos éxitosa!'; 
		   
		   
		   
	   } 

     
  }//Fin if validacion campos obligatorios

  else if(isset($_REQUEST['editar'])){

     $mensaje='¡Valide los campos Obligatorios!'; 
  } 


//Selecciono datos a editar
if(isset($_GET['codigoEdi'])){
  $codigoEstudiante=$_GET['codigoEdi'];

$registros= mysql_query("SELECT id_estudiante,est.id_colegio,est.nombre,est.apellido,est.cedula,
                         est.grado,est.seccion,est.foto,est.representante,est.cedulaRepresentante,
                         est.apellidoRepresentante,est.telefono,est.periodo,coleg.colegio  FROM estudiantes AS est 
                         LEFT JOIN colegios AS coleg
                         ON est.id_colegio = coleg.id_colegio

                         WHERE id_estudiante = $codigoEstudiante", $enlace) or
                        die("Problemas en el select 2:".mysql_error());


   $row=mysql_fetch_array($registros);

      ?>


<script type="text/javascript">
<!--
function mostrarReferencia(){
//Si la opcion con id Conocido_1 (dentro del documento > formulario con name fcontacto > y a la vez dentro del array de Conocido) esta activada
if (document.formulario.Conocido[1].checked == true) {
//muestra (cambiando la propiedad display del estilo) el div con id 'desdeotro'
document.getElementById('desdeotro').style.display='block';
//por el contrario, si no esta seleccionada
} else {
//oculta el div con id 'desdeotro'
document.getElementById('desdeotro').style.display='none';
     }
}

</script>
 </head>

 <body>

    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>

     
     <ol class="breadcrumb">
     <li><a href="../index.php">Home</a></li>
      <li><a href="../index.php">Colegio</a></li>
      <li class="active">Editar Estudiante</li>
      </ol>

<!-- MENSAJE PARA PROCESAMIENTO DE FORMULARIO -->

<?php if (isset($mensaje))
    { ?>
         <div id="mensaje" title="RESULTADO...">
          <?php echo $mensaje;
     } ?>
          </div>   


<article id="menu_lateral">


  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
  <li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-wrench"> </span> Administrar  </a> </li>
   <!-- Button trigger modal -->
  <li style="color:#FFFFFF;background-color:blue"> 
    <span  data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-camera"> </span> 
    Capturar Foto </span> </li>

</article>
     
 <div id="formulario"> 
         
         <h4>Complete el siguiente formulario</h4>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Capturar Imagen</h4>
      </div>
     <div class="modal-body">

<!--CAMPOS PARA CAPTURA DE FOTO -->
<article align="center">
<canvas id="canvas" width="236px" height="472px"></canvas>

            <video  id="video" width="236px" height="472px" autoplay 
            style="border:#EEEEEE; solid 4px; width:236px; height:472px; z-index:10">
            
            
            </video>

            <section>
    
  <button type="button"  id="btnStart" class="btn btn-default">Encender </button>
   <button type="button"  id="btnPhoto" class="btn btn-danger ">Capturar </button>
  
            </section>

  
    </article> 


    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" id="btnStop" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div><!-- FIN Modal -->

<!-- Inicico de formulario para actualización-->

<form class="form-horizontal" action="#" method="post" name="formulario" enctype="multipart/form-data">

<div id="formEstudiante">

<div id="formCabecera" class="bg-info" >
        <br>

   <!--SELECT PARA OBTENER COLEGIO -->
  <label class="col-sm-1 control-label">Colegio</label>
          <div class="col-sm-8">
           <select id="id_colegio" name="id_colegio" class="form-control">
                 <option selected="selected" value="<?php echo $row['id_colegio'] ?> ">
            
            <?php
              if (strlen($row['colegio']) ==0) {
                           echo "HEY! Debes asignar un colegio a este estudiante";
                      } else {
                            echo $row['colegio']; }?>
             </option>
            <?php 
            $colegios=mysql_query ("SELECT id_colegio,colegio FROM colegios 
                                    WHERE estatus=1", $enlace) or
            die("Problemas en el select 3:".mysql_error());
            
            while($cole=mysql_fetch_array($colegios)){
            echo ' <option value="'.$cole['id_colegio'].'">'.$cole['colegio'].'</option>';    
            }?> 
            </select>  
        </div>  
   

</div><!-- FIN FORM CABECERA-->
                
     <hr class="alert-info"> 
      <h4> Datos del Alumno </h4>
      <hr class="alert-info">  

      <!-- INICIO FORMULARIO REGISTRO PARA ESTUDIANTES-->    

      <div class="form-group">

         <label class="col-xs-1 control-label">Cédula</label>
          <div class="col-sm-3">
           <input type="number" name="cedula" placeholder="Cédula" class="form-control" 
           value="<?php echo $row['cedula'] ?>" required>
          </div>
            
          <label class="col-xs-1 control-label">Nombre</label>
          <div class="col-sm-3">       
           <input type="text" name="nombre" placeholder="Nombre" class="form-control"  
           value="<?php echo $row['nombre'] ?>" required>
          </div>   


          <label class="col-xs-1 control-label">Apellido</label>
          <div class="col-sm-3">       
           <input type="text" name="apellido" placeholder="Apellido" class="form-control" 
            value="<?php echo $row['apellido'] ?>" required>
          </div> 

      </div> 

    
<div class="form-group">
          <label class="col-sm-1 control-label">Grado</label>
          <div class="col-sm-3">
           <select id="periodo" name="grado" class="form-control">
  <option selected="selected" value="<?php echo $row['grado'] ?> ">
                <?php echo $row['grado'] ?></option>
                <option value="Primero"  >Primero</option>
                <option value="Primero"  >Primero</option>
                <option value="Segundo"  >Segundo</option>
                <option value="Tercero"  >Tercero</option>
                <option value="Cuarto"   >Cuarto </option>
                <option value="Quinto"   >Quinto </option>
                <option value="Sexto"    >Sexto  </option>
                <option value="1°Año"    >1°Año  </option>
                <option value="2°Año"    >2°Año  </option>
                <option value="3°Año"    >3°Año  </option>
                <option value="4°Año"    >4°Año  </option>
                <option value="5°Año"    >5°Año  </option>
                <option value="6°Año"    >6°Año  </option>
                </select>
          </div>


          <label class="col-xs-1 control-label">Sección</label>
          <div class="col-sm-3">       
           <input type="text" name="seccion" placeholder="Sección" class="form-control"  
           value="<?php echo $row['seccion'] ?>" maxlength="2" >
          </div>  

      

   <label class="col-sm-1 control-label">Periodo</label>
          <div class="col-sm-3">
           <select id="periodo" name="periodo" class="form-control">
                 <option selected="selected" value="<?php echo $row['periodo']; ?> ">
                  <?php echo $row['periodo']; ?></option>
                <option value="2016-2017">2016-2017</option>
                </select>
          </div>  

 </div> 

 <hr class="alert-info"> 
<h4> Datos del Representante</h4>
  <hr class="alert-info">  
   <div class="form-group">

         <label class="col-xs-1 control-label">Cédula</label>
          <div class="col-sm-3">
           <input type="number" name="cedulaRepresentante" placeholder="Cédula" class="form-control"
            value="<?php echo $row['cedulaRepresentante'] ?>" required>
          </div>
            
          <label class="col-xs-1 control-label">Nombre</label>
          <div class="col-sm-3">       
           <input type="text" name="representante" placeholder="Nombre" class="form-control"
            value="<?php echo $row['representante'] ?>" required>
          </div>   


          <label class="col-xs-1 control-label">Apellido</label>
          <div class="col-sm-3">       
           <input type="text" name="apellidoRepresentante" placeholder="Apellido" class="form-control"
            value="<?php echo $row['apellidoRepresentante'] ?>" required>
          </div> 

      </div> 

      <div class="form-group">

         <label class="col-xs-1 control-label">Teléfono</label>
          <div class="col-sm-3">
           <input type="number" name="telefono" placeholder="Teléfono" class="form-control"
            value="<?php echo $row['telefono'] ?>">
          </div>
       
      </div> 
      <br>

<div class="form-group">
      
    <p>Elegir Nueva Foto:<br />
    <input type="radio" name="Conocido" id="Conocido_0" checked
    onclick="mostrarReferencia();" /> No
    <input type="radio" name="Conocido" id="Conocido_1" 
    onclick="mostrarReferencia();" /> Si
    </p>

    <!--div oculto-->
   <div id="desdeotro" style="display:none;align:left;">
              
          <div class="col-sm-5">
            <input type="file" name="foto" class="form-control">
          
          </div>
   </div>

<div>
<!-- PARA ACTUALIZACION -->
<input type="hidden" name="codigoEdi" value="<?php echo $_GET['codigoEdi']?>" /> 
 <button type="submit" name="editar" value ="1" class="btn btn-default">Actualizar</button>
  </div>             

</form><!-- FIN FORMULARIO REGISTRO PAR ESTUDIANTES-->
</div> <!-- fin formEstudiante-->

<?php }?>
     </div> <!-- FIN FORMULARIO SELECCION INICIAL -->
</body>
</html>