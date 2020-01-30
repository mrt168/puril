$(function() {

	var cnt = 0;
	$('input[type="submit"], input[type="image"], button[type="submit"], a').click(function() {
		if (nidooshi.cnt == 0) {
			nidooshi.cnt = 1;
			window.setTimeout("nidooshi.reset()", 1000);
			return true;
		}
		return false;
	});
})
var nidooshi = {

	cnt: 0

	,reset: function() {
		nidooshi.cnt = 0;
	}
}