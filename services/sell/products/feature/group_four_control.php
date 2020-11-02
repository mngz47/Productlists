<script>
    
function sendreq_22(url,target){
var req = new XMLHttpRequest();

document.domain = window.location.hostname;

var full_path = "https://"+window.location.hostname+"/"+url;

req.open("GET",full_path,true);

target.className+=' loader';
req.send();
req.onload = function(){
target.className = target.className.replace(' loader','');
target.innerHTML = req.responseText;
};
}

function in_forward(url,type){
    sendreq_22(url,e(type));
}
    
</script>


<div class=forward >
    <a href=# id=four_forward onclick="in_forward('group_four_engine.php?index=<?php
     
     echo ($index+1);
   
     $_SESSION['GF_index'] = ($index+1);
    
    ?>','left_pane_1');return false;" class=block >  </a>
    <script>
    setInterval(function(){e('four_forward').click();},14000);
    </script>
</div>
