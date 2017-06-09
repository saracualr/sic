<?php
/*
 * sesion.php
 * 
 * Manejadores de sesiones.
 * 
 * @author Ray Saracual
 * @version 1.0
 * 
 * */
 
session_start();

 if (strlen($_SESSION['usuario'])==0){
 
   header('location:../index.php');

   }
?>
