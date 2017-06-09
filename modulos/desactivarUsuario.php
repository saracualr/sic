<?php
/*
 * desactivar_categoria.php
 * 
 * @author Ray Saracual
 * @version 1.0
 * 
 * */


include "../conexion/db.php";
 
 
// Conexión a la base de datos

$enlace  = conectar();


// Procesamiento del formulario
//if (!empty($_POST['codigo'])) 

   $rs1= mysql_query("update usuarios set estatus = '0' where id_usuario ={$_GET['codigo']}",$enlace); 
                      
       
    if (!$rs1)
        die('Query no valida: ' . mysql_error());
    
    else
        
     header('location:agregarUsuario.php');
  
?>

<?php 
// Cierre de conexión 
desconectar($enlace); 
?>


