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
		if ($('body').hasClass("home")){
			var slide=$('.jslide');
			var jslide=slide.jSlide({
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
	};
	worldpress.like=function(){
		$('.blog-posts').each(function(){
			var that=$(this);
			var data=that.find('.forlikedata');
			var actionURL=data.attr('data-action');
			var id=data.attr('data-postid');
			var like=that.find('.like');
			var dislike=that.find('.dislike');
			var callback=function(data){
				like.find('span')[0].textContent=data.like;
				dislike.find('span')[0].textContent=data.dislike;
			};
			like.click(function(){
				$.post(actionURL,{'id':id,'method':'like'},callback);
			});
			dislike.click(function(){
				$.post(actionURL,{'id':id,'method':'dislike'},callback);
			});
		});
	};
	worldpress.galleryModal=function(){
		var gallery=$('.worldpress-gallery-widget');
		if (gallery) {
			var images=gallery.find('.worldpress-gallery-image a');
			var modal=$('#worldpress-modal');
			var modalBody=modal.find('.modal-body');
			var modalTitle=modal.find('.modal-title');
			console.log(images);
			images.click(function(event){
				var src=this.getAttribute('href');
				var title=this.getAttribute('title');
				modalTitle.text(title);
				modalBody.html('<div class="text-center"><img src="'+src+'" class="img-responsive"></div>');
				modal.modal();
				event.preventDefault();
				return false;
			});
		}
	};
	$(document).ready(function(){
		$.each(worldpress,function(key,value){
			if (typeof value==="function") {
				value();
			}
		});
	});
})(jQuery)