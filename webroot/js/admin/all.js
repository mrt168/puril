$(function() {
	$.datetimepicker.setLocale('ja');
	$('input.datetimepicker').datetimepicker({
		step:5
	}).keydown(function(e) {
	}).dblclick(function() {
		// ダブルクリックで現在時刻セット
		var hiduke = new Date();

		//年・月・日・曜日を取得する
		var date = hiduke.getFullYear()+'-'+all._addZero((hiduke.getMonth()+1), 2)+'-'+all._addZero(hiduke.getDate(), 2);
		date += ' '+all._addZero(hiduke.getHours(), 2)+':'+all._addZero(hiduke.getMinutes(), 2);
		$(this).val(date);
	});
});

var all = {
		_addZero: function(num, len) {
			num += "";
			if (num.length < len) {
				for (var i = num.length; i < len; i++) {
					num = "0" + num;
				}
			}
			return num;
		}
}