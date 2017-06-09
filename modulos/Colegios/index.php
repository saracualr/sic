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


//INSERTANDO FORMULARIO ESTUDIANTE//

if(!empty($_POST["cedula"])&& !empty($_POST["cedulaRepresentante"])){

 $estudiantes_registro= mysql_query("SELECT cedula FROM estudiantes
                        WHERE cedula=$_REQUEST[cedula]", $enlace) 
                        or die("Problemas en el select 1:".mysql_error());
  
  $totalRows_estudiantes= mysql_num_rows($estudiantes_registro);
  $reg_estudiantes      = mysql_fetch_array($estudiantes_registro);
    
    
    if( $totalRows_estudiantes== 1){$mensaje='Error: El Estudiante YA EXISTE'; }       

      else if(isset($_REQUEST["cedula"])&& isset($_REQUEST["cedulaRepresentante"]))
             {
             // obtenemos los datos del archivo
            $tipo = $_FILES["foto"]['type'];
            $tamano = $_FILES["foto"]['size'];
            $archivo = $_FILES["foto"]['name'];
            $extension = substr ($archivo, -4);
                  
          // Valido formato de archivo
          if ((($tipo =="image/png") or ($tipo =="image/jpeg")) and (($tamano < 1000000)))

            {         
              //Seteo de Variable para llevar a destino
              if (isset($archivo)) 
                {
               // guardamos el archivo a la carpeta subidas
                 $destino = "estudiantes_IMG/".$_REQUEST['cedula']."_".$extension;
                 $nombreFoto = $_REQUEST['cedula']."_".$extension;

                //Valido paso anterior e inserto en base de datos

                if (copy($_FILES['foto']['tmp_name'],$destino))
                 {   

                  $reg_estudiante= mysql_query("INSERT INTO estudiantes
                (id_colegio,nombre,apellido,cedula,grado,seccion,foto,representante,apellidoRepresentante,
                  cedulaRepresentante,telefono,periodo,estatus)
                   VALUES 
                  ('$_REQUEST[id_colegio]','$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[cedula]',
                    '$_REQUEST[grado]','$_REQUEST[seccion]','$nombreFoto','$_REQUEST[representante]',
                    '$_REQUEST[apellidoRepresentante]','$_REQUEST[cedulaRepresentante]','$_REQUEST[telefono]',
                    '$_REQUEST[periodo]','1')",$enlace) or
                die("Problemas en el INSERT".mysql_error());
                      
                       
                 $mensaje='¡Estudiante registrado con exitó!';
   
      }


    }} else{ $mensaje='¡Formato de Imagen no Valido o Tamaño muy Grande!';}
 
}}else if (empty($_POST["cedula"])&& empty($_POST["cedulaRepresentante"]) && !empty($_POST["registrar"]) ) {

         $mensaje='¡Debe rellenar los campos obligatorios!';


}

//INSERTANDO FORMULARIO EMPLEADO//

if(!empty($_REQUEST["cedulaEmpleado"])){

 $empleados_registro= mysql_query("SELECT cedula FROM empleadosColegios
                        WHERE cedula= $_REQUEST[cedulaEmpleado]", $enlace) 
                        or die("Problemas en el select 2:".mysql_error());
  
  $totalRows_empleados= mysql_num_rows($empleados_registro);
  $reg_empleados     = mysql_fetch_array($empleados_registro);
    
    
    if( $totalRows_empleados== 1){$mensaje='El Empleado YA FUE REGISTRADO'; }       

      else if(isset($_REQUEST["cedulaEmpleado"]))
             {
             // obtenemos los datos del archivo
            $tipo = $_FILES["foto"]['type'];
            $tamano = $_FILES["foto"]['size'];
            $archivo = $_FILES["foto"]['name'];
            $extension = substr ($archivo, -4);
                  
          // Valido formato de archivo
          if ((($tipo =="image/png") or ($tipo =="image/jpeg")) and (($tamano < 1000000)))

            {         
              //Seteo de Variable para llevar a destino
              if (isset($archivo)) 
                {
               // guardamos el archivo a la carpeta subidas
                 $destino = "empleados_IMG/".$_REQUEST['cedulaEmpleado']."_".$extension;
                 $nombreFoto = $_REQUEST['cedulaEmpleado']."_".$extension;

                //Valido paso anterior e inserto en base de datos

                if (copy($_FILES['foto']['tmp_name'],$destino))
                 {   

        $reg_empleado= mysql_query("INSERT INTO empleadoscolegios
        (id_colegio,nombre,apellido,cedula,telefono,id_cargo,
        foto,periodo,estatus)
        VALUES 
        ('$_REQUEST[id_colegio]','$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[cedulaEmpleado]',
        '$_REQUEST[telefono]', '$_REQUEST[id_cargo]','$nombreFoto','$_REQUEST[periodo]','1')",$enlace) or
        die("Problemas en el INSERT".mysql_error());

                       
          $mensaje='¡Empleado registrado con exitó!';
   
      }

    }} else{ $mensaje='¡Formato de Imagen no Valido o Tamaño muy Grande!';}
 
}}
      ?>
 </head>

 <body>
 
    <nav id="menu">
       <?php include "../../menu/menu_portal.php" ?>
     </nav>
     
     <ol class="breadcrumb">
     <li><a href="../index.php">Home</a></li>
      <li class="active">Colegio</li>
      </ol>

<!-- MENSAJE PARA PROCESAMIENTO DE FORMULARIO -->

<?php if (isset($mensaje)){ ?>
         <div id="mensaje" title="Resultado...">
    <?php 
    echo $mensaje;} ?>
    </div>   


<article id="menu_lateral">

<?php if($_SESSION['id_rol_usuario']==2){?>
  <li><a href="agregarColegio.php"> <span class="glyphicon glyphicon-tag"> </span>Gestionar Colegio </a> </li>
  <?php } ?>

  <li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-wrench"> </span> Administrar  </a> </li>
   <!-- Button trigger modal -->
   
  <?php if($_SESSION['id_rol_usuario']==2){?>
  <li style="color:#FFFFFF;background-color:blue"> <span  data-toggle="modal" 
    data-target="#myModal"><span class="glyphicon glyphicon-camera"> </span> 
    Capturar Foto </span> </li>
 <?php } ?>

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
<canvas id="canvas" width="236px" height="272px"></canvas>

            <video  id="video" width="236px" height="272px" autoplay 
            style="border:#EEEEEE; solid 4px; z-index:10">
            
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

   <form class="form-horizontal" action="#" method="post">


      <div class="form-group">
              
          <label class="col-sm-1 control-label">Tipo</label>
          <div class="col-sm-3">
           <select id="seleccion" name="seleccion" class="form-control">
                <option selected="selected" value=" ">Seleccione</option>
                <option value="1">Estudiante</option>
                <option value="2">Empleado</option>
                </select>
          </div>

        <label class="col-sm-2 control-label">Colegio</label>
          <div class="col-sm-5">
           <select id="id_colegio" name="id_colegio" class="form-control">
            <?php 
            //SELECT PARA OBTENER COLEGIO//
            $colegios=mysql_query ("SELECT id_colegio,colegio FROM colegios AS cole WHERE estatus=1", $enlace) or
            die("Problemas en el select 3:".mysql_error());
            echo ("<option> Seleccione </option>"); 
            while($row=mysql_fetch_array($colegios)){
            echo ' <option value="'.$row['id_colegio'].'">'.$row['colegio'].'</option>';    
            }?> 
            </select>       
          </div>
         
         <button type="submit"   class="btn btn-default">Ir</button>
             
     </div>

   </form>

<?php 

if(isset($_POST['seleccion']) && isset($_POST['id_colegio']) )
{
  $seleccion=$_POST['seleccion'];
  $id_colegio=$_POST['id_colegio'];
 
   if($seleccion==1 && $id_colegio !=0){


      $colegios=mysql_query ("SELECT id_colegio,colegio FROM colegios AS cole 
                            WHERE estatus=1 and id_colegio= $id_colegio", $enlace) or
                            die("Problemas en el select 4:".mysql_error());

   $row=mysql_fetch_array($colegios);
   $colegio = $row['colegio'];
    ?>
<div id="formEstudiante">

    <div id="formCabecera" class="bg-info">
      <h4><b>Registo de Estudiante</b> <br>
        <b>Colegio:</b> <?php echo $colegio;?>
      </h4>
    
    </div><!-- FIN FORM CABECERA-->
   
            
     <hr class="alert-info"> 
      <h4> Datos del Alumno </h4>
      <hr class="alert-info">  

      <!-- INICIO FORMULARIO REGISTRO PARA ESTUDIANTES-->    

    <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
     
      <div class="form-group">

         <label class="col-xs-1 control-label">Cédula</label>
          <div class="col-sm-3">
           <input type="number" name="cedula" placeholder="Cédula" class="form-control" required   >
          </div>

          <label class="col-xs-1 control-label">Nombre</label>
          <div class="col-sm-3">       
           <input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
          </div>   


          <label class="col-xs-1 control-label">Apellido</label>
          <div class="col-sm-3">       
           <input type="text" name="apellido" placeholder="Apellido" class="form-control" required>
          </div> 

      </div> 
<div class="form-group">
         
<label class="col-sm-1 control-label">Grado</label>
          <div class="col-sm-3">
           <select id="periodo" name="grado" class="form-control" required>
                <option selected="selected" >Seleccione</option>
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
           <input type="text" name="seccion" placeholder="Sección" class="form-control" required>
          </div>   

     <label class="col-sm-1 control-label">Periodo</label>
          <div class="col-sm-3">
           <select id="periodo" name="periodo" class="form-control">
                <option selected="selected" value=" ">Seleccione</option>
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
           <input type="number" name="cedulaRepresentante" placeholder="Cédula" class="form-control" required>
          </div>
            
          <label class="col-xs-1 control-label">Nombre</label>
          <div class="col-sm-3">       
           <input type="text" name="representante" placeholder="Nombre" class="form-control" required>
          </div>   


          <label class="col-xs-1 control-label">Apellido</label>
          <div class="col-sm-3">       
           <input type="text" name="apellidoRepresentante" placeholder="Apellido" class="form-control" required>
          </div> 
        </div>

 <div class="form-group">
         <label class="col-xs-1 control-label">Teléfono</label>
          <div class="col-sm-3">
           <input type="number" name="telefono" placeholder="Teléfono" class="form-control">
          </div>

      </div> 
     

 <div class="form-group">
       <div align="center" style="margin-top:10px;">
                                              
         <p> <b>Seleccione una foto para el estudiante,solo formato PNG o JPG</b></p>
        <div class="col-xs-6">
         <br> 
        <input type="file" name="foto" required>
        </div>

   </div>

<!-- VALOR PARA INSERT DE COLEGIO-->   
<input type="hidden" name="id_colegio" value="<?php echo $id_colegio?>" /> 
<!--FIN-->
<div>
<button type="submit" class="btn btn-default" value="1" name="registrar">Registrar</button>
  </div>             
</form><!-- FIN FORMULARIO REGISTRO PAR ESTUDIANTES-->

</div> <!-- fin formEstudiante-->

</form>

<?php }
 else if ($seleccion==2 && $id_colegio !=0) { 

 $colegios=mysql_query ("SELECT id_colegio,colegio FROM colegios AS cole 
                            WHERE estatus=1 and id_colegio= $id_colegio", $enlace) or
                            die("Problemas en el select 5:".mysql_error());

   $row=mysql_fetch_array($colegios);
   $colegio = $row['colegio'];

  ?>

<div id="formEmpleado">
<div id="formCabecera" class="bg-info">
      <h4><b>Registo de Empleado </b><br>
      <b> Colegio:</b> <?php echo $colegio;?>
      </h4>
    
    </div><!-- FIN FORM CABECERA-->

      <!-- INICIO FORMULARIO REGISTRO PARA EMPLEADOS-->  
 <hr class="alert-info"> 
      <h4> Datos del Empleado </h4>
      <hr class="alert-info">  

<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
     
      <div class="form-group">

         <label class="col-xs-1 control-label">Cédula</label>
          <div class="col-sm-3">
           <input type="number" name="cedulaEmpleado" placeholder="Cédula" class="form-control">
          </div>
            
          <label class="col-xs-1 control-label">Nombre</label>
          <div class="col-sm-3">       
           <input type="text" name="nombre" placeholder="Nombre" class="form-control">
          </div>   

          <label class="col-xs-1 control-label">Apellido</label>
          <div class="col-sm-3">       
           <input type="text" name="apellido" placeholder="Apellido" class="form-control">
          </div> 

      </div> 

      <div class="form-group">

         <label class="col-xs-1 control-label">Teléfono</label>
          <div class="col-sm-3">
           <input type="number" name="telefono" placeholder="Teléfono" class="form-control">
          </div>
      
            
           <label class="col-sm-1 control-label">Cargo</label>
          <div class="col-sm-3">
           <select id="id_cargo" name="id_cargo" class="form-control">

            <?php 
            //SELECT PARA OBTENER COLEGIO//
            $cargos=mysql_query ("SELECT id_cargo,cargo FROM cargos", $enlace) or
            die("Problemas en el select 6:".mysql_error());
            echo ("<option> Seleccione </option>"); 
            while($row=mysql_fetch_array($cargos)){
            echo ' <option value="'.$row['id_cargo'].'">'.$row['cargo'].'</option>';    
            }?> 
            </select>       
          </div>

          <label class="col-sm-1 control-label">Periodo</label>
          <div class="col-sm-3">
           <select id="periodo" name="periodo" class="form-control">
                <option selected="selected" value=" ">Seleccione</option>
                <option value="2016-2017">2016-2017</option>
                </select>
          </div>
      </div> 

<div class="form-group">
       <div align="center" style="margin-top:10px;">
                                              
           <p> <b>Seleccione una foto,solo formato PNG o JPG</b></p>
          <div class="col-xs-6">
           <br> 
          <input type="file" name="foto" >
          </div>

  <!-- VALOR PARA INSERT DE COLEGIO-->                   
<input type="hidden" name="id_colegio" value="<?php echo $id_colegio?>" /> 
 <!--FIN-->
   </div>
<div>
 <button type="submit" class="btn btn-default" value="1" name="registrar">Registrar</button>
  </div>     

</form>   
<!-- FIN FORMULARIO REGISTRO PARA EMPLEADOS-->  

<!-- VALIDAD SELECCION INICIAL DEL TIPO Y COLEGIO -->

<?php } else {
?>
<h4 align="center" class="text-warning">
  <br>
  <br>
  <?php
  echo "Es obligatorio elegir al menos (1) Tipo y  (1) Colegio.";
}} ?>
</h4>
         </div> <!-- FIN FORMULARIO SELECCION INICIAL -->

</body>
</html>
