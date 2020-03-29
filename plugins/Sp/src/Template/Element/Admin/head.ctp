<?php
use App\Vendor\Constants;
?>
<meta charset="utf-8">
<title><?php echo $title_for_layout.'｜'.Constants::ADMIN_SYSYTEM_NAME?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<?php
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');

echo $this->Html->script('/lib/jQuery-Knob/js/jquery.knob');
echo $this->Html->script('//ajaxzip3.github.io/ajaxzip3.js');
echo $this->Html->script('/lib/jQuery-Knob/js/jquery.knob');
echo $this->Html->script('/js/admin/jquery.datetimepicker.full.min');
echo $this->Html->script('/js/admin/datepicker-ja');
echo $this->Html->script('/js/admin/nidooshi');
echo $this->Html->script('/js/admin/check');
echo $this->Html->script('/js/admin/all');


echo $this->Html->css('/lib/bootstrap/css/bootstrap');
echo $this->Html->css('/lib/font-awesome/css/font-awesome');

echo $this->Html->css('/css/admin/theme');
echo $this->Html->css('/css/admin/premium');
echo $this->Html->css('/css/admin/style');
echo $this->Html->css('/css/admin/jquery.datetimepicker');

echo $this->Html->css('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
?>

<script src="//ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<script type="text/javascript">
$(function() {
	$(".knob").knob();
});
</script>


<script type="text/javascript">
	$(function() {
		var match = document.cookie.match(new RegExp('color=([^;]+)'));
		if(match) var color = match[1];
		if(color) {
			$('body').removeClass(function (index, css) {
				return (css.match (/\btheme-\S+/g) || []).join(' ')
			})
			$('body').addClass('theme-' + color);
		}

		$('[data-popover="true"]').popover({html: true});

	});
</script>
<style type="text/css">
#line-chart {
	height: 300px;
	width: 800px;
	margin: 0px auto;
	margin-top: 1em;
}

.navbar-default .navbar-brand, .navbar-default .navbar-brand:hover {
	color: #fff;
}

.message, .error-message {
	color: #ff0000;
}
</style>

<script type="text/javascript">
	$(function() {
		var uls = $('.sidebar-nav > ul > *').clone();
		uls.addClass('visible-xs');
		$('#main-menu').append(uls.clone());
	});
</script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<!--<![endif]-->