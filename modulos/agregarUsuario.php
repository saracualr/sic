<?php include '../conexion/sesion.php' ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../css/sicColegio.css">

<link rel="stylesheet" type="text/css" href="../css/redmond/jquery-ui.css">
 
 <!-- JS -->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery-ui.min.js"></script> 
<script src="../js/scriptSic.js"></script> 
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 

	
<?php 

include '../conexion/db.php';

//Conexión a la base de datos
$enlace = conectar();



// Procesamiento del formulario PARA ELIMINAR ESTUDIANTE
if ( isset($_GET['codigoEli'])){ ?>


   <div id="mensaje" title="Atencion...">
    <p> ¿Seguro que desea borrar el Usuario?
    <form method="POST" action="agregarUsuario.php">

      <a href="agregarUsuario.php"> <button type="button"  class="btn btn-default">No</button></a>
   <input type="hidden" value="<?php echo $_GET['codigoEli']?>" name="codigoEli2">
  <button type="submit" name="seleccionEli" value="1" class="btn btn-danger ">Si </button>

    </form>
    </div>   



<?php

}
if (isset($_POST['codigoEli2'])){

   $rs1 = mysql_query("DELETE FROM usuarios
   WHERE id_usuario= {$_POST['codigoEli2']}");
    
     header('location:agregarUsuario.php');
        
  }          
 // Procesamiento del formulario
if (!empty($_POST['usuario'])) {

    $registrar_cargo = mysql_query("INSERT INTO 
                        usuarios(nombre_apellido,usuario,clave,id_rol_usuario,estatus) 
                        VALUES ('{$_POST['nombre_apellido']}','{$_POST['usuario']}',
                         md5('$_REQUEST[clave]'),'{$_POST['id_rol_usuario']}','1')");
    
   if (!$registrar_cargo )
        die('Query no valida error en registrar_usuario' . mysql_error());
    else
      $mensaje = '¡REGISTRO EXITOSO!';
        
}

?>

</head>
<body>

  <div id="container-fluid"> 

<nav id="menu">
<?php include "../menu/menu_index.php"; ?>

 </nav>

 <ol class="breadcrumb">
     <li><a href="index.php">Home</a></li>
     <li class="active">Agregar Usuario</li>
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
   <li><a href="#"> <span class="glyphicon glyphicon-plus"> </span>Agregar Usuario </a> </li>

  <!--<li> <a href="adminSelect.php"> <span class="glyphicon glyphicon-gift"> 
</span> Administrar</a> </li>-->
   

</article>



<div id="contenidoCentral">

<!-- Button trigger modal -->
<figure id="boton_agregar">
<button type="button" class="btn btn-primary btn-small" data-toggle="modal" 
data-target="#myModal">
<span class="glyphicon glyphicon-plus">
 </span> [ Agregar Usuario] 

</button>
</figure><!-- FIN BOTON AGREGAR -->
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

<form class="form-horizontal" role="form" action="#" method="post" id="reg_presentacion" name="reg_presentacion">

  <div class="form-group">
    <label for="Nombre de usuario" class="col-lg-4 control-label">Nombre y Apellido</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="nombre_apellido" name="nombre_apellido"
             placeholder="Nombre y Apellido" autofocus required>    
    </div>

    <label for="User ID" class="col-lg-4 control-label">User ID</label>
    <div class="col-lg-5">
      <input type="text" class="form-control" id="usuario" name="usuario"
             placeholder="User ID" autofocus required>    
    </div>

    <label for="User ID" class="col-lg-4 control-label">Password</label>
    <div class="col-lg-5">
      <input type="password" class="form-control" id="clave" name="clave"
             placeholder="Password" autofocus required>    
    </div>

   
         <label  class="col-lg-2 control-label">Tipo Usuario</label>
         
    <div class="col-lg-5">   
    
     <select id="id_rol_usuario" name="id_rol_usuario" class="form-control">
   <?php 
  ///////////SELECT PARA OBTENER TIPO DE USUARIO///////////////////////////////////////////
  $categorias= mysql_query ("SELECT * FROM rol_usuarios ", $enlace) or
                            die("Problemas en el select:".mysql_error());
   echo ("<option> Tipo de Usuario </option>"); 
  while($row=mysql_fetch_array($categorias)){
                    
 echo ' <option value="'.$row['id_rol_usuario'].'">'.$row['descripcion'].'</option>';  
}?>    
  
  
</select>
      
       </div>
   

   

  
      </div><!--   FIN FORM GROUP -->
  <hr>
  <div class="form-group" >
    <div class="col-lg-offset-2 col-lg-8">
   <button type="submit" class="btn btn-default">
    Registrar Usuario</button>
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


<div style="padding:1%;">
<form class="navbar-form navbar-right" role="search" action="#" method="post" >
        <div class="form-group">
           <div class="col-lg-6">
          <input type="text" class="form-control" autofocus placeholder="Buscar Usuario" 
          name="buscar_usuario">
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
            <th>NOMBRE</th>
            <th>USUARIO</th>
            <th>ROL</th>
            <th>ESTATUS</th>
           <th>OPCIONES</th>
            </tr>
        
    </thead>  
   
    <tbody>
    <?php 
	$cont=0;
	if(empty($_POST["buscar_usuario"])){
		
	$usuarios= mysql_query ("SELECT id_usuario,nombre_apellido,usuario,user.id_rol_usuario,
                           estatus,rol.descripcion
                           FROM usuarios AS user LEFT JOIN rol_usuarios AS rol 
                           ON user.id_rol_usuario = rol.id_rol_usuario", $enlace) or
                           die("Problemas en el select:".mysql_error());

	} else {
		$buscar_usuario = addslashes($_POST['buscar_usuario']);
		$usuarios = mysql_query ("SELECT id_usuario,nombre_apellido,usuario,user.id_rol_usuario,
                           estatus,rol.descripcion
                           FROM usuarios AS user LEFT JOIN rol_usuarios AS rol 
                           ON user.id_rol_usuario = rol.id_rol_usuario             
                            WHERE usuario LIKE '%$buscar_usuario%' ", $enlace) or
                            die("Problemas en el select:".mysql_error());
			}
			
	$total_usuario= mysql_num_rows($usuarios);
	
	if($total_usuario>0){							 
	while ($usuario=mysql_fetch_array($usuarios)){ 
	$cont++;
	?>
    <tr>
    <td><?php echo $cont ?></td>
     <td><?php echo $usuario["nombre_apellido"] ?></td>
     <td><?php echo $usuario["usuario"] ?></td>
      <td><?php echo $usuario["descripcion"] ?></td>
 
       <td > 
		<?php if (($usuario["estatus"])==1)
		 {?>
  <a class="btn btn-mini" href="desactivarUsuario.php?codigo=<?php echo $usuario['id_usuario']; ?>"> 
   <buton id ="reactivar"class="btn-success badge" >
      &nbsp&nbsp;Activo&nbsp; </buton>  </a>    
          <?php } else if (($usuario["estatus"])==0) { ?>
         
           <a class="btn btn-mini" href="activarUsuario.php?codigo=<?php echo $usuario['id_usuario']; ?>"> 
          <buton class="btn-danger badge"> 
          Inactivo
           </buton>   </a>
           </buton><?php } ?></td>           

<td>

<a class="btn btn-mini" href="agregarUsuario.php?codigoEli=<?php echo $usuario['id_usuario']; ?>">
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