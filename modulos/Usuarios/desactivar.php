<?php 

// Conexión a la base de datos
 include "../../conexion/db.php";
$enlace = conectar();

   $id=$_GET['id']; 
   mysql_query("update familias set estatus = '0' where id = $id",$link); 
?> 
<script>
javascript:carga('index.php')
</script>