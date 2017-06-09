<?php include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Editar Estudiante</title>
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

//INSERTANDO FORMULARIO EMPLEADO//

if(!empty($_REQUEST["cedulaEmpleado"]) && isset($_POST['codigoEdi']))
{
$codigoEdi= $_POST['codigoEdi'];
 
 $empleados_registro= mysql_query("SELECT cedula FROM empleadosColegios
                        WHERE id_empleado= $codigoEdi", $enlace) 
                        or die("Problemas en el select 2:".mysql_error());
  
  $totalRows_empleados= mysql_num_rows($empleados_registro);
  $reg_empleados     = mysql_fetch_array($empleados_registro);
    
    if($reg_empleados['cedula'] == $_REQUEST["cedulaEmpleado"] )

    {  // obtenemos los datos del archivo
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
               // guardamos el archivo a la carpeta empleados_IMG
                 $destino = "empleados_IMG/".$_REQUEST['cedulaEmpleado']."_".$extension;
                 $nombreFoto = $_REQUEST['cedulaEmpleado']."_".$extension;

                //Valido paso anterior e inserto en base de datos

                if (copy($_FILES['foto']['tmp_name'],$destino))
                 {   

            $edit_empleado= mysql_query("UPDATE empleadoscolegios SET 
            nombre='$_REQUEST[nombre]',id_colegio='$_REQUEST[id_colegio]',
            apellido='$_REQUEST[apellido]',cedula='$_REQUEST[cedulaEmpleado]',
            telefono='$_REQUEST[telefono]',id_cargo='$_REQUEST[id_cargo]',foto='$nombreFoto',
            periodo='$_REQUEST[periodo]'  WHERE id_empleado = '$_POST[codigoEdi]' ", $enlace)
            or die("Problemas en el UPDATE".mysql_error());
               
            $mensaje='¡Empleado actualizado con exitó!';

          //header("location:adminEmpleado.php");


    }}} else{ $mensaje='¡Formato de Imagen no Valido o Tamaño muy Grande!';}
 
}  /* Fin validacion cedulas iguales */

else if($reg_empleados['cedula'] != $_REQUEST["cedulaEmpleado"] ) {

   $empleados_registro= mysql_query("SELECT cedula FROM estudiantes
            WHERE cedula= $_REQUEST[cedulaEmpleado]", $enlace) 
            or die("Problemas en el select 1:".mysql_error());

            $totalRows_empleados= mysql_num_rows($empleados_registro);
            $reg_empleados     = mysql_fetch_array($empleados_registro);

          if ($totalRows_empleados > 0){
            $mensaje='El Empleado ya fue Registrado'; 
           } else
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
               // guardamos el archivo a la carpeta empleados_IMG
                 $destino = "empleados_IMG/".$_REQUEST['cedulaEmpleado']."_".$extension;
                 $nombreFoto = $_REQUEST['cedulaEmpleado']."_".$extension;

                //Valido paso anterior e inserto en base de datos

                if (copy($_FILES['foto']['tmp_name'],$destino))
                 {   

  $edit_empleado= mysql_query("UPDATE empleadoscolegios SET 
  nombre='$_REQUEST[nombre]',id_colegio='$_REQUEST[id_colegio]',apellido='$_REQUEST[apellido]',
  cedula='$_REQUEST[cedulaEmpleado]',telefono='$_REQUEST[telefono]',
  id_cargo='$_REQUEST[id_cargo]',foto='$nombreFoto',periodo='$_REQUEST[periodo]'
  WHERE id_empleado = '$_POST[codigoEdi]' ", $enlace)
  or die("Problemas en el UPDATE".mysql_error());
                       
                 $mensaje='¡Empleado actualizado con exitó!';

     }}}

           else{ $mensaje='¡Formato de Imagen no Valido o Tamaño muy Grande!';}

    }

  }/*Fin validacion cedulas diferentes*/

}



//Selecciono datos a editar
if(isset($_GET['codigoEdi'])){
  $codigoEmpleado=$_GET['codigoEdi'];

$registros= mysql_query("SELECT id_empleado,empCole.id_colegio,nombre,apellido,cedula,
                        empCole.telefono,cole.colegio,cole.id_colegio,
                        empCole.foto,empCole.periodo, empCole.id_cargo,cargos.cargo 
                        FROM empleadosColegios AS empCole LEFT JOIN 
                        cargos AS cargos ON empCole.id_cargo = cargos.id_cargo
                        LEFT JOIN colegios AS cole ON empCole.id_colegio = cole.id_colegio
                         WHERE id_empleado = $codigoEmpleado", $enlace) or
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
      <li><a href="../index.php">Colegio</a></li>
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
  <li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-wrench"> </span> Administrar  </a> </li>
   <!-- Button trigger modal -->
  <li style="color:#FFFFFF;background-color:blue"> <span  data-toggle="modal" 
    data-target="#myModal"><span class="glyphicon glyphicon-camera"> </span> 
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

<!--- Aqui inicia el formulario -->
<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">

<div id="formEmpleado">
<div id="formCabecera" class="bg-info" >
      <b></b> 
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

      <!-- INICIO FORMULARIO REGISTRO PARA EMPLEADOS-->  
 <hr class="alert-info"> 
      <h4> Datos del Empleado </h4>
      <hr class="alert-info">  
     
      <div class="form-group">

         <label class="col-xs-1 control-label">Cédula</label>
          <div class="col-sm-3">
           <input type="number" name="cedulaEmpleado" placeholder="Cédula" class="form-control"
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

         <label class="col-xs-1 control-label">Teléfono</label>
          <div class="col-sm-3">
           <input type="number" name="telefono" placeholder="Teléfono" class="form-control"
           value="<?php echo $row['telefono'] ?>">
          </div>
      
            
           <label class="col-sm-1 control-label">Cargo</label>
          <div class="col-sm-3">
          <select id="id_cargo" name="id_cargo" class="form-control">
          <option selected="selected" value="<?php echo $row['id_cargo'] ?> ">
                  <?php echo $row['cargo']; ?></option>
            <?php 
            //SELECT PARA OBTENER cargo//
            $cargos=mysql_query ("SELECT id_cargo,cargo FROM cargos", $enlace) or
            die("Problemas en el select 6:".mysql_error());
            while($carg=mysql_fetch_array($cargos)){
            echo ' <option value="'.$carg['id_cargo'].'">'.$carg['cargo'].'</option>';    
            } ?> 
            </select>       
          </div>



           <label class="col-sm-1 control-label">Periodo</label>
          <div class="col-sm-3">
           <select id="periodo" name="periodo" class="form-control">
                 <option selected="selected" value="<?php echo $row['periodo'] ?> ">
                  <?php echo $row['periodo'] ?></option>
                <option value="2016-2017">2016-2017</option>
                </select>
          </div>  


      </div> 

<div class="form-group">
       <div align="center" style="margin-top:10px;">
                                              
            <p> <b> La foto actual es: 
            <span style="color:red"><?php echo $row['foto'] ?></span>
            Seleccione la foto indicada u otra para cambiar</b></p>
                        <div class="col-xs-6">
                         <br> 
                        <input type="file" name="foto" >
                        </div>
  
  <!-- VALOR PARA INSERT DE COLEGIO-->                   
<!--<input type="hidden" name="id_colegio" value="<?php echo $id_colegio?>" />--> 

<input type="hidden" name="codigoEdi" value="<?php echo $_GET['codigoEdi']?>" /> 
 <!--FIN-->
   </div>
<div>
 <button type="submit" class="btn btn-default"  name="registrar">Actualizar</button>
  </div>     
</form>  <!-- FIN FORMULARIO ACTUALIZACION PARA EMPLEADOS-->  
<?php }?>

</body>
</html>