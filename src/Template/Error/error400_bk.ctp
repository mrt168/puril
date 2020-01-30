<?php
use Cake\Routing\Router;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\ShopType;

$this->layout = 'default';
$this->assign ( 'title', 'Puril' );
?>
<div id="container">
	<div class="inner">
		<div class="undercontentwrap cf">
			<div id="mainclum_404">
				<p class="comment_404">404 NOT FOUND</p>
				<h1>お探しのページが見つかりませんでした</h1>
				<div class="textarea">
					お探しのページは、存在しないか削除された可能性があります。<br>
					お手数では御座いますが、以下の情報より、再度目的のページをお探しいただけますと幸いです。
				</div>
				<?php
				$prefTable = TableRegistry::get('PrefDatas');
				$prefDatas = $prefTable->find('all');
				$regionPrefs = Pref::getRegionOptions();
				foreach ($regionPrefs as $region => $pref) {
					foreach ($pref as $prefCode => $value) {
						foreach ($prefDatas as $prefData) {
							if($prefData['pref'] == $prefCode) {
								$regionPrefs[$region][$prefCode] = $prefData['url_text'];
							}
						}
					}
				}
				echo $this->element('Front/section404', ['regionPrefs'=> $regionPrefs]);
				?>
			</div>
		</div>
	</div>
</div>