define(["jquery"],function(e){var t={init:function(){t.nav.init()},nav:{button:e("#main").find("#nav-bars"),navItemContainer:e("#main").find("#nav-item-container"),init:function(){t.nav.controls()},controls:function(){t.nav.button.on("click",function(){e(this).hasClass("open")?(e(this).removeClass("open"),e(this).find("div:nth-child(1)").css({position:"static",webkitTransform:"rotate(180deg)",MozTransform:"rotate(180deg)",transform:"rotate(180deg)"}),e(this).find("div:nth-child(2)").css({position:"static",webkitTransform:"rotate(0deg)",MozTransform:"rotate(0deg)",transform:"rotate(0deg)"}),e(this).find("div:nth-child(3)").show(),t.nav.navItemContainer.css({webkitTransform:"translate3d(0px,0,0)",MozTransform:"translate3d(0px,0,0)",transform:"translate3d(0px,0,0)"})):(e(this).addClass("open"),e(this).find("div:nth-child(1)").css({position:"absolute",webkitTransform:"rotate(45deg)",MozTransform:"rotate(45deg)",transform:"rotate(45deg)",top:"12px"}),e(this).find("div:nth-child(2)").css({position:"absolute",webkitTransform:"rotate(130deg)",MozTransform:"rotate(130deg)",transform:"rotate(130deg)",top:"12px"}),e(this).find("div:nth-child(3)").hide(),t.nav.navItemContainer.css({webkitTransform:"translate3d(-200px,0,0)",MozTransform:"translate3d(-200px,0,0)",transform:"translate3d(-200px,0,0)"}))})}}};return t});