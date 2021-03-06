<?php  include '../../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Visualizar Carnet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- styles -->
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


  $verCarnet = addslashes ($_GET['seleccionCarnet']);



  $registros = mysql_query("SELECT id_estudiante,descargado,estu.id_colegio AS idColeEst,nombre,
    apellido,seccion,grado,periodo,cedula,estu.representante,apellidoRepresentante,cedulaRepresentante,
                           estu.telefono,foto,seguro,codSeguro,cole.colegio,cole.imgCarnet from 
                           estudiantes AS estu 
                           LEFT JOIN colegios AS cole ON estu.id_colegio = cole.id_colegio
                                                      where id_estudiante= $verCarnet",
                      $enlace) or die("Problemas en el select 1:".mysql_error());
       
  $reg       = mysql_fetch_array($registros);  


// Actualizo referencia de que se descargo el carnet

if (($reg['descargado']) == 1){
  $mensaje="Este carnet ya fue descargado. Verifique";

}else{
$rs1= mysql_query("update estudiantes set descargado= '1'
 where id_estudiante =$verCarnet",$enlace); 
      }            
       ?>


 </head>

 <body>

<div class="container-fluid"> 
  <a id="btn-Convert-Html2Image" href="#"><h3>Descargar</h3></a> 
<div id="credencial"> 

<h2 align="center">
<?php 
//Valido Colegio : Siso Martinez //
if (!isset($reg['imgCarnet'])) {
  
    echo "El colegio del cual desea emitir carnet,
    no tiene el diseño en nuestra base de datos.";
    } else 

    {

    ?>
</h2>
  <img src="disCarnet/<?php echo $reg['imgCarnet'];?>" width="100%">

      <article class="logo">
      
      </article><!--fin logo--> 
      <div class="cabecera"> 

      <p>
      
	  </p>
      </div><!--fin cabecera--> 
      <div class="foto">
        
      <article><img src="estudiantes_IMG/<?php echo $reg['foto'];?>"></article>
            
      </div><!--fin foto--> 
 

<br>
<br>
<br>
<br>


 <div id="descripcion">
   <span class="titulosCarnet"> Datos del Estudiante</span> 

   <table width="500" border="0">
   <tbody>
    <tr>
      <td width="165"><strong>Nombre:</strong></td>
      <td width="229" ><?php  echo $reg['nombre'] ?></td>
      <td width="71"><strong>Sección:</strong></td>
      <td width="17"><?php echo $reg['seccion'] ?></td>
    </tr>
    <tr>
      <td height="25"><strong>Apellidos:</strong></td>
      <td ><?php  echo $reg['apellido'] ?></td>
      <td><strong>Grado:</strong></td>
      <td><?php  echo $reg['grado'] ?></td>
    </tr>
    <tr>
      <td width="165"><strong>Código - Cédula:</strong></td>
      <td><?php  
          echo number_format($reg['cedula'], 0,",",".");
            ?>

      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<div style="margin-top:16px;">
     <span class="titulosCarnet">Datos del Representante</span>
     <table width="630" border="0">
       <tbody>
         <tr>

           <td width="99"><strong>Nombre:</strong></td>
           <td width="250"><?php  echo $reg['representante'] ?></td>
          </tr>
         <tr>
           <td height="25"><strong>Apellidos:</strong></td>
           <td><?php  echo $reg['apellidoRepresentante'] ?></td>
          </tr>
         <tr>
           <td><strong>Cédula:</strong></td>
           <td><?php  
              echo number_format($reg['cedulaRepresentante'],0,",",".");
           ?></td>
         </tr>
         <tr>
           <td><strong>Teléfono:</strong></td>
           <td><?php  echo $reg['telefono'] ?></td>
          </tr>
   </div>
         <tr>
<tr> 
<tr>  
<tr>
<tr>  
<tr>  
<tr>  
<tr>
<tr>  
<tr>  
<tr>  
<tr>  
<tr>  
<tr>  
<tr>  
<tr> 
<tr>  
<tr> 
            <td width="120"><strong>Aseguradora:</strong></td>
           <td width="160"><?php  echo $reg['seguro'] ?></td>
           <td width="5"><strong>Código:</strong></td>
           <td width="400"><?php  echo $reg['codSeguro'] ?></td>
           <td width="20"><strong>Período:</strong></td>
           <td width="880"><?php  echo $reg['periodo'] ?></td>
         </tr>
       </tbody>
     </table>
   
       
<?php } } ?>

</div> <!-- Fin descripcion estudiante -->

</div> <!-- FIN CREDENCIAL -->

 </div> <!-- FIN CONTAINER -->

<script>

var element = $("#credencial"); // global variable
var getCanvas; // global variable

html2canvas(element, {
  onrendered: function(canvas) {

    $("#previewImage").append(canvas);
                getCanvas = canvas;

    //document.body.appendChild(canvas);

    var imgageData = getCanvas.toDataURL("image/png");
    var cedula = "<?php echo $reg['cedula'] ?>";
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
   $("#btn-Convert-Html2Image").attr("download", cedula+".png").attr("href", newData);
     //document.body.attr("download", cedula+".png").attr("href", newData);

  }

 

});

</script>
<h1 align="center"><?php if (isset($mensaje)) {echo $mensaje;}?></h1>
</body>
</html>
