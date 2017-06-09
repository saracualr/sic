<?php  include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Visualizar Carnet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
 <link rel="stylesheet" type="text/css" href="../../css/carnet.css">

 <!-- JS -->
<script src="../../js/jquery-1.11.1.min.js"></script>
<script src="../../js/jquery-ui.min.js"></script> 
<script src="../../js/html2canvas.js"></script> 
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
<?php
include '../../conexion/db.php';

//Conexión a la base de datos
$enlace = conectar();

// Procesamiento del formulario Ver Carnet

if (isset($_GET['seleccionCarnet'])){

  $verCarnet = $_GET['seleccionCarnet'];

  $registros = mysql_query("SELECT id_empleado,empleCole.id_cargo,empleCole.id_colegio AS idColeEmple,
                            nombre,apellido,periodo,cedula,empleCole.telefono,
                            foto,cole.seguro,cole.codSeguro,cole.colegio,carg.cargo  from 
                           empleadoscolegios AS empleCole
                           LEFT JOIN cargos AS carg ON empleCole.id_cargo = carg.id_cargo
                           LEFT JOIN colegios AS cole ON empleCole.id_colegio = cole.id_colegio
                           
                           where id_empleado= $verCarnet",
                      $enlace) or die("Problemas en el select 1:".mysql_error());
       
  $reg       = mysql_fetch_array($registros);  
                
       ?>

 </head>

 <body>

<div class="container-fluid"> 

    
<?php 
//Valido Colegio : Siso Martinez //
if (!empty($reg['idColeEmple']!=1) ) {
  
    echo "El colegio del cual desea emitir carnet,
    no tiene el diseño en nuestra base de datos.";
    } else 

    {

    ?>

<div id="credencial"> 
  <img src="../../img/fichaEmpleado.png" width="100%">

      <article class="logo">
      
      </article><!--fin logo--> 
      <div class="cabecera"> 

      <p>
        <!--República Bolivariana de Venezuela
Ministerio del Poder Popular para la Educación
Unidad Educativa "Dr. José Manuel Siso Martínez"
      --></p>
      </div><!--fin cabecera--> 
      <div class="foto">
        
      <article><img src="empleados_IMG/<?php echo $reg['foto'];?>">

<!--<div class="fotocargo"> <?php  echo $reg['cargo'] ?></div>
      </article>
      <!--<img src="../../img/estudiante.png">-->
     
       
      </div><!--fin foto--> 

 <div id="descripcionEmple"> 
         
          <h2>Datos del Empleado </h2>
          
          <table width="437" border="0">
  <tbody>
    <tr>
      <td ><strong>Nombre:</strong></td>
      <td ><?php  echo $reg['nombre'] ?></td>
    </tr>
    <tr>
      <td height="25"><strong>Apellidos:</strong></td>
      <td><?php  echo $reg['apellido'] ?></td>
    </tr>
    <tr>
      <td><strong>Cédula:</strong></td>
      <td><?php  echo $reg['cedula'] ?></td>
    </tr>
     <tr>
      <td><strong>Cargo:</strong></td>
      <td><?php  echo $reg['cargo'] ?></td>
      
    </tr>
  </tbody>
</table>


     <div class="periodoEmple">
    <p><b> Período</b> <br>
      <?php  echo $reg['periodo'] ?>
    </p>
     </div>


<?php } } ?>
</div> <!-- Fin descripcion estudiante -->
</div> <!-- FIN CREDENCIAL -->
 </div> <!-- FIN CONTAINER -->




</body>
</html>
