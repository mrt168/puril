<?php
use App\Vendor\PagingUtil;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\URLUtil;
use PHP_CodeSniffer\Tokenizers\PHP;
use App\Vendor\Code\Pref;
use App\Vendor\Code\Sex;
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
    $condition = implode('、', $conditions);
}
?>

<div id="bread">
    <div class="inner cf">
        <span class="breaditem"><a href="<?=Router::url('/')?>"><span>Purilトップ</span></a></span>
        <span class="breaditem"><a href="<?=Router::url('/'. URLUtil::RANKING. "/")?>"><span>全国の脱毛施設の口コミランキング</span></a></span>
        <?php
        if (!empty($pankuzus)) {
            $i = 1;
            $pankzuCnt = count($pankuzus);
            foreach ($pankuzus as  $pankuzu) {
                if ($i == $pankzuCnt) {

                    ?>
                    <span class="breaditem"><span><?php echo $pankuzu['val']?>口コミランキング</span></span>
                    <?php
                    continue;
                }
                ?>
                <span class="breaditem"><a href="<?=$pankuzu['url']. "/"?>"><span><?php echo $pankuzu['val']?></span></a></span>
                <?php
                $i++;
            }
        }
        ?>
    </div>
</div>
<div id="container">
    <div class="inner">
        <div class="undercontentwrap cf">
            <main id="maincolumn" class="search ranking">
                <div class="cf">
                    <h1 class="maintit">
                        <span class="area"><?php echo $placeName;?></span>
                        <span class="small">の</span>
                        <span class="facility"><?php echo $shopTypeVal;	?></span>
                        <span class="small">を<?php echo !empty($condition) ? $condition."の":"" ;?>口コミランキングから探す</span>
                    </h1>
                    <div class="counter">
                        <div class="counter_tbl">
                            <?php
                            $shopCnt = $this->Paginator->param('count');
                            for ($i = 0; $i < mb_strlen($shopCnt); $i++) {
                                $cntStr = mb_substr($shopCnt, $i, 1);
                                echo "<span class=\"num\">{$cntStr}</span>";
                            }
                            ?>
                        </div>
                        <span class="txt">件</span>
                    </div>
                </div>
                <div class="main_img">
                    <?php
                    $mainImgPath = "";
                    $alt = "";
                    $url = strstr(Router::url(), URLUtil::RANKING);

                    if(strpos($url, ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]) !== false){
                        if(strpos($url, ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) === false){
                            $mainImgPath = "/img/ranking_main_img_salon.jpg";
                            $alt = "脱毛サロンの口コミ人気ランキング";
                        }
                    }

                    if(strpos($url, ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) !== false){
                        if(strpos($url, ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]) === false){
                            $mainImgPath = "/img/ranking_main_img_iryou.jpg";
                            $alt = "医療脱毛クリニックの口コミ人気ランキング";
                        }
                    }

                    if(strpos($url, "mens") !== false){
                        $mainImgPath = "/img/ranking_main_img_men.jpg";
                        $alt = "メンズ脱毛の口コミ人気ランキング";
                    }

                    if (empty($mainImgPath)) {
                        $mainImgPath = "/img/ranking_main_img_sougou.jpg";
                        $alt = "全国の脱毛サロン・医療脱毛クリニックの口コミ人気総合ランキング";
                    }

                    echo $this->Html->image($mainImgPath, ['alt'=> $alt]);
                    ?>
                </div>
                <?php
                if ($this->request->isMobile() && $this->request->action !== 'brandRanking') {
                    echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);
                    echo !empty($shops) ? $this->element('Front/SearchResult/sp_search') : "";
                    echo $this->ExForm->end();
                }

                if ($this->request->action != 'brandRanking') {
                    ?>
                    <div id="pcsearch" class="search_wrap pc">
                        <h2 class="tit">条件を入力して、ジブンにピッタリの脱毛サロン・クリニックを見つけましょう！</h2>
                        <?=$this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);?>
                        <div class="search_inner">
                            <div class="check_box">
                                <h3 class="sub_tit">施設の種類で絞り込む</h3>
                                <ul class="cf">
                                    <?php
                                    echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']], true, URLUtil::RANKING);
                                    ?>
                                </ul>
                            </div>
                            <div class="check_box w20 slide">
                                <?php
                                if (empty($this->request->data['Make']['pref'])) {
                                    ?>
                                    <h3 class="sub_tit">都道府県で絞り込む</h3>
                                    <?=$this->ExForm->byRegion('Make.pref', [], true, URLUtil::RANKING); ?>
                                    <?php
                                } else {
                                    echo $this->element('Front/area_link', ['prefCodes'=> $this->request->data['Make']['pref']]);
                                }
                                ?>
                            </div>
                            <div class="form_btn"><input type="submit" name="ranking_search" id="kono-tiao-jiande-jian-suo" value="この条件で検索！"></div>
                        </div>
                        <div class="more_btn pc"><span>さらに条件を絞って探す</span></div>
                        <div class="more_btn_sp sp"><span>さらに詳しい条件で絞る</span></div>
                        <div class="search_inner slide_down active" style="display: none;">
                            <div class="modal-content">
                                <div class="md_inner">
                                    <div class="depilation_site pc check_box w33">
                                        <h3 class="sub_tit">脱毛部位</h3>
                                        <ul class="prt cf">
                                            <?=$this->ExForm->depilationSiteCnt('Make.depilation_site_id.', null, true, $searchWheres, URLUtil::RANKING);?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">価格</h3>
                                        <ul class="cf">
                                            <?=$this->ExForm->priceCnt('Make.price_id.', null, true, $searchWheres, URLUtil::RANKING);?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">支払い方法</h3>
                                        <ul class="cf">
                                            <?=$this->ExForm->paymentCnt('Make.payment_id.', null, true, $searchWheres, URLUtil::RANKING);?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">特典・割引</h3>
                                        <ul class="cf">
                                            <?=$this->ExForm->discountCnt('Make.discount_id', null, true, $searchWheres, URLUtil::RANKING);?>
                                        </ul>
                                    </div>
                                    <div class="check_box w50">
                                        <h3 class="sub_tit">その他こだわり</h3>
                                        <?=
                                        $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
                                            'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']
                                        ], true, $searchWheres, URLUtil::RANKING);
                                        ?>
                                    </div>
                                </div>
                                <div class="form_btn">
                                    <?=$this->ExForm->input('この条件で検索！', ['name'=> 'ranking_search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);?>
                                </div>
                            </div>
                        </div>
                        <?=$this->ExForm->end();?>
                    </div>
                    <?php
                }
                ?>
                <div class="result_list" id="result_list">
                    <h2 class="commontit">
                        <?php
                        echo $placeName. "の". $shopTypeVal;
                        echo !empty($condition) ? "、": "";
                        echo $condition;
                        ?>の口コミランキング一覧
                        <span>
							<?php
                            echo $this->Paginator->counter('（{{count}}件中{{start}}件～{{end}}件）');
                            ?>
							</span>
                    </h2>
                    <ul class="tab cf">
                        <?php
                        $active = "shop";
                        if ($this->request->action == "brandRanking") {
                            $active = "brand";
                        }
                        ?>
                        <li><?=$this->Html->link('店舗ランキング', ['controller'=> 'rankings', 'action'=> 'index'], $active == "shop" ? ['class'=> 'active'] : []);?></li>
                        <li><?=$this->Html->link('ブランドランキング', ['controller'=> 'rankings', 'action'=> 'brandRanking'], $active == "brand" ? ['class'=> 'active'] : []);?></li>
                        <?php
                        // TODO サロン,クリニック,メンズでURLを分ける？
                        // 							$monthRankingUrl = "?".URLUtil::MONTH_RANKING_PARA."=desc";
                        $monthRankingUrl = "https://puril.net/column/lp/salon-manual/";
                        ?>
                        <li><a href="<?=$monthRankingUrl?>" target="_blank">月間ランキング</a></li>
                    </ul>
                    <?php
                    if ($this->request->action !== 'brandRanking') {
                        $to_salonlist_name = $placeName. "の". $shopTypeVal;
                        $to_salonlist_name .= !empty($condition) ? "、": null;
                        $to_salonlist_name .= $condition;

                        $searchUrl = str_replace(URLUtil::RANKING, URLUtil::SEARCH, Router::url(null,true));
                        ?>
                        <a href="<?=$searchUrl?>" class="to_salonlist">
                            <?=$to_salonlist_name?>一覧へ
                        </a>
                        <?php
                    }
                    ?>
                    <div class="tab_wrap">
                        <div id="tab01" class="">
                            <?php
                            foreach ($shops as $key => $shop) {
                                if (!$isBrandRanking) {
                                    ?>
                                    <div class="pickup_box">
                                        <ul class="tag">
                                            <li><?=$this->Html->link(ShopType::convert($shop['shop_type'], CodePattern::$VALUE), ['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)])?></li>
                                        </ul>
                                        <div class="salon_name">
                                            <?php
                                            $rank = $key+1;

                                            if ($this->Paginator->current() > 1) {
                                                $addPank = PagingUtil::FRON_SEARCH * ($this->Paginator->current() - 1);
                                                $rank = $rank+$addPank;
                                            }

                                            if ($rank<=3) {
                                                ?>
                                                <span class="rank_icon"><?=$this->Html->image("/img/rank{$rank}.png", ['alt'=>""])?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="rank_icon"><?=$this->Html->image('/img/rank_other.png', ['alt'=> ""])?><span class="no"><?=$rank?></span></span>
                                                <?php
                                            }

                                            $url = ['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']];
                                            echo $this->Html->link($shop['name'], $url, ['class'=> 'shop']);
                                            ?>
                                        </div>
                                        <div class="detail_info">
                                            <div class="area_bread">
                                                <?=$this->Html->link($shop['PrefData']['search_text'], ['controller'=> 'rankings', 'action'=> 'search', $shop['PrefData']['url_text']])?>
                                                ＞
                                                <?=$this->Html->link($shop['Area']['name'], ['controller'=> 'rankings', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY. $shop['Area']['area_id']])?>
                                            </div>
                                            <?php
                                            if (!empty($shop['station_name'])) {
                                                ?>
                                                <div class="station">
                                                    <span>最寄駅</span>
                                                    <?php
                                                    $nearStations = '';
                                                    foreach ($shop['station_name'] as $key => $stationName) {
                                                        $nearStations .= $this->Html->link($stationName, ['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2), $shop->PrefData['url_text'], URLUtil::CITY. $shop['area_id'][$key], URLUtil::STATION_G. $shop['station_g_cd'][$key]]);
                                                        $nearStations .= '、';
                                                    }
                                                    echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="add"><?=$shop['address']?></div>
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
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="txt_box">
                                                <div class="tit"><?=$shop->description_subject?></div>
                                                <div class="count_box">
                                                    <div class="star_box">
                                                        <div class="star-rating-box">
                                                            <div class="empty-star">☆☆☆☆☆</div>
                                                            <div class="filled-star" style=" width: <?php echo $shop->star * 20?>%;">★★★★★</div>
                                                        </div>
                                                        <span class="points"><?=number_format($shop->star,2)?></span>
                                                    </div>
                                                    <?php
                                                    if ($shop->review_cnt > 0) {
                                                        ?>
                                                        <div class="review_box">
                                                            <p class="review_box_title"><?php echo $this->Html->image('/img/Shop/icon_comment.png', ['alt' => '口コミ']) ?><?php echo $shop->review_cnt; ?>件</p>
                                                        </div>
                                                    <?php } ?>
                                                </div>
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
                                                <li class="btn orange">
                                                    <?php
                                                    echo $this->Html->link('施設詳細へ', ['controller'=> 'shop', 'detail', $shop['shop_id']], ['onclick'=> "gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"]);
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="pickup_box type02">
                                        <ul class="tag">
                                            <li><?=$this->Html->link(ShopType::convert($shop['shop_type'], CodePattern::$VALUE), ['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)])?></li>
                                        </ul>
                                        <div class="salon_name">
                                            <?php
                                            $rank = $key+1;
                                            if ($this->Paginator->current() > 1) {
                                                $addPank = PagingUtil::FRON_SEARCH * ($this->Paginator->current() - 1);
                                                $rank = $rank+$addPank;
                                            }
                                            if ($rank<=3) {
                                                ?>
                                                <span class="rank_icon"><?=$this->Html->image("/img/rank{$rank}.png", ['alt'=>""])?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="rank_icon"><?=$this->Html->image('/img/rank_other.png', ['alt'=> ""])?><span class="no"><?=$rank?></span></span>
                                                <?php
                                            }
                                            echo $this->Html->link($shop['name'], ['controller'=> 'brands', 'action'=> 'detail', $shop['brand_id']], ['class'=> 'shop']);
                                            ?>
                                        </div>
                                        <div class="detail_info">
                                            <div class="star_box">
                                                <div class="star-rating-box">
                                                    <div class="empty-star">☆☆☆☆☆</div>
                                                    <div class="filled-star" style=" width: <?php echo $shop['star'] * 20?>%;">★★★★★</div>
                                                </div>
                                                <span class="points"><?=number_format($shop['star'],2)?></span>
                                            </div>
                                            <div class="review_allnum">
                                                <?php
                                                $reviewIndexUrl = Router::url(['controller'=> 'brands', 'action'=> 'reviewIndex', 'brand_id'=> $shop['brand_id']]);
                                                ?>
                                                <a href="<?=$reviewIndexUrl?>/">（口コミ数<?=$shop['review_cnt']?>件）</a>
                                            </div>
                                            <div class="add">登録店舗数<?=$shop['shop_cnt']?>件</div>
                                        </div>
                                        <?php
                                        if (!empty($shop['image_path'])) {
                                            ?>
                                            <div class="brandimg">
                                                <?php
                                                if (!empty($shop['affiliate_page_url'])) {
                                                    $imgLink = $shop['affiliate_page_url'];
                                                } else {
                                                    $imgLink = Router::url(['controller'=> 'brands', 'action'=> 'detail', $shop['brand_id']]). "/";
                                                }
                                                ?>
                                                <a href="<?=$imgLink?>"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                    <?=$this->Html->image(['controller'=> 'images', 'action'=> 'brandImage', $shop['brand_id']]);?>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="btn_box">
                                            <ul>
                                                <?php
                                                if (!empty($shop['affiliate_page_url'])) {
                                                    ?>
                                                    <li class="btn green"><a href="<?=$shop['affiliate_page_url']?>"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a></li>
                                                    <?php
                                                }
                                                ?>
                                                <li class="btn orange"><a href="<?=Router::url(['controller'=> 'brands', 'action'=> 'detail', $shop['brand_id']])?>/" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">施設詳細へ</a></li>
                                            </ul>
                                        </div>
                                        <dl>
                                            <dt>新着の口コミ</dt>
                                            <dd>
                                                <div class="reviewslist_wrap">
                                                    <?php
                                                    foreach ($shop['reviews'] as $key => $review) {
                                                        $hideClass = "";
                                                        if ($key >= 1) {
                                                            $hideClass = " moreview hide";
                                                        }
                                                        ?>
                                                        <div class="itembox<?=$hideClass?>">
                                                            <div class="titlearea cf">
                                                                <div class="shopnamebox">
                                                                    <a href="<?=Router::url(['controller'=> 'shops', 'action'=> 'detail', $review['Shop']['shop_id']])?>/"><?=$review['Shop']['name']?>[<?=Pref::convert($review['Shop']['pref'], CodePattern::$VALUE)?>]</a>
                                                                </div>
                                                                <div class="titbox cf">
                                                                    <div class="usericon">
                                                                        <?php
                                                                        $imgPath = "/img/reviews_icon_";
                                                                        if ($review['sex'] == Sex::$MAN[CodePattern::$CODE]) {
                                                                            $imgPath .= Sex::$MAN[CodePattern::$VALUE2];
                                                                        } else {
                                                                            $imgPath .= Sex::$WOMAN[CodePattern::$VALUE2];
                                                                        }
                                                                        if ($review['evaluation'] < 3) {
                                                                            $imgPath .= "_b";
                                                                        } else if ($review['evaluation'] >= 3 && $review['evaluation'] < 4) {
                                                                            $imgPath .= "_n";
                                                                        } else {
                                                                            $imgPath .= "_g";
                                                                        }
                                                                        $imgPath .= ".png";
                                                                        echo $this->Html->image($imgPath, ['alt'=> $review['nickname']]);
                                                                        ?>
                                                                    </div>
                                                                    <div class="namewrap">
                                                                        <div class="name"><?=$review['nickname']?></div>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">☆☆☆☆☆</div>
                                                                                <div class="filled-star" style=" width: <?=$review['evaluation'] * 20?>%;">★★★★★</div>
                                                                            </div>
                                                                            <span class="points"><?=$review['evaluation']?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <ul class="snsarea cf">
                                                                    <?php if (!empty($review['instagram_account'])) {?>
                                                                        <li><a href="https://www.instagram.com/<?=$review['instagram_account']?>" target="_blank"><?php echo $this->Html->image('/img/auther_icon_inst.png', ['alt'=> ''])?></a></li>
                                                                    <?php }?>
                                                                    <?php if (!empty($review['twitter_account'])) {?>
                                                                        <li><a href="https://twitter.com/<?=$review['twitter_account']?>" target="_blank"><?php echo $this->Html->image('/img/auther_icon_twt.png', ['alt'=> ''])?></a></li>
                                                                    <?php }?>
                                                                </ul>
                                                            </div>
                                                            <div class="contentwrap">
                                                                <div class="tit"><?=$review['title']?></div>
                                                                <div class="txtarea"><?=$review['content']?></div>
                                                                <div class="underbox cf">
                                                                    <div class="cntlbtn">
                                                                        <?php
                                                                        echo $this->Html->link('詳細はこちら',['controller'=> 'brands', 'action'=> 'detail', $shop['brand_id']],['class'=> 'btn']);
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    $hideClass = " moreview hide";
                                                    if (count($shop['reviews']) > 1) {
                                                        ?>
                                                        <div class="morebtn">
                                                            <a href=""><span>口コミをもっと見る</span></a>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        $hideClass = "";
                                                    }
                                                    ?>
                                                    <div class="linkbtn<?=$hideClass?>">
                                                        <?=$this->Html->link('<span>口コミ一覧はこちら</span>', ['controller'=> 'brands', 'action'=> 'reviewIndex', 'brand_id'=> $shop['brand_id']], ['escape'=> false])?>
                                                    </div>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                    <?php
                                }
                            }

                            if (!empty($addShops)) {
                                ?>
                                <div class="othermoreshop">
                                    <p>この条件でお探しの方は<br class="sp">こんな施設もご覧になっています</p>
                                </div>
                                <?php
                                foreach ($addShops as $shop) {
                                    ?>
                                    <div class="pickup_box">
                                        <ul class="tag">
                                            <li><?=$this->Html->link(ShopType::convert($shop['shop_type'], CodePattern::$VALUE), ['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)])?></li>
                                        </ul>
                                        <div class="salon_name">
                                            <?php
                                            $url = ['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']];
                                            echo $this->Html->link($shop['name'], $url, ['class'=> 'shop']);
                                            ?>
                                        </div>
                                        <div class="detail_info">
                                            <div class="area_bread">
                                                <?=$this->Html->link($shop['PrefData']['search_text'], ['controller'=> 'rankings', 'action'=> 'search', $shop['PrefData']['url_text']])?>
                                                ＞
                                                <?=$this->Html->link($shop['Area']['name'], ['controller'=> 'rankings', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY. $shop['Area']['area_id']])?>
                                            </div>
                                            <?php
                                            if (!empty($shop['station_name'])) {
                                                ?>
                                                <div class="station">
                                                    <span>最寄駅</span>
                                                    <?php
                                                    $nearStations = '';
                                                    foreach ($shop['station_name'] as $key => $stationName) {
                                                        $nearStations .= $this->Html->link($stationName, ['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2), $shop->PrefData['url_text'], URLUtil::CITY. $shop['area_id'][$key], URLUtil::STATION_G. $shop['station_g_cd'][$key]]);
                                                        $nearStations .= '、';
                                                    }
                                                    echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="add"><?=$shop['address']?></div>
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
                                                                        $url = Router::url(['controller'=> 'shops', 'detail', $shop['shop_id']]);
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
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="txt_box">
                                                <div class="tit"><?=$shop->description_subject?></div>
                                                <div class="star_box">
                                                    <div class="star-rating-box">
                                                        <div class="empty-star">☆☆☆☆☆</div>
                                                        <div class="filled-star" style=" width: <?php echo $shop->star * 20?>%;">★★★★★</div>
                                                    </div>
                                                    <span class="points"><?=number_format($shop->star,2)?></span>
                                                </div>
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
                                                <li class="btn orange">
                                                    <?php
                                                    echo $this->Html->link('施設詳細へ', ['controller'=> 'shop', 'detail', $shop['shop_id']], ['onclick'=> "gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"]);
                                                    ?>
                                                </li>
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
                                                        <li class="page-numbers"><a href="<?=$url?>#result_list"><?=$i?></a></li>
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
                                                        <li class="page-numbers"><a href="<?=$url?>#result_list"><?=$i?></a></li>
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
                <div id="shopdetailwrap">
                    <div class="listwrap_introduce">
                        <?php
                        if ($this->Paginator->current() <= 1) {
                            // 都道府県
                            if (!empty($htmls)) {
                                foreach ($htmls as $html) {
                                    echo $html;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </main>
            <?= $this->element('Front/SearchResult/side')?>
        </div><!--/.undercontentwrap-->
    </div><!--/.inner-->
    <?php
    echo $this->ExForm->end();
    ?>
</div><!--/#container-->

