$(function() {
	/* jshint strict: false */

	// swiper
	if($('#slider_wrap').length){
		var swiper = new Swiper('#slider_wrap .swiper-container', {
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			centeredSlides : true,
			loop: true,
			autoplay: {
				delay: 4000,
				disableOnInteraction: true,
			},
			speed: 800,
			slidesPerView: 3,
			spaceBetween: 20,
			breakpoints: {
				767: {
					slidesPerView: 1.2,
					spaceBetween: 10,
					centeredSlides : true,
				}
			}
		});
	}

	$('#slider article').click(function(){
		if($('.pc').css('display') == 'none') {
			if($(this).hasClass('swiper-slide-active')){
			} else {
				return false;
			}
		}
	});

	// side menu ドロワー
	$(document).ready(function() {
		$('.drawer').drawer();
	});

	// tab
	$('#sec02 ul.tab a').click(function () {
		$('#sec02 .tab_box').hide().filter(this.hash).fadeIn(300);
		$('#sec02 ul.tab a').removeClass('active').filter(this).addClass('active');
		return false;
	}).filter(':eq(0)').click();
	$('#sec03 ul.tab a').click(function () {
		$('#sec03 .tab_box').hide().filter(this.hash).fadeIn(300);
		$('#sec03 ul.tab a').removeClass('active').filter(this).addClass('active');
		return false;
	}).filter(':eq(0)').click();

	/*
	$('.search .result_list .tab a').click(function () {
		$('.search .result_list .tab_box').hide().filter(this.hash).fadeIn(300);
		$('.search .result_list .tab a').removeClass('active').filter(this).addClass('active');
		return false;
	}).filter(':eq(0)').click();
	*/

	// 検索slideIn
	$('#search01').animatedModal({
		modalTarget:'content01',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search02').animatedModal({
		modalTarget:'content02',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search03').animatedModal({
		modalTarget:'content03',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search04').animatedModal({
		modalTarget:'content04',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search05').animatedModal({
		modalTarget:'content05',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search06').animatedModal({
		modalTarget:'content06',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search07').animatedModal({
		modalTarget:'content07',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});
	$('#search08').animatedModal({
		modalTarget:'content08',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
	});

	$('#sp_search').animatedModal({
		modalTarget:'sp_search_detail',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
		color:'#fff', //背景色
	});
	$('#sp_search1').animatedModal({
		modalTarget:'sp_search_detail1',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
		color:'#fff', //背景色
	});
	$('#sp_search2').animatedModal({
		modalTarget:'sp_search_detail2',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
		color:'#fff', //背景色
	});
	$('#sp_search3').animatedModal({
		modalTarget:'sp_search_detail3',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
		color:'#fff', //背景色
	});
	$('#sp_search4').animatedModal({
		modalTarget:'sp_search_detail4',
		animatedIn:'slideInRight', //表示する時のアニメーション
		animatedOut:'slideOutRight', //閉じる時のアニメーション
		animationDuration:'0.3s', //アニメーションにかける秒数
		color:'#fff', //背景色
	});

	// 部分脱毛にcheckがあるときだけ選択可能
	$('.check_box .parts').on('click', function() {
		if ($(this).prop('checked')) {
			$('#categories :input, #category_all').prop('disabled', false);
		} else {
			$('#categories :input, #category_all').prop('disabled', true);
		}
	});

	// 全選択チェック
	$('#category_all').on('click', function() {
		$('.category').prop('checked', this.checked);
	});
	$('.category').on('click', function() {
		if ($('#categories :checked').length === $('#categories :input').length){
			$('#category_all').prop('checked', 'checked');
		} else {
			$('#category_all').prop('checked', false);
		}
	});

	// search slidedown PC
	if($(".search #pcsearch.search_wrap .more_btn").hasClass('active')){
		$(".search #pcsearch.search_wrap .more_btn").find('span').html('詳しい条件を折りたたむ');
	}
	$(".search #pcsearch.search_wrap .more_btn").on("click", function() {
		$(".search_inner.slide_down").slideToggle();
		if($(this).hasClass('active')){
			$(this).find('span').html('さらに条件を絞って探す');
		} else {
			$(this).find('span').html('詳しい条件を折りたたむ');
		}
		$(this).toggleClass("active");
	});

	$(".search #pcsearch.search_wrap .more_btn2").on("click", function() {
		$(this).next('.search_town').slideToggle();
		if($(this).hasClass('active')){
			$(this).find('span').html('郡・町村を絞って探す');
		} else {
			$(this).find('span').html('郡・町村を折りたたむ');
		}
		$(this).toggleClass("active");
	});

	// search slidedown SP
	$(".search #spsearch.search_wrap .area_tit").on("click", function() {
		$(this).next('ul').toggle();
		$(this).toggleClass('active');
	});

	// search 一言説明
	$(".description .memo").on("click", function() {
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$(this).next('.txt').removeClass('active');
		} else {
			$('.description .memo.active').removeClass('active');
			$('.description .txt.active').removeClass('active');
			$(this).addClass('active');
			$(this).next('.txt').addClass('active');
		}
	});
	$(".description .txt").on("click", function() {
		if($(".description .memo").hasClass('active')){
			$(".description .memo").removeClass('active');
			$(".description .memo").next('.txt').removeClass('active');
		}
		return false;
	});

	// search SP formBtn
	$('#sp_search').on('click', function() {
		$('#spsearch .form_btn02').addClass("active");
	});
	$('.close-sp_search_detail, #spsearch .form_btn02').on('click', function() {
		$('#spsearch .form_btn02').removeClass("active");
	});

	// PC header パネルメニュー
	$('li.open_mddWrap').hover(function(){
		childPanel = $(this).children('.mddWrap');
		childPanel.each(function(){
			childPanel.css({height:'0',display:'block',opacity:'0'}).stop().animate({height:'380px',opacity:'1'},500,'swing');
		});
		$(this).addClass('active');
	},function(){
		childPanel.css({display:'none'});
		$(this).removeClass('active');
	});

	// side colum content
	$('.sidecommonbox .columlistwrap li.active').parents('ul').slideDown(300).addClass('active');
	$('.sidecommonbox .columlistwrap li.active').parents('li').addClass('active');
	$('.treemainwrap > li div.parent').on('click',function(){
		if(!$(this).parent('li').hasClass('active')){
			if($('.pc').css('display') !== 'none') {
				$('.treemainwrap > li').removeClass('active');
				$('.sidecommonbox .columlistwrap li ul').slideUp(300).removeClass('active');
			}
			$(this).parent('li').addClass('active');
			$(this).parent('li').find('ul').slideDown(300).addClass('active');
		} else {
			if($('.pc').css('display') !== 'none') {
				$('.treemainwrap > li').removeClass('active');
				$('.sidecommonbox .columlistwrap li ul').slideUp(300).removeClass('active');
			} else {
				$(this).parent('li').removeClass('active');
				$(this).next('ul').slideUp(300).removeClass('active');
			}
		}
	});

	// ranking tab
	$('.rankingtabwrap .tabarea li a').on('click',function(){
		var href= $(this).attr('href');
		$('.rankingtabwrap .tabarea li').removeClass('active');
		$('.rankingtabwrap .tabcontentarea .tabbox').removeClass('active');
		$(this).parent('li').addClass('active');
		$(href).addClass('active');
		return false;
	});

	// side tab
	$('#sidecolumn .tabjswrap .tabjscontrol li a').on('click',function(){
		var href= $(this).attr('href');
		$(this).parents('.tabjswrap').find('.tabjscontrol li').removeClass('active');
		$(this).parents('.tabjswrap').find('.rankingwrap').removeClass('active');
		$(this).parent('li').addClass('active');
		$(href).addClass('active');
		return false;
	});

	// relationtabswrap tab
	$('#relationtabswrap.tabjswrap .tabjscontrol li a').on('click',function(){
		var href= $(this).attr('href');
		$(this).parents('.tabjswrap').find('.tabjscontrol li').removeClass('active');
		$(this).parents('.tabjswrap').find('.tabscontentarea').removeClass('active');
		$(this).parent('li').addClass('active');
		$(href).addClass('active');
		if($('.sp').css('display') == 'none') {
			relationtabshi();
		}
		return false;
	});


	// gallerysldier
	if($('.gallerysldier').length){
		// 枚数1~2
		if($('.gallerysldier').hasClass('allnotloop')){
			var option = {
				loop: false,
				speed: 800,
				slidesPerView: 3.5,
				spaceBetween: 20,
				centeredSlides : true,
				breakpoints: {
					767: {
						slidesPerView: 1.3,
						spaceBetween: 10,
					}
				}
			}
		} else if($('.gallerysldier').hasClass('pcnotloop')){
			var option = {
				loop: false,
				speed: 800,
				slidesPerView: 3.5,
				spaceBetween: 20,
				centeredSlides : true,
				breakpoints: {
					767: {
						loop: true,
						slidesPerView: 1.3,
						spaceBetween: 10,
						autoplay: {
							delay: 4000,
							disableOnInteraction: true
						},
					}
				}
			}
		} else if($('.gallerysldier').hasClass('allloop')){
			var option = {
				loop: true,
				autoplay: {
					delay: 4000,
					disableOnInteraction: true
				},
				slidesPerView: 3.5,
				spaceBetween: 20,
				centeredSlides : true,
				breakpoints: {
					767: {
						slidesPerView: 1.3,
						spaceBetween: 10,
					}
				}
			}
		}
		var swiperw = new Swiper('.gallerysldier .swiper-container',option);
	}

	$('#shopdetailwrap .leadwrap .menu li a').click(function(){
		if($('.pc').css('display') == 'none') {
			var headhi = $('#header .headwrap .logarea').outerHeight();
			var	navHi = $('.menu-box').outerHeight();
			var taget =  $(this.hash).offset().top -headhi - navHi;
		} else {
			var taget =  $(this.hash).offset().top;
		}
		$('html,body').animate({
			scrollTop: taget
		}, 400);
		return false;
	});

	$('#brands_tabjscontrol.leadwrap a').click(function(){
		if($('.pc').css('display') == 'none') {
			var headhi = $('#header .headwrap .logarea').outerHeight();
			var taget =  $(this.hash).offset().top -headhi;
		} else {
			var taget =  $(this.hash).offset().top;
		}
		$('html,body').animate({
			scrollTop: taget
		}, 400);
		return false;
	});

	$('#mainclum_brands .tabscontentarea .nav_list li a').click(function(){
		if($('.pc').css('display') == 'none') {
			var headhi = $('#header .headwrap .logarea').outerHeight();
			var taget =  $(this.hash).offset().top -headhi;
		} else {
			var taget =  $(this.hash).offset().top;
		}
		$('html,body').animate({
			scrollTop: taget
		}, 400);
		return false;
	});

	if($('input.datepicker').length){
		$.datepicker.setDefaults( $.datepicker.regional[ "ja" ] );
		$('input.datepicker').datepicker({
			buttonText : 'cal',
			dateFormat : 'yy/mm/dd'
		});
	}

	if($('.routeslider').length){
		var mySwiper = new Swiper ('.routeslider .swiper-container', {
			loop: true,
			slidesPerView: 1,
			spaceBetween: 0,
			centeredSlides : true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: true
			},
			pagination: {
				el: '.routeslider .swiper-pagination',
				type: 'bullets',
			}
		});
	}

	$('.depilation_site .prt .toggle').click(function(){
		depilationSiteCheck( !$(this).hasClass('show') );
		return false;
	});
	$('input[type=checkbox].all_check').click(function(){
		$(this).parents('.cld').find('input[type=checkbox]').prop('checked', $(this).prop('checked'));
	});
	$('.all_check_wrap input[type="checkbox"]:not(.all_check)').change(function(){
		depilationSiteAllCheck( $(this).parents('.all_check_wrap') );
	});

	$('#shopdetailwrap .reviews .reviewslist_wrap .itembox .contentwrap .underbox .cntlbtn a.btn').on('click',function(){
		var btn = $(this).parents('.cntlbtn');
		var content = $(this).parents('.contentwrap').find('.dolwcont');
		if(btn.hasClass('active')){
			btn.removeClass('active');
			content.slideUp(250);
		} else {
			btn.addClass('active');
			content.slideDown(250);
		}
		return false;
	});

	$('#shopdetailwrap .reviews .morebtn a').on('click',function(){
		var viewboxnum = $('#shopdetailwrap .reviews .reviewslist_wrap .itembox.hide').length;
		if(viewboxnum < 4){
			$(this).parents('.morebtn').hide();
		}
		$('#shopdetailwrap .reviews .reviewslist_wrap .itembox.hide').each(function(i, elem) {
			if(i < 3){
				$(elem).fadeIn().removeClass('hide');
			}
		});
		return false;
	});

	$('#shopstafflist .morebtn a').on('click',function(){
		var viewboxnum = $('#shopstafflist .stafflist .staffbox.hide').length;
		if(viewboxnum < 4){
			$(this).parents('.morebtn').hide();
		}
		$('#shopstafflist .stafflist .staffbox.hide').each(function(i, elem) {
			if(i < 3){
				$(elem).fadeIn().removeClass('hide');
			}
		});
		return false;
	});

	$('#shopdetailwrap .shopnewsarea .morebtn a').on('click',function(){
		var viewboxnum = $('#shopdetailwrap .shopnewsarea .newsbox.hide').length;
		if(viewboxnum < 4){
			$(this).parents('.morebtn').hide();
		}
		$('#shopdetailwrap .shopnewsarea .newsbox.hide').each(function(i, elem) {
			if(i < 3){
				$(elem).fadeIn().removeClass('hide');
			}
		});
		return false;
	});

	$('.search .result_list .pickup_box.type02 .morebtn a').on('click',function(){
		var viewboxnum = $(this).parents('.reviewslist_wrap').find('.moreview.hide').length;
		if(viewboxnum < 4){
			$(this).parents('.morebtn').hide();
		}
		$(this).parents('.reviewslist_wrap').find('.moreview.hide').each(function(i, elem) {
			if(i < 4){
				$(elem).fadeIn().removeClass('hide');
			}
		});
		return false;
	});


	// big_sidedown mail form
	$("#contact_userclum.shopreviews .big_slide_btn").on("click", function() {
		$(this).toggleClass("active");
		if($(this).hasClass('active')){
			$("#contact_userclum.shopreviews .slideform").css('display','block');
		} else {
			$("#contact_userclum.shopreviews .slideform").css('display','none');
		}
	});

	// sidedown mail form
	$("#contact_userclum.shopreviews .contact_form td.slide_btn").on("click", function() {
		$(this).toggleClass("active");
		if($(this).hasClass('active')){
			$("#contact_userclum.shopreviews .contact_form .valuetion").css('display','inline-block');
		} else {
			$("#contact_userclum.shopreviews .contact_form .valuetion").css('display','none');
		}
	});

	//詳細ページ固定バー
	var contactFloatBar = $("#dtfixbtnarea");

	$(window).on('scroll', function() {
		var scrollTop = $(window).scrollTop();

		if (scrollTop > 200) {
			$(contactFloatBar).addClass('display');
		} else {
			$(contactFloatBar).removeClass('display');
		}
	});

	$(".area_map_tab_box").each(function(){
		$(this).hover(function(){
			var id = $(this).data("link");
			$(".area_map_tab_box").each(function(){
				if($(this).data("link") == id) {
					$(this).addClass("on");
				} else {
					$(this).removeClass("on");
				}
			});
			$(".mapBox").each(function(){
				if($(this).attr("id") == id+ "Map"){
					$(this).addClass("on");
				} else {
					$(this).removeClass("on");
				}
			});
		},function () {
		});
	});
	$(".area_map").hover(function(){

	},function(){

		$(".area_map_tab_box").each(function(){
			$(this).removeClass("on");
		});
		$(".mapBox").each(function(){
			$(this).removeClass("on");
		});
	});

	var catnavfix = $('.menu-box'); //固定させるメニュー
	if(catnavfix.length > 0 ) {
		var fix = catnavfix.offset().top; //オブジェクトの距離を取得
		$(window).scroll(function () {
			if ($(window).scrollTop() >= fix) {
				catnavfix.addClass('cat-nav-fix');
			} else {
				catnavfix.removeClass('cat-nav-fix');
			}
		});
	}
});

function reviewboxshow(){
}

$(document).ready(function(){
	sliderloocontent('#slide_scroll_shopdt','#slide_thumb_shopdt');
	sliderloocontent('#slide_scroll_shopdt_sp','#slide_thumb_shopdt_sp');
});

// sp nav scroll
$(window).on('load scroll resize',function(){
	if($('.pc').css('display') == 'none') {
		var headerHe = $('#header').outerHeight();
		var snsHe = $('#header .snsshare').outerHeight();
		var logareaHe = $('#header .logarea').outerHeight() - 1;
		var scroll = $(window).scrollTop();
		if(scroll < snsHe) {
			var navposi = headerHe - scroll;
			$('.drawer-overlay , .drawer-nav , .animated').css('top',navposi);
			$('#header .headwrap .logarea').css('position','relative');
			$('#header .headwrap .logarea').removeClass('headerLittle');
			$('span.closehead').css('top','-11.4vw');
		} else {
			$('.drawer-overlay , .drawer-nav , .animated').css('top',logareaHe);
			$('#header .headwrap .logarea').css('position','fixed');
			$('#header .headwrap .logarea').addClass('headerLittle');
			$('span.closehead').css('top','-13vw');
		}
	} else {
		$('#header .headwrap .logarea').css('position','static');
		$('#header .headwrap .logarea').removeClass('headerLittle');
	}
});

$(window).on('load',function(){
	if($('.sp').css('display') == 'none') {
		relationtabshi();
	}

	if( $('.depilation_site').length ){
		depilationSiteCheck( $('.depilation_site .cld [type="checkbox"]:checked').length > 0 );
	}
	if( $('.all_check_wrap').length ){
		$('.all_check_wrap').each(function(){
			depilationSiteAllCheck( $(this) );
		});
	}
});

// relationtabshi
function relationtabshi() {
	var pareHi = $('#relationtabswrap .tabscontentarea.active .shoplistwrap').height();
	$('#relationtabswrap .tabscontentarea.active .shoplistwrap .shopitem').css('height',pareHi);
}

function autoHeightAnimate(element, time){
	var curHeight = element.height(),
		autoHeight = element.css('height', 'auto').height();
	element.height(curHeight);
	element.stop().animate({ height: autoHeight }, time);
}

function depilationSiteCheck( bool ){
	$('.depilation_site .cld [type="checkbox"]').prop('disabled', !bool);
	$('.depilation_site .cld').toggle(bool);
	$('.depilation_site .prt .toggle').toggleClass('show', bool);
}
function depilationSiteAllCheck( wrap ){
	wrap.find('input[type=checkbox].all_check').prop('checked', ( wrap.find('input[type="checkbox"]:not(.all_check):not(:checked)').length == 0));
}

function sliderloocontent($scrollwrap,$thumbwrap) {
	var $setMainId = $($scrollwrap);
	var $setThumbId = $($thumbwrap);
	var scrollSpeed = 300;

	var $setMainUl = $setMainId.children('ul'),
		$setThumbUl = $setThumbId.children('ul'),
		$setThumbLi = $setThumbUl.children('li'),
		$setThumbLiFirst = $setThumbUl.children('li:first'),
		listWidth = parseInt($setMainUl.children('li').css('width')),
		listCount = $setMainUl.children('li').length,
		leftMax = -((listWidth)*((listCount)-1));

	$setMainUl.each(function(){
		$(this).css({width:(listWidth)*(listCount)});
	});

	var isTouch = ('ontouchstart' in window);
	$setMainUl.bind(
		{'touchstart mousedown': function(e){
				var $setMainUlNot = $setMainId.children('ul:not(:animated)');
				$setMainUlNot.each(function(){
					e.preventDefault();
					this.pageX = (isTouch ? event.changedTouches[0].pageX : e.pageX);
					this.leftBegin = parseInt($(this).css('left'));
					this.left = parseInt($(this).css('left'));
					this.touched = true;
				});
			},'touchmove mousemove': function(e){
				if(!this.touched){
					return;
				}
				e.preventDefault();
				this.left = this.left - (this.pageX - (isTouch ? event.changedTouches[0].pageX : e.pageX) );
				this.pageX = (isTouch ? event.changedTouches[0].pageX : e.pageX);

				if(this.left < 0 && this.left > leftMax){
					$(this).css({left:this.left});
				} else if(this.left >= 0) {
					$(this).css({left:'0'});
				} else if(this.left <= leftMax) {
					$(this).css({left:(leftMax)});
				}
			},'touchend mouseup mouseout': function(e){
				if (!this.touched) {
					return;
				}
				this.touched = false;

				var $setThumbLiActive = $setThumbUl.children('li.active');

				if(this.leftBegin > this.left && (!((this.leftBegin) === (leftMax)))){
					$(this).stop().animate({left:((this.leftBegin)-(listWidth))},scrollSpeed);
					$setThumbLiActive.each(function(){
						$(this).removeClass('active');
						$(this).next().addClass('active');
					});
				} else if(this.leftBegin < this.left && (!((this.leftBegin) === 0))) {
					$(this).stop().animate({left:((this.leftBegin)+(listWidth))},scrollSpeed);
					$setThumbLiActive.each(function(){
						$(this).removeClass('active');
						$(this).prev().addClass('active');
					});
				} else if(this.leftBegin === 0) {
					$(this).css({left:'0'});
				} else if(this.leftBegin <= leftMax) {
					$(this).css({left:(leftMax)});
				}
			}
		});
	$setThumbLi.click(function(){
		var connectCont = $setThumbLi.index(this);
		$setMainUl.stop().animate({left:(-(listWidth)*(connectCont))},scrollSpeed);
		$setThumbLi.removeClass('active');
		$(this).addClass('active');
	});

	$setThumbLiFirst.addClass('active');
	$setThumbLi.css({opacity:'0.5'});

	var agent = navigator.userAgent;
	if(!(agent.search(/iPhone/) != -1 || agent.search(/iPad/) != -1 || agent.search(/iPod/) != -1 || agent.search(/Android/) != -1)){
		$setThumbLi.hover(function(){
			$(this).stop().animate({opacity:'1'},300);
		},function(){
			$(this).stop().animate({opacity:'0.5'},300);
		});
	}
}

$(window).on('load scroll resize',function(){
	var windowWidth = $(window).width();
	var windowSm = 767;
	if (windowWidth >= windowSm) {
		$("#shopdetailwrap .leadwrap .menu").each(function () {
			var num = $(this).find('ul li').length;
			if(num >= 5){
				$(this).find('ul li:nth-child(1)').addClass('bdr');
				$(this).find('ul li:nth-child(2)').addClass('bdr');
				$(this).find('ul li:nth-child(3)').addClass('bdr');
				$(this).find('ul li:nth-child(4)').addClass('bdr');
			}
		});
	} else {
		$("#shopdetailwrap .leadwrap .menu").each(function () {
			var num = $(this).find('ul li').length;
			if(num >= 7){
				$(this).find('ul li:nth-child(1)').addClass('bdr');
				$(this).find('ul li:nth-child(2)').addClass('bdr');
				$(this).find('ul li:nth-child(3)').addClass('bdr');
				$(this).find('ul li:nth-child(4)').addClass('bdr');
				$(this).find('ul li:nth-child(5)').addClass('bdr');
				$(this).find('ul li:nth-child(6)').addClass('bdr');
			}
			else if(num >= 4){
				$(this).find('ul li:nth-child(1)').addClass('bdr');
				$(this).find('ul li:nth-child(2)').addClass('bdr');
				$(this).find('ul li:nth-child(3)').addClass('bdr');
			}
		});
	}
});
