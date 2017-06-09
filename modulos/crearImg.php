<?php
  error_reporting(E_ALL); 
   $_GET['path']='gallery/19627090.jpg';
  $imagen = $_GET['path'];
  //if (!is_file($imagen))
  //{
    //die('no existe');
  //}
  //else
  //{
    $ext = substr($imagen, strrpos($imagen, '.') + 1); // extension

    header('content-type: image/'.$ext);
    readfile($imagen);
  //}
?>