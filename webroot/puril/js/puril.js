$(function() {
	$('.Parts__box .prt .toggle').click(function(){
		depilationSiteCheck( !$(this).hasClass('show') );
		return false;
	});
});

function depilationSiteCheck( bool ){
	$('.Parts__box .cld [type="checkbox"]').prop('disabled', !bool);
	$('.Parts__box .cld').toggleClass('show', bool);;
	$('.Parts__box .prt .toggle').toggleClass('show', bool);
}