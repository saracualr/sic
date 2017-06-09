<?php 
include"../conexion/sesion.php";
include "../conexion/db.php";

// Conexión a la base de datos

$enlace  = conectar();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <!-- Le styles -->
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap.css.map"> 
<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.7-dist/css/bootstrap-theme.css"> 
<link rel="stylesheet" type="text/css" href="../css/sicColegio.css">

<link rel="stylesheet" type="text/css" href="../css/redmond/jquery-ui.css">
 
 <!-- JS -->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/jquery-ui.min.js"></script> 
<script src="../js/scriptSic.js"></script> 
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script> 
 


<style>
#area{
	margin-left:auto;
	margin-right:auto;
	margin-top: 3%;
	
	
	}
		

.datos_complementarios {
	margin-left:auto;
	margin-right:auto;
	box-shadow : rgba(0,0,0,0.3) 0px 0px 1em;
	
	margin-bottom:5%;
	width:40%;
	
	border-radius:3%;

}

	
		.titulo_iniciarS{
		border-top-left-radius: 10px;
        border-top-right-radius: 10px; 
		background-color:blue; 
		height:30px; 
		padding-top:5px; 
		color:#FFF;
		text-align:center;
		width:100%;
			
		
		}

</style>

</head>

<?php		
	
// SELECT DATOS //
$id_usuario= $_SESSION["id_usuario"];

 			
	
		$usuario=mysql_query("SELECT * FROM usuarios WHERE id_usuario = $id_usuario");
          $row=mysql_fetch_array($usuario);  

		
////////////////////////////// PROCESAR FORMULARIO///////////////////////////		
		if(isset($_POST['clave_vieja'])){
			
			$clave_vieja=$_POST['clave_vieja'];
			} else
			  {
				  $clave_vieja=" ";
				
				  }
		
		
	        if($row["clave"]== md5($clave_vieja) && $_POST["clave_n1"] == $_POST["clave_n2"])
				 
	          {
			
			
			 $usuario = mysql_query("UPDATE usuarios  SET
 clave=md5('$_REQUEST[clave_n1]') WHERE id_usuario = '$id_usuario'", $enlace) or
  die("Problemas en el UPDATE".mysql_error());
  
   
       $mensaje=' ¡Cambio de Clave éxitoso!';
			
		?>
          
		    
        <div id="mensaje" style="display:none; text-align:center;" title="RESULTADO">
     <?php
	   echo $mensaje;
	   echo "<br>";
	   echo "Su nueva clave es : ";
	   ?>
	   
	   <strong><?php echo $_REQUEST["clave_n1"]; ?></strong> 
      </div>  
          <?php  
		  
		  
		     }
			 
	  else if(isset($_POST["clave_n1"]))
			 { $mensaje= 'ERROR : Verifique los datos ingresados';
			  ?>
             
              <div id="mensaje" style="display:none; text-align:center;" title="Error...">
    
     <?php
	   echo $mensaje;
	   
       ?> 
      </div>  
		<?php }?>
            
 

<body >


<?php include "../menu/menu_index.php" ?>


<!---FIN MENÚ-->
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li class="active"> Cambiar Contraseña</li>
  
<div class="container">
</ol><h4>
<p style="margin-left:35px;"> Complete el siguiente formulario: </p></h4>

<div id="area">


<form id="form1" name="form1" action="?" method="POST" >


<div class="datos_complementarios"> 
      
       <p class="titulo_iniciarS">
        CAMBIAR CONTRASEÑA
       
       </p>


<div  style="padding:0 3% 3%;">


 
         <div class="form-group">       	   
	 <label for="clave_vieja">Contraseña Actual <span class="obligatorio">*</span></label>		 
    <input type="password" class="form-control" id="clave_vieja"  name="clave_vieja" placeholder="CONTRASEÑA ACTUAL" required >
    </div>
    
    
    
    <div class="form-group">
    <label for="clave_n1">Nueva Contraseña<span class="obligatorio">*</span></label>
    <input type="password" class="form-control" id="clave_n1"  name="clave_n1" placeholder=" NUEVA CONTRASEÑA" required>
  </div>
        
     
 <div class="form-group">
    <label for="clave_n2"> Confirme Nueva Contraseña<span class="obligatorio">*</span></label>
    <input type="password" class="form-control" id="clave_n2"  name="clave_n2" placeholder="CONFIRME NUEVA CONTRASEÑA " required
    >
  </div>
        
 
        

<div align="center">
<button type="reset" class="btn btn-danger" 
name="registrar">Restablecer <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>

<button type="submit" class="btn btn-default" 
name="registrar">Registrar</button>

</div>

</form><!-- FIN FORMULARIO-->
</div>




</div><!--- FIN DIV FORMULARIO-->
        
        
    </div>   

</div><!-- FIN DATOS COMPLEMENTARIO-->


</div>



</div><!--FIN CONTAINER





</body>
</html>
