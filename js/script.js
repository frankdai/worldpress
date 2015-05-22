(function($){
	var worldpress={};
	worldpress.searchToggle=function(){
		var icon=$('.search-bar .search-icon');
		var toggle=$('.search-toggle');
		icon.click(function(){
			toggle.toggleClass('show');
		})
	};
	worldpress.maniMenu=function(){
		var items=$('#menu-main-menu-nav>li');
		items.each(function(){
			var $this=$(this);
			var sub=$this.find('.sub-menu');
			if (sub) {
				$this.mouseover(function(){
					sub.addClass('over');
				});
				$this.mouseout(function(){
					sub.removeClass('over');
				});
			}
		})
	};
	worldpress.mobileNav=function(){
		var button=$('.navbar-toggle');
		var items=$('.navbar-mobile .menu-item-has-children');
		button.click(function(){
			var menu=$('.navbar-mobile');
			menu.toggleClass('show');
			$(this).toggleClass('collapsed');
		});
		items.click(function(event){
			$(this).find('.sub-menu').toggleClass('show');
			event.preventDefault();
		});
	};
	worldpress.carousel=function(){
		var jslide=$('.jslide').jSlide({
			number:1,
			CSSTransition:true,
		});
		var controls=$('.jslide-control');
		var height=$('.jslide-container').height();
		var padding=(height-20)/2;
		$('.jslide-container .post-content').css('height',height-63);
		controls.css({'padding-top':padding,'padding-bottom':padding});
		$(window).resize(function(){
			jslide.data('jslide').init();
			padding=($('.jslide-container').height()-20)/2;
			controls.css({'padding-top':padding,'padding-bottom':padding});
		});
	}
	$(document).ready(function(){
		$.each(worldpress,function(key,value){
			if (typeof value==="function") {
				value();
			}
		});
	});
})(jQuery)