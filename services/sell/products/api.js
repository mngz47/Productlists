var product_image_index = 0;


var main_image_temp;

function setProduct(index){
	product_image_index = index;
	if(index==0){
		e('main_product_image').src = main_image_temp;
	}else{
		if(product_image_index==1){
		main_image_temp = e('main_product_image').src;
		}
		
		e('main_product_image').src = e('product_images').getElementsByTagName('span')[index-1].id;
	}
}

function nextProduct(){
	var pi = e('product_images').getElementsByTagName('span').length+1;
	
	product_image_index+=1;
	
	if(product_image_index<pi){
	
	    checkImageParameterAbility();
		
		if(product_image_index==1){
		main_image_temp = e('main_product_image').src;
		}
		
		e('main_product_image').src = e('product_images').getElementsByTagName('span')[product_image_index-1].id;
		
	}else{
		 product_image_index = 0;
		 
		 checkImageParameterAbility();
		 
		 e('main_product_image').src = main_image_temp;
		 
	}
}

function checkImageParameterAbility(){
	var product_image_length = e('product_images').getElementsByTagName('span').length+1;
	
	params = document.getElementById('params').getElementsByTagName('select');
	
	for(var a=0;a<params.length;a++){
		var param_name = params[a].getElementsByTagName('option')[0].value;
		
		var param_length = params[a].getElementsByTagName('option').length-1;
		
		if(/[cC]olou?r/.test(param_name)){
			
			params[a].onchange = function(){
				setProduct(params[a].selectedIndex-1);
			};
			
			if(product_image_length==param_length){
				
				params[a].getElementsByTagName('option')[product_image_index+1].selected = true;
			
				break;
			}else{
				break;
			}
		}
	}
}

function deleteProduct(product_id){
var res = sendreq("services/sell/products/delete_product.php?product_id="+product_id);
res.onload = function(){
if(res.responseText){
alert('success');
}else{
alert('failure');
}
};
}

function showMother(event){
    
    e('mother').style.display = 'block';
    e('mother').style.backgroundImage = 'url('+e('main_product_image').src+')';
    
    var x = Math.round(event.clientX * e('main_product_image').offsetWidth / e('mother').offsetWidth)-188;
    var y = Math.round(event.clientY * e('main_product_image').offsetHeight / e('mother').offsetHeight)-281;
    
    e('mother').style.backgroundPosition = -x+'px '+-y+'px';
    e('mother').style.backgroundSize = '200%';
    e('mother').style.backgroundRepeat = 'no-repeat';
}

