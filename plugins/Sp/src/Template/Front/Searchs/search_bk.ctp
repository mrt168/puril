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
    $placeName = $place;
} else if (!empty($prefCodes)) {
    $prefNames = [];
    foreach ($prefCodes as $prefCode) {
        array_push($prefNames, Pref::convert($prefCode, CodePattern::$VALUE));
    }

    if (!empty($prefNames)) {
        $placeName = implode('、', $prefNames);
    }
} else {
    $placeName = "全国";
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
    $condition = implode('、', $conditions);
}
?>

<div id="bread">
    <div class="inner cf">
        <span class="breaditem"><a href="<?=Router::url('/')?>"><span>Purilトップ</span></a></span>
        <span class="breaditem"><a href="<?=Router::url('/'. URLUtil::SEARCH. "/")?>"><span>全国の脱毛施設</span></a></span>
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
            <span class="breaditem"><a href="<?=$pankuzu['url']. "/"?>"><span><?php echo $pankuzu['val']?></span></a></span>
            <?php
            $i++;
        }
        ?>
    </div>
</div>
<div id="container">
    <?php
    echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);
    ?>
    <div class="inner">
        <?php
        if (!empty($shops)) {
            ?>
            <div class="search cf">
                <div class="cf maintit-wrap">
                    <h1 class="maintit">
                        <?php echo $placeName;?>の<?php echo $shopTypeVal;?>を<?php echo !empty($condition) ? $condition."から":"" ;?>探す
                    </h1>
                    <div class="counter">
                        <div class="counter_tbl">
                            <?php
                            for ($i = 0; $i < mb_strlen($resultCnt); $i++) {
                                $cntStr = mb_substr($resultCnt, $i, 1);
                                echo "<span class=\"num\">{$cntStr}</span>";
                            }
                            ?>
                        </div>
                        <span class="txt">件</span>
                    </div>
                </div>
                <?php
                if (!empty($prefCodes)) {
                    ?>
                    <?php
                    echo $this->element('Front/SearchResult/pc_map');
                    // 					echo $this->request->isMobile() ? $this->element('Front/SearchResult/sp_search') : "";
                }
                ?>
                <?php
                if ($this->request->isMobile()) {
                    echo !empty($shops) ? $this->element('Front/SearchResult/sp_search') : "";
                }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="undercontentwrap cf">
            <main id="maincolumn" class="search">
                <?php
                echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);
                ?>
                <?php
                if (!$this->request->isMobile()) {
                    echo !empty($shops) ? $this->element('Front/SearchResult/pc_search') : "";
                }
                if (!empty($shops) && empty($prefs)) {
// 						echo $this->element('Front/SearchResult/pc_search');
                    ?>
                    <div class="result_list type02">
                        <h2 class="commontit">
                            <?php
                            echo "<span class='pink'>".$placeName. "</span>の<span class='pink'>". $shopTypeVal."</span>";
                            echo !empty($condition) ? "、": "";
                            echo $condition;
                            ?>の検索結果
                            <span>
								<?php
                                echo $this->Paginator->counter('（{{count}}件中{{start}}件～{{end}}件）');
                                ?>
							</span>
                        </h2>
                        <ul class="tab cf pc">
                            <?php
                            $sort = empty($this->request->query('sort')) ? 'Shops.created' : $this->request->query('sort');
                            ?>
                            <?php /**
                            <li><?php echo $this->Html->link('新着順', '?direction=desc&sort=Shops.created', ['class'=> $sort == 'Shops.created' ? 'active' : '']);?></li>
                            <li><?php echo $this->Html->link('更新順', '?direction=desc&sort=Shops.modified', ['class'=> $sort == 'Shops.modified/' ? 'active' : '']);?></li>
                            <li><?php echo $this->Html->link('口コミ数', '?direction=desc&sort=Shops.review_cnt', ['class'=> $sort == 'Shops.review_cnt/' ? 'active' : '']);?></li>
                             */?>

                            <li><a href="?direction=desc&sort=Shops.created" class="<?php echo $sort == 'Shops.created' ? 'active' : ''?>">新着順</a></li>
                            <li><a href="?direction=desc&sort=Shops.modified" class="<?php echo $sort == 'Shops.modified' ? 'active' : ''?>">更新順</a></li>
                            <li><a href="?direction=desc&sort=Shops.review_cnt" class="<?php echo $sort == 'Shops.review_cnt' ? 'active' : ''?>">口コミ数</a></li>
                            <?php
                            $rankingUrl = str_replace(URLUtil::SEARCH, URLUtil::RANKING, Router::url(null,true));
                            ?>
                            <li><a href="<?=$rankingUrl?>" class="<?php echo $sort == 'Shops.star' ? 'active' : ''?>">ランキング</a></li>
                        </ul>
                        <div class="tab_wrap">
                            <!-- 							<div id="tab01" class="tab_box"> -->
                            <div id="tab01" class="">
                                <?php
                                foreach ($shops as $shop) {
                                    ?>
                                    <div class="pickup_box">
                                        <ul class="tag">
                                            <li><?=$this->Html->link(ShopType::convert($shop['shop_type'], CodePattern::$VALUE), '/search/'. ShopType::convert($shop['shop_type'], CodePattern::$VALUE2))?></li>
                                        </ul>
                                        <?= $this->Html->link($shop->name, ['controller'=> 'shop', 'detail', $shop->shop_id], ['class'=> 'shop', 'escape'=> false])?>
                                        <div class="count_box">
                                            <?php
                                            if (!empty($shop->star)) {
                                                ?>
                                                <div class="star_box">
                                                    <div class="star-rating-box">
                                                        <div class="empty-star">★★★★★</div>
                                                        <div class="filled-star" style=" width: <?php echo $shop->star * 20?>%;">
                                                            <?php
                                                            $star = empty($shop->star) ? 0 : $shop->star;
                                                            for ($i = 0; $i < abs($star); $i++) { echo '★';}
                                                            ?>.search .result_list .pickup_box
                                                        </div>
                                                    </div>
                                                    <span class="points"><?=number_format($star,2)?></span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            if ($shop->review_cnt > 0) {
                                                ?>
                                                <div class="review_box">
                                                    <p class="review_box_title"><?php echo $this->Html->image('/img/Shop/icon_comment.png', ['alt' => '口コミ']) ?><?php echo $shop->review_cnt; ?>件</p>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="detail_info">
                                            <div class="area_bread">
                                                <?=$this->Html->link($shop->PrefData['search_text'], '/search/'.$shop->PrefData['url_text'])?>
                                                ＞
                                                <?=$this->Html->link($shop->Area['name'], '/search/'.$shop->PrefData['url_text'].'/'. URLUtil::CITY. $shop->Area['area_id'])?>
                                            </div>

                                            <?php
                                            if (!empty($shop->station_name)) {
                                                ?>
                                                <div class="station">
                                                    <span>最寄駅</span>
                                                    <?php
                                                    $nearStations = '';
                                                    foreach ($shop->station_name as $key => $stationName) {
                                                        $nearStations .= $this->Html->link($stationName, '/search/'. ShopType::convert($shop['shop_type'], CodePattern::$VALUE2). "/". $shop->PrefData['url_text'].'/'. URLUtil::CITY. $shop->area_id[$key]. "/". URLUtil::STATION_G. $shop->station_g_cd[$key]);
                                                        $nearStations .= '、';
                                                    }
                                                    echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="add"><?=$shop->address?></div>
                                        </div>
                                        <div class="box_in cf">
                                            <?php
                                            if (!empty($shop->shop_images)) {
                                                $isAffiliate = false;
                                                ?>
                                                <div class="imgbox">
                                                    <div id="slide_scroll_<?php echo $shop->shop_id; ?>" class="sliderscrollwrap">
                                                        <?php
                                                        if (!empty($shop->affiliate_page_url) && !empty($shop->affiliate_banner_url)) {
                                                            $isAffiliate = true;
                                                            ?>
                                                            <a href="<?php echo $shop->affiliate_page_url?>"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><?php echo $this->Html->image($shop->affiliate_banner_url)?></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <ul>
                                                                <?php
                                                                foreach ($shop->shop_images as  $shopImage) {
                                                                    $target = "";
                                                                    if (!empty($shop->affiliate_page_url)) {
                                                                        $url = $shop->affiliate_page_url;
                                                                        $target = ' ';
                                                                    } else {
                                                                        $url = Router::url(['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']]). "/";
                                                                    }

                                                                    if ($shopImage['priority'] > 4) {
                                                                        break;
                                                                    }
                                                                    $imgUrl = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                    echo "<li><a href='{$url}'{$target}>".$this->Html->image($imgUrl)."</a></li>";
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div><!--/#flickscroll-->
                                                    <?php
                                                    if (count($shop->shop_images) > 1 && !$isAffiliate) {
                                                        ?>
                                                        <div id="slide_thumb_<?php echo $shop->shop_id; ?>" class="sliderthumbwrap">
                                                            <ul>
                                                                <?php
                                                                foreach ($shop->shop_images as  $shopImage) {
                                                                    if ($shopImage['priority'] > 4) {
                                                                        break;
                                                                    }
                                                                    $imgUrl = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                    echo '<li>'.$this->Html->image($imgUrl).'</li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(document).ready(function(){ sliderloocontent('#slide_scroll_<?php echo $shop->shop_id; ?>','#slide_thumb_<?php echo $shop->shop_id; ?>'); });
                                                        </script>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="txt_box">
                                                <div class="tit"><?=$shop->description_subject?></div>
                                                <div class="txt"><?=$shop->description_content?></div>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($shop->other_conditions)) {
                                            ?>
                                            <dl>
                                                <dt>こだわり条件</dt>
                                                <dd class="cf icon-flex">
                                                    <?php
                                                    foreach ($shop->other_conditions as $other_condition) {
                                                        echo $this->Html->image("/img/icon{$other_condition['other_condition_id']}_chara.png");
                                                    }
                                                    ?>
                                                </dd>
                                            </dl>
                                            <?php
                                        }
                                        ?>
                                        <div class="btn_box">
                                            <ul>
                                                <?php
                                                if (!empty($shop->affiliate_page_url)) {
                                                    ?>
                                                    <li class="btn green"><a href="<?=$shop->affiliate_page_url?>"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li class="btn orange"><?=$this->Html->link('施設詳細へ', ['controller'=> 'shop', 'detail', $shop['shop_id']], ['onclick'=> "gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"])?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }

                                if (!empty($addShops)) {
                                    ?>
                                    <div class="othermoreshop">
                                        <p>この条件でお探しの方は<br class="sp">こんな施設もご覧になっています</p>
                                    </div>
                                    <?php
                                    foreach ($addShops as $addShop) {
                                        ?>
                                        <div class="pickup_box">
                                            <ul class="tag">
                                                <li><?=$this->Html->link(ShopType::convert($addShop['shop_type'], CodePattern::$VALUE), '/search/'.$addShop['shop_type'])?></li>
                                            </ul>
                                            <?= $this->Html->link($addShop['name'], ['controller'=> 'shop', 'detail', $addShop['shop_id']], ['class'=> 'shop', 'escape'=> false])?>
                                            <?php
                                            if (!empty($addShop['star'])) {
                                                ?>
                                                <div class="star_box">
                                                    <div class="star-rating-box">
                                                        <div class="empty-star">☆☆☆☆☆</div>
                                                        <div class="filled-star" style=" width: <?php echo $addShop['star'] * 20?>%;">
                                                            <?php
                                                            $star = empty($addShop['star']) ? 0 : $addShop['star'];
                                                            for ($i = 0; $i < abs($star); $i++) { echo '★';}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <span class="points"><?=number_format($star,2)?></span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="detail_info">
                                                <div class="area_bread">
                                                    <?=$this->Html->link($addShop->PrefData['search_text'], '/search/'.$addShop->PrefData['url_text'].'/')?>
                                                    ＞
                                                    <?=$this->Html->link($addShop->Area['name'], '/search/'.$addShop->PrefData['url_text'].'/'. URLUtil::CITY. $addShop->Area['area_id'])?>
                                                </div>

                                                <?php
                                                if (!empty($addShop->station_name)) {
                                                    ?>
                                                    <div class="station">
                                                        <span>最寄駅</span>
                                                        <?php
                                                        $nearStations = '';
                                                        foreach ($addShop->station_name as $key => $stationName) {
                                                            $nearStations .= $this->Html->link($stationName, '/search/'.$addShop->PrefData['url_text'].'/'. URLUtil::CITY. $addShop->area_id[$key]. "/". URLUtil::STATION_G. $addShop->station_g_cd[$key]);
                                                            $nearStations .= '、';
                                                        }
                                                        echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="add"><?=$addShop->address?></div>
                                            </div>
                                            <div class="box_in cf">
                                                <?php
                                                if (!empty($addShop->shop_images)) {
                                                    ?>
                                                    <div class="imgbox">
                                                        <div id="slide_scroll_<?php echo $addShop->shop_id; ?>" class="sliderscrollwrap">
                                                            <ul>
                                                                <?php
                                                                foreach ($addShop->shop_images as  $shopImage) {
                                                                    if ($shopImage['priority'] > 4) {
                                                                        break;
                                                                    }
                                                                    $url = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                    echo '<li>'.$this->Html->image($url).'</li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div><!--/#flickscroll-->
                                                        <?php
                                                        if (count($addShop->shop_images) > 1) {
                                                            ?>
                                                            <div id="slide_thumb_<?php echo $addShop->shop_id; ?>" class="sliderthumbwrap">
                                                                <ul>
                                                                    <?php
                                                                    foreach ($addShop->shop_images as  $shopImage) {
                                                                        if ($shopImage['priority'] > 4) {
                                                                            break;
                                                                        }
                                                                        $url = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                        echo '<li>'.$this->Html->image($url).'</li>';
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $(document).ready(function(){ sliderloocontent('#slide_scroll_<?php echo $addShop->shop_id; ?>','#slide_thumb_<?php echo $addShop->shop_id; ?>'); });
                                                            </script>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="txt_box">
                                                    <div class="tit"><?=$addShop->description_subject?></div>
                                                    <div class="txt"><?=$addShop->description_content?></div>
                                                    <?php
                                                    if (!empty($addShop->other_conditions)) {
                                                        ?>
                                                        <dl>
                                                            <dt>こだわり条件</dt>
                                                            <dd class="cf icon-flex">
                                                                <?php
                                                                foreach ($addShop->other_conditions as $other_condition) {
                                                                    echo $this->Html->image("/img/icon{$other_condition['other_condition_id']}_chara.png");
                                                                }
                                                                ?>
                                                            </dd>
                                                        </dl>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="btn_box">
                                                <ul>
                                                    <?php
                                                    if (!empty($addShop->affiliate_page_url)) {
                                                        ?>
                                                        <li class="btn green"><a href="<?=$addShop->affiliate_page_url?>" >公式サイトへ</a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li class="btn orange"><?=$this->Html->link('施設詳細へ', ['controller'=> 'shop', 'detail', $addShop['shop_id']])?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="pager">
                            <div class="pagenation pagenation-hover">
                                <div class="pagenation-prev">
                                    <?php
                                    $getUrl = null;
                                    if (!empty($_GET)) {
                                        foreach ($_GET as $key => $get) {
                                            if ($key == "page") {
                                                continue;
                                            }
                                            $getUrl .= "&". $key. "=". $get;
                                        }
                                    }

                                    if ($this->Paginator->hasPrev()) {
                                        echo $this->Paginator->prev('前の20件', ['class'=> 'prev', 'tag'=> 'div']);
                                    }
                                    ?>
                                </div>
                                <?php
                                $pageCnt = $this->Paginator->param('pageCount');
                                if ($pageCnt > 1) {
                                    ?>
                                    <div class="pagenation-page-list-wrap">
                                        <ul class="pagenation-page-list-all">
                                            <li class="pagenation-page-list-current">
                                                <ul class="pagenation-page-list">
                                                    <?php
                                                    for($i=1; $i<=ceil($pageCnt/PagingUtil::FRON_PAGINATE); $i++) {
                                                        if ($this->Paginator->current() <= $i*PagingUtil::FRON_PAGINATE) {
                                                            $lineCnt = $i;
                                                            break;
                                                        }
                                                    }

                                                    $page = ($lineCnt-1)*PagingUtil::FRON_PAGINATE + 1;
                                                    $maxPage = $lineCnt*PagingUtil::FRON_PAGINATE;

                                                    for ($i=$page; $i<=$maxPage; $i++) {
                                                        $url = Router::url(null,true). "?page={$i}".$getUrl;

                                                        if ($i > $pageCnt) {
                                                            echo "<span class='page-numbers'></span>";
                                                        } else if ($i != $this->Paginator->current()) {
                                                            ?>
                                                            <li class="page-numbers"><a href="<?=$url?>"><?=$i?></a></li>
                                                            <?php
                                                        } else {
                                                            echo "<span class='page-numbers active'>{$i}</span>";
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                            if ($this->Paginator->current() > PagingUtil::FRON_PAGINATE) {
                                                ?>
                                                <li class="pagenation-page-list-before">
                                                    <ul class="pagenation-page-list">
                                                        <?php
                                                        $maxPage = $lineCnt*PagingUtil::FRON_PAGINATE-PagingUtil::FRON_PAGINATE;
                                                        for ($i=1; $i<=$maxPage; $i++) {
                                                            $url = Router::url(null,true). "?page={$i}".$getUrl;
                                                            ?>
                                                            <li class="page-numbers"><a href="<?=$url?>"><?=$i?></a></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <li class="pagenation-page-list-after">
                                                <ul class="pagenation-page-list">
                                                    <?php
                                                    $page = ($lineCnt-1)*PagingUtil::FRON_PAGINATE + 1 + PagingUtil::FRON_PAGINATE;
                                                    for ($i=$page; $i<=$pageCnt; $i++) {
                                                        $url = Router::url(null,true). "?page={$i}".$getUrl;
                                                        ?>
                                                        <li class="page-numbers"><a href="<?=$url?>"><?php echo $i?></a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>

                                    <?php
                                }
                                ?>
                                <div class="pagenation-next">
                                    <?php
                                    if ($this->Paginator->hasNext()) {
                                        echo $this->Paginator->next('次の20件', ['class'=> 'next', 'tag'=> false]);
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="ad_banner_area pc">
                            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_1080200.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
                        </div>
                        <div class="ad_banner_area sp">
                            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_600500.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
                        </div>
                    </div>
                    <?php
                } else if (empty($prefs))  {
                    ?>
                    <div class="result_list none cf">
                        <h1 class="maintit result_none">
                            <span class="area"><?php echo $placeName;?></span>
                            <span class="small">の</span>
                            <span class="facility"><?php echo $shopTypeVal;	?></span>
                            <span class="small">を<?php echo $condition;?>探す</span>
                        </h1>
                        <p class="result_text">
                            ■
                            <?php
                            if (empty($prefCodes)) {
                                $prefCodes = ["全国"];
                            }
                            if (!empty($place)) {
                                $prefCodes = [$placeName];
                            }
                            foreach ($prefCodes as $prefCode) {
                                echo "<span class='area'>". Pref::convert($prefCode, CodePattern::$VALUE). "</span>";
                            }
                            if (!empty($conditions)) {
                                $condition = [];
                                foreach ($conditions as $condition) {
                                    $condition = implode('、</span><span class="facility">', $conditions);
                                }
                                echo "、<span class='facility'>". $condition. "</span>";
                            }
                            ?>
                            の<?php echo $shopTypeVal?>の検索結果（0件）
                        </p>
                        <div class="textarea">
                            ご指定の検索条件では該当がありませんでした。<br>
                            大変お手数ですが、再度検索条件をご指定いただけますと幸いです。
                        </div>
                        <div class="form_btn"><input type="submit" value="再度条件を指定する！"></div>
                        <div class="othermoreshop">
                            <p>この条件でお探しの方は<br class="sp">こんな施設もご覧になっています</p>
                        </div>
                        <div class="tab_wrap">
                            <div id="tab01" class="tab_box">
                                <?php
                                foreach ($addShops as $addShop) {
                                    ?>
                                    <div class="pickup_box">
                                        <ul class="tag">
                                            <li><?=$this->Html->link(ShopType::convert($addShop['shop_type'], CodePattern::$VALUE), '/search/'. ShopType::convert($addShop['shop_type'], CodePattern::$VALUE2))?></li>
                                        </ul>
                                        <?= $this->Html->link($addShop['name'], ['controller'=> 'shop', 'detail', $addShop['shop_id']], ['class'=> 'shop', 'escape'=> false])?>
                                        <?php
                                        if (!empty($addShop['star'])) {
                                            ?>
                                            <div class="star_box">
                                                <div class="star-rating-box">
                                                    <div class="empty-star">☆☆☆☆☆</div>
                                                    <div class="filled-star" style=" width: <?php echo $addShop['star'] * 20?>%;">
                                                        <?php
                                                        $star = empty($addShop['star']) ? 0 : $addShop['star'];
                                                        for ($i = 0; $i < abs($star); $i++) { echo '★';}
                                                        ?>
                                                    </div>
                                                </div>
                                                <span class="points"><?=number_format($star,2)?></span>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="detail_info">
                                            <div class="area_bread">
                                                <?=$this->Html->link($addShop->PrefData['search_text'], '/search/'.$addShop->PrefData['url_text'].'/')?>
                                                ＞
                                                <?=$this->Html->link($addShop->Area['name'], '/search/'.$addShop->PrefData['url_text'].'/'. URLUtil::CITY. $addShop->Area['area_id'])?>
                                            </div>

                                            <?php
                                            if (!empty($addShop->station_name)) {
                                                ?>
                                                <div class="station">
                                                    <span>最寄駅</span>
                                                    <?php
                                                    $nearStations = '';
                                                    foreach ($addShop->station_name as $key => $stationName) {
                                                        $nearStations .= $this->Html->link($stationName, '/search/'. ShopType::convert($addShop['shop_type'], CodePattern::$VALUE2). "/". $addShop->PrefData['url_text'].'/'. URLUtil::CITY. $addShop->area_id[$key]. "/". URLUtil::STATION_G. $addShop->station_g_cd[$key]);
                                                        $nearStations .= '、';
                                                    }
                                                    echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="add"><?=$addShop->address?></div>
                                        </div>
                                        <div class="box_in cf">
                                            <?php
                                            if (!empty($addShop->shop_images)) {
                                                ?>
                                                <div class="imgbox">
                                                    <div id="slide_scroll_<?php echo $addShop->shop_id; ?>" class="sliderscrollwrap">
                                                        <ul>
                                                            <?php
                                                            foreach ($addShop->shop_images as  $shopImage) {
                                                                if ($shopImage['priority'] > 4) {
                                                                    break;
                                                                }
                                                                $url = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                echo '<li>'.$this->Html->image($url).'</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div><!--/#flickscroll-->
                                                    <?php
                                                    if (count($addShop->shop_images) > 1) {
                                                        ?>
                                                        <div id="slide_thumb_<?php echo $addShop->shop_id; ?>" class="sliderthumbwrap">
                                                            <ul>
                                                                <?php
                                                                foreach ($addShop->shop_images as  $shopImage) {
                                                                    if ($shopImage['priority'] > 4) {
                                                                        break;
                                                                    }
                                                                    $url = Router::url("/shop_img/".$shopImage['shop_image_id'], true);
                                                                    echo '<li>'.$this->Html->image($url).'</li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <script type="text/javascript">
                                                            $(document).ready(function(){ sliderloocontent('#slide_scroll_<?php echo $addShop->shop_id; ?>','#slide_thumb_<?php echo $addShop->shop_id; ?>'); });
                                                        </script>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="txt_box">
                                                <div class="tit"><?=$addShop->description_subject?></div>
                                                <div class="txt"><?=$addShop->description_content?></div>
                                                <?php
                                                if (!empty($addShop->other_conditions)) {
                                                    ?>
                                                    <dl>
                                                        <dt>こだわり条件</dt>
                                                        <dd class="cf icon-flex">
                                                            <?php
                                                            foreach ($addShop->other_conditions as $other_condition) {
                                                                echo $this->Html->image("/img/icon{$other_condition['other_condition_id']}_chara.png");
                                                            }
                                                            ?>
                                                        </dd>
                                                    </dl>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="btn_box">
                                            <ul>
                                                <?php
                                                if (!empty($addShop->affiliate_page_url)) {
                                                    ?>
                                                    <li class="btn green"><a href="<?=$addShop->affiliate_page_url?>" >公式サイトへ</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li class="btn orange"><?=$this->Html->link('施設詳細へ', ['controller'=> 'shop', 'detail', $addShop['shop_id']])?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div id="shopdetailwrap">
                    <div class="listwrap_introduce">
                        <?php
                        if ($this->Paginator->current() <= 1 && !empty($htmls)) {
                            foreach ($htmls as $html) {
                                echo $html;
                            }
                        }
                        /*
                        ?>
                        <h3 class="coomontit_h3">脱毛サロンをお探しの方へ</h3>
                        <div class="pr_box">
                            <?= $this->Html->image('/img/image_empty.jpg', ['class'=> 'pc'])?>
                            <?= $this->Html->image('/img/image_empty_sp.jpg', ['class'=> 'sp'])?>
                            <div class="textarea">
                                テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                            </div>
                        </div>
                        */
                        ?>
                    </div>
                </div>
                <?php /*
					<div class="ad_banner_area pc"><?= $this->Html->image('/img/shop_dt_adbanner_pc.png')?></div>
					<div class="ad_banner_area sp"><?= $this->Html->image('/img/shop_dt_adbanner_sp.png')?></div>
					*/ ?>
                <?php
                if (!empty($prefs)) {
                    ?>
                    <div class="published_wrap">
                        <h2 class="tit"><?php echo $shopTypeVal?>の都道府県別掲載数</h2>
                        <div class="tbl">
                            <table>
                                <tbody>
                                <tr>
                                    <th>都道府県</th>
                                    <th>全身脱毛</th>
                                    <th>部分脱毛</th>
                                </tr>
                                <?php
                                $shopTypeUrl = "";
                                if (count($this->request->data['Make']['shop_type']) < 2) {
                                    $shopTypeUrl = "/". ShopType::convert($this->request->data['Make']['shop_type'][0], CodePattern::$VALUE2);
                                } else {
                                    $shopTypeUrl = "/". ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]. "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
                                }
                                foreach ($prefs as $pref) {
                                    $prefUrl = Router::url("/". URLUtil::SEARCH. "/". $pref['url_text']. $shopTypeUrl, true);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $this->Html->link(Pref::convert($pref['pref'], CodePattern::$VALUE), $prefUrl);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($pref['all_cnt'] > 0) {

                                                echo $this->Html->link($pref['all_cnt'].'件', $prefUrl. "/". $zenshin_url);
                                            } else {
                                                echo $pref['all_cnt']. "件";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($pref['parts_cnt'] > 0) {
                                                echo $this->Html->link($pref['parts_cnt'].'件', $prefUrl. "/". URLUtil::PARTS_DEPILATION);
                                            } else {
                                                echo $pref['parts_cnt']. "件";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php
                echo $this->ExForm->end();
                ?>
            </main>
            <?= $this->element('Front/SearchResult/side')?>
        </div><!--/.undercontentwrap-->
        <?php
        echo $this->ExForm->end();
        ?>
    </div><!--/.inner-->

</div><!--/#container-->

