<?php
echo ($_GET['category']?'<script>'.
      'var ll="https://agg-lite.herokuapp.com/index.html?category='.$_GET['category'].'&page=0";'.
      'var ww = window.open(ll);'.
      'if(!ww){'.
      'var link = ne("a");'.
      'link.target="blank";'.
      'link.href=ll;'.
      'link.style.display="none";'.
      'document.body.appendChild(link);'.
      'link.click();'.
      '}</script>'
      :'');
      
?>
