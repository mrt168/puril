window.onpageshow = function(){
	document.getElementById('reserve_exform').reset();
};

$(function() {
	$('.datetimepicker').datetimepicker();
});

$(function() {

	// const ----------------------------------------

	const RESERVE_TABLE = {
		// 日付の選択肢の数
		DATE_OPTIONS:    $('#reserve_table').data('date-options'),
		// 予約の時刻帯の開始
		TIME_START:      $('#reserve_table').data('time-start'),
		// 予約の時刻帯の終了
		TIME_END:        $('#reserve_table').data('time-end'),
		// バツの確率
		PROBABILITY:     $('#reserve_table').data('probability'),
		// 希望日を取る数
		VISIT_OPTIONS:   $('#reserve_table').data('visit-options'),
		// 曜日の表現(en)
		WEEK_OPTIONS_EN: $('#reserve_table').data('week-options-en').split(','),
		// 曜日の表現(jp)
		WEEK_OPTIONS_JP: $('#reserve_table').data('week-options-jp').split(','),
	};

	const SCROLL_OFFSET = {
		PM_SCROLL:    $($('#pm_scroll').data('target')).offset().top,
		NIGHT_SCROLL: $($('#night_scroll').data('target')).offset().top,
	};

	// var ------------------------------------------

	var addWeeks = 0;
	var reserveTable = $('#reserve_table');
	var reserveTablesRepository = [];

	// listener -------------------------------------

	$('#reserve_table td[data-time]').on('click', pickReserveTable);

	$('.reserve_section .prev').on('click', function(){
		if (addWeeks > 0) {
			reserveTablesRepository[addWeeks--] = reserveTable.html();
			restoreReserveTable();
		}

		if (addWeeks === 0) {
			$('.reserve_section .prev').addClass('disabled');
		}

		pickReserveRecheck();
	});

	$('.reserve_section .next').on('click', function(){
		if (reserveTablesRepository[addWeeks+1]) {
			++addWeeks;
			restoreReserveTable();
		} else {
			reserveTablesRepository[addWeeks] = reserveTable.html();
			reserveTable.empty();
			generateReserveTable(++addWeeks * 7);
		}

		$('.reserve_section .prev').removeClass('disabled');
		pickReserveRecheck();
	});

	$('.visit_dates').on('change', changeReserveHelp);

	// $('#reserve_exform').on('change', function() {
	// 	$('#reserve_exform').find('input[required],select[required]').each(function() {
	// 		if (!$(this).val() ) {
	// 			$('#reserve_submit').prop('disabled', true);
	// 			return false;
	// 		}

	// 		$('#reserve_submit').prop('disabled', false);
	// 	});
	// });

	$('#pm_scroll,#night_scroll').on('click', scroll);

	// util -----------------------------------------

	function pickReserveTable() {
		var i = $(this).data('selected');
		if (i && $('#visit_date_' + i).val()) {
			// alert('選択セルを再クリックした');
			cancelReserveTable(this);
			return;
		}

		var time = $(this).data('time');
		for (var i = 1; i <= RESERVE_TABLE['VISIT_OPTIONS']; i++) {
			var $visit = $('#visit_date_' + i);
			if (!$visit.val()) {
				$visit.val(time);
				changeReserveHelp(this, i);
				break;
			}
		}
	}

	function pickReserveRecheck() {
		for (var i = 1; i <= RESERVE_TABLE['VISIT_OPTIONS']; i++) {
			var $visit = $('#visit_date_' + i);
			if (!$visit.val()) {
				$('td[data-selected="' + i + '"]').removeAttr('data-selected');
			}
		}

		$('#reserve_table td[data-time]').on('click', pickReserveTable);
		$('#pm_scroll, #night_scroll').on('click', scroll);
	}

	function changeReserveHelp(selected, num) {
		if ($(selected).data()) {
			$(selected).attr('data-selected', num);
		}

		$('.visit_dates').each(function(i, visit) {
			if (!$(visit).val()) {
				var any = (i===0) ? '' : '（任意）';
				$('#reserve_help').text('第' + (i+1) + '希望日を選択してください' + any);
				$('td[data-selected="' + (i+1) + '"]').removeAttr('data-selected');
				return false;
			}
		});
	}

	function cancelReserveTable(cell) {
		var i = $(cell).data('selected');
		$('#visit_date_' + i).val('');
		changeReserveHelp();
	}

	function restoreReserveTable() {
		reserveTable.html(reserveTablesRepository[addWeeks]);
	}

	function generateReserveTable(addDays) {
		var timeOptions = [];
		for (i = RESERVE_TABLE['TIME_START']; i <= RESERVE_TABLE['TIME_END']; i++) {
			timeOptions.push(i);
		}

		var theadTag = $('<thead>');
		var tbodyTag = $('<tbody>');
		var trTag;
		var thTags = [];
		var tdTags = [];

		// --- thead ------------------------------------

		// ------ thead row 1 ---------------------------

		thTags = [];
		thTags.push($('<th rowspan="2">').text('日時'));
		for (var d = 2; d <= RESERVE_TABLE['DATE_OPTIONS']; d++) {
			var now  = moment();
			var date = now.add(d+addDays, 'days');
			var text = date.format('MM/DD');
			thTags.push($('<th scope="col" class="'+RESERVE_TABLE['WEEK_OPTIONS_EN'][date.day()]+'_en">').text(text));
		}

		trTag = $('<tr>');
		$.each(thTags, function() {
			trTag.append(this);
		});

		theadTag.append(trTag);

		// ------ thead row 2 ---------------------------

		thTags = [];
		for (var d = 2; d <= RESERVE_TABLE['DATE_OPTIONS']; d++) {
			var now  = moment();
			var date = now.add(d+addDays, 'days');
			var text = RESERVE_TABLE['WEEK_OPTIONS_JP'][date.day()];
			thTags.push($('<th scope="col" class="'+RESERVE_TABLE['WEEK_OPTIONS_EN'][date.day()]+'_jp">').text(text));
		}

		trTag = $('<tr>');
		$.each(thTags, function() {
			trTag.append(this);
		});

		theadTag.append(trTag);

		// ------ thead row 3 ---------------------------

		thTags = [];
		thTags.push($('<th>'));
		thTags.push($('<th colspan="'+RESERVE_TABLE['DATE_OPTIONS']+'">'));
		thTags[1].append($('<span id="pm_scroll" data-target="#time_12">').text('午後（12:00-18:00）'));
		thTags[1].append($('<span id="night_scroll" data-target="#time_18">').text('夜（18:00-）'));

		trTag = $('<tr>');
		$.each(thTags, function() {
			trTag.append(this);
		});

		theadTag.append(trTag);

		// --- tbody ------------------------------------

		$.each(timeOptions, function() {
			var timeOption = this;

			for (var d = 2; d <= RESERVE_TABLE['DATE_OPTIONS']; d++) {
				var now  = moment();
				var date = now.add(d+addDays, 'days');
				var text = date.format('MM/DD');
				tdTags.push($('<th scope="col">').text(text));
			}

			tdTags = [];
			for (var d = 2; d <= RESERVE_TABLE['DATE_OPTIONS']; d++) {
				var now  = moment();
				var date = now.add(d+addDays, 'days');
				var time = date.format('YYYY/MM/DD ' + timeOption + ':00');
				tdTags.push($('<td data-time="'+time+'">').text('□'));
			}

			trTag = $('<tr>');
			trTag.append($('<th scope="row">').text(timeOption + ':00'));
			$.each(tdTags, function() {
				trTag.append(this);
			});

			tbodyTag.append(trTag);
		});

		// table ----------------------------------------

		reserveTable.append(theadTag);
		reserveTable.append(tbodyTag);
	}

	function scroll() {
		$('body,html').animate({
			scrollTop: SCROLL_OFFSET[$(this)[0].id.toUpperCase()],
		}, 'fast');
		return false;
	}
	
	var checkedsum = 0; //チェックが入っている個数

	$(".depilation-box").find(".checkbox").each(function(){
		$(this).find("input").change(function(){
			checkedsum = $('.depilation-check:checked').length;
			$(".depilation-box").find(".depilation-check").each(function(){
				if( checkedsum > 0 ){
					$(this).prop("required",false); //required属性の解除
				}else{
					$(this).prop("required",true); //required属性の付与
				}
			});
			if($(this).prop("checked")) {
				$(this).parents(".checkbox").addClass("checked");
			} else {
				$(this).parents(".checkbox").removeClass("checked");
			}
		});
	});
	$(".depilation-more").click(function(){
		$(this).hide();
		$(".depilation-box").find(".checkbox").each(function(){
			$(this).fadeIn();
		});
	});
});
