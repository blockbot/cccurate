var footer = document.getElementsByTagName("footer"),
	templateURL = footer[0].attributes[0].value;

require.config({
    baseUrl: templateURL + "/library/js/",
    paths: {
        jquery: 'vendor/jquery.min'
    }
});

require(["jquery","interface/global"], function($, global){

	global.init();
	
	if($(".posts")){

		require(["vendor/jquery.infinitescroll.min"], function(infinitescroll){
			
			var i = 1;

			$('.posts').infinitescroll({
				
 				loading: {
					finishedMsg: "<p><em>No more posts.</em></p>",
					img: templateURL + "/img/loading.gif",
					msgText: "Loading"
				},
			    navSelector: "div.next-posts",            
			    nextSelector: "div.next-posts a:first",    
			    itemSelector: ".posts div.post" 

			  	}, function(data){

			  		i++;

			  		console.log(data);

			  		$("img.lazy").lazyload({
						effect : "fadeIn"
					});


					// fire GA tracking on loading new set of posts
					ga('send', 'pageview', window.location.href + i);

			});
			
		});

	}

	require(["vendor/jquery.lazyload.min"], function(lazyload){

		$(".lazy").lazyload({
			effect : "fadeIn"
		});

	});

});