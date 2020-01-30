<?php
use Cake\Routing\Router;
use App\Vendor\URLUtil;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Route\Route;
use App\Vendor\Code\Pref;
use App\Vendor\PagingUtil;
?>

<?php
// 都道府県
if (!empty($place)) {
    $placeName = $place.'/';
} else if (!empty($prefCodes)) {
    $prefNames = [];
    foreach ($prefCodes as $prefCode) {
        array_push($prefNames, Pref::convert($prefCode, CodePattern::$VALUE));
    }

    if (!empty($prefNames)) {
        $placeName = implode('、', $prefNames).'/';
    }
} else {
    $placeName = "全国/";
}

// 店舗タイプ
$shopTypeVal = "";
if (empty($this->request->data['Make']['shop_type'])) {
    $shopTypeVal = ShopType::$DEPILATION_SALON[CodePattern::$VALUE]. "・". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];
} else {
    foreach ($this->request->data['Make']['shop_type'] as $key => $shopType) {
        if ($key <= 0) {
            $shopTypeVal .= ShopType::convert($shopType, CodePattern::$VALUE);
        } else {
            $shopTypeVal .= "・". ShopType::convert($shopType, CodePattern::$VALUE);
        }
    }
}

// 詳しい条件
$condition = null;
if (!empty($conditions)) {
// 	$condition = implode('、', $conditions)."から";
    $condition = implode('/', $conditions);
}
?>
<body>
<?php
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/search/index']);
?>
<header class="datsumou-search-header">
    <div class="datsumou-search-header-inner"><a href="#"><i class="fas fa-chevron-left datsumou-search-header-arrow"></i></a>
        <div class="datsumou-search-header-input-area"><i class="fas fa-search datsumou-search-header-input-search"></i>
            <input class="datsumou-search-header-input" type="text" placeholder="サロン・クリニック名を…"><i class="fas fa-times-circle datsumou-search-header-input-cancel"></i>
        </div><a href="#"><img class="datsumou-search-header-twobar" src="/puril/images/img/datsumou/twobar.png"></a>
    </div>
</header>
<div class="content search-condition">
    <div class="search-condition-text"><?php echo $placeName;?> <?php echo $shopTypeVal;	?> <?php echo $condition;?></div>
    <div class="button-base search-condition-change"><i class="fas fa-search search-condition-change-icon"></i><a class="plain-link search-condition-change-text" href="#">条件変更</a></div>
</div>
<div class="content-base search-shop">
    <ul class="search-shop-list">
        <?php
        foreach ($shops as $shop) {
            ?>
            <li class="content search-shop-item"><a class="plain-link" href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $shop->shop_id], true);?>">
                    <h2 class="search-shop-title">
                        <div class="search-shop-title-text"><?php echo $shop->name;?></div>
                    </h2>
                    <div class="search-shop-title-sub"><?php
                        if (!empty($shop->station_name)) {
                            ?>
                            <?php
                            $nearStations = '';
                            foreach ($shop->station_name as $key => $stationName) {
                                $nearStations .= $this->Html->link($stationName, '/search/'.$shop->PrefData['url_text'].'/'. URLUtil::CITY. $shop->area_id[$key]. "/". URLUtil::STATION_G. $shop->station_g_cd[$key]);
                                $nearStations .= '/';
                            }
                            echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                            ?>
                            <?php
                        }
                        ?> / <a href="/datsumou/search/<?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE2); ?>">
                            <?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE); ?>
                        </a></div>

                    <div class="search-shop-photo-area">
                        <?php
                        $img_count = 0;
                        foreach ($shop->shop_images as $shopImage) {
                            $target = "";
                            if (!empty($shop->affiliate_page_url)) {
                                $url = $shop->affiliate_page_url;
                                $target = ' ';
                            } else {
                                $url = Router::url(['controller' => 'shops', 'action' => 'detail', $shop['shop_id']]) . "/";
                            }

                            if ($shopImage['priority'] > 4) {
                                break;
                            }
                            $imgUrl = Router::url("/shop_img/" . $shopImage['shop_image_id'], true);
                            ?>
                            <div class="search-shop-photo"><img src="<?php echo $imgUrl;?>" alt="<?php echo $shop->name;?>"></div>
                            <?php
                            $img_count++;
                            if($img_count > 2) {
                                break;
                            }
                        }
                        ?>
                        <?php while($img_count < 3):?>
                            <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>

                            <?php
                            $img_count++;
                        endwhile;?>
                    </div>
                    <!--                <div class="search-shop-tips">--><?php //echo $shop->description_subject;?><!--</div>-->
                    <div class="search-shop-label">
                        <div class="search-shop-review">
                            <div class="shop-star-area">
                                <div class="shop-star">
                                    <?php
                                    $star = empty($shop->star) ? 0 : $shop->star;
                                    $reviewCount = 0;
                                    while($reviewCount < $star):
                                        echo '<img src="/puril/images/img/star-on.png">';
                                        $reviewCount++;
                                    endwhile;
                                    ?>
                                    <?php
                                    while(5 - $reviewCount > 0):
                                        echo '<img src="/puril/images/img/star-off.png">';
                                        $reviewCount++;
                                    endwhile;
                                    ?>
                                </div>
                                <div class="shop-point"><?= number_format($star, 2) ?></div>
                            </div>
                            <?php
                            if ($shop->review_cnt > 0) {
                                ?>
                                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                                    <div class="shop-comment-count"><?php echo $shop->review_cnt; ?>件</div>
                                </div>
                            <?php } ?>
                        </div>
                        <!--                    <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>-->
                    </div>
                    <div class="search-shop-desc">
                        <h3 class="search-shop-desc-title"><?php echo $shop->description_subject;?></h3>
                        <div class="search-shop-desc-text">
                            <p><?= $shop->description_content?></p>
                        </div>
                    </div>
                    <div class="search-shop-info">
                        <table>
                            <tbody>
                            <tr>
                                <th>住所</th>
                                <td><?= $shop->address ?></td>
                            </tr>
                            <?php
                            if (!empty($shop->station_name)) {
                                ?>
                                <tr>
                                    <th>最寄り駅</th>
                                    <td>
                                        <?php
                                        $nearStations = '';
                                        foreach ($shop->station_name as $key => $stationName) {
                                            $nearStations .= $this->Html->link($stationName, '/search/'.$shop->PrefData['url_text'].'/'. URLUtil::CITY. $shop->area_id[$key]. "/". URLUtil::STATION_G. $shop->station_g_cd[$key]);
                                            $nearStations .= '、';
                                        }
                                        echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            if (!empty($shop['business_hours'])) { ?>
                            <tr>
                                <th>営業時間</th>
                                <td><?php echo $shop['business_hours']; ?></td>
                            </tr>

                                <?php
                            }
                            if (!empty($shop['holiday'])) { ?>
                            <tr>
                                <th>定休日</th>
                                <td><?php echo $shop['holiday']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<div class="content-base search-shop-best">
    <ul class="search-shop-best-list">
        <li class="search-shop-best-item"><a class="plain-link" href="/datsumou/brand/">
                <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-first"></i>
                    <div class="search-shop-best-rank-point">4.25</div>
                </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/kireimo.png" alt="キレイモ">
                <div class="search-shop-best-name">キレイモ</div></a></li>
        <li class="search-shop-best-item"><a class="plain-link" href="#">
                <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-second"></i>
                    <div class="search-shop-best-rank-point">3.96</div>
                </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/musee.png" alt="ミュゼプラチナム">
                <div class="search-shop-best-name">ミュゼプラチナム</div></a></li>
        <li class="search-shop-best-item"><a class="plain-link" href="#">
                <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-third"></i>
                    <div class="search-shop-best-rank-point">3.91</div>
                </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/stlassh.png" alt="STLASSH">
                <div class="search-shop-best-name">STLASSH</div></a></li>
    </ul>
    <div class="search-shop-ranking"><a class="button-base search-shop-rainking-button" href="#">ランキングを見る</a></div>
</div>
<nav class="content-base breadcrumbs"><i class="fas fa-home home-icon"></i>
    <ul class="breadcrumbs-list">
        <li><a href="<?=Router::url('/')?>">ホーム</a></li>
        <li><a href="<?=Router::url('/datsumou')?>">脱毛</a></li>
        <li><a href="<?=Router::url('/'. URLUtil::SEARCH. "/")?>">全国の脱毛施設</a></li>
        <?php
        $i = 1;
        $pankzuCnt = count($pankuzus);
        foreach ($pankuzus as  $pankuzu) {
            if ($i == $pankzuCnt) {

                ?>
                <span class="breaditem"><span><?php echo $pankuzu['val']?></span></span>
                <?php
                continue;
            }
            ?>
            <li><a href="<?=$pankuzu['url']. "/"?>"><?php echo $pankuzu['val']?></a></li>
            <?php
            $i++;
        }
        ?>
    </ul>
</nav>
<footer class="content datsumou-footer">
    <ul class="datsumou-footer-list">
        <li class="datsumou-footer-item active"><a href="/datsumou/search/"><i class="fas fa-search datsumou-footer-item-icon"></i>
                <div class="datsumou-footer-item-text">探す</div></a></li>
        <li class="datsumou-footer-item"><a href="#"><i class="fas fa-comments datsumou-footer-item-icon"></i>
                <div class="datsumou-footer-item-text">口コミ</div></a></li>
        <li class="datsumou-footer-item"><a href="/datsumou/ranking/"><i class="fas fa-crown datsumou-footer-item-icon"></i>
                <div class="datsumou-footer-item-text">ランキング</div></a></li>
    </ul>
</footer>
</body>