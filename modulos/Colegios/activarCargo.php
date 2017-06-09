<?php
/*
 * activar_categoria.php
 * 
 * @author Ray Saracual
 * @version 1.0
 * 
 * */


include "../../conexion/db.php";
 
 
// Conexión a la base de datos

$enlace  = conectar();


// Procesamiento del formulario
//if (!empty($_POST['codigo'])) 

   $rs1= mysql_query("update cargos set estatus = '1' where id_cargo ={$_GET['codigo']}",$enlace); 
                      
       
    if (!$rs1)
        die('Query no valida: ' . mysql_error());
    
    else
        
     header('location:agregarCargo.php');
  
?>

<?php 
// Cierre de conexión 
desconectar($enlace); 
?>

