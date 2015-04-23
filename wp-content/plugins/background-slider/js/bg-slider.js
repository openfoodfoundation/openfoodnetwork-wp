var checkConvertfirst=1;
var __minPaddingTop=0;
var _minPaddingTop=0;
var checkLoadingfrist=1;
function parallax_for_slider(strVal) {
	(function($){	
		var $this=strVal;			
		var dataIMG=$this.attr("data-bg-img");
		var isFullHeight=parseInt($this.parents( "div.cactus-slider-single" ).attr("data-full-height"));
		var maxWindowHeight=parseInt($(window).height());		
		var dataHeight=maxWindowHeight;
		if(isFullHeight==1) {
			dataHeight=maxWindowHeight;
		}else{
			dataHeight=parseInt($this.attr("data-div-height"));
		};		
		var intMarginTop=$this.find(".text-content").height()/2 ;		
		$this.css({"max-height": (dataHeight), "min-height": (dataHeight)});		
		var strDefaultTop=$this.find(".text-content").attr("data-margin-top");		
		if(strDefaultTop!='' && strDefaultTop!=null){	
			$this.find(".text-content").css({"top":strDefaultTop});
		}else{
			$this.find(".text-content").css({"top":(dataHeight/2-intMarginTop)+"px"});
		};	
		$('<img src="'+dataIMG+'">').load(function(){
			$this.css({"background-image":"url("+dataIMG+")"});
			$this.find(".loading-img").css({"visibility":"hidden", "opacity":"0"});
			$this.find(".text-content").addClass("translate-fix");			
			
			if(checkLoadingfrist==1 && !$.browser.msie && !check_Safari_Bro()) {
				if($(window).scrollTop() <= $this.offset().top) {
					$this.find(".text-content").css({"opacity":OpacityPercent}).transition({ y: 0 },0);
				}else{	
					$this.find(".text-content").css({"opacity":OpacityPercent}).transition({ y: (scrollPos * speed) },0);			
				};		
			};			
			checkLoadingfrist=2;
		});
		var scrollPos = $(window).scrollTop() - $this.offset().top;
		speed = 0.6;		
		var dataBackgroundSingle=$this.attr("data-background-single");		
		var OpacityPercent=(parseInt(dataHeight)-scrollPos)/parseInt(dataHeight);		
		if(window.innerWidth > 1199) {			
			if(!$.browser.msie && !check_Safari_Bro()) {
				if(window.innerWidth <= 1600) {
					if(!dataBackgroundSingle) {
						if(window.innerWidth <= 1600 && window.innerWidth > 1366) {
							$this.css({"background-position":"50% "+((scrollPos * (speed / 1.2)))+"px", "background-size":"125% auto"});
						}else if(window.innerWidth <= 1366 && window.innerWidth > 1200){
							$this.css({"background-position":"50% "+((scrollPos * (speed / 1.5)))+"px", "background-size":"135% auto"});
						}else if(window.innerWidth <= 1200) {
							$this.css({"background-position":"50% "+((scrollPos * (speed / 1.8)))+"px", "background-size":"145% auto"});
						};
					}else{
						$this.css({"background-position":"50% "+ (-(scrollPos * (speed / 2))) +"px", "background-attachment":"fixed", "background-size":"cover"});
					};
				}else{				
					if(!dataBackgroundSingle) {
						$this.css({"background-position":"50% "+(scrollPos * speed)+"px", "background-size":"cover"});
					}else{
						$this.css({"background-position":"50% "+ (-(scrollPos * (speed / 2))) +"px", "background-attachment":"fixed", "background-size":"cover"});
					};
				};
				if($(window).scrollTop() <= $this.offset().top) {
					$this.find(".text-content.translate-fix").css({"opacity":OpacityPercent}).transition({ y: 0 },0);
				}else{	
					$this.find(".text-content.translate-fix").css({"opacity":OpacityPercent}).transition({ y: (scrollPos * speed) },0);			
				};
			}else{ 
				if(!$($this).hasClass("is-post-fix-parallax") && $this.parents(".cactus-wraper-slider-bg").offset().top == 0) {
					var minHeightNavDefault=parseInt($this.parents(".cactus-wraper-slider-bg").find(".cactus-slider-single").css("padding-top").replace("px",""));
					$this.parents(".cactus-wraper-slider-bg").css({"max-height": (dataHeight+minHeightNavDefault), "min-height": (dataHeight+minHeightNavDefault)});
					$this.parents(".cactus-slider-single").css({"position":"fixed"});
					if($this.parents("#header-navigation").find(".navbar-default").length > 0 && minHeightNavDefault > 0) {
						if($this.parents("#header-navigation").find(".navbar-default").hasClass("fixed-menu")) {
							$this.parents(".cactus-slider-single").css({"padding-top":"50px"})							
						}else{
							$this.parents(".cactus-slider-single").css({"padding-top":"100px"});
						};
					};					
					scrollPos = $(window).scrollTop() - $this.parents(".cactus-wraper-slider-bg").offset().top;
					OpacityPercent=(parseInt(dataHeight)-scrollPos)/parseInt(dataHeight);					
					$this.css({"background-position":"50% "+ (-(scrollPos * (speed / 3.5))) +"px", "background-size":"cover"});
					$this.find(".text-content.translate-fix").css({"opacity":OpacityPercent}).transition({ y: (-(scrollPos * (speed / 4.5))) },0);					
				};										
			};						
		}else{
			if(window.innerWidth > 768) {
				$this.css({"max-height": (600), "min-height": (600)});
				$this.find(".text-content").css({"top":(300-intMarginTop)+"px"});
			}else{
				$this.css({"max-height": (480), "min-height": (480)});
				$this.find(".text-content").css({"top":(240-intMarginTop)+"px"});
			};
			$this.find(".text-content.translate-fix").css({"opacity":"1"}).transition({ y: 0 },0);
			$this.css({"background-position":"50% 50%", "background-size":"cover", "background-attachment":"scroll"});
			if($.browser.msie || check_Safari_Bro()) {
				$this.parents(".cactus-wraper-slider-bg").css({"max-height": "", "min-height": ""});
				$this.parents(".cactus-slider-single").css({"position":"", "padding-top":""});
			};
		};
	}(jQuery));		
};

function parallax_for_slider_frontPage(strVal) {
	(function($){	
		var $this=strVal;			
		var dataIMG=$this.attr("data-bg-img");
		var isFullHeight=parseInt($this.parents( "div.cactus-slider-single" ).attr("data-full-height"));
		var maxWindowHeight=parseInt($(window).height());		
		var dataHeight=maxWindowHeight;
		if(isFullHeight==1) {
			dataHeight=maxWindowHeight;
		}else{
			dataHeight=parseInt($this.attr("data-div-height"));
		};
		
		if(window.innerWidth > 1199) {
			dataHeight=dataHeight+$("#wpadminbar").height();
		}
		else if(window.innerWidth > 768) {
			dataHeight=600;
		}else{
			dataHeight=480;
		};
				
		var intMarginTop=$this.find(".text-content").height()/2 ;		
		//$this.css({"max-height": (dataHeight), "min-height": (dataHeight)});		
		var strDefaultTop=$this.find(".text-content").attr("data-margin-top");		
		if(strDefaultTop!='' && strDefaultTop!=null){	
			$this.find(".text-content").css({"top":strDefaultTop});
		}else{
			$this.find(".text-content").css({"top":(dataHeight/2-intMarginTop)+"px"});
		};	
		$('<img src="'+dataIMG+'">').load(function(){
			$this.css({"background-image":"url("+dataIMG+")"});
			$this.find(".loading-img").css({"visibility":"hidden", "opacity":"0"});
			$this.find(".text-content").addClass("translate-fix");			
			
			if(checkLoadingfrist==1) {					
				$this.find(".text-content").css({"opacity":OpacityPercent});	
			};			
			checkLoadingfrist=2;
		});
		var scrollPos = $(window).scrollTop() - $this.parents('#top-background-slider-0').offset().top;
		speed = 0.6;		
		var dataBackgroundSingle=$this.attr("data-background-single");		
		var OpacityPercent=(parseInt(dataHeight)-scrollPos)/parseInt(dataHeight);		
		
		if(window.innerWidth > 1199) {
			if(($this.parents('#top-background-slider-0').offset().top + $this.parents('#top-background-slider-0').height()) >  $(window).scrollTop()) {
				$this.find(".text-content.translate-fix").css({"opacity":OpacityPercent});
				$this.parents(".cactus-wraper-slider-bg").transition({ y: (-(scrollPos * (speed / 2.15))) },0);
			};
		}else{
			$this.find(".text-content.translate-fix").css({"opacity":"1"});
			$this.parents(".cactus-wraper-slider-bg").transition({ y: 0 },0);
		};			

	}(jQuery));		
};

function check_Safari_Bro() {
	var checkSafariBrowser=false;
	var ua = navigator.userAgent.toLowerCase(); 
	if (ua.indexOf('safari') != -1) { 
		if (ua.indexOf('chrome') > -1) {
			//chrome
		} else {
			checkSafariBrowser=true;
		};
	};
	return checkSafariBrowser;
};
function scrollParallax(){
	(function($){	
		$(".slider-item.is-parallax").each(function(index, element){
			var $this_item = $(this);
			if(!$this_item.hasClass("is-post-fix-parallax") && $this_item.parents('#top-background-slider-0').length>0) {
				parallax_for_slider_frontPage($this_item);
			}else{
				parallax_for_slider($this_item);
			};
		});
	}(jQuery));		
};
function textEffectSliderV1(){
	(function($){
		$(".cactus-slider-single").find(".slider-item.is-parallax").find(".text-content").removeClass("translate-fix").removeClass("transition-fix");
		$(".cactus-slider-single").find(".owl-item.active").find(".slider-item.is-parallax").each(function(index, element){	
			if(!$(this).hasClass("is-post-fix-parallax") && $(this).parents('#top-background-slider-0').length>0) {
				parallax_for_slider_frontPage($(this));
			}else{
				parallax_for_slider($(this));				
			};
		});	
	}(jQuery));			
};
function createParallaxSlider(){
	(function($){		
		scrollParallax();
		$(".cactus-slider-single").each(function(index, elements){
			if(!$(this).hasClass("is-post-fix-parallax")) {
				var dataAutoPlay=$(this).attr("data-auto-play");
				var dataPagination=parseInt($(this).attr("data-pagination"));
				var dataTransition=$(this).attr("data-transition");
				var isFullHeight=parseInt($(this).attr("data-full-height"));				
				if(!dataTransition) {dataTransition="fade"};				
				$(this).owlCarousel({
					transitionStyle: dataTransition,
					singleItem:true,
					autoHeight: false,
					autoPlay: dataAutoPlay!=0 ?dataAutoPlay:false,
					navigation: true,
					navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
					addClassActive : true,
					pagination: dataPagination===1?true:false,
					stopOnHover:true,
					afterMove:textEffectSliderV1,
				});
			};			
		});
		checkConvertfirst=0;
	}(jQuery));	
};
window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame || function(f){setTimeout(f, 1000/10)};
//SmoothScroll for websites v1.2.1
function smoothScroll(){
(function(){function c(){var e=false;if(e){N("keydown",y)}if(t.keyboardSupport&&!e){T("keydown",y)}}function h(){if(!document.body)return;var e=document.body;var i=document.documentElement;var a=window.innerHeight;var f=e.scrollHeight;o=document.compatMode.indexOf("CSS")>=0?i:e;u=e;c();s=true;if(top!=self){r=true}else if(f>a&&(e.offsetHeight<=a||i.offsetHeight<=a)){var l=false;var h=function(){if(!l&&i.scrollHeight!=document.height){l=true;setTimeout(function(){i.style.height=document.height+"px";l=false},500)}};i.style.height="auto";setTimeout(h,10);if(o.offsetHeight<=a){var p=document.createElement("div");p.style.clear="both";e.appendChild(p)}}if(!t.fixedBackground&&!n){e.style.backgroundAttachment="scroll";i.style.backgroundAttachment="scroll"}}function m(e,n,r,i){i||(i=1e3);k(n,r);if(t.accelerationMax!=1){var s=+(new Date);var o=s-v;if(o<t.accelerationDelta){var u=(1+30/o)/2;if(u>1){u=Math.min(u,t.accelerationMax);n*=u;r*=u}}v=+(new Date)}p.push({x:n,y:r,lastX:n<0?.99:-.99,lastY:r<0?.99:-.99,start:+(new Date)});if(d){return}var a=e===document.body;var f=function(s){var o=+(new Date);var u=0;var l=0;for(var c=0;c<p.length;c++){var h=p[c];var v=o-h.start;var m=v>=t.animationTime;var g=m?1:v/t.animationTime;if(t.pulseAlgorithm){g=D(g)}var y=h.x*g-h.lastX>>0;var b=h.y*g-h.lastY>>0;u+=y;l+=b;h.lastX+=y;h.lastY+=b;if(m){p.splice(c,1);c--}}if(a){window.scrollBy(u,l)}else{if(u)e.scrollLeft+=u;if(l)e.scrollTop+=l}if(!n&&!r){p=[]}if(p.length){M(f,e,i/t.frameRate+1)}else{d=false}};M(f,e,0);d=true}function g(e){if(!s){h()}var n=e.target;var r=x(n);if(!r||e.defaultPrevented||C(u,"embed")||C(n,"embed")&&/\.pdf/i.test(n.src)){return true}var i=e.wheelDeltaX||0;var o=e.wheelDeltaY||0;if(!i&&!o){o=e.wheelDelta||0}if(!t.touchpadSupport&&A(o)){return true}if(Math.abs(i)>1.2){i*=t.stepSize/120}if(Math.abs(o)>1.2){o*=t.stepSize/120}m(r,-i,-o);e.preventDefault()}function y(e){var n=e.target;var r=e.ctrlKey||e.altKey||e.metaKey||e.shiftKey&&e.keyCode!==l.spacebar;if(/input|textarea|select|embed/i.test(n.nodeName)||n.isContentEditable||e.defaultPrevented||r){return true}if(C(n,"button")&&e.keyCode===l.spacebar){return true}var i,s=0,o=0;var a=x(u);var f=a.clientHeight;if(a==document.body){f=window.innerHeight}switch(e.keyCode){case l.up:o=-t.arrowScroll;break;case l.down:o=t.arrowScroll;break;case l.spacebar:i=e.shiftKey?1:-1;o=-i*f*.9;break;case l.pageup:o=-f*.9;break;case l.pagedown:o=f*.9;break;case l.home:o=-a.scrollTop;break;case l.end:var c=a.scrollHeight-a.scrollTop-f;o=c>0?c+10:0;break;case l.left:s=-t.arrowScroll;break;case l.right:s=t.arrowScroll;break;default:return true}m(a,s,o);e.preventDefault()}function b(e){u=e.target}function S(e,t){for(var n=e.length;n--;)w[E(e[n])]=t;return t}function x(e){var t=[];var n=o.scrollHeight;do{var i=w[E(e)];if(i){return S(t,i)}t.push(e);if(n===e.scrollHeight){if(!r||o.clientHeight+10<n){return S(t,document.body)}}else if(e.clientHeight+10<e.scrollHeight){overflow=getComputedStyle(e,"").getPropertyValue("overflow-y");if(overflow==="scroll"||overflow==="auto"){return S(t,e)}}}while(e=e.parentNode)}function T(e,t,n){window.addEventListener(e,t,n||false)}function N(e,t,n){window.removeEventListener(e,t,n||false)}function C(e,t){return(e.nodeName||"").toLowerCase()===t.toLowerCase()}function k(e,t){e=e>0?1:-1;t=t>0?1:-1;if(i.x!==e||i.y!==t){i.x=e;i.y=t;p=[];v=0}}function A(e){if(!e)return;e=Math.abs(e);f.push(e);f.shift();clearTimeout(L);var t=O(f[0],120)&&O(f[1],120)&&O(f[2],120);return!t}function O(e,t){return Math.floor(e/t)==e/t}function _(e){var n,r,i;e=e*t.pulseScale;if(e<1){n=e-(1-Math.exp(-e))}else{r=Math.exp(-1);e-=1;i=1-Math.exp(-e);n=r+i*(1-r)}return n*t.pulseNormalize}function D(e){if(e>=1)return 1;if(e<=0)return 0;if(t.pulseNormalize==1){t.pulseNormalize/=_(1)}return _(e)}var e={frameRate:150,animationTime:400,stepSize:120,pulseAlgorithm:true,pulseScale:8,pulseNormalize:1,accelerationDelta:20,accelerationMax:1,keyboardSupport:true,arrowScroll:50,touchpadSupport:true,fixedBackground:true,excluded:""};var t=e;var n=false;var r=false;var i={x:0,y:0};var s=false;var o=document.documentElement;var u;var a;var f=[120,120,120];var l={left:37,up:38,right:39,down:40,spacebar:32,pageup:33,pagedown:34,end:35,home:36};var t=e;var p=[];var d=false;var v=+(new Date);var w={};setInterval(function(){w={}},10*1e3);var E=function(){var e=0;return function(t){return t.uniqueID||(t.uniqueID=e++)}}();var L;var M=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(e,t,n){window.setTimeout(e,n||1e3/60)}}();var P=/chrome/i.test(window.navigator.userAgent);var H=null;if("onwheel"in document.createElement("div"))H="wheel";else if("onmousewheel"in document.createElement("div"))H="mousewheel";if(H&&P){T(H,g);T("mousedown",b);T("load",h)}})()
};
/*jQuery Transit*/
(function(t,e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else if(typeof exports==="object"){module.exports=e(require("jquery"))}else{e(t.jQuery)}})(this,function(t){t.transit={version:"0.9.12",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:true,useTransitionEnd:false};var e=document.createElement("div");var n={};function i(t){if(t in e.style)return t;var n=["Moz","Webkit","O","ms"];var i=t.charAt(0).toUpperCase()+t.substr(1);for(var r=0;r<n.length;++r){var s=n[r]+i;if(s in e.style){return s}}}function r(){e.style[n.transform]="";e.style[n.transform]="rotateY(90deg)";return e.style[n.transform]!==""}var s=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;n.transition=i("transition");n.transitionDelay=i("transitionDelay");n.transform=i("transform");n.transformOrigin=i("transformOrigin");n.filter=i("Filter");n.transform3d=r();var a={transition:"transitionend",MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"};var o=n.transitionEnd=a[n.transition]||null;for(var u in n){if(n.hasOwnProperty(u)&&typeof t.support[u]==="undefined"){t.support[u]=n[u]}}e=null;t.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeInCubic:"cubic-bezier(.550,.055,.675,.190)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};t.cssHooks["transit:transform"]={get:function(e){return t(e).data("transform")||new f},set:function(e,i){var r=i;if(!(r instanceof f)){r=new f(r)}if(n.transform==="WebkitTransform"&&!s){e.style[n.transform]=r.toString(true)}else{e.style[n.transform]=r.toString()}t(e).data("transform",r)}};t.cssHooks.transform={set:t.cssHooks["transit:transform"].set};t.cssHooks.filter={get:function(t){return t.style[n.filter]},set:function(t,e){t.style[n.filter]=e}};if(t.fn.jquery<"1.8"){t.cssHooks.transformOrigin={get:function(t){return t.style[n.transformOrigin]},set:function(t,e){t.style[n.transformOrigin]=e}};t.cssHooks.transition={get:function(t){return t.style[n.transition]},set:function(t,e){t.style[n.transition]=e}}}p("scale");p("scaleX");p("scaleY");p("translate");p("rotate");p("rotateX");p("rotateY");p("rotate3d");p("perspective");p("skewX");p("skewY");p("x",true);p("y",true);function f(t){if(typeof t==="string"){this.parse(t)}return this}f.prototype={setFromString:function(t,e){var n=typeof e==="string"?e.split(","):e.constructor===Array?e:[e];n.unshift(t);f.prototype.set.apply(this,n)},set:function(t){var e=Array.prototype.slice.apply(arguments,[1]);if(this.setter[t]){this.setter[t].apply(this,e)}else{this[t]=e.join(",")}},get:function(t){if(this.getter[t]){return this.getter[t].apply(this)}else{return this[t]||0}},setter:{rotate:function(t){this.rotate=b(t,"deg")},rotateX:function(t){this.rotateX=b(t,"deg")},rotateY:function(t){this.rotateY=b(t,"deg")},scale:function(t,e){if(e===undefined){e=t}this.scale=t+","+e},skewX:function(t){this.skewX=b(t,"deg")},skewY:function(t){this.skewY=b(t,"deg")},perspective:function(t){this.perspective=b(t,"px")},x:function(t){this.set("translate",t,null)},y:function(t){this.set("translate",null,t)},translate:function(t,e){if(this._translateX===undefined){this._translateX=0}if(this._translateY===undefined){this._translateY=0}if(t!==null&&t!==undefined){this._translateX=b(t,"px")}if(e!==null&&e!==undefined){this._translateY=b(e,"px")}this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var t=(this.scale||"1,1").split(",");if(t[0]){t[0]=parseFloat(t[0])}if(t[1]){t[1]=parseFloat(t[1])}return t[0]===t[1]?t[0]:t},rotate3d:function(){var t=(this.rotate3d||"0,0,0,0deg").split(",");for(var e=0;e<=3;++e){if(t[e]){t[e]=parseFloat(t[e])}}if(t[3]){t[3]=b(t[3],"deg")}return t}},parse:function(t){var e=this;t.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(t,n,i){e.setFromString(n,i)})},toString:function(t){var e=[];for(var i in this){if(this.hasOwnProperty(i)){if(!n.transform3d&&(i==="rotateX"||i==="rotateY"||i==="perspective"||i==="transformOrigin")){continue}if(i[0]!=="_"){if(t&&i==="scale"){e.push(i+"3d("+this[i]+",1)")}else if(t&&i==="translate"){e.push(i+"3d("+this[i]+",0)")}else{e.push(i+"("+this[i]+")")}}}}return e.join(" ")}};function c(t,e,n){if(e===true){t.queue(n)}else if(e){t.queue(e,n)}else{t.each(function(){n.call(this)})}}function l(e){var i=[];t.each(e,function(e){e=t.camelCase(e);e=t.transit.propertyMap[e]||t.cssProps[e]||e;e=h(e);if(n[e])e=h(n[e]);if(t.inArray(e,i)===-1){i.push(e)}});return i}function d(e,n,i,r){var s=l(e);if(t.cssEase[i]){i=t.cssEase[i]}var a=""+y(n)+" "+i;if(parseInt(r,10)>0){a+=" "+y(r)}var o=[];t.each(s,function(t,e){o.push(e+" "+a)});return o.join(", ")}t.fn.transition=t.fn.transit=function(e,i,r,s){var a=this;var u=0;var f=true;var l=t.extend(true,{},e);if(typeof i==="function"){s=i;i=undefined}if(typeof i==="object"){r=i.easing;u=i.delay||0;f=typeof i.queue==="undefined"?true:i.queue;s=i.complete;i=i.duration}if(typeof r==="function"){s=r;r=undefined}if(typeof l.easing!=="undefined"){r=l.easing;delete l.easing}if(typeof l.duration!=="undefined"){i=l.duration;delete l.duration}if(typeof l.complete!=="undefined"){s=l.complete;delete l.complete}if(typeof l.queue!=="undefined"){f=l.queue;delete l.queue}if(typeof l.delay!=="undefined"){u=l.delay;delete l.delay}if(typeof i==="undefined"){i=t.fx.speeds._default}if(typeof r==="undefined"){r=t.cssEase._default}i=y(i);var p=d(l,i,r,u);var h=t.transit.enabled&&n.transition;var b=h?parseInt(i,10)+parseInt(u,10):0;if(b===0){var g=function(t){a.css(l);if(s){s.apply(a)}if(t){t()}};c(a,f,g);return a}var m={};var v=function(e){var i=false;var r=function(){if(i){a.unbind(o,r)}if(b>0){a.each(function(){this.style[n.transition]=m[this]||null})}if(typeof s==="function"){s.apply(a)}if(typeof e==="function"){e()}};if(b>0&&o&&t.transit.useTransitionEnd){i=true;a.bind(o,r)}else{window.setTimeout(r,b)}a.each(function(){if(b>0){this.style[n.transition]=p}t(this).css(l)})};var z=function(t){this.offsetWidth;v(t)};c(a,f,z);return this};function p(e,i){if(!i){t.cssNumber[e]=true}t.transit.propertyMap[e]=n.transform;t.cssHooks[e]={get:function(n){var i=t(n).css("transit:transform");return i.get(e)},set:function(n,i){var r=t(n).css("transit:transform");r.setFromString(e,i);t(n).css({"transit:transform":r})}}}function h(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}function b(t,e){if(typeof t==="string"&&!t.match(/^[\-0-9\.]+$/)){return t}else{return""+t+e}}function y(e){var n=e;if(typeof n==="string"&&!n.match(/^[\-0-9\.]+/)){n=t.fx.speeds[n]||t.fx.speeds._default}return b(n,"ms")}t.transit.getTransitionValue=d;return t});

(function($){	
	$(document).ready(function() {
		function checkSizeSmooth() {
			if(!navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/) && window.innerWidth > 1199){ //Not run in mobile
				if($('input[name="cactus_scroll_effect"]').length > 0)
				{
					if($('input[name="cactus_scroll_effect"]').val() == 'on')
						smoothScroll();
				}
			};	
		};
		checkSizeSmooth();
		$(window).resize(function(){
			checkSizeSmooth();
		});
		$('.scroll-next-div').click(function(){
			$("html, body").animate({ scrollTop: $(this).parent().outerHeight()+$(this).parent().offset().top }, 500);
			return false;
		});
		$(window).bind("scroll", function() { requestAnimationFrame(scrollParallax) });	
		createParallaxSlider();
	});	
	$(window).resize(function() {
		checkConvertfirst=1;
		createParallaxSlider();	
		scrollParallax();
		
		setTimeout(createParallaxSlider, 388);
		setTimeout(scrollParallax, 388);		
	});
}(jQuery));