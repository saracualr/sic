 $(document).on("ready", function(){
  
    $( "#datepicker").datepicker();
  
  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
   
  
  
   window.onload = function() {

    //Compatibility
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;

    var canvas = document.getElementById("canvas"),
        context = canvas.getContext("2d"),
        video = document.getElementById("video"),
        btnStart = document.getElementById("btnStart"),
        btnStop = document.getElementById("btnStop"),
        btnPhoto = document.getElementById("btnPhoto"),
        videoObj = {
            video: true,
            audio: false
        };

    btnStart.addEventListener("click", function() {
        var localMediaStream;

        if (navigator.getUserMedia) {
            navigator.getUserMedia(videoObj, function(stream) {              
                video.src = (navigator.webkitGetUserMedia) ? window.webkitURL.createObjectURL(stream) : stream;
                localMediaStream = stream;
                
            }, function(error) {
                console.error("Video capture error: ", error.code);
            });

            btnStop.addEventListener("click", function() {
                localMediaStream.stop();
            });

            btnPhoto.addEventListener("click", function() {
                context.drawImage(video, 0, 0, 236, 272);

            });
        }
    });


};


  $( "#mensaje" ).dialog({
      hide:"explode",
      modal: true
    
    
   
  });



  });
