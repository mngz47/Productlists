function company_name(parent){
	if(parent.value && !stillOriginal(parent)){
	if(parent.value.length>5){
		var v = parent.value;
		parent.value = v.substring(0,1).toUpperCase()+v.substring(1,v.length);
		
		 v_close();
		 parent.className = 'tick';
		 return true;
	}else{
		 e('error_msg').innerHTML = '<span class=highlight >too short</span>';
		 parent.className = 'cross';
	}
}
}

function registration_number(parent){
	if(parent.value && !stillOriginal(parent)){
	if(/[0-9]{4}\/[0-9]*\/[0-9]{2}/.test(parent.value)){
		v_close();
	    parent.className = 'tick';
		return true;
	}else{
		e('error_msg').innerHTML = '<span class=highlight >Required format: 0000/00000/00</span>';
		parent.className = 'cross';
	}
	}
}
