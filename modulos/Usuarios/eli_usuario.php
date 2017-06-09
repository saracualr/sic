<?php
/*
 * eli_proveedor.php
 * 
 * @author Ray Saracual
 * @version 1.0
 * 
 * */

include "../../conexion/db.php";
 
 
// Conexión a la base de datos

$enlace  = conectar();


// Procesamiento del formulario
//if ( !empty($_POST['nombre'])) 

   $rs1 = mysql_query("DELETE FROM usuarios
   WHERE id_usuario= {$_GET['codigo']}");
                      
       
    if (!$rs1)
        die('Query no valida: ' . mysql_error());
    
    else
        
     header('location:index.php');
  
?>

<?php 
// Cierre de conexión 
desconectar($enlace); 
?>


