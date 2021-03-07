
function addOption(cb){
var res = sendreq('services/sell/products/feature/option/index.php?target='+cb.value+'&t='+(cb.checked?'a':'r'));
res.onload = function(){
if(res.responseText=='signin'){
signInFocus();
cb.checked = false;
}else if(res.responseText=='signup'){
document.location = 'https://productlists.co.za/member/signup_main.php';	
}else if(res.responseText){
if(cb.checked){
alert('preference succesfully selected.');
}else{
alert('preference succesfully deselected.');
}
}else{
alert('failure');
cb.checked = false;
}
};
}
