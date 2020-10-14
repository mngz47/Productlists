<iframe id=tv src="https://productlists.co.za/services/f_snake/index.html" style="width:100%;height:400px;border:2px solid yellow;" ></iframe>
<script>
	var apps = 
	    [ "https://productlists.co.za/services/f_snake/index.html",
	      "https://www.productlists.co.za/services/pamel_slots/index.html",
	      "https://www.productlists.co.za/services/kasi_nametest/index.html",
	      "https://productlists.co.za/services/cv_engine/templates/temp32.html"];
	
	var index = 0;
	function next(){
		if(index<apps.length){
			e('tv').src = apps[index];
			index++;
		}else{
		index = 0;	
		}
	}
	
	</script>
	<a href=# onclick=next(); class=block style="float:right;" >Another One</a>
