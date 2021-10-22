<iframe id=tv src="https://f-snake.herokuapp.com" style="width:100%;height:400px;border:2px solid yellow;" ></iframe>
<div class=row >
<div style="width:80%;float:left;" >
<a id=tv_title href=https://www.productlists.co.za/services/f_snake/index.html class="block" style="background-repeat:no-repeat;background-size:50px auto;background-postion:0 0;padding-left:55px;display:block;width:100%;" >F Snake</a>
</div>
<div style="width:18%;float:left;" >
<a href=# onclick="next();return false;" class="block" style="width:100%;" >Next</a>
</div>
</div>
<script>
	var apps = 
	    [ 
		"https://f-snake.herokuapp.com",
	      "https://pamel-slots.herokuapp.com",
	      "https://kasi-nametest.herokuapp.com",
	      "https://mngz47.github.io/cv_engine",
	      "https://agg-v3.herokuapp.com/paraphrase"
	    ];
	
	var titles = [ "F Snake",
		      "Pamel Slots",
		      "Kasi Nametest",
		      "Temp22", 
		      "Paraphrase"
		     ];
	
	var index = 0;
	function next(){
		if(index<apps.length){
			e('tv').src = apps[index];
			e('tv_title').innerHTML = titles[index];
			e('tv_title').href = apps[index];
			index++;
		}else{
		index = 0;	
		}
	}
	
	</script>
