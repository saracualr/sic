<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <title>SIC 1.0 | Colegio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
 </head>

 <body>


<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

     
      <img src="../../img/sic.png">
    
    
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      
        
      <ul class="nav navbar-nav navbar-right">
      
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
          Bienvenido(a) <?php echo $_SESSION['usuario']; ?><span class="caret"> </span></a>
          <ul class="dropdown-menu" role="menu">
           
            
           <li class="divider"></li>
           <li><a href="../edit_usuario.php" >
            <span class="glyphicon glyphicon-wrench"> </span> Cambiar Contraseña</a></li>
            
            <?php if($_SESSION['id_rol_usuario']==2){?>
            <li><a href="../agregarUsuario.php" >
            <span class="glyphicon glyphicon-plus"> </span> Gestionar Usuario</a></li>
             <?php } ?> 
              <li><a href="../../index.php?cmd=cerrar"><span class="glyphicon glyphicon-off"> 
              </span>Cerrar Sesión</a></li>
        
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


</body>
</html>
