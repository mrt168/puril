<?php
use Cake\Routing\Router;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\URLUtil;

if (!empty($prefCodes)) {
?>
<?php
$prefNames = [];
foreach ($prefCodes as $prefCode) {
	array_push($prefNames, Pref::convert($prefCode, CodePattern::$VALUE));
}
?>
<h3 class="sub_tit">市区町村から探す</h3>
	<?php
	foreach ($prefCodes as $prefCode){
	?>
	<ul class="cf">
		<?php
		$isLink = $this->request->isMobile() ? false : true;

		$baseUrl = null;
		if(strpos(Router::url(null,false), URLUtil::RANKING) !== false){
			$baseUrl = URLUtil::RANKING;
		}
		echo $this->ExForm->cityLink('Make.area_id', $prefCode, ['templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], $isLink, $baseUrl);
		echo $this->ExForm->hidden('Make.pref.', ['value'=> $prefCode]);
		?>
	</ul>
<?php
	}
}
?>


<?php /**
<ul class="cf">
	<?php
// 	foreach ($areas as $area) {
// 		$url = Router::url("/search/{$prefCode}/{$area->area_id}");

// 		// TODO: T.YAGI 後でURLを正確なものに
// 		echo "<li><input type=\"checkbox\" name=\"Make.area_id\" value=\"{$area->area_id}\"><a href=\"{$url}\">{$area->name}</a></li>";
// 	}
	?>
</ul>
<?php
}
*/
?>