
function signInFocus(){
	if(detectMob()){
		toggleSignIn();
		e('signin').getElementsByTagName('input')[0].focus();
	}else{
		e('signin').getElementsByTagName('input')[0].focus();
	}
}

function toggleSignIn(){
if(e('signin_toggle_hold').className.indexOf(' shadow')!==-1){
	if(e('search').className.indexOf(' shadow')==-1){
	e('search').className+=' shadow';	
	}
	e('signin_toggle_hold').className = e('signin_toggle_hold').className.replace(' shadow','');
}else{
	e('signin_toggle_hold').className+=' shadow';
}
}

function handleSignInType(ele){
	if(e('signin_type').value==''){
		e('signin_type').value = 'customer';
		ele.style.background = 'red';
	}else{
		e('signin_type').value = 'company';
		ele.style.background = 'yellow';
	}
	
	e('signin').submit();
}
