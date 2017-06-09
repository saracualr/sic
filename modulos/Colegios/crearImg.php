<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>titulo</title> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">
/*<![CDATA[*/
#img_uno{
width: 100px;
height: 100px;
}
.logo{
border: solid 3px #000;
}
/*]]>*/
</style>
<script type="text/javascript">
//<![CDATA[
function imagendiv() {
               var imagen = document.createElement("img"); 
               // agregamos propiedades al elemento
               imagen.src = "botones_enc.jpg"; 
               imagen.id = "img_uno";
               imagen.className = "logo";
               imagen.title = "titulo de la imagen";
               imagen.alt = "texto alternativo";
               imagen.onclick = function(){
              alert('el id de este elemento es: ' + this.id);
              };
               // definimos el elemento donde insertamos la imagen
               var div = document.getElementById("capa"); 
               // agregamos la imagen
               div.appendChild(imagen); 
           }
//]]>
</script>
</head>
<body>
<button onclick="imagendiv()">cccc</button>
<div id="img_uno">

asdsadsads
</div>
<div id="capa"></div>
</body>
</html> 