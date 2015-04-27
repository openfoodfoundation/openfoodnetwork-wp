/* Set a cookie */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

/* Read a cookie */
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

/* Check retina screens */
function isRetinaDisplay() {
	if (window.matchMedia) {
		var mq = window.matchMedia("only screen and (min--moz-device-pixel-ratio: 1.3), only screen and (-o-min-device-pixel-ratio: 2.6/2), only screen and (-webkit-min-device-pixel-ratio: 1.3), only screen  and (min-device-pixel-ratio: 1.3), only screen and (min-resolution: 1.3dppx)");
		if (mq && mq.matches || (window.devicePixelRatio > 1)) {
			return true;
		} else {
			return false;
		}
	}
}

var _is_retina = false;

/*Slider Picture Post*/
function createCarouselPostList(strIndex) {
	(function($){
		var $this=strIndex;
		
		var dataAutoPlay=$this.attr("data-auto-play");
		var dataPagination=parseInt($this.attr("data-pagination"));
		var dataTransition=$this.attr("data-transition");
		if(!dataTransition) {dataTransition="fade"};
		
		$this.owlCarousel({
			transitionStyle: dataTransition,				
			singleItem:true,
			autoHeight: true,
			autoPlay: dataAutoPlay!=''?dataAutoPlay:false,
			navigation: true,
			navigationText:[],
			addClassActive : true,
			pagination: dataPagination===1?true:false,
			stopOnHover:true
		});	
		
		
	}(jQuery));	
};

function openCloseShareListing() {
	(function($){
		/*Close button social list*/
		$('.author-button[data-close-btn-text="open"]').click(function() {
			var $this=$(this);
			//$this.parents(".list-item.col-md-4").addClass("active-index");
			$this.parents(".item-author").find(".hidden-social").addClass("active");	
			$this.parents(".item-author").find('.author-pic').animate({opacity:0},200);	
				$this.parents(".item-author").find('.author-content').animate({opacity:0},200);	
				$this.parents(".item-author").find('.author-button').animate({opacity:0},200);		
			return false;
		});
		
		$('.hidden-social-button[data-close-btn-text="close"]').click(function() {
			closeCheck($(this), true);
		});
		
		$(window).resize(function(){
			$('.hidden-social-button[data-close-btn-text="close"]').each(function(index, element) {
                closeCheck($(this), false);
            });
		});
		
		function closeCheck(strEle, animateCheck) {
			var $this=strEle;
			if(animateCheck) {
				$this.parents(".item-author").find(".hidden-social").removeClass("active");
				$this.parents(".item-author").find('.author-pic').animate({opacity:1},200);	
				$this.parents(".item-author").find('.author-content').animate({opacity:1},200);	
				$this.parents(".item-author").find('.author-button').animate({opacity:1},200);	
				return false;
			}else{
				$this.parents(".item-author").find(".hidden-social").removeClass("active");	
				$this.parents(".item-author").find('.author-pic').animate({opacity:1},200);	
				$this.parents(".item-author").find('.author-content').animate({opacity:1},200);	
				$this.parents(".item-author").find('.author-button').animate({opacity:1},200);		
			};
		};
		/*Close button social list*/
	}(jQuery));	
};
/*Slider Picture Post*/

function openWidgetMenu() {
	(function($){
		$(".listing-sc-content.menu.click").each(function(){
			var $this=$(this);
			var $liAction=$(".parent",  $this);
			$(".parent > a",  $this).click(function(){
				var $this_1=$(this).parents(".parent");
				
				if($this_1.hasClass("active")) {
					$("ul",$liAction).slideUp(300);	
					
					$liAction.removeClass("active");			
				}else{
					$("ul",$liAction).slideUp(300);
					$("ul",$this_1).slideDown(500);
					
					$liAction.removeClass("active");	
					$this_1.addClass("active");
				};
				return false;
			})
		});
	}(jQuery));
};

(function($){	

	var retina = getCookie("cactus-retina");
    if (retina != "") {
		if(retina = '1'){
		    _is_retina = true;
		}
    } else {
		if(isRetinaDisplay()){
			_is_retina = true;
			
			setCookie("cactus-retina", "1", 300);
		} else {
			_is_retina = false;
			
			setCookie("cactus-retina", "0", 300);
		}
	};
	
	//Load Function
	$(window).load(function(){		
		/*masonry*/
		createMasonry();
		createMasonry_filter();
		/*masonry*/
		
		/*loading listing*/
		loadinglisting();
		/*loading listing*/

	});
	
	//Resize Function	
	var rtime = new Date(1, 1, 2000, 12,00,00);
	var timeout = false;
	var delta = 200;
	$(window).resize(function() {
		
		rtime = new Date();
		if (timeout === false) {
			timeout = true;
			setTimeout(createParallaxForText, delta);
			setTimeout(createParallaxForSlider_V4, delta);
			setTimeout(setFullWindowForSlider, delta);
			setTimeout(setFullWindowForSlider_post, delta);
			setTimeout(syncedOwlCarouselPost, delta);
			setTimeout(addFixedEffect, delta);
		}
		
		//no delay		
			/*masonry*/
			createMasonry();
			setTimeout(function(){createMasonry();createMasonry_filter()}, 500);
			setTimeout(function(){createMasonry();createMasonry_filter()}, 1000);
			/*masonry*/

			createParallaxForText();
			createParallaxForSlider_V4();			
			setFullWindowForSlider();
			setFullWindowForSlider_post();
			syncedOwlCarouselPost();
			addFixedEffect();
			
			//console.log(window.innerWidth);
				
	});//End Resize Function
	
	/*V2 - Parralax Text*/
	var defaultMarginTop=[];
	var defaultMaxHeight=[];
	function createParallaxForText() {
		$(".slider-item.is-text-parallax").each(function(index, element){
			if(defaultMarginTop[index]!='' && defaultMarginTop[index]!=null){
				defaultMarginTop[index]=defaultMarginTop[index];				
			}else{
				defaultMarginTop[index]=$(this).find(".text-content").css("margin-top");
			};				
			$(window).resize(function() {
				defaultMaxHeight[index]='';
			});
			if(defaultMaxHeight[index]!='' && defaultMaxHeight[index]!=null){
				defaultMaxHeight[index]=defaultMaxHeight[index];
			}else{
				defaultMaxHeight[index]=$(this).height();
			};					
			parallax_for_text($(this), defaultMarginTop[index], defaultMaxHeight[index]);
		});
	};	
	function parallax_for_text(strVal, str_defaultMarginTop, int_defaultMaxHeight) {
		var $this=strVal;
		var maxHeight=int_defaultMaxHeight;
		var fix_defaultMarginTop=parseInt(str_defaultMarginTop.replace("px",""));
		$this.find(".row").css({"max-height":(maxHeight+fix_defaultMarginTop)});
		var scrollPos = $(window).scrollTop();
		var speed = 0.6;
		var OpacityPercent=(parseInt(maxHeight+fix_defaultMarginTop)-scrollPos)/parseInt(maxHeight+fix_defaultMarginTop);
		
		if(window.innerWidth > 991) {
			if(parseInt(maxHeight)-scrollPos==parseInt(maxHeight)){
				$this.find(".text-content").css({"opacity":"1", "max-height":(maxHeight), "margin-top":str_defaultMarginTop});
			}else{
				$this.find(".text-content").css({"opacity":OpacityPercent, "max-height":(maxHeight), "margin-top":(scrollPos * speed + fix_defaultMarginTop)+"px"});
			};
		}else{
			$this.find(".text-content").css({"opacity":"1", "max-height":(maxHeight), "margin-top":str_defaultMarginTop});
		};
	};
	/*V2 - Parralax Text*/
	
	/*masonry*/	
	function createMasonry(){		
		var $cactus_isotope = $('.list-content.post-masonry .container .row .row');
		var $cactus_isotope_A = $('.list-content.modern-grid:not(.portfolio-grid) .container .row .row');
				
		var isoOptions = {
		  itemSelector: '.list-item.col-md-4',
		  layoutMode: 'masonry',
		  masonry: {
		 	 columnWidth: $cactus_isotope.find('.list-item.col-md-4')[0],
		  },
		};
		
		$cactus_isotope.isotope( isoOptions );
		$cactus_isotope.isotope('layout');	
		
		$cactus_isotope_A.isotope( isoOptions );	
		$cactus_isotope_A.isotope('layout');	
	};
	
	function createMasonry_filter(){		
	
		var $cactus_isotope = $('.list-content.post-grid.modern-grid.portfolio-grid .container .row .row');
						
		var isoOptions = {
		  itemSelector: '.list-item.col-md-4',
		  layoutMode: !$(".list-content.post-grid.modern-grid.portfolio-grid").hasClass("portfolio-masonry")?'fitRows':'masonry',
		  masonry: {
		 	 columnWidth: $cactus_isotope.find('.list-item.col-md-4')[0],
		  },
		};
		
		$cactus_isotope.isotope( isoOptions );
		$cactus_isotope.isotope('layout');	
		
		
		var filterFns = {
			// show if number is greater than 50
			numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
			},
			// show if name ends with -ium
			ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
			}
		};
		
		$('.filter-masonry').on( 'click', function() {
			var filterValue = $( this ).attr('data-filter');
			// use filterFn if matches value
			filterValue = filterFns[ filterValue ] || filterValue;
			$cactus_isotope.isotope({ filter: filterValue });
			
			$('.filter-masonry').removeClass("active");
			$(this).addClass("active");
			return false;
		});
		
	};
	/*masonry*/
	
	/*loading listing*/
		function loadinglisting() {
			$(".loading-listing").addClass("active-false");
			
			var win = $(window);
			var allMods = $(".is-effect-visible");
			allMods.each(function(i, el) {
				var el = $(el);
				if (el.visible(true)) {
					el.addClass("default-visible"); 
				}; 
			});
			
			win.scroll(function(event) {		  
				allMods.each(function(i, el) {
					var el = $(el);
					if (el.visible(true)) {
						el.addClass("fading-visible"); 
					}; 
				});			  
			});
		};
		
		$.fn.visible = function(partial) {    
		  var $t            = $(this),
			  $w            = $(window),
			  viewTop       = $w.scrollTop(),
			  viewBottom    = viewTop + $w.height(),
			  _top          = $t.offset().top,
			  _bottom       = _top + $t.height(),
			  compareTop    = partial === true ? _bottom : _top,
			  compareBottom = partial === true ? _top : _bottom;		
			  return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
	   };
	/*loading listing*/
	
	function remove_class_preload() {
		$('nav[data-fixed="1"]').removeClass("preload");
	};
	
	/*Fixed menu*/
	function addFixedEffect(){
		var $this=$("header .nav-default > .navbar-default");
		var dataFixedScrollTop = $this.attr("data-fixed-scroll-top");
		if(dataFixedScrollTop==null) {dataFixedScrollTop=''};
		
		var dataFixed = parseInt($this.attr("data-fixed"));
		if(
			dataFixed===1 && 
			dataFixedScrollTop.toString() != "auto" &&
			!$this.parents("#header-navigation").hasClass("index-v3") &&
			window.innerWidth > 1199
		) {	$this.css({"position":"fixed", "top":$("#wpadminbar").height()+"px"});}
		else{			
			$this.css({"position":"", "top":""});
		}
	}
	
	var fixedMenuAuto=0;
	function addHeaderFixedMenu(){	
		function actionHeaderFixedMenu() {
			var $this=$("header .nav-default > .navbar-default");
			var scrollPos = $(window).scrollTop();
			var dataFixed = parseInt($this.attr("data-fixed"));
			var dataFixedScrollTop = $this.attr("data-fixed-scroll-top");
			if(dataFixedScrollTop==null) {dataFixedScrollTop=''};
			var checkWpbar=0;
			
			if(dataFixedScrollTop.toString() == "auto"){
				checkWpbar=1;
				if(fixedMenuAuto>0 && fixedMenuAuto<1000){
					dataFixedScrollTop=fixedMenuAuto;
				}else{
					fixedMenuAuto=($this.offset().top) + ($this.height());
					dataFixedScrollTop=($this.offset().top) + ($this.height());
				};
			}else{
				checkWpbar=0;
				//dataFixedScrollTop=parseInt(dataFixedScrollTop);
				dataFixedScrollTop=2;
			};

			if(dataFixed===1 && window.innerWidth > 1199) {
				if(scrollPos>dataFixedScrollTop){
					remove_class_preload();					
					$this.removeClass("fixed-menu-default");
					$this.addClass("fixed-menu");
					//if(checkWpbar==0){
						$this.css({"top":$("#wpadminbar").height()+"px"});
					//};
				}else{
					$this.removeClass("fixed-menu");
					$this.addClass("fixed-menu-default");
					if(checkWpbar==0){
						if(dataFixedScrollTop.toString() != "auto" &&!$this.parents("#header-navigation").hasClass("index-v3")){
							$this.css({"top":$("#wpadminbar").height()+"px"});
						}else{
							$this.css({"top":"0px"});
						};
					}else{
						$this.css({"top":"auto"});
					};
				};
			}else{
				if(checkWpbar==0){
					$this.css({"top":"0px"});
				}else{
					$this.css({"top":"auto"});
				}
			};
		};
		
		actionHeaderFixedMenu();
		$(window).bind("scroll", function() { 	
			actionHeaderFixedMenu();
		});
	};
	/*Fixed menu*/
	
	/*Slider V4*/
	var autoplaytime=4000;
	function clickChangeImageV4() {
		$(".list-post-nav .fix-right .title-item").click(function(){
			if(window.innerWidth > 991) {
				clearInterval(mySliderRun);	
				changeImageSliderV4($(this));
				return false;
			};
		});
		
		$(".list-post-nav .table-fix").mouseenter(function(){
			clearInterval(mySliderRun);			
			$(".list-post-nav .fix-right .title-content").addClass("fix-reponsive");
			
			if(window.innerWidth > 991) {
				$.mCustomScrollbar.defaults.scrollButtons.enable=true;
				$(this).find(".overflow-fix").mCustomScrollbar({
					setTop:getTopCustombar+"px",
					theme:"dark-3"	
				});	
			}else{
				$(this).find(".overflow-fix").mCustomScrollbar("destroy");
			};		

		}).mouseleave(function(){
			$(this).find(".overflow-fix").mCustomScrollbar({setTop:getTopCustombar+"px"})
			$(this).find(".overflow-fix").mCustomScrollbar("destroy");
			
			fixMouseLeaverScroll=1;
			each_autoPlaySlider_V4();
				
			clearInterval(mySliderRun);	
			mySliderRun=setInterval(function(){each_autoPlaySlider_V4()}, autoplaytime);
		});
	};
	
	function LoadfirstImageV4() {
		if($(".list-post-nav .fix-right .title-item:first-child").length){
		    changeImageSliderV4($(".list-post-nav .fix-right .title-item:first-child"));
		};

	};
	
	var FixReadySliderImageLoad=[];
	
	function changeImageSliderV4(sElements) {		
		var $this=sElements;	
		var $thisPicChange=$(".list-post-nav .fix-left .picture");	
		var $thisLoadback=$(".list-post-nav .loading-background");
		var $thisLoading=$(".list-post-nav .loading-img");		
		
		$thisLoadback.addClass("active");
		$thisLoading.addClass("active");
		$thisPicChange.removeClass("animation");
			
		var dataImg=$this.attr("data-picture");
		var dataHTML=$this.find(".data-social-images").html();
		
		$(".list-post-nav .fix-right .title-item").removeClass("active");			
		$this.addClass("active");
		
		$this.attr("data-loading", "loading");
		
		$('<img src="'+ dataImg+'">').load(function(){			
			$this.attr("data-loading", "");
			
			if($this.hasClass("active")) {
				FixReadySliderImageLoad.push(sElements);
				$thisLoadback.removeClass("active");
				$thisLoading.removeClass("active");
							
				setTimeout(function(){
					$thisPicChange.html(dataHTML).addClass("animation");
				}, 150);
				
			};
						
		});
	};
	
	var getTopCustombar=0;
	var fixMouseLeaverScroll=0;
	function each_autoPlaySlider_V4() {

		var totalItem=$(".list-post-nav .fix-right .title-content .title-item").length;
				
		$(window).resize(function() {
			clearInterval(mySliderRun);
			$(".list-post-nav .fix-right .title-content").addClass("fix-reponsive");
			$(".list-post-nav .fix-right .title-content .title-item").removeClass("active")
			$(".list-post-nav .fix-right .title-content .title-item:first-child").addClass("active");
			mySliderRun=setInterval(function(){each_autoPlaySlider_V4()}, autoplaytime);
		});
		
		if(totalItem && window.innerWidth > 991) {			
			$(".list-post-nav .fix-right .title-content .title-item").each(function(index, element){
				var $this=$(this);
				var defaultHeight=$this.height();
				var defaultMarginBottom= parseInt( $this.css("margin-bottom").replace("px","") );
				var thisindexelement = index+1-fixMouseLeaverScroll;
				var $thisparrentMargintop=$this.parents(".title-content");
				var numberMargintop=((defaultHeight+defaultMarginBottom) * (thisindexelement));
				
				$thisparrentMargintop.removeClass("fix-reponsive");	
						
				var itemInPage=4;
				if(window.innerWidth < 1200) {
					itemInPage=3;
				};
				
				if($this.hasClass("active")) {
					$this.removeClass("active");
					
					var numberAction=(thisindexelement+1);
					var $elementAction= $(".list-post-nav .fix-right .title-content .title-item:nth-child("+(numberAction)+")");
					var $intAnimate= numberMargintop;
					
					if( (numberAction+fixMouseLeaverScroll-1) == totalItem) {
						if(fixMouseLeaverScroll==0) {							
							$elementAction=$(".list-post-nav .fix-right .title-content .title-item:first-child");						
							$intAnimate=0;
						};
					};

					if((thisindexelement)>(totalItem-itemInPage) ){ 
						if( (totalItem-thisindexelement+1)==itemInPage ) {
							$intAnimate=((defaultHeight+defaultMarginBottom) * (thisindexelement-1));							
						};
						if( (totalItem-thisindexelement)<itemInPage && (totalItem-thisindexelement) > 0) {
							var last_index_el=(itemInPage-(totalItem-thisindexelement));
							var last_bottom_padding=(defaultHeight+defaultMarginBottom);
							
							if( (itemInPage-last_index_el)==1 ){
								last_bottom_padding=(defaultHeight+15);
							}
							
							$intAnimate=((last_bottom_padding) * (thisindexelement - last_index_el ));
							
							
						};
					};
					
					$elementAction.addClass("active");
					
					$thisparrentMargintop.animate({"margin-top": -$intAnimate+"px"},700);

					if(fixMouseLeaverScroll==0) {					
						changeImageSliderV4($elementAction);					
					};
					
					getTopCustombar=$intAnimate;
					fixMouseLeaverScroll=0;
					
					return false;
				};

			});		
		}else{
			clearInterval(mySliderRun);
			$(".list-post-nav .fix-right .title-content").addClass("fix-reponsive");
			$(".list-post-nav .fix-right .title-content .title-item").removeClass("active")
			$(".list-post-nav .fix-right .title-content .title-item:first-child").addClass("active");
		};		
	};
	var mySliderRun;
	function autoPlaySlider_V4() {
		//if($(".list-post-nav .table-fix .picture animation").html()) {
			mySliderRun=setInterval(function(){each_autoPlaySlider_V4()}, autoplaytime);
			$(".list-post-nav .table-fix").mouseenter(function(){
				clearInterval(mySliderRun);	
			}).mouseleave(function(){				
				clearInterval(mySliderRun);	
				mySliderRun=setInterval(function(){each_autoPlaySlider_V4()}, autoplaytime);
			});
		//};
	};
	
	function createParallaxForSlider_V4() {
		$(".list-post-nav.is-parallax-v4").each(function(index, element){
			parallax_for_slider_V4($(this));
		});
	};		
	function parallax_for_slider_V4(strVal) {
		var $this=strVal;
		var maxHeight=parseInt($this.find(".row").css("max-height").replace("px",""));	
		var defaultPaddingTop=parseInt($this.parents(".slider").css("padding-top").replace("px",""));
		var scrollPos = $(window).scrollTop();
		var speed = 0.6;
		var OpacityPercent=(parseInt(maxHeight)+defaultPaddingTop-scrollPos)/parseInt(maxHeight+defaultPaddingTop);	
		var ParallaxForSliderTop=(scrollPos * speed);
		if(window.innerWidth<992) {
			OpacityPercent=1;	
			ParallaxForSliderTop=0;
		}
		
		$this.find(".table-fix").css({"opacity":OpacityPercent, "margin-top":(ParallaxForSliderTop)+"px"});
	};
	/*Slider V4*/
	
	function setFullWindowForSlider_post() {
		var $this=$(".cactus-single-page .col-md-12 .style-post.gallery-v1");
		
		$this.each(function(index, element) {
            var $this_e = $(this);
			$this_e.attr("style","");
		
			var defaultWidth= $this_e.width();
			var windowWidth= $(window).width();		
			
			if($this_e.parents(".version-6-table-right").length > 0) {
				windowWidth= $this_e.parents(".version-6-table-right").width();
				$this_e.addClass("full-width-v6");
			};
			
			var marginWidth= ( windowWidth - defaultWidth ) / 2 ;
			$this_e.css({"margin-left":"-"+marginWidth+"px", "margin-right":"-"+marginWidth+"px", });
        });

		function createParallaxSlider(){								
			scrollParallax_post();
			//Single OWlCarousel V1
			$(".cactus-slider-single").each(function(index, elements){
				if($(this).hasClass("is-post-fix-parallax")) {
					var dataAutoPlay=$(this).attr("data-auto-play");
					var dataPagination=parseInt($(this).attr("data-pagination"));
					var dataTransition=$(this).attr("data-transition");
					var isFullHeight=parseInt($(this).attr("data-full-height"));
					
					if(!dataTransition) {dataTransition="fade"};
					
					$(this).owlCarousel({
						transitionStyle: dataTransition,
						singleItem:true,
						autoHeight: false,
						autoPlay: dataAutoPlay!=''?dataAutoPlay:false,
						navigation: true,
						navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
						addClassActive : true,
						pagination: dataPagination===1?true:false,
						stopOnHover:true,
						afterMove:textEffectSliderV1,
					});
				};			
			});//Single OWlCarousel V1
		};
		
		function scrollParallax_post(){
			$(".slider-item.is-parallax").each(function(index, element){
				if($(this).hasClass("is-post-fix-parallax")) {
					parallax_for_slider($(this));
				};
			});
		};
		
		createParallaxSlider();
		$(window).bind("scroll", function() { requestAnimationFrame(scrollParallax_post); });//Parallax Function For Slider	
		
		$(window).resize(function() {
			createParallaxSlider();				
		});
		
		/*Fix margin top sidebar*/
	};
	
	function setFullWindowForSlider() {
		var visibleItem=3;
		var durationTime=1000;
		var paddingVisibleItem=15;
		var windowWidth= $(window).width();	
		var strDirection="left";
		
		var $this=$(".cactus-single-page .col-md-12 .sc-slider-post");
		
		$this.each(function(index, element) {
			var $this_e = $(this);
			
			if($this_e.parents(".version-6-table-right").length > 0) {
				windowWidth= $this_e.parents(".version-6-table-right").width() - paddingVisibleItem * 2;
				$this_e.addClass("full-width-v6");
			};
			
            $this_e.attr("style","");			
			var defaultWidth= $this_e.width();				
			
			var marginWidth= ( windowWidth - defaultWidth ) / 2 + (paddingVisibleItem);
			$this_e.css({"margin-left":"-"+marginWidth+"px", "margin-right":"-"+marginWidth+"px", });	
			
			setupSlider($this_e, visibleItem, strDirection);
			
        });
		
		function checkItemsListing(currentChange, curentPosition){
			currentChange.parents(".sc-slider-post").find(".currentPage").text((curentPosition+1)+'/'+currentChange.find(".slider-item").length);
		};
		
		function setupSlider(strEle, visibleItem, strDirection) {
			setTimeout(function(){		
				strEle.find(".currentPage").text('1/'+strEle.find(".cactus-silder-multi-post .slider-item").length);
				
				if(strEle.find(".currentPage").length) {
					strEle.addClass("active-cal");
				}else{
					strEle.removeClass("active-cal");
				};	
				
				var __configSlider = strEle.find(".cactus-silder-multi-post");
				
				var dataAutoPlay= __configSlider.attr("data-auto-play");	
				var dataAutoHeight= __configSlider.attr("data-auto-height");
				var dataID= __configSlider.attr("data-id");
				var __configHeight=550;
				
				if(dataAutoHeight!=''&&dataAutoHeight!=null) {
					__configSlider.removeClass("default");
					if(window.innerWidth<=767){
						__configHeight='auto';
						$("img", __configSlider).css({"height":"auto", "width":(window.innerWidth)+"px"});
						visibleItem=1;
						durationTime=500;
					}					
					else if(window.innerWidth>767 && window.innerWidth<=1200) {
						__configHeight=(parseInt(dataAutoHeight)*0.72);
						$("img", __configSlider).css({"height":(parseInt(dataAutoHeight)*0.72)+"px", "width":"auto"});
						visibleItem=3;
						durationTime=1000;
					}else if(window.innerWidth<=1366 && window.innerWidth>1200) {
						__configHeight=(parseInt(dataAutoHeight)*0.87);
						$("img", __configSlider).css({"height":(parseInt(dataAutoHeight)*0.87)+"px", "width":"auto"});
						visibleItem=3;
						durationTime=1000;
					} else {
						__configHeight=parseInt(dataAutoHeight);
						$("img", __configSlider).css({"height":dataAutoHeight+"px", "width":"auto"});
						visibleItem=3;
						durationTime=1000;
					};
					
				}else{
					if(window.innerWidth<=767){
						__configSlider.removeClass("default");
						__configHeight='auto';
						$("img", __configSlider).css({"height":"auto", "width":(window.innerWidth)+"px"});						
						visibleItem=1;
						durationTime=500;
					}else{	
						__configSlider.addClass("default");
						__configHeight=550;	
						$("img", __configSlider).css({"height":(__configHeight)+"px", "width":"auto"});						
						visibleItem=3;
						durationTime=1000;
					};
				};
				
					__configSlider.carouFredSel({
						width				:'100%',
						height				:(__configHeight==550 || __configHeight=='auto')?'variable':__configHeight,
						items				:{
							visible			:visibleItem,
							width			:'variable',
						},
						direction           :strDirection,
						scroll : {
							items 			:1,
							easing			:'quadratic',
							pauseOnHover	:true,
							duration		:durationTime,
							onAfter			:function(data){checkItemsListing($(this),$(this).triggerHandler("currentPosition"));}	,
						},
						/*auto: {
							play			:dataAutoPlay!=''&&dataAutoPlay!=null ? true : false,
							timeoutDuration	:dataAutoPlay!=''&&dataAutoPlay!=null ? parseInt(dataAutoPlay)-1000 : (4000)-1000,
						},*/ 
						auto:	{
							play:false,
						},
						swipe: {
							onTouch			:true,
							onMouse			:true,
						},
						prev				:'.sc-slider-post .prev.c-'+dataID,
						next				:'.sc-slider-post .next.c-'+dataID,
						align				:'left',	
						  
					});	
					
					var totalItemSlide = strEle.find(".cactus-silder-multi-post .slider-item").length;
					
					if(totalItemSlide <= visibleItem) {
						if((visibleItem-totalItemSlide)==0) {
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:first-child").html()+'</div>', '2']);
						};
						if((visibleItem-totalItemSlide)==1) {
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:first-child").html()+'</div>', 'end']);
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:nth-child(2)").html()+'</div>', 'end']);
						};
						if((visibleItem-totalItemSlide)==2) {
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:first-child").html()+'</div>', 'end']);	
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:first-child").html()+'</div>', 'end']);
							__configSlider.trigger('insertItem', ['<div class="slider-item">'+strEle.find(".cactus-silder-multi-post .slider-item:first-child").html()+'</div>', 'end']);						
						};
						strEle.find(".currentPage").text('1/4');
					};
					
					__configSlider.imagesLoaded().always(function( instance ){
						__configSlider.trigger("finish").trigger("configuration", {
							auto: {
								play			:dataAutoPlay!=''&&dataAutoPlay!=null ? true : false,
								timeoutDuration	:dataAutoPlay!=''&&dataAutoPlay!=null ? parseInt(dataAutoPlay)-1000 : (4000)-1000,
							}
						});
					});
					
			},400);
		};
	};
	
	function lightVideo() {
		$(".cactus-light").click(function(){
			if(!$(this).hasClass("active")) {
				$(".navbar-default").animate({opacity:0},200).css("z-index","1").delay(300).animate({opacity:1},0);
				$(".fixed-video-background").addClass("active");
				$(this).addClass("active");
				$("#cactus-body-container").css("z-index","9");
			}else{
				$(".navbar-default").animate({opacity:1},200).css("z-index","9999");
				$(".fixed-video-background").removeClass("active");
				$(this).removeClass("active");
				$("#cactus-body-container").css("z-index","1");		
						
			};
		});
	};
	
	function syncedOwlCarouselPost() {
		
		$(".cactus-gallery-v2-content").each(function(index, element) {
			var $this=$(this);
			
        	var sync1 = $this.find(".sync1");
			var sync2 = $this.find(".sync2");
			
			sync1.owlCarousel({
				transitionStyle: "fade",
				singleItem : true,
				slideSpeed : 1000,
				navigation: false,
				pagination:false,
				afterAction : syncPosition,
				responsiveRefreshRate : 200,
				autoHeight:true,
				autoPlay:5000,
			});
			
			sync2.owlCarousel({
				items : 9999,
				slideSpeed : 1000,
				itemsDesktop : false,
				itemsDesktopSmall : false,
				itemsTablet: false,
				itemsTabletSmall: false,
				itemsMobile : false,
				pagination:false,
				responsiveRefreshRate : 100,
				afterInit : function(el){
					el.find(".owl-item").eq(0).addClass("synced");
				}
			});
			
			function syncPosition(el){
				var current = this.currentItem;
				sync2
				.find(".owl-item")
				.removeClass("synced")
				.eq(current)
				.addClass("synced")
				if(sync2.data("owlCarousel") !== undefined){
					center(current)
				};
			};
			
			sync2.on("click", ".owl-item", function(e){
				e.preventDefault();
				var number = $(this).data("owlItem");
				sync1.trigger("owl.goTo",number);
			});
			
			function center(number){
				var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
				var num = number;
				var found = false;
				
				for(var i in sync2visible){
					if(num === sync2visible[i]){
						var found = true;
					}
				};
			
				if(found===false){
					if(num>sync2visible[sync2visible.length-1]){
						sync2.trigger("owl.goTo", num - sync2visible.length+2)
					}
					else{
						if(num - 1 === -1){
							num = 0;
						}
						sync2.trigger("owl.goTo", num);
					}
				} 
				else if(num === sync2visible[sync2visible.length-1]){	sync2.trigger("owl.goTo", sync2visible[1])} 
				else if(num === sync2visible[0]){	sync2.trigger("owl.goTo", num-1) 
				}					
			}; 
        });
	};
	
	function addPlaceholderCm(){
		$("#commentform #author").attr("placeholder", "YOUR NAME (required)");
		$("#commentform #email").attr("placeholder", "EMAIL (required)");
		$("#commentform #url").attr("placeholder", "WEBSITE");
		$("#commentform #comment").attr("placeholder", "COMMENT");
	};
	
	$(document).ready(function() { //Ready Function	
		//ToolTip
		$('[data-toggle="tooltip"]').tooltip();		
		
		/*Top*/
		$('.button-to-top').click(function(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});	
		
		$(window).scroll(function(){
			if($(window).scrollTop() > (window.innerHeight)) {
				$('.button-to-top').addClass('active');
			}else{
				$('.button-to-top').removeClass('active');
			};
		});
		
		$('.next-to-comments').click(function(){
			$("html, body").animate({ scrollTop: $("#comments").offset().top }, 1200);
			return false;
		});	
		
		/*Open Search Box*/
		$(".cactus-form-header .button-search-top").click(function(){
			$(".cactus-form-header .search-header-top, .cactus-form-header .input-search, .cactus-form-header .button-search-top").removeClass("active-true");
			setTimeout(function(){$(".cactus-form-header .input-search").blur();},200);		
			return false;
		});
		$("header .search").click(function(){
			$(".cactus-form-header .search-header-top, .cactus-form-header .input-search, .cactus-form-header .button-search-top").addClass("active-true");
			setTimeout(function(){$(".cactus-form-header .input-search").focus();},200);
			return false;
		});
		
		/*Open mini Search Box*/
		$("#off-canvas .button-search-mobile").click(function(){
			$("#off-canvas .cactus-form-mobile").removeClass("active-true");
			setTimeout(function(){$("#off-canvas .cactus-form-mobile .input-search").blur();},200);
			return false;
		});
		
		$("#off-canvas .open-mini-search-box").click(function(){
			$("#off-canvas .cactus-form-mobile").addClass("active-true");
			setTimeout(function(){$("#off-canvas .cactus-form-mobile .input-search").focus();},200);
			return false;
		});
		
		$(".container-version-6 .button-search-mobile").click(function(){
			$(".container-version-6 .cactus-form-mobile").removeClass("active-true");
			setTimeout(function(){$(".container-version-6 .cactus-form-mobile .input-search").blur();},200);
			return false;
		});
		
		$(".container-version-6 .open-mini-search-box").click(function(){
			$(".container-version-6 .cactus-form-mobile").addClass("active-true");
			setTimeout(function(){$(".container-version-6 .cactus-form-mobile .input-search").focus();},200);
			return false;
		});
		
		/*Open menu mobile*/
		$("#open-menu-moblie").click(function(){
			$("#off-canvas").addClass("open-true");
			$("#wrap").addClass("open-true");
			$(".canvas-ovelay").addClass("open-true");
		});
		
		/*Close menu mobile*/
		$("#off-canvas .close-button-1, .canvas-ovelay").click(function(){
			$("#off-canvas").removeClass("open-true");
			$("#wrap").removeClass("open-true");
			$(".canvas-ovelay").removeClass("open-true");
		});	
		$(window).resize(function(){
			if(window.innerWidth > 991) {
				$("#off-canvas").removeClass("open-true");
				$("#wrap").removeClass("open-true");
				$(".canvas-ovelay").removeClass("open-true");
			};
		});	
		/*Close menu mobile*/
		
		/*Fixed menu*/		
		addFixedEffect();
		addHeaderFixedMenu();
		/*Fixed menu*/
		
		/*V2 - Parralax Text*/
		createParallaxForText();
		$(window).bind("scroll", function() { requestAnimationFrame(createParallaxForText); });//Parallax Function For Slider
		/*V2 - Parralax Text*/
		
		/*V4 - Parralax Slider*/
		createParallaxForSlider_V4();
		$(window).bind("scroll", function() { requestAnimationFrame(createParallaxForSlider_V4); });//Parallax Function For Slider
		
		LoadfirstImageV4();
		clickChangeImageV4();
		autoPlaySlider_V4();
		/*V4 - Parralax Slider*/
		
		/*V3 - V5 Slider*/
		$(".cactus-silder-multi").each(function(){
			var dataAutoPlay=$(this).attr("data-auto-play");
			var dataPagination=parseInt($(this).attr("data-pagination"));
			var dataAutoHeight=$(this).attr("data-auto-height");
			
			if( $(this).find(".slider-item").length > 0 ) {
				$(this).owlCarousel({
					items : 3,
					itemsDesktop : [1199,3],
					itemsDesktopSmall : [980,2],
					itemsTablet: [768,1],
					itemsTabletSmall: false,
					itemsMobile : [479,1],
					singleItem:false,
					autoHeight: dataAutoHeight=='0'?false:true,
					autoPlay: dataAutoPlay!=''?dataAutoPlay:false,
					navigation: true,
					navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
					addClassActive : true,
					pagination: dataPagination===1?true:false,
					stopOnHover:true,
					rewindNav:false,
					slideSpeed : 1200,
				});
			};
		});
		/*V3 - V5 Slider*/
		
		setFullWindowForSlider();
		
		/*masonry*/
		createMasonry();
		createMasonry_filter();
		/*masonry*/	
		
		/*Standard Video*/
		lightVideo();
		
		openCloseShareListing();
		
		setFullWindowForSlider_post();
		
		syncedOwlCarouselPost();
		
		addPlaceholderCm();
		
		$("#cancel-comment-reply-link").click(function(){addPlaceholderCm(); $("#comments").removeClass("fix-reply") });
		$(".comment-reply-link").click(function(){ $("#comments").addClass("fix-reply") });
		
		openWidgetMenu();	

		setTimeout(function(){createCarouselPostList($('.is-slider-post-list'));},600);		
		
		$('.list-content .list-item').each(function(index, element) {
            if($(this).attr('id')!='' && $(this).attr('id')!=null && typeof($(this).attr('id'))!='undefined' && $(this).attr('data-cactus-color')!='' && $(this).attr('data-cactus-color')!=null && typeof($(this).attr('data-cactus-color'))!='undefined') {
				$('<style>#'+$(this).attr('id')+' .fix-color-modern.background-color-1 {background-color:'+$(this).attr('data-cactus-color')+';}</style>').appendTo('head');
			};
        });
		
		if($('.container-version-6 .version-6-row .version-6-table-left .menu-container').length > 0) {
			$('.container-version-6 .version-6-row .version-6-table-left .menu-container').mCustomScrollbar({
				theme:"minimal",
			});	
		};
		
		
		var totalLengthItemIMGColumn = ($('.sc-images-list .img-content .img-item > a').length - 1);
		$('.sc-images-list .img-content .img-item > a').each(function(index, element) {
			var $this=$(this);
            $this.click(function(){
				
				var $this_item=$(this);
				
				function addImageToBody(index, elm) {
					if($('#light-box-img-c'+index).length==0 && index <= totalLengthItemIMGColumn){
						$('<div id="light-box-img-c'+index+'" class="cactus-ele-img-column">  <div><img src="'+ elm.find('img').attr('src') +'"><span><i class="fa fa-times"></i></span></div> <div class="btn-prev"><i class="fa fa-chevron-left"></i></div><div class="btn-next"><i class="fa fa-chevron-right"></i></div> </div>').appendTo('body');							
					};
					
					$('#light-box-img-c'+index).css('padding-top', ((window.innerHeight - $('#light-box-img-c'+index+'>div').height())/2)+'px')
					$('#light-box-img-c'+index).addClass('active');					
					$('#light-box-img-c'+index+' > div > span').click(function(){
						$('#light-box-img-c'+index).removeClass('active');
					});
					
					$('.btn-prev', '#light-box-img-c'+index).click(function(){
						$('[id^="light-box-img-c"]').removeClass('active');
						if(index <= 0) {																		
							addImageToBody(totalLengthItemIMGColumn, $('.sc-images-list .img-content .img-item > a').eq(totalLengthItemIMGColumn));
						}else{
							addImageToBody((index-1), $('.sc-images-list .img-content .img-item > a').eq(index-1));	
						};
					});
					
					$('.btn-next', '#light-box-img-c'+index).click(function(){
						$('[id^="light-box-img-c"]').removeClass('active');
						if(index >= totalLengthItemIMGColumn) {																		
							addImageToBody(0, $('.sc-images-list .img-content .img-item > a').eq(0));	
						}else{
							addImageToBody((index+1), $('.sc-images-list .img-content .img-item > a').eq(index+1));	
						};
						
					});
					
				};
				
				addImageToBody(index, $this_item );
				
				$(window).resize(function(){
					$('.cactus-ele-img-column.active').css('padding-top', ((window.innerHeight - $('.cactus-ele-img-column.active>div').height())/2)+'px')
				});
				
				return false;
			});
        });
		
	}); //End Ready Function	
}(jQuery));