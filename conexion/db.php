<?php
/*
 * db.php
 * Archivo para centralizar las funciones de la base de datos.
 * 
 *@Author Ray Saracual
 *@Version 1.0
 *  
 * */
 
 function conectar(){
   
    $enlace =  mysql_connect('localhost','root','');
    
    if (!$enlace) {
     die('No pudo conectarse: ' . mysql_error());
     } 

     $bd = mysql_select_db('sicdesarrollo', $enlace);
      
      if(!$bd){
              die('Base de Datos no encontrada: ' . mysql_error());

      }else

       
     return $enlace;

	  }
 
 
 
 function desconectar($end){
     
    mysql_close($end);
     
     }

?>

