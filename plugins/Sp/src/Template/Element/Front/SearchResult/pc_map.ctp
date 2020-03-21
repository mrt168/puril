<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;
use Cake\Routing\Router;
use App\Vendor\URLUtil;

if (!empty($prefCodes)) {
?>
<style>
#area_map {
	width: 100%;
	height: 530px;
}
</style>
<?php
$prefName = Pref::convert($prefCodes[0], CodePattern::$VALUE);
$addressDatas = [['name'=> $prefName, 'address'=> $prefName]];
foreach ($mapShops as $mapShop) {
	array_push($addressDatas, ['name'=> $mapShop->name, 'address'=> $mapShop->address]);
}
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<script>

var addresses = <?php echo json_encode( $addressDatas , JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);?>;
var styledMapType = [
    {
    	featureType: 'administrative.province',
        elementType: 'geometry.stroke',
        stylers: [{color: '#ff0000'}]
    }
    ,{
        featureType: "road",
        elementType: "labels",
        stylers: [
            { visibility: "off" }
      ]
    }
];
$(function() {
	$('#map-pref').change(function() {
		var pref = $(this).val();
		// 都道府県を変えた場合は市区町村をリセット
		var html = $('#map-area option').first()[0];
		$('#map-area').html(html);

		getMapData(pref, '');
	});

	$('#map-area').change(function() {
		var pref = $('#map-pref').val();
		var area = $(this).val();

		getMapData(pref, area);
	});

	iniMap();
});

function getMapData(pref, area) {
	addresses = [];

    $.ajax({
        url:'<?= Router::url(['controller'=> 'searches', 'search_map'])?>/'+pref+'/'+area,
        type:'GET',
        dataType : 'json'
    })
    // Ajaxリクエストが成功した時発動
    .done( (data) => {
        if (Object.keys(data).length) {
            if (data['areas'].length) {
                var areas = data['areas'];
                var mapArea = $('#map-area');
                $('#select').append($('<option>').html("追加される項目名").val("追加される値"));

                $('#map-area option').each(function(index, element){
                });

               	var option = $('#map-area').children();
            	Object.keys(areas).forEach(function (key) {

					// 同じ項目は追加しない
            		for(var i=0; i<option.length; i++){
                   		if (option.eq(i).text() == areas[key]['name']) {
                   			return true;
                       	}
                    }

            		mapArea.append($('<option>').html(areas[key]['name']).val(areas[key]['area_id']));
            	});
            }
            if (data['prefName'].length) {
            	addresses = JSON.parse(data['shops']);
            	iniMap();
            }
        }
    })
    // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
    })
    // Ajaxリクエストが成功・失敗どちらでも発動
    .always( (data) => {
    });
}



function loadMap(arg, data) {
    new Promise(function (resolve, reject) {
    	setTimeout(function() {
    		geocoder.geocode({'address': data['address']}, function(results, status) { // 結果
				if (status === google.maps.GeocoderStatus.OK) { // ステータスがOKの場合
					if (map == null) {
				        map = new GMaps({
				    	 	div: '#area_map', //地図を表示する要素
				    	 	lat: results[0].geometry.location.lat(),
				    	 	lng: results[0].geometry.location.lng(),
				    	 	zoom: 10
				    	});

				        map.addStyle({
				            styledMapName:"Styled Map",
				            styles: styledMapType,
				            mapTypeId: "map_style"
				        });
				        map.setStyle("map_style");

// 						// ここで都道府県のエリア座標をセットする
// 						polygonPaths = [];
// 						for (var i = 0; i < results.length; i++) {
// 							console.log(results[i].geometry.location_type);
// 							console.log(results[i].geometry.bounds);
// 							console.log(results[i].postcode_localities);
// 						}
// 						polygon = map.drawPolygon({
// 						 	paths: [[results[0].geometry.location.lat(), results[0].geometry.location.lng()]],
// 						 	strokeColor: '#FF2626', //ポリゴンラインの色
// 						 	strokeOpacity: 0.75, //ポリゴンラインの透明度
// 						 	strokeWeight: 3, //ポリゴンラインの太さ
// 						 	fillColor: '#FF2626', //ポリゴンの色
// 						 	fillOpacity: 0.35 //ポリゴンの透明度
// 						});


					} else {
						map.addMarker({
						 	lat: results[0].geometry.location.lat(),
						 	lng: results[0].geometry.location.lng(),
						 	title: 'サンプル',
						 	infoWindow: {
						 	 	content: '<h4>'+data['name']+'</h4><ul><li>'+data['address']+'</li></ul>'
						 	}
						});
					}

				} else { // 失敗した場合
					console.log(status);
				}

				if (map != null && arg == limit - 1) {
					map.fitZoom();
				}
			});
    	}, arg * 200);
    });
}

function iniMap() {
	map = null;
	marker = [];
	geocoder = null;
	geocoder = new google.maps.Geocoder();

	limit = Object.keys(addresses).length;
	var promises = [];
	var i = 0;
	Object.keys(addresses).forEach(function (key) {
		promises.push(loadMap(key, addresses[key]));
	});
	Promise.all(promises).then(function(results) {
	});
}
</script>
<?php }?>

<div class="pc">
	<h2 class="maintit2 v1">地域を絞り込む
		<span class="ib_wrap">
			<?php
			if (count($prefCodes) === 1) {
			?>
			<span class="ib">
				<?= $this->ExForm->pref('Make.pref', ['type'=> 'select', 'id'=> 'map-pref']);?>
			</span>
			<span class="ib">
				<?php
				echo $this->ExForm->city('Map.area_id', $prefCodes[0], ['class'=> 'area_id', 'type'=> 'select', 'empty'=> '▼市区町村', 'id'=> 'map-area']);
				echo $this->ExForm->hidden('Map.pref.', ['value'=> $prefCodes[0]]);
				?>
			</span>
			<?php
			}
			?>
		</span>
	</h2>
	<div id="area_map"></div>
	<?php
	$shopTypeVals = [];
	foreach ($shopTypes as $shopType) {
		array_push($shopTypeVals, ShopType::convert($shopType, CodePattern::$VALUE));
	}
	$shopTypeVal = implode('・', $shopTypeVals);

	if (!empty($pickupShops)) {
	?>
	<h2 class="maintit2-little"><span class="pink">【ピックアップ】</span><?=Pref::convert($prefCodes[0], CodePattern::$VALUE)?>の<?php echo $shopTypeVal?></h2>
	<div class="pickup_wrap cf">
		<?php
		foreach ($pickupShops as $pickupShop) {
		?>
		<div class="pickup_box">
			<ul class="tag">
				<li><?=$this->Html->link(ShopType::convert($pickupShop['shop_type'], CodePattern::$VALUE), '/search/'. ShopType::convert($pickupShop['shop_type'], CodePattern::$VALUE2))?></a></li>
			</ul>
			<?= $this->Html->link($pickupShop->name, ['controller'=> 'shop', 'detail', $pickupShop->shop_id], ['class'=> 'shop'])?>
			<?php
			if (!empty($pickupShop->star)) {
			?>
			<div class="star_box">
				<div class="star-rating-box">
					<div class="empty-star">★★★★★</div>
					<div class="filled-star" style=" width: <?php echo $pickupShop->star * 20?>%;">
					<?php
					$star = empty($pickupShop->star) ? 0 : $pickupShop->star;
					for ($i = 0; $i < abs($star); $i++) { echo '★';}
					?>
					</div>
				</div>
				<span class="points"><?= number_format($star,2)?></span>
			</div>
			<?php
			}
			?>
			<div class="area_bread">
				<?=$this->Html->link($pickupShop->PrefData['search_text'], '/search/'.$pickupShop->PrefData['url_text'])?>
				＞
				<?=$this->Html->link($pickupShop->Area['name'], '/search/'.$pickupShop->PrefData['url_text'].'/'. URLUtil::CITY. $pickupShop->Area['area_id'])?>
			</div>
			<div class="mgn10 cf">
				<?php
				$imgUrl = null;
				if (!empty($pickupShop->affiliate_banner_url)) {
					$imgUrl = $pickupShop->affiliate_banner_url;
				} else if (!empty($pickupShop['shop_images'][0])) {
					$imgUrl = Router::url(['controller'=> 'images', 'action'=> 'shopImage', $pickupShop['shop_images'][0]['shop_image_id']]);
				}

				if (!empty($imgUrl)) {
				?>
				<div class="img_box">
					<a href="<?php echo $pickupShop->affiliate_page_url?>" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
						<div class="img" style="background-image: url(<?= $imgUrl?>);"></div>
					</a>
				</div>
				<?php
				}
				?>
				<div class="right_box">
					<?php
					if (!empty($pickupShop['station_name'])) {
					?>
					<dl class="station">
						<dt>最寄駅</dt>
						<dd>
						<?php
						$nearStations = '';
						foreach ($pickupShop['station_name'] as $key => $stationName) {
							$nearStations .= $this->Html->link($stationName,
									'/search/'. ShopType::convert($pickupShop['shop_type'], CodePattern::$VALUE2). "/". $pickupShop->PrefData['url_text'].'/'. URLUtil::CITY. $pickupShop->area_id[$key]. "/". URLUtil::STATION_G. $pickupShop->station_g_cd[$key]);
							$nearStations .= '<br>';
						}
						echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
						?>
						</dd>
					</dl>
					<?php
					}
					?>
					<?php if (!empty($pickupShop->affiliate_page_url)) {?>
					<a href="<?=$pickupShop->affiliate_page_url?>" class="official">公式サイトへ</a>
					<?php }?>
				</div>
			</div>
			<div class="more_btn"><?=$this->Html->link('詳細を見る', ['controller'=> 'shop', 'detail', $pickupShop['shop_id']], ['onclick'=> "gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"])?></div>
		</div>
		<?php
		}
		?>
	</div>
	<?php
	}
	?>
</div><!--/.pc-->