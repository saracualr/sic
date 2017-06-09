<!DOCTYPE html>
<html lang="es">
<head>  
<title> SICV 1.0 - Registro de Usuarios</title>
<meta charset="utf-8">
<meta name="author" content="@rssystem2014">
<link rel="stylesheet"  href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css">

<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css.map">
<script src="../../js/jquery-1.11.1.min.js"></script>

 

	<script src="../../js/bootstrap.js"></script>
	<style>
	#datos_compra{
		padding:2%;
		}
	</style>
   
<?php 

include "../../conexion/db.php";
$enlace = conectar();
$mensaje =" ";
// Conexión a la base de datos
// mysql_query("update familias set estatus = '0' where id = $id",$link); 


 $fecha_creacion = date ("d/m/y");
?>





 <?php
 $idReactivar = ' <script> document.write(´id_producto)</script> ';

 // Procesamiento del formulario
if (!empty($_POST['clave'])) {

    $registar_usuario = mysql_query("INSERT INTO  usuarios(nombre_apellido,usuario,clave,correo,telefono,id_tipo_usuario,fecha_creacion,estatus
						) 
                        VALUES                                                       ('{$_POST['nombre_apellido']}','{$_POST['usuario']}','{$_POST['clave']}','{$_POST['correo']}', 
'{$_POST['telefono']}','{$_POST['id_tipo_usuario']}','{$_POST['fecha_creacion']}','1')");
    
    if (!$registar_usuario)
        die('Query no valida: ' . mysql_error());
    else
        $mensaje = '<div class="alert alert-success" role="alert" align="center"> ¡REGISTRO EXITOSO!</div>';
        
}
 
 //echo $fecha_creacion = date ("d/m/y");
 
?>



</head>
<body>

<nav id="menu">
<?php include "../../menu/menu_proveedor.html"; ?>

 </nav>

<section id="principal"> 
 <?php echo $mensaje;

   ?> 




  <article id="menu_lateral">

  <li><a href="../Categorias/index.php"> <span class="glyphicon glyphicon-star-empty"> </span>Categorias </a> </li>
  <li><a href="../Presentacion/index.php"> <span class="glyphicon glyphicon-tag"> </span>Presentación </a> </li>
   <li> <a href="../Productos/index.php"> <span class="glyphicon glyphicon-gift"> </span> Productos </a> </li>
    <li>
    <a href="index.php"> <span class="glyphicon glyphicon-briefcase"> </span>Proveedores </a></li>
 
 <li> <a href="../Clientes/index.php">   <span class=" glyphicon glyphicon-folder-open" ></span> Clientes</a> </li>
     <li> <a href="#"> <span class="glyphicon glyphicon-stats"> </span>Reportes</a> </li>
        
         <li><a href="index.php">  <span class="glyphicon glyphicon-user"></span>Usuarios </a> </li>
      

 </article>

<!--------------id CONTENIDO_CENTRAL IMPORTANTE PARA LA DIAGRAMANCIÓN DE LA PANTALLA------------------------->
<div id="contenido_central">

<!-- Button trigger modal -->
<figure id="boton_agregar">
<button type="button" class="btn btn-success btn-small"  data-toggle="modal" data-target="#myModal">
<span class="glyphicon glyphicon-plus">
 </span> [ Agregar Usuario]
</button>
</figure>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>       
        
        <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
      </div>
      <div class="modal-body">
       



<form class="form-horizontal" role="form" action="index.php" method="post" id="reg_producto" name="reg_producto">

<input type="hidden" name="fecha_creacion" value="<?php echo $fecha_creacion ?>">
 
 
 
 
 <!-- /////////////////////////////////////////////////-->
 
 
  <div class="form-group">
    <label for="nombre_cliente" class="col-lg-2 control-label">Nombre y Apellido</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="nombre_apellido" name="nombre_apellido"
             placeholder="Nombre y Apellido">    
    </div>
  </div><!-------------------   FIN FORM GROUP ------------------->
  
  
  <div class="form-group">
    <label for="nombre_cliente" class="col-lg-2 control-label">Usuario</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="usuario" name="usuario"
             placeholder="Nombre de Acceso">    
    </div>
  </div><!-------------------   FIN FORM GROUP ------------------->
  
  <div class="form-group">
    <label for="nombre_cliente" class="col-lg-2 control-label">Clave</label>
    <div class="col-lg-5">
      <input type="password" class="form-control" id="clave" name="clave"
             placeholder="Contraseña">    
    </div>
  </div><!-------------------   FIN FORM GROUP ------------------->
  
  
  
   <div class="form-group">
         <label  class="col-lg-2 control-label">Tipo Usuario</label>
         
    <div class="col-lg-6">   
    
     <select id="id_tipo_usuario" name="id_tipo_usuario" class="form-control">
   <?php 
	///////////SELECT PARA OBTENER TIPO DE USUARIO///////////////////////////////////////////
	$categorias= mysql_query ("SELECT * FROM tipo_usuario ", $enlace) or
                                 die("Problemas en el select:".mysql_error());
	 echo ("<option> Tipo de Usuario </option>"); 
	while($row=mysql_fetch_array($categorias)){
										
 echo ' <option value="'.$row['id_tipo_usuario'].'">'.$row['descripcion'].'</option>';	
}?>		 
  
  
</select>
      
       </div>
 </div><!-------------------   FIN FORM GROUP ------------------->
  
  
  
  
  <div class="form-group">
         <label for="telefono" class="col-lg-2 control-label">Teléfono</label>
         
    <div class="col-lg-5">   
     <input type="text" class="form-control" id="telefono"name="telefono" 
             placeholder="Teléfono">
    
      
       </div>
 </div><!-------------------   FIN FORM GROUP ------------------->
     
       <div class="form-group">  
         <label for="Correo Electronico" class="col-lg-2 control-label">Correo Electronico</label>
    <div class="col-lg-5">   
     <input type="email" class="form-control" id="correo"name="correo" 
             placeholder="ejemplo@gmail.com">
    
      
       </div>
   </div><!-------------------   FIN FORM GROUP ------------------->
   
   
      
  <hr>
  <div class="form-group" >
    <div class="col-lg-offset-2 col-lg-10">
   <button type="submit" class="btn btn-default">Registrar Usuario</button>
   
      <button  class="btn btn-default" type="reset" >Restablecer</button>
   
   
    </div>
    
  
 </div><!-------------------   FIN FORM GROUP ------------------->
  
  
  
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>
<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="index.php" method="post" >
        <div class="form-group">
          <input type="text" class="form-control" autofocus
          placeholder="Buscar Usuario" name="buscar_usuario">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>
</div><!-- FIN DEL DEIV QUE ENCIERRA EL INPUT TEXT DE BUSQUEDA-->
<article id="datos_compra">
<table class="table table-hover" >
    <thead>
           <tr class="active">
            <th>ITEMS</th>
            <th>NOMBRE DEL USUARIO</th>  
            <th>TIPO DE USUARIO</th>             
            <th>TÉLEFONO</th>
            <th>CORREO</th>
            <th>ESTATUS</th>
            <th>OPCIONES</th>             
        </tr>
        
    </thead>  
   
    <tbody>
    <?php 
	$cont=0;
	if(empty($_POST["buscar_usuario"])){
		
	$usuarios = mysql_query ("SELECT * FROM usuarios AS user JOIN tipo_usuario AS tu ON 
	                          user.id_tipo_usuario = tu.id_tipo_usuario ", $enlace) or
                                 die("Problemas en el select:".mysql_error());
	} else {
		$buscar_usuario = addslashes($_POST['buscar_usuario']);
		$usuarios= mysql_query ("SELECT * FROM usuarios AS user JOIN tipo_usuario AS tu ON 
	                          user.id_tipo_usuario = tu.id_tipo_usuario
		WHERE nombre_apellido LIKE '%$buscar_usuario%'", $enlace) or
                                 die("Problemas en el select:".mysql_error());
			}
			
	$total_usuarios= mysql_num_rows($usuarios);
	
	if($total_usuarios>0){							 
	while ($usuario=mysql_fetch_array($usuarios)){ 
	$cont++
	?>
    <tr>
    <td><?php echo $cont ?></td>
     <td><?php echo $usuario["nombre_apellido"] ?></td>
      <td><?php echo $usuario["descripcion"] ?></td>
      <td><?php echo $usuario["telefono"] ?></td>
      <td><?php echo $usuario["correo"] ?></td>
     <!--  <td><?php //echo $usuario["autor"] ?></td>-->
        <td > 
		<?php if (($usuario["estatus"])==1)
		 {?>
          <a class="btn btn-mini" href="desactivar_usuario.php?codigo=<?php echo $usuario['id_usuario']; ?>"> 
           <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($usuario["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activar_usuario.php?codigo=<?php echo $usuario['id_usuario']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton>   </a>
           </buton><?php } ?></td>           
      
          
          
           <td>
                 <a class="btn btn-mini" href="eli_usuario.php?codigo=<?php echo $usuario['id_usuario']; ?>">
                <span class=" glyphicon glyphicon-trash"></span>
              </a>              
              
               </td>
    
          
      </tr>
          <?php  }} else {
			  ?>
			  <td align="center"> NO SE ENCONTRARÓN COINCIDENCIAS</td>
			  <?php
			  }?>
              
              
    </tbody>
           </table>
 </article>

 </div> <!---- FIN CONTENIDO CENTRAL------------------>

</body>
</html>
