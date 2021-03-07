function search(value){
if(value.length>1){
sendreq_2("feature/search/search.php?text="+value+"&s=1",e("main"));
}
}

function toggleUpperScroll(){
if(e('search').className.indexOf(' shadow')!==-1){
	if(e('signin_toggle_hold').className.indexOf(' shadow')==-1){
	e('signin_toggle_hold').className+=' shadow';
    }
	e('search').className = e('search').className.replace(' shadow','');
}else{
	e('search').className+=' shadow';
}
}
