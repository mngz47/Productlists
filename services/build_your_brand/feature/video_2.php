<div class="video_plugin w3-animate-left" >
<iframe id=yt_tv width="100%" ></iframe>
<div class=row >
<div style="width:80%;float:left;" >
<a href=# onclick="nextVideo();return false;" class="block" style="background-repeat:no-repeat;background-size:50px auto;background-postion:0 0;padding-left:55px;display:block;width:100%;" ></a>
</div>
<div style="width:18%;float:left;" >
<a href=# onclick="nextVideo();return false;" class="block" style="width:100%;" >next video</a>
</div>
</div>
<script>
     
e('yt_tv').style.height = (e('yt_tv').offsetWidth*220/400)+'px';
    
e('yt_tv').onresize = function(){
e('yt_tv').style.height = (e('yt_tv').offsetWidth*220/400)+'px';
    };
    
var video_index = 0;

var videos = 
['https://www.youtube.com/embed/B4RgQEuzcLY',
'https://www.youtube.com/embed/4uU7UIrSFlg',
'https://www.youtube.com/embed/T4vuh_kQvcA'];

e('yt_tv').src = videos[video_index];
	

function nextVideo(){
	if(video_index<(videos.length-1)){
		video_index+=1;
		 e('yt_tv').src = videos[video_index];
		four_next(video_index);
	}else{
		video_index=0;
		e('yt_tv').src = videos[video_index];
		four_next(video_index);
	}
}
</script>
</div>


