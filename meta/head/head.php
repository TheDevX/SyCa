<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
      var $toggleButton = $('.toggle-button'),
          $menuWrap = $('.menu-wrap');
          $body = $('.main');

      $toggleButton.on('click', function() {
          $(this).toggleClass('button-open');
          $menuWrap.toggleClass('menu-show');
          $body.toggleClass('body-make-place');
      });
  });
  window.onload=function(){
    var mobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
    if (mobile) {alert("Wir empfehlen den Aufruf an einem Computer, da bei mobilen Endgeräten aufgrund verschiedener Kompatibilität nicht immer der volle Funktionsumfang gewährleistet sein kann.");}
  }
  </script>
  <?php
  if(file_exists('../../css/style.css')){
    echo '<link rel="stylesheet" href="../../css/style.css">';
  }
  else if(file_exists('../css/style.css')){
    echo '<link rel="stylesheet" href="../../css/style.css">';
  }
  else if(file_exists('../../../css/style.css')){
    echo '<link rel="stylesheet" href="../../../css/style.css">';
  }
  else{
    die('Keine CSS-Datei gefunden.');
  }
  ?>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Niramit">
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <style>
  html,body,h1,h2,h3,h4,h5,h6 {font-family: "Dosis" ,"Roboto", sans-serif}
  th {background-color: #9e9e9e; color: white;}
  </style>
</head>
