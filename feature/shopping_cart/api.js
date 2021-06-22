function select(flag,method){
	var p;
	
	if(flag==1){
		p = e('affiliate').getElementsByClassName('payment');
	}else if(flag==0){
		p = e('affiliate').getElementsByClassName('delivery');
	}	
		for(var a=0;a<p.length;a++){
			p[a].selected = false;
			p[a].className = p[a].className.replace(' block_hoov',' block');
		}
		
		method.className = method.className.replace(' block',' block_hoov');
		
		method.selected = true;
}

function getSelectedMethod(flag){
	var r = '';
	var p = e('affiliate').getElementsByClassName((flag==1?'payment':'delivery'));
	
	for(var a=0;a<p.length;a++){
	if(p[a].selected){
		r = p[a].id;
		break;
	}
	}
	return r;
}

function setCheckoutMethods(ele){
	if(getSelectedMethod(1)===''){
		alert('select payment method');
		return false;
	}else{
		if(getSelectedMethod(0)===''){
			alert('select delivery method');
			return false;
		}else{
			ele.href+='?date='+getFormatedDate()+'&p='+getSelectedMethod(1)+'&d='+getSelectedMethod(0);
			return true;
		}
	}
}

function setParameters(product_id,params,cart_qty){
params = document.getElementById('params').getElementsByTagName('select');
var p_t = "";
var status = true;

for(var a=0;a<params.length;a++){
var param_name = params[a].getElementsByTagName('option')[0].value;
p_t+=param_name+'>';
var v = params[a].value;
if(v==param_name || e('cart_qty').value==0){
alert('Fill in all parameters required to purchase product.');
status=false;
break;
}else{
p_t+=v+';';
}
}

if(status){
return 'feature/shopping_cart/index.php?product_id='+product_id+'&params='+p_t+'&qty='+e('cart_qty').value;
}
}

function addToCart(rel,link){
if(rel){
var res = sendreq(rel);
res.onload = function(){
if(res.responseText=="success"){
    location.reload();
}else{
alert(res.responseText);
}
};
}
}

//-----------------------------------------------------

function quick_checkout_transport(btn){
        
        var f = new FormData();
        
        if(e('qc_name').value && e('qc_surname').value && e('qc_email').value && e('qc_vc').value){
            
        f.append("name",e('qc_name').value);
        f.append("surname",e('qc_surname').value);
        f.append("email",e('qc_email').value);
        setDate("date_added");
        f.append("date_added",e('date_added').value);
        f.append("verification_code",e('qc_vc').value);
        
        if(e('qc_country').value && e('qc_state_province').value && e('qc_city').value && e('qc_postal_code').value && e('qc_addressl1').value){
            
            f.append("country",e('qc_country').value);
            f.append("state_province",e('qc_state_province').value);
            f.append("city",e('qc_city').value);
            f.append("postal_code",e('qc_postal_code').value);
            f.append("addressl1",e('qc_addressl1').value);
            f.append("addressl2",e('qc_addressl2').value);
            
            var r = sendform_2('feature/shopping_cart/q_c/quick_c_new.php',f);
            r.onload = function(){
                if(r.responseText.includes('success')){
                    check_out(btn);
                }
                
            };
        }else{
            alert('Fill in all Delivery Info');
        }
        }else{
            alert('Fill in all Primary Info');
        }
        }
        
        function check_out(btn){
             btn.href = 'https://www.productlists.co.za/feature/shopping_cart/checkout.php';
             btn.onclick = '';
             
             if(setCheckoutMethods(btn)){
                 btn.click();
             }
        }

        function transport_handle(btn){
            if(window.location.pathname.split('/').pop()=='open.php'){
                quick_checkout_transport(btn);
            }else{
                check_out(btn);
            }
        }
