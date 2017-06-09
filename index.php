<?php
 session_start();

 include("captcha/securimage.php");
 include 'conexion/db.php';
 $img = new Securimage();
  if (!empty($_POST['code'])){
  $valid = $img->check($_POST['code']);
  }
 
if (isset($_GET['cmd']) == 'cerrar'){

  $_SESSION['usuario'] ='';
	$_SESSION['admin'] ='';
	$_SESSION['id_usuario'] ='';
  $_SESSION['id_colegio'] ='';
	
	 header('location:logout.php');
   
}

// Conexión a la base de datos
$enlace = conectar();
 $mensaje=" ";
if (!empty($_POST['nombre']) && 
    strlen($_POST['clave'])> 0) 
	{
    
   $nombre= addslashes($_POST ['nombre']);   
   $clave = addslashes($_POST ['clave']);   
    
    $rs     = mysql_query("SELECT * FROM usuarios
                            WHERE usuario='$nombre'
                            AND clave= md5('$clave') AND estatus=1

                            ",$enlace)or die ("Problemas en el select".mysql_error());
	$datos= mysql_fetch_array ($rs);
    $count  = mysql_num_rows($rs);
	
    if ($count > 0 && ($valid == true)) {
		 $_SESSION['usuario']    = $datos["nombre_apellido"];
		 $_SESSION['id_usuario'] = $datos["id_usuario"];
     $_SESSION['id_rol_usuario'] = $datos["id_rol_usuario"];
     $_SESSION['id_colegio'] == $datos["id_colegio"];

     if  ($_SESSION['id_rol_usuario'] ==3){
    
    
         header('location:modulos/Colegios/adminSelect.php');

       } else {

          header('location:modulos/index.php');


       }
  
	}
	else if (isset($_POST['nombre'])) {

		 $mensaje= "Inicio de sesión incorrecto, intente nuevamente..";
		 
		 ?>
		  <div id="mensaje" style="display:none" title="Error...">
				 <?php
                    echo $mensaje;
                     ?> 
                      </div>  
	<?php
    }  
	  }
	  
?>
<!DOCTYPE html>
<html lang="es">
  <head>

 <meta charset="utf-8">
    <title>SIC 1.0 | Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="@rssystem">

    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/sicColegio.css">
    <link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui.css">

 <!-- JS -->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script> 
<script src="js/scriptSic.js"></script> 
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 
  </head>
    <body >

<div class="container-fluid">
<figure id="logo">
  <img src="img/sic1.png" width="12%">
</figure>
      
     
       <figure class="login">  
      <form name="Login" action="" method="POST" >
        <table  align="center" border="0" >

            <p class="titulo_cuadro">
                      Iniciar Sesión
                  </p>

     <p align="center"  style="font-size:14px; width:100%; padding:8px; margin-left:auto; margin-right:auto;"> Si ya esta registrado, llene el siguiente formulario para entrar al sistema.                      
                  </p>   
                    <tr>
                        <td>
                         Usuario:  <br>                        
                            <input type="text" name="nombre" class="form-control" placeholder="Usuario" autocomplete="off" 
                            autofocus required>
                          </p>                         
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <p>Clave: <br>                            
                  <input type="password" name="clave" class="form-control" placeholder="Clave" autocomplete="off" required >
                          </p>
                        </td>
                    </tr>
                  
                   <tr bordercolor="#F8F8F8">
                     
                      <td bordercolor="#F8F8F8">
                        <p>Código: <br>        
                        <img src="captcha/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"></p>
                      </td>
                  </tr>
                    
                      <td bordercolor="#F8F8F8" >
                     Escribir Código: <br>        
                      <input name="code" type="text" class="form-control" size="22" 
                      required placeholder="Código de seguridad" 
                      style="height:30px" autocomplete="off"  maxlength="4"  / ></td>

                    </tr>
           <tr>
                        <td colspan="2" align="center">


  <hr>       
<button class="btn btn-succes" type="submit">
<strong>Entrar</strong>
</button>

          
                     
         <!--<button class="btn btn-medium btn-danger" type="reset" ><strong>Borrar</strong></button>-->
                        </td>
                      </tr>
                </table>  
  </form>
     
</figure><!--LOGIN-->



</div> <!-- FIN container-fluid"-->
<br>
<div id="antesFooter">

<img src="img/globalSystems.png" width="12%">
<img src="img/RS2015.png" width="18%">

<p> Facilitamos tu mundo.</p>

</div>
<footer > 
<span class="glyphicon glyphicon-copyright-mark" > </span>Global Systems.
Todo los derechos reservados 2.016.
Diseño y Desarrollo por RsSystem
</footer>
</body>
</html>
<?php
// Cierre de conexión 
desconectar($enlace);
?>