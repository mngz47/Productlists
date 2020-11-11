
    var affiliates_banner = ["//rcm-na.amazon-adsystem.com/e/cm?o=1&p=48&l=ur1&category=instruments&banner=0JB0A4VDS5FZSF8J66G2&f=ifr&linkID=957b6056e810aaba8d6734b832d49fbf&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=26&l=ur1&category=amazonhomepage&f=ifr&linkID=395a3797c0390ce90b0909dac625fbf4&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=26&l=ur1&category=bestsellingproducts&banner=1F8VTV49P7N5K5XY5N82&f=ifr&linkID=62fbaa2c4f1eadfd296f4e00a685b4c2&t=productlists4-20&tracking_id=productlists4-20",
		     "//rcm-na.amazon-adsystem.com/e/cm?o=1&p=48&l=ur1&category=instruments&banner=1F5XAJEA6KXT7JPXEC02&f=ifr&linkID=e4ae1c402faaed3fc1483d4072b07ade&t=productlists4-20&tracking_id=productlists4-20",
		         "https://www.productlists.co.za/services/banners/air_bnb.html",
			 "https://www.productlists.co.za/services/banners/temp222.html",
			 "https://www.productlists.co.za/services/banners/ezio.html",
			 "https://www.productlists.co.za/services/banners/enola-holmes.html",
			 "https://www.productlists.co.za/services/banners/betway.html",
			 "https://www.productlists.co.za/services/banners/revenuehits.html",
			 "https://www.productlists.co.za/services/banners/splitly.html"
			     
			 ];
	    
    var index_home = 0;
    
    function four_next_home(){
		if(index_home<affiliates_banner.length){
			e('four_target_home').src = affiliates_banner[index_home];
			index_home++;
		}else{
		index_home = 0;	
		}
	  }
  setInterval(function(){
  four_next_home();
  },14000);
