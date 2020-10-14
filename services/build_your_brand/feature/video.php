<div class="video_plugin w3-animate-left" >
<iframe id=tv width="100%" ></iframe>
<div class=row >
<div style="width:80%;float:left;" >
<a id=tv_title href=# class="block" style="background-repeat:no-repeat;background-size:50px auto;background-postion:0 0;padding-left:55px;display:block;width:100%;" ></a>
</div>
<div style="width:18%;float:left;" >
<a href=# onclick="nextVideo();return false;" class="block" style="width:100%;" >next video</a>
</div>
</div>
<script>
     
e('tv').style.height = (e('tv').offsetWidth*220/400)+'px';
    
e('tv').onresize = function(){
e('tv').style.height = (e('tv').offsetWidth*220/400)+'px';
    };
    
var video_index = 0;

<?php
$conn = new mysqli('localhost','produc10_mng','mngzpass636','produc10_productlists_columns');
$sql = 'SELECT id,cover_image,title,text FROM col ORDER BY date_added DESC';
$result = $conn->query($sql);

$images = '';
$titles = '';
$title_links = '';
$videos = '';

if($result){
while($row = $result->fetch_assoc()){
    
$matches = [];
preg_match('"https://www.youtube.com/embed/[A-Za-z0-9]*"',$row['text'],$matches);

for($a=0;$a<count($matches);$a++){
	
	$images.="'".$row['cover_image']."',";
	$titles.="'".str_replace('\'','',$row['title'])."',";
	$title_links.="'".$row['id']."',";
	$videos.="'".$matches[$a]."',";
}
}
}

echo 'var images = ['.substr($images,0,strlen($images)-1).'];';
echo 'var titles = ['.substr($titles,0,strlen($titles)-1).'];';
echo 'var title_links = ['.substr($title_links,0,strlen($title_links)-1).'];';
echo 'var videos = ['.substr($videos,0,strlen($videos)-1).'];';

?>

e('tv_title').href = 'https://www.productlists.co.za/services/build_your_brand/open.php?member_id='+title_links[video_index];
e('tv_title').innerHTML = titles[video_index];
e('tv_title').style.backgroundImage = 'url(https://www.productlists.co.za/services/build_your_brand/images/'+images[video_index]+')';
e('tv').src = videos[video_index];

function nextVideo(){
	if(video_index<(videos.length-1)){
		video_index+=1;
		e('tv_title').href = 'https://www.productlists.co.za/services/build_your_brand/open.php?member_id='+title_links[video_index];
		e('tv_title').innerHTML = titles[video_index];
		e('tv_title').style.backgroundImage = 'url(https://www.productlists.co.za/services/build_your_brand/images/'+images[video_index]+')';
	    e('tv').src = videos[video_index];
	}else{
		video_index=0;
		e('tv_title').href = 'https://www.productlists.co.za/services/build_your_brand/open.php?member_id='+title_links[video_index];
		e('tv_title').innerHTML = titles[video_index];
		e('tv_title').style.backgroundImage = 'https://www.productlists.co.za/services/build_your_brand/images/'+images[video_index];
		e('tv').src = videos[video_index];
	}
}
</script>
</div>
