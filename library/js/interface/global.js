define(["jquery"], function($){

	var global = {

		init: function(){

			global.nav.init();
		
		},
		nav: {

			button: $("#main").find("#nav-bars"),
			navItemContainer: $("#main").find("#nav-item-container"),
			init: function(){

				global.nav.controls();

			}, controls: function(){

				global.nav.button.on("click", function(){

					if(!$(this).hasClass("open")){

						$(this).addClass("open");

						$(this).find("div:nth-child(1)").css({
							position: "absolute",
							webkitTransform: "rotate(45deg)",
							MozTransform: "rotate(45deg)",
							transform: "rotate(45deg)",
							top: "12px"
						});

						$(this).find("div:nth-child(2)").css({
							position: "absolute",
							webkitTransform: "rotate(130deg)",
							MozTransform: "rotate(130deg)",
							transform: "rotate(130deg)",
							top: "12px"
						});

						$(this).find("div:nth-child(3)").hide();

						global.nav.navItemContainer.css({
							webkitTransform: "translate3d(-200px,0,0)",
							MozTransform: "translate3d(-200px,0,0)",
							transform: "translate3d(-200px,0,0)"
						});

					} else {

						$(this).removeClass("open");

						$(this).find("div:nth-child(1)").css({
							position: "static",
							webkitTransform: "rotate(180deg)",
							MozTransform: "rotate(180deg)",
							transform: "rotate(180deg)"
						});

						$(this).find("div:nth-child(2)").css({
							position: "static",
							webkitTransform: "rotate(0deg)",
							MozTransform: "rotate(0deg)",
							transform: "rotate(0deg)"
						});

						$(this).find("div:nth-child(3)").show();

						global.nav.navItemContainer.css({
							webkitTransform: "translate3d(0px,0,0)",
							MozTransform: "translate3d(0px,0,0)",
							transform: "translate3d(0px,0,0)"
						});

					}

				});

			}

		}

	};

	return global;

});