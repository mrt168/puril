<?php

use App\Vendor\FormUtil;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>

<style type="text/css">
    .send_error {
        color: red;
    }
</style>

<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<div class="ShopDetail">
    <div id="bread">
        <div class="inner cf">
            <span class="breaditem"><a href="<?=Router::url('/')?>"><span>Purilトップ</span></a></span>
            <span class="breaditem"><?php echo $this->Html->link("<span>全国の脱毛施設</span>", ['controller'=> 'searchs'], ['escape'=> false])?></span>
            <span class="breaditem"><?php echo $this->Html->link("<span>全国の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
            <span class="breaditem"><?php echo $this->Html->link("<span>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
            <span class="breaditem"><?php echo $this->Html->link("<span>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
            <span class="breaditem"><?php echo "<span>{$shop['name']}</span>"?></span>
        </div>
    </div>
    <div id="container">
        <?php
        if (!empty($shop['shop_images'])) {
            ?>
            <div class="imgbox shop-sp-img">
                <?php
                $imagenum = count($shop['shop_images']);
                if($imagenum === 1):
                    foreach ($shop['shop_images'] as $shopImage) {
                        $url = Router::url(array('controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']));
                        echo $this->Html->image(['controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']]);
                    }
                else:
                    echo $this->Html->image('/img/Shop/slick_left.png', ['class'=> 'slick-left','alt'=> '']);
                    echo $this->Html->image('/img/Shop/slick_right.png', ['class'=> 'slick-right','alt'=> '']);
                    ?>
                    <div id="shoptopslider">
                        <div id="slide_scroll_shopdt_sp" class="sliderscrollwrap">
                            <ul>
                                <?php
                                foreach ($shop['shop_images'] as $shopImage) {
                                    if ($shopImage['priority'] > 4) {
                                        break;
                                    }
                                    $url = Router::url(array('controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']));
                                    echo '<li>'.$this->Html->image(['controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']]).'</li>';
                                }
                                ?>
                            </ul>
                        </div><!--/#flickscroll-->
                        <div id="slide_thumb_shopdt_sp" class="sliderthumbwrap">
                            <ul>
                                <?php
                                foreach ($shop['shop_images'] as $shopImage) {
                                    if ($shopImage['priority'] > 4) {
                                        break;
                                    }
                                    $url = Router::url(array('controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']));
                                    echo '<li>'.$this->Html->image(['controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']]).'</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php
                endif;
                ?>
            </div>
            <?php
        }
        ?>
        <div class="inner">
            <div class="undercontentwrap cf">
                <main id="maincolumn">
                    <div class="">
                        <div id="shopdetailwrap">
                            <div class="leadwrap">
                                <div class="tag <?php if (!empty($shop['shop_images'])) {
                                    echo 'has-image';
                                }; ?>">
                                    <ul>
                                        <li><?php echo $this->Html->link($shop['shop_type'], ['controller' => 'searchs', 'action' => 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)]); ?></li>
                                    </ul>
                                </div>
                                <h1 class="coomontit_h1"><?php echo $shop['name']; ?></h1>
                                <div class="flex-row flex-space align-center mb20">
                                    <div class="ratingwrap cf">
                                        <?php
                                        if (!empty($shop['star'])) {
                                            $percent = $shop['star'] * 20;
                                            ?>
                                            <div class="star_rating_box">
                                                <div class="star_rating">
                                                    <div class="empty_star">★★★★★</div>
                                                    <div class="filled_star" style=" width: <?php echo $percent ?>%;">
                                                        ★★★★★
                                                    </div>
                                                </div>
                                                <div class="number_and_reviews">
                                                    <spanよよ class="number"><?php echo number_format($shop['star'], 2) ?></spanよよ>
                                                    <span class="reviews"><a
                                                                href="#shop_dt_reviews"><?php echo $this->Html->image('/img/Shop/icon_comment.png', ['alt' => '口コミ']) ?><?php echo $shop['review_cnt'] ?>件</a></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php /**
                                         * <div class="campaign">
                                         * <span>キャンペーンあり</span>
                                         * </div>
                                         */ ?>
                                    </div>
                                    <div class="snsshare">
                                        <ul class="snsshare cf">
                                            <?php
                                            $shareurl = Router::url(null, true);
                                            ?>
                                            <li class="tw"><a href="//twitter.com/share?url=<?php echo $shareurl ?>"
                                                              target="_blank">ツイート</a></li>
                                            <li class="fb"><a
                                                        href="//www.facebook.com/sharer/sharer.php?u=<?php echo $shareurl ?>"
                                                        target="_blank">シェア</a></li>
                                            <li class="hb"><a
                                                        href="//b.hatena.ne.jp/add?mode=confirm&url=<?php echo $shareurl ?>"
                                                        target="_blank" rel="nofollow">はてぶ</a></li>
                                            <li class="li"><a href="//line.me/R/msg/text/?<?php echo $shareurl ?>"
                                                              target="_blank">シェア</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="menu pc">
                                    <ul class="cf">
                                        <li><a href="#shop_dt_menu">メニュー</a></li>
                                        <li><a href="#shop_dt_info">基本情報</a></li>
                                        <?php if (count($shop['shop_images']) > 4) { ?>
                                            <li><a href="#shop_dt_gallery">ギャラリー</a></li>
                                        <?php } ?>
                                        <li><a href="#shop_dt_access">アクセス</a></li>
                                        <?php if (!empty($shop['staffs'])) { ?>
                                            <li><a href="#shop_dt_staff">スタッフ紹介</a></li>
                                        <?php } ?>
                                        <?php if (!empty($shop['interviews'])) { ?>
                                            <li><a href="#shop_dt_interview">インタビュー</a></li>
                                        <?php } ?>
                                        <?php if (!empty($shop['infos']) || !empty($shop['blogs'])) { ?>
                                            <li><a href="#shop_dt_blog"><span class='icon'>お知らせ・ブログ</a></li>
                                        <?php } ?>
                                        <?php if (!empty($shop['reviews'])) { ?>
                                            <li><a href="#shop_dt_reviews">口コミ</a></li>
                                        <?php } ?>
                                        <?php if (FormUtil::checkUseForm($shop['name'],$shop['shop_id'] ) ) { ?>
                                        <li><a href="/shop/reserve?shop_id=<?= $shop['shop_id'] ?>"  onclick="gtag_report_conversion('<?php echo "https://puril.net/shop/reserve?shop_id=". $shop['shop_id']?>');">予約フォーム</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                                <?php
                                $count = 3;
                                if (count($shop['shop_images']) > 4) {
                                    $count++;
                                }
                                if (!empty($shop['staffs'])) {
                                    $count++;
                                }
                                if (!empty($shop['interviews'])) {
                                    $count++;
                                }
                                if (!empty($shop['infos']) || !empty($shop['blogs'])) {
                                    $count++;
                                }
                                if (!empty($shop['reviews'])) {
                                    $count++;
                                }
                                if (FormUtil::checkUseForm($shop['name'],$shop['shop_id'] ) ){
                                    $count++;
                                }
                                $width = 96 * $count;
                                ?>
                                <div class="menu-box <?php if($count < 5) { echo 'full-width';};?>">
                                    <div class="menu sp">
                                        <ul class="cf sp" style="width: <?php echo $width; ?>px;">
                                            <li><a href="#shop_dt_menu">メニュー</a></li>
                                            <li><a href="#shop_dt_info">基本情報</a></li>
                                            <?php if (count($shop['shop_images']) > 4) { ?>
                                                <li><a href="#shop_dt_gallery">ギャラリー</a></li>
                                            <?php } ?>
                                            <li><a href="#shop_dt_access">アクセス</a></li>
                                            <?php if (!empty($shop['staffs'])) { ?>
                                                <li><a href="#shop_dt_staff">スタッフ紹介</a></li>
                                            <?php } ?>
                                            <?php if (!empty($shop['interviews'])) { ?>
                                                <li><a href="#shop_dt_interview">インタビュー</a></li>
                                            <?php } ?>
                                            <?php if (!empty($shop['infos']) || !empty($shop['blogs'])) { ?>
                                                <li class="letter"><a href="#shop_dt_blog">お知らせ・ブログ</a></li>
                                            <?php } ?>
                                            <?php if (!empty($shop['reviews'])) { ?>
                                                <li><a href="#shop_dt_reviews">口コミ</a></li>
                                            <?php } ?>
                                            <?php if (FormUtil::checkUseForm($shop['name'],$shop['shop_id'] ) ) { ?>
                                                <li><a href="/shop/reserve?shop_id=<?= $shop['shop_id'] ?>" onclick="gtag_report_conversion('<?php echo "https://puril.net/shop/reserve?shop_id=". $shop['shop_id']?>');">予約フォーム</a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <style>
								.NotReserve {
	text-align: center;color: red;padding: 10px 20px;border: 1px solid red;margin-bottom: 20px;
}

.NotReserve_text {
font-size:16px;font-weight: bold;margin-bottom: 10px;	
}

.NotReserve_btn {
	border-radius:5px;display:inline-block;font-size:14px;padding:15px 10px;background-color:#f876a3;color:white;
}
.NotReserve_btn:hover {
	opacity: 0.6;
	}
							</style>
                            <?php if (!FormUtil::checkUseForm($shop['name'],$shop['shop_id'] ) ) { ?>
                            <div class="NotReserve" style="">
	                            <p class="NotReserve_text" style="">この店舗は現在Purilで予約できません。</p>
		                            <?php echo $this->Html->link("<span class='NotReserve_btn' style=''>近くの予約可能なオススメ店舗を探す！</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?>
                            </div>
                            <?php }?>
                            <div class="listwrap shopinfo">
                                <?php
                                if (!empty($shop['description_subject'])) {
                                    ?>
                                    <h2 class="description_h2"><?php echo $shop['description_subject']; ?></h2>
                                    <?php
                                }
                                ?>
                                <div class="content cf">
                                    <?php
                                    if (!empty($shop['shop_images']) && $shop['shop_images'] > 1) {
                                        ?>
                                        <div class="imgbox">
                                            <?php
                                            $imagenum = count($shop['shop_images']);
                                            if ($imagenum === 1):
                                                foreach ($shop['shop_images'] as $shopImage) {
                                                    $url = Router::url(array('controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']));
                                                    echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']]);
                                                }
                                            else:
                                                echo $this->Html->image('/img/Shop/slick_left.png', ['class' => 'slick-left', 'alt' => '']);
                                                echo $this->Html->image('/img/Shop/slick_right.png', ['class' => 'slick-right', 'alt' => '']);
                                                ?>
                                                <div id="shoptopslider">
                                                    <div id="slide_scroll_shopdt" class="sliderscrollwrap">
                                                        <ul>
                                                            <?php
                                                            foreach ($shop['shop_images'] as $shopImage) {
                                                                if ($shopImage['priority'] > 4) {
                                                                    break;
                                                                }
                                                                $url = Router::url(array('controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']));
                                                                echo '<li>' . $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']]) . '</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div><!--/#flickscroll-->
                                                    <div id="slide_thumb_shopdt" class="sliderthumbwrap">
                                                        <ul>
                                                            <?php
                                                            foreach ($shop['shop_images'] as $shopImage) {
                                                                if ($shopImage['priority'] > 4) {
                                                                    break;
                                                                }
                                                                $url = Router::url(array('controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']));
                                                                echo '<li>' . $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']]) . '</li>';
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php
                                            endif;
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="textbox">
                                        <p><?php echo nl2br($shop['description_content']); ?></p>
                                        <?php
                                        if (!empty($shop['affiliate_page_url'])) {
                                            ?>
                                            <div class="btnarea only-pc">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="shop_conversion_area flex-row flex-center align-stretch">
                                <div class="shop_reserve_area flex-column flex-center align-center">
                                    <?php
                                    // if ($is_allow_reservation) {
                                    echo $this->element('Front/shop_dt_reserve');
                                    // }
                                    ?>
                                    <?php
                                    if (!empty($shop['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                               
                                               onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (!empty($shop['affiliate_banner_url'])) {
                                    ?>
                                    <div class="ad_banner_area">
                                        <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                           onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                            <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                        </a>
                                    </div>


                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            $mens = "";
                            if (in_array("メンズ脱毛", array_column($shop['other_conditions'], 'name'))) {
                                $mens = '_mens';
                            }
                            ?>

                            <div id="shop_dt_menu<?= $mens ?>"
                                 class="listwrap shopmenu<?= !empty($mens) ? " mens" : "" ?>">
                                <h2 class="coomontit_h2">
                                    <?php echo $shop['name']; ?>
                                    の脱毛メニュー<?php if (!empty($shop['price_plan_html'])) { ?>と料金プラン<?php } ?>
                                </h2>
                                <?php
                                if (!empty($shop['price_plan_html'])) {
                                    ?>
                                    <h3 class="coomontit_h3"><?php echo $shop['name']; ?>の料金プラン</h3>
                                    <div class="scroll">
                                        <?php
                                        echo $shop['price_plan_html'];
                                        ?>
                                        <!--
                                        <table class="price_list">
                                            <tr>
                                                <th>プラン名</th>
                                                <td class="price">00,000円</td>
                                                <td>プラン内容プラン内容プラン内容プラン内容</td>
                                            </tr>
                                            <tr>
                                                <th>プラン名</th>
                                                <td class="price">00,000円</td>
                                                <td>プラン内容プラン内容プラン内容プラン内容</td>
                                            </tr>
                                            <tr>
                                                <th>プラン名</th>
                                                <td class="price">00,000円</td>
                                                <td>プラン内容プラン内容プラン内容プラン内容</td>
                                            </tr>
                                            <tr>
                                                <th>プラン名</th>
                                                <td class="price">00,000円</td>
                                                <td>プラン内容プラン内容プラン内容プラン内容</td>
                                            </tr>
                                        </table>
                                        -->
                                    </div>
                                    <?php
                                }
                                if (!empty($shop['depilation_sites'])) {
                                    ?>
                                    <h3 class="coomontit_h3"><?php echo $shop['name']; ?>が対応できる脱毛部位</h3>
                                    <div class="partwrap">
                                        <div class="imgbox">
                                            <?php
                                            echo $this->Html->image('/img/shop_dt_part_img' . $mens . ".gif", ['alt' => '']);
                                            foreach ($shop['depilation_sites'] as $depilationSite) {
                                                // ※現状url_textでCSSを作成してもらっているが、depilation_site_idで管理したほうが良いかも
                                                ?>
                                                <span class="pointcircle <?php echo $depilationSite['url_text'] ?>"></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="partbox cf">
                                            <div class="part_list left">
                                                <ul>
                                                    <?php
                                                    foreach ($shop['depilation_sites'] as $depilationSite) {
                                                    $allClass = null;
                                                    if ($depilationSite['depilation_site_id'] == 1) {
                                                        $allClass = " class='all'";
                                                    }
                                                    echo "<li{$allClass}>{$depilationSite['name']}</li>";
                                                    if ($depilationSite['depilation_site_id'] == 11) {
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="part_list right">
                                                <ul>
                                                    <?php
                                                    }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    /**
                                     * <div id="shop_dt_menu_mens" class="listwrap shopmenu mens">
                                     * <h3 class="coomontit_h3">エステティックTBCが対応している脱毛部位</h3>
                                     * <div class="partwrap">
                                     * <div class="imgbox">
                                     * <?php echo $this->Html->image('/img/shop_dt_part_img_mens.gif', ['alt'=> ''])?>
                                     * <span class="pointcircle zenshin"></span>
                                     * <span class="pointcircle face"></span>
                                     * <span class="pointcircle forehead"></span>
                                     * <span class="pointcircle eyebrows"></span>
                                     * <span class="pointcircle nape"></span>
                                     * <span class="pointcircle nose"></span>
                                     * <span class="pointcircle jaw"></span>
                                     * <span class="pointcircle underarm-hair"></span>
                                     * <span class="pointcircle breast"></span>
                                     * <span class="pointcircle nipple"></span>
                                     * <span class="pointcircle arm"></span>
                                     * <span class="pointcircle hand"></span>
                                     * <span class="pointcircle back"></span>
                                     * <span class="pointcircle belly"></span>
                                     * <span class="pointcircle violine"></span>
                                     * <span class="pointcircle vline"></span>
                                     * <span class="pointcircle iline"></span>
                                     * <span class="pointcircle oline"></span>
                                     * <span class="pointcircle hip"></span>
                                     * <span class="pointcircle leg"></span>
                                     * </div>
                                     * <div class="partbox cf">
                                     * <div class="part_list left">
                                     * <ul>
                                     * <li class="all">全身</li><li>顔</li><li>おでこ</li><li>眉毛</li><li>うなじ・襟足</li><li>鼻</li><li>あご・ひげ</li><li>ワキ</li><li>胸</li>
                                     * </ul>
                                     * </div>
                                     * <div class="part_list right">
                                     * <ul>
                                     * <li>乳首・乳輪</li><li>腕</li><li>手・指</li><li>背中</li><li>お腹</li><li>VIO</li><li>Vライン</li><li>Iライン</li><li>Oライン</li><li>お尻</li><li>足・ひざ下</li>
                                     * </ul>
                                     * </div>
                                     * </div>
                                     * </div>
                                     * </div>
                                     */ ?>

                                    <?php
                                }
                                if (!empty($shop['other_conditions'])) {
                                    ?>
                                    <h3 class="coomontit_h3"><?php echo $shop['name']; ?>の特徴・こだわり</h3>
                                    <div class="icon_box cf">
                                        <?php
                                        foreach ($shop['other_conditions'] as $otherCondition) {
                                            echo "<span>" . $this->Html->image("/img/icon{$otherCondition['other_condition_id']}_chara.png", ['alt' => $otherCondition['name']]) . "</span>";
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="shop_conversion_area flex-row flex-center align-stretch">
                                <div class="shop_reserve_area flex-column flex-center align-center">
                                    <?php
                                    // if ($is_allow_reservation) {
                                    echo $this->element('Front/shop_dt_reserve');
                                    // }
                                    ?>
                                    <?php
                                    if (!empty($shop['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                               
                                               onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (!empty($shop['affiliate_banner_url'])) {
                                    ?>
                                    <div class="ad_banner_area">
                                        <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                           onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                            <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                        </a>
                                    </div>


                                    <?php
                                }
                                ?>
                            </div>

                            <div id="shop_dt_info" class="listwrap shopetc">
                                <h2 class="coomontit_h2"><?php echo $shop['name']; ?>の基本情報</h2>
                                <h3 class="coomontit_h3"><?php echo $shop['name']; ?>の概要</h3>
                                <table class="addres_table">
                                    <?php if (!empty($shop['name'])) { ?>
                                        <tr>
                                            <th>店舗名</th>
                                            <td><?php echo $shop['name']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['address'])) { ?>
                                        <tr>
                                            <th>住所</th>
                                            <td><?php echo $shop['address']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['station'])) { ?>
                                        <tr>
                                            <th>最寄り駅</th>
                                            <td><?php echo $shop['station']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['business_hours'])) { ?>
                                        <tr>
                                            <th>営業時間</th>
                                            <td><?php echo $shop['business_hours']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['holiday'])) { ?>
                                        <tr>
                                            <th>定休日</th>
                                            <td><?php echo $shop['holiday']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['credit_card'])) { ?>
                                        <tr>
                                            <th>クレジットカード</th>
                                            <td><?php echo $shop['credit_card']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['staff'])) { ?>
                                        <tr>
                                            <th>スタッフ人数</th>
                                            <td><?php echo $shop['staff']; ?></td>
                                        </tr>
                                    <?php }
                                    if (!empty($shop['parking'])) { ?>
                                        <tr>
                                            <th>駐車場</th>
                                            <td><?php echo $shop['parking']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                                <?php
                                if (!empty($shop['word'])) {
                                    ?>
                                    <h3 class="coomontit_h3"><?php echo $shop['name']; ?>からの一言</h3>
                                    <div class="content cf">
                                        <?php
                                        if (!empty($shop['shop_image_path'])) {
                                            ?>
                                            <div class="imgbox">
                                                <?php
                                                echo $this->Html->image(['controller' => 'images', 'action' => 'wordShopImage', $shop['shop_id']])
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <div class="textbox">
                                            <p><?php echo $shop['word'] ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="shop_conversion_area flex-row flex-center align-stretch">
                                <div class="shop_reserve_area flex-column flex-center align-center">
                                    <?php
                                    // if ($is_allow_reservation) {
                                    echo $this->element('Front/shop_dt_reserve');
                                    // }
                                    ?>
                                    <?php
                                    if (!empty($shop['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                               
                                               onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (!empty($shop['affiliate_banner_url'])) {
                                    ?>
                                    <div class="ad_banner_area">
                                        <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                           onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                            <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                        </a>
                                    </div>


                                    <?php
                                }
                                ?>
                            </div>

                            <?php
                            if (!empty($shop['shop_images'])) {
                                ?>
                                <div id="shop_dt_gallery" class="listwrap garally">
                                    <h2 class="coomontit_h2"><?php echo $shop['name']; ?>のギャラリー</h2>
                                    <?php
                                    $imgCnt = count($shop['shop_images']);
                                    $loopClass = " allnotloop";
                                    if ($imgCnt >= 6) {
                                        $loopClass = " allloop";
                                    } else if ($imgCnt >= 3) {
                                        $loopClass = " pcnotloop";
                                    }
                                    ?>
                                    <div class="gallerysldier<?= $loopClass ?>">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper">
                                                <?php
                                                foreach ($shop['shop_images'] as $shopImage) {
                                                    if (!empty($shopImage['shop_image_id'])) {
                                                        $url = Router::url(array('controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']));
                                                    }
                                                    ?>
                                                    <div class="swiper-slide"><?php echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']]); ?>
                                                        <p><?php echo $shopImage['text'] ?></p>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="shop_conversion_area flex-row flex-center align-stretch">
                                    <div class="shop_reserve_area flex-column flex-center align-center">
                                        <?php
                                        // if ($is_allow_reservation) {
                                        echo $this->element('Front/shop_dt_reserve');
                                        // }
                                        ?>
                                        <?php
                                        if (!empty($shop['affiliate_page_url'])) {
                                            ?>
                                            <div class="btnarea">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                   
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (!empty($shop['affiliate_banner_url'])) {
                                        ?>
                                        <div class="ad_banner_area">
                                            <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                               onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                            </a>
                                        </div>


                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php

                            }
                            ?>

                            <div id="shop_dt_access" class="listwrap access">
                                <h2 class="coomontit_h2"><?php echo $shop['name']; ?>へのアクセス</h2>
                                <div class="access_wrap flex-row flex-space">
                                    <div id="accesstabswrap">
                                        <ul class="tablabel cf">
                                            <li>Google Map</li>
                                        </ul>
                                        <div class="tabboxcontent">
                                            <!-- <img src="img/map_img.jpg" alt=""> -->
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <table class="table_access">
                                        <tr>
                                            <th>施設住所</th>
                                            <td><?php echo $shop['address']; ?></td>
                                        </tr>
                                        <?php
                                        if (!empty($shop['StationG'])) {
                                            ?>
                                            <tr>
                                                <th>最寄り駅</th>
                                                <td>
                                                    <?php
                                                    foreach ($shop['StationG'] as $stationG) {
                                                        echo $this->Html->link($stationG['name'],
                                                                [
                                                                    'controller' => 'searchs', 'action' => 'search',
                                                                    ShopType::convert($shop['shop_type'], CodePattern::$VALUE2),
                                                                    $shop['PrefData']['url_text'],
                                                                    URLUtil::CITY . $stationG['area_id'],
                                                                    URLUtil::STATION_G . $stationG['station_g_cd'],
                                                                ]) . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        if (!empty($shop['Station'])) {
                                            ?>
                                            <tr>
                                                <th>路線</th>
                                                <td>
                                                    <?php
                                                    foreach ($shop['Station'] as $station) {
                                                        echo $this->Html->link($station['name'],
                                                                [
                                                                    'controller' => 'searchs', 'action' => 'search',
                                                                    ShopType::convert($shop['shop_type'], CodePattern::$VALUE2),
                                                                    $shop['PrefData']['url_text'],
                                                                    URLUtil::CITY . $station['area_id'],
                                                                    URLUtil::STATION . $station['station_cd'],
                                                                ]) . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                                if (!empty($shop['shop_access_images'])) {
                                    ?>
                                    <h3 class="coomontit_h3"><?php echo $shop['name']; ?>への詳細道順</h3>
                                    <div class="routeslider">
                                        <div class="swiper-container">
                                            <ul class="swiper-wrapper">
                                                <?php
                                                foreach ($shop['shop_access_images'] as $shopAccessImage) {
                                                    ?>
                                                    <li class="swiper-slide">
                                                        <div class="tit"><?php echo $shopAccessImage['text'] ?></div>
                                                        <div class="imgbox">
                                                            <?php
                                                            echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopAccessImage['shop_image_id']], ['alt' => '']);
                                                            ?>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="shop_conversion_area flex-row flex-center align-stretch">
                                    <div class="shop_reserve_area flex-column flex-center align-center">
                                        <?php
                                        // if ($is_allow_reservation) {
                                        echo $this->element('Front/shop_dt_reserve');
                                        // }
                                        ?>
                                        <?php
                                        if (!empty($shop['affiliate_page_url'])) {
                                            ?>
                                            <div class="btnarea">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                   
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if (!empty($shop['affiliate_banner_url'])) {
                                        ?>
                                        <div class="ad_banner_area">
                                            <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                               onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                            </a>
                                        </div>


                                        <?php
                                    }
                                    ?>
                                </div>

                                <?php
                                if (!empty($shop['staffs'])) {
                                    ?>
                                    <div id="shop_dt_staff" class="listwrap staff">
                                        <h2 class="coomontit_h2"><?php echo $shop['name'] ?>のスタッフ紹介</h2>
                                        <div class="stafflist">
                                            <?php
                                            foreach ($shop['staffs'] as $key => $staff) {
                                                $moreview = "";
                                                if ($key >= 3) {
                                                    $moreview = " moreview hide";
                                                }
                                                ?>
                                                <div class="staffbox cf itembox<?= $moreview ?>">
                                                    <?php
                                                    $url = Router::url(['controller' => 'images', 'action' => 'staffImage', $staff['staff_id']]);
                                                    ?>
                                                    <div class="profimgbox"
                                                         style="background-image: url(<?php echo $url ?>);">
                                                    </div>
                                                    <div class="textbox">
                                                        <div class="namearea cf">
                                                            <div class="name"><?php echo $staff['name'] ?><span
                                                                        class="kana">（<?php echo $staff['name_kana'] ?>）</span>
                                                            </div>
                                                            <ul class="snsarea cf">
                                                                <?php if (!empty($staff['instagram_account'])) { ?>
                                                                    <li>
                                                                        <a href="https://www.instagram.com/<?php echo $staff['instagram_account'] ?>/"
                                                                           target="_blank"><?php echo $this->Html->image('/img/auther_icon_inst.png', ['alt' => '']) ?></a>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if (!empty($staff['twitter_account'])) { ?>
                                                                    <li>
                                                                        <a href="https://twitter.com/<?php echo $staff['twitter_account'] ?>"
                                                                           target="_blank"><?php echo $this->Html->image('/img/auther_icon_twt.png', ['alt' => '']) ?></a>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if (!empty($staff['facebook_account'])) { ?>
                                                                    <li>
                                                                        <a href="https://www.facebook.com/<?php echo $staff['facebook_account'] ?>"
                                                                           target="_blank"><?php echo $this->Html->image('/img/auther_icon_fcbk.png', ['alt' => '']) ?></a>
                                                                    </li>
                                                                    <li><a href=""
                                                                           target="_blank"><?php echo $this->Html->image('/img/auther_icon_blog.png', ['alt' => '']) ?></a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                        <div class="text"><?php echo $staff['description'] ?></div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (count($shop['staffs']) > 3) {
                                            ?>
                                            <div class="morebtn">
                                                <a href="" class="btn"><span>もっと見る</span></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="shop_conversion_area flex-row flex-center align-stretch">
                                        <div class="shop_reserve_area flex-column flex-center align-center">
                                            <?php
                                            // if ($is_allow_reservation) {
                                            echo $this->element('Front/shop_dt_reserve');
                                            // }
                                            ?>
                                            <?php
                                            if (!empty($shop['affiliate_page_url'])) {
                                                ?>
                                                <div class="btnarea">
                                                    <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                       
                                                       onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($shop['affiliate_banner_url'])) {
                                            ?>
                                            <div class="ad_banner_area">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                    <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                                </a>
                                            </div>


                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($shop['interviews'])) {
                                    ?>
                                    <div id="shop_dt_interview" class="listwrap interview">
                                        <h2 class="coomontit_h2"><?php echo $shop['name'] ?>のインタビュー</h2>
                                        <?php
                                        if (!empty($shop['interview_title'])) {
                                            ?>
                                            <h3 class="coomontit_h3"><?= $shop['interview_title'] ?></h3>
                                            <?php
                                        }
                                        if (!empty($shop['interview_image_path']) || !empty($shop['interview_video_url'])) {
                                            ?>
                                            <div class="eyecatch">
                                                <?php
                                                if (!empty($shop['interview_video_url'])) {
                                                    echo '<iframe src="' . $shop['interview_video_url'] . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                } else {
                                                    echo $this->Html->image(['controller' => 'images', 'action' => 'interviewShopImage', $shop['shop_id']], ['alt' => '']);
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        foreach ($shop['interviews'] as $interview) {

                                            $textClass = 'txtright';
                                            if ($interview['image_position_type'] == ImagePositionType::$RIGHT[CodePattern::$CODE]) {
                                                $textClass = 'txtleft';
                                            }
                                            ?>
                                            <h4 class="coomontit_h4"><?php echo $interview['title'] ?></h4>
                                            <div class="<?php echo $textClass ?> cf">
                                                <?php
                                                if (!empty($interview['image_path'])) {
                                                    ?>
                                                    <div class="imgbox">
                                                        <?php
                                                        echo $this->Html->image(['controller' => 'images', 'action' => 'interviewImage', $interview['interview_id']], ['alt' => '']);
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="textbox">
                                                    <p><?php echo $interview['content'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="shop_conversion_area flex-row flex-center align-stretch">
                                        <div class="shop_reserve_area flex-column flex-center align-center">
                                            <?php
                                            // if ($is_allow_reservation) {
                                            echo $this->element('Front/shop_dt_reserve');
                                            // }
                                            ?>
                                            <?php
                                            if (!empty($shop['affiliate_page_url'])) {
                                                ?>
                                                <div class="btnarea">
                                                    <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                       
                                                       onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($shop['affiliate_banner_url'])) {
                                            ?>
                                            <div class="ad_banner_area">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                    <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                                </a>
                                            </div>


                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($shop['infos']) || !empty($shop['blogs'])) {
                                    ?>
                                    <div id="shop_dt_blog" class="listwrap shopblog">
                                        <h2 class="coomontit_h2"><?php echo $shop['name'] ?>のお知らせ・ブログ</h2>
                                        <?php
                                        if (!empty($shop['infos'])) {
                                            ?>
                                            <h3 class="coomontit_h3"><?php echo $shop['name']; ?>のお知らせ</h3>
                                            <div class="shopnewsarea">
                                                <div class="shopnewslist">
                                                    <?php
                                                    foreach ($shop['infos'] as $key => $info) {
                                                        $moreview = "";
                                                        if ($key >= 3) {
                                                            $moreview = " moreview hide";
                                                        }
                                                        ?>
                                                        <div class="newsbox cf itembox<?= $moreview ?>">
                                                            <div class="day"><?php echo !empty($info['date']) ? date('Y.m.d', strtotime($info['date'])) : "　" ?></div>
                                                            <div class="newstext"><?php echo $info['content'] ?></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                                if (count($shop['infos']) > 3) {
                                                    ?>
                                                    <div class="morebtn">
                                                        <a href="" class="btn"><span>もっと見る</span></a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        if (!empty($shop['blogs'])) {
                                            ?>
                                            <h3 class="coomontit_h3"><?php echo $shop['name']; ?>のブログ</h3>
                                            <div class="shopblogarea">
                                                <?php
                                                foreach ($shop['blogs'] as $key => $blog) {
                                                    $moreview = "";
                                                    if ($key >= 3) {
                                                        break;
                                                    }
                                                    ?>
                                                    <a href="" class="blogbox cf">
                                                        <?php
                                                        if (!empty($blog['image_path'])) {
                                                            ?>
                                                            <div class="imgbox">
                                                                <?php
                                                                echo $this->Html->image(['controller' => 'images', 'action' => 'blogImage', $blog['blog_id']], ['alt' => '']);
                                                                ?>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div class="textbox">
                                                            <div class="day"><?php echo !empty($blog['date']) ? date('Y.m.d', strtotime($blog['date'])) : null ?></div>
                                                            <div class="tit"><?php echo $blog['title'] ?></div>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                                <div class="morebtn">
                                                    <?php
                                                    echo $this->Html->link('<span>もっと見る</span>', ['controller' => 'shops', 'action' => 'blogIndex', 'shop_id' => $shop['shop_id']], ['class' => 'btn02', 'escape' => false]);
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="shop_conversion_area flex-row flex-center align-stretch">
                                        <div class="shop_reserve_area flex-column flex-center align-center">
                                            <?php
                                            // if ($is_allow_reservation) {
                                            echo $this->element('Front/shop_dt_reserve');
                                            // }
                                            ?>
                                            <div class="btnarea">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                   
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($shop['affiliate_banner_url'])) {
                                            ?>
                                            <div class="ad_banner_area">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                    <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                                </a>
                                            </div>


                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                }
                                ?>

                                <?php
                                if (!empty($shop['reviews'])) {
                                    ?>
                                    <div class="listwrap reviews" id="shop_dt_reviews">
                                        <h2 class="coomontit_h2"><?php echo $shop['name'] ?>の口コミ</h2>
                                        <div class="reviewslist_wrap">
                                            <?php
                                            foreach ($shop['reviews'] as $key => $review) {
                                                $moreview = "";
                                                if ($key >= 3) {
                                                    $moreview = " moreview hide";
                                                }
                                                ?>
                                                <div class="itembox<?= $moreview ?>">
                                                    <div class="titlearea cf">
                                                        <div class="titbox cf">
                                                            <div class="usericon">
                                                                <?php
                                                                // 												$imgPath = "/img/reviews_icon_men_g.png";
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

                                                                echo $this->Html->image($imgPath, ['alt' => $review['nickname']]);
                                                                ?>
                                                            </div>
                                                            <div class="namewrap">
                                                                <div class="star_box">
                                                                    <div class="star-rating-box">
                                                                        <div class="empty-star">★★★★★</div>
                                                                        <div class="filled-star"
                                                                             style=" width: <?= $review['evaluation'] * 20 ?>%;">
                                                                            ★★★★★
                                                                        </div>
                                                                    </div>
                                                                    <span class="points"><?= $review['evaluation'] ?></span>
                                                                </div>
                                                                <div class="name"><?= $review['nickname'] ?></div>
                                                            </div>
                                                        </div>
                                                        <ul class="snsarea cf">
                                                            <?php
                                                            if (!empty($review['instagram_account'])) {
                                                                ?>
                                                                <li>
                                                                    <a href="//www.instagram.com/<?= $review['instagram_account'] ?>"
                                                                       target="_blank"><?php echo $this->Html->image('/img/Shop/icon_instagram.png', ['alt' => '']) ?></a>
                                                                </li>
                                                                <?php
                                                            }
                                                            if (!empty($review['twitter_account'])) {
                                                                ?>
                                                                <li>
                                                                    <a href="//twitter.com/<?= $review['twitter_account'] ?>"
                                                                       target="_blank"><?php echo $this->Html->image('/img/Shop/icon_twitter.png', ['alt' => '']) ?></a>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="contentwrap">
                                                        <div class="tit"><?= $review['title'] ?></div>
                                                        <div class="txtarea"><?= nl2br($review['content']) ?></div>
                                                        <div class="underbox cf">
                                                            <div class="daycont">
                                                                <?php
                                                                echo !empty($review['visit_date']) ? "<span>来店日：" . date('m/d', strtotime($review['visit_date'])) . "</span>" : "";
                                                                echo !empty($review['post_date']) ? "<span>投稿日：" . date('m/d', strtotime($review['post_date'])) . "</span>" : "";
                                                                ?>
                                                            </div>
                                                            <?php
                                                            $isQuestion = false;
                                                            for ($i = 1; $i <= 6; $i++) {
                                                                $questionColumn = "question" . $i;
                                                                if (!empty($review[$questionColumn])) {
                                                                    $isQuestion = true;
                                                                    break;
                                                                }
                                                            }
                                                            if ($isQuestion) {
                                                                ?>
                                                                <div class="cntlbtn">
                                                                    <a href="" class="btn">もっと見る</a>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="dolwcont">
                                                            <ul>
                                                                <?php
                                                                if (!empty($review['question1'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            治療前の説明は十分でしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question1'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question1'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($review['question2'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            痛みへの配慮はいかがでしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question2'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question2'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($review['question3'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            スタッフの態度、対応はいかがでしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question3'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question3'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($review['question4'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            店舗の雰囲気、設備、清潔感はいかがでしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question4'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question4'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($review['question5'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            待ち時間、予約対応はいかがでしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question5'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                if (!empty($review['question6'])) {
                                                                    ?>
                                                                    <li class="cf">
                                                                        <p class="txt">
                                                                            術前、術中、術後の対応はいかがでしたか？
                                                                        </p>
                                                                        <div class="star_box">
                                                                            <div class="star-rating-box">
                                                                                <div class="empty-star">★★★★★</div>
                                                                                <div class="filled-star"
                                                                                     style=" width: <?= Satisfaction::convert($review['question6'], CodePattern::$VALUE2) ?>%;">
                                                                                    ★★★★★
                                                                                </div>
                                                                            </div>
                                                                            <span class="points"><?= Satisfaction::convert($review['question6'], CodePattern::$VALUE) ?></span>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (count($shop['reviews']) > 3) {
                                            ?>
                                            <div class="morebtn">
                                                <a href=""><span>口コミをもっと見る</span></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="shop_conversion_area flex-row flex-center align-stretch">
                                        <div class="shop_reserve_area flex-column flex-center align-center">
                                            <?php
                                            // if ($is_allow_reservation) {
                                            echo $this->element('Front/shop_dt_reserve');
                                            // }
                                            ?>
                                            <div class="btnarea">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                   
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                            </div>
                                        </div>
                                        <?php
                                        if (!empty($shop['affiliate_banner_url'])) {
                                            ?>
                                            <div class="ad_banner_area">
                                                <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                                   onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                    <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                                </a>
                                            </div>


                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                }
                                ?>

                                <div id="contact_userclum" class="shopreviews listwrap">
                                    <div class="big_slide_btn"><?php echo $shop['name'] ?>の<br class="sp">口コミ投稿フォーム
                                    </div>
                                    <div class="slideform">
                                        <?= $this->ExForm->create('Reviews', ['url' => false, 'type' => 'post', 'novalidate' => true, 'id' => 'form', 'enctype' => 'multipart/form-data']) ?>
                                        <div style="display:none;"><input type="hidden" name="_method" value="POST">
                                        </div>
                                        <table class="contact_form">
                                            <tbody>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="imp">必須</span>評価
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->evaluation('Reviews.evaluation', ['id' => 'evaluation']); ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="imp">必須</span>年齢
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->age('Reviews.age', ['id' => 'age', 'type' => 'select']) ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="imp">必須</span>性別
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->sex('Reviews.sex', ['id' => 'sex', 'type' => 'select', 'default' => Sex::$WOMAN[CodePattern::$CODE]]); ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="any">任意</span>来店日
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->text('Reviews.visit_date', ['class' => 'datepicker', 'placeholder' => '例）2018/12/06', 'id' => 'visit_date']); ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="imp">必須</span>来店店舗
                                                </th>
                                                <td>
                                                    <?php
                                                    echo $this->ExForm->text('Reviews.shop_name', ['class' => '', 'value' => $shop['name'], 'readonly' => 'readonly']);
                                                    echo $this->ExForm->hidden('Reviews.shop_id', ['value' => $shop['shop_id']]);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2 slide-type">
                                                <th class="slide_btn">
                                                    <span class="any">任意</span>評価詳細
                                                </th>
                                                <td class="slide_btn">評価詳細を記入する</td>
                                                <th class="valuetion first">施術前の説明は十分でしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question1', ['class' => 'question', 'id' => 'question1', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                                <th class="valuetion">痛みへの配慮はいかがでしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question2', ['class' => 'question', 'id' => 'question2', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                                <th class="valuetion">スタッフの態度、対応はいかがでしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question3', ['class' => 'question', 'id' => 'question3', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                                <th class="valuetion">店舗の雰囲気、設備、清潔感はいかがでしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question4', ['class' => 'question', 'id' => 'question4', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                                <th class="valuetion">待ち時間、予約対応はいかがでしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question5', ['class' => 'question', 'id' => 'question5', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                                <th class="valuetion">術前、術中、術後の対応はいかがでしたか？</th>
                                                <td class="valuetion">
                                                    <?= $this->ExForm->satisfaction('Reviews.question6', ['class' => 'question', 'id' => 'question6', 'type' => 'select', 'empty' => true]); ?>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2 query-type-3">
                                                <th>
                                                    <span class="imp">必須</span>氏名・ニックネーム
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->text('Reviews.nickname', ['id' => 'nickname', 'placeholder' => '例）脱毛 花子']); ?>
                                                    <p class="atention nickname"></p>

                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="any">任意</span>Instagramアカウント
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->text('Reviews.instagram_account', ['id' => 'instagram_account']); ?>
                                                    <p class="atention instagram_account"></p>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="any">任意</span>Twitterアカウント
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->text('Reviews.twitter_account', ['id' => 'twitter_account']); ?>
                                                    <p class="atention twitter_account"></p>
                                                </td>
                                            </tr>
                                            <tr class="query-type query-type-2">
                                                <th>
                                                    <span class="imp">必須</span>口コミタイトル
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->text('Reviews.title', ['id' => 'title', 'required' => 'required', 'placeholder' => '例）スタッフさんの対応がよかった']); ?>
                                                    <p class="atention title">
                                                        ※25文字以内でご記入ください。
                                                    </p>
                                                </td>

                                            </tr>
                                            <tr>
                                                <th>
                                                    <span class="imp">必須</span>口コミ詳細
                                                </th>
                                                <td>
                                                    <?= $this->ExForm->textarea('Reviews.content', ['id' => 'content', 'required' => 'required', 'row' => 4, 'rows' => 5]); ?>
                                                    <p class="atention content"></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="submit"><input type="submit" name="contact_user"
                                                                   class="submit_button" id="song-xinsuru" value="投稿する">
                                        </div>
                                        <div class="send_error"></div>
                                        <?= $this->ExForm->end(); ?>
                                        <div class="shop_conversion_area flex-row flex-center align-stretch">
                                            <div class="shop_reserve_area flex-column flex-center align-center">
                                                <?php
                                                // if ($is_allow_reservation) {
                                                echo $this->element('Front/shop_dt_reserve');
                                                // }
                                                ?>
                                                <div class="btnarea">
                                                    <a href="<?php echo $shop['affiliate_page_url'] ?>" class="green"
                                                       
                                                       onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                                </div>
                                            </div>
                                            <?php
                                            if (!empty($shop['affiliate_banner_url'])) {
                                                ?>
                                                <div class="ad_banner_area">
                                                    <a href="<?php echo $shop['affiliate_page_url'] ?>" 
                                                       onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                                        <?php echo $this->Html->image($shop['affiliate_banner_url'], ['alt' => '']) ?>
                                                    </a>
                                                </div>


                                                <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="listwrap relation">
                                    <h2 class="coomontit_h2"><?php echo $shop['name']; ?>を見た方はこんな施設もご覧になっています
                                    </h2>
                                    <div id="relationtabswrap" class="tabjswrap">
                                        <ul class="tabjscontrol cf">
                                            <li class="active"><a href="#moyorieki">最寄駅が同じ</a></li>
                                            <li><a href="#shikutyouson">市区町村が同じ</a></li>
                                            <li><a href="#todoufuken">都道府県が同じ</a></li>
                                        </ul>
                                        <div id="moyorieki" class="tabscontentarea active">
                                            <div class="shoplistwrap cf">
                                                <?php
                                                if (!empty($othreShops['station_data']->toArray())) {
                                                    foreach ($othreShops['station_data'] as $stationData) {
                                                        $url = Router::url(['controller' => 'shops', 'action' => 'detail', $stationData['shop_id']]);
                                                        $noImg = " no_img";
                                                        $imgUrl = null;
                                                        if (!empty($stationData['shop_images'])) {
                                                            $noImg = null;
                                                            $imgUrl = Router::url(array('controller' => 'images', 'action' => 'shopImage', $stationData['shop_images'][0]['shop_image_id']));
                                                        }
                                                        ?>
                                                        <div class="shopitem<?php echo $noImg ?>">
                                                            <a href="<?php echo $url ?>/" class="cf">
                                                                <div class="txt">
                                                                    <div class="tit"><?php echo $stationData['name'] ?></div>
                                                                    <div class="dtarae">
                                                                        <?php echo Pref::convert($stationData['pref'], CodePattern::$VALUE) ?>
                                                                        > <?php echo $stationData['Area']['name'] ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if (!empty($imgUrl)) {
                                                                    ?>
                                                                    <div class="imgbox">
                                                                        <img src="<?php echo $imgUrl ?>" alt="">
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    該当する店舗がありません。
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div id="shikutyouson" class="tabscontentarea">
                                            <div class="shoplistwrap cf">
                                                <?php
                                                foreach ($othreShops['area_data'] as $areaData) {
                                                    $url = Router::url(['controller' => 'shops', 'action' => 'detail', $areaData['shop_id']]);
                                                    $noImg = " no_img";
                                                    $imgUrl = null;
                                                    if (!empty($areaData['shop_images'])) {
                                                        $noImg = null;
                                                        $imgUrl = Router::url(array('controller' => 'images', 'action' => 'shopImage', $areaData['shop_images'][0]['shop_image_id']));
                                                    }
                                                    ?>
                                                    <div class="shopitem<?php echo $noImg ?>">
                                                        <a href="<?php echo $url ?>/" class="cf">
                                                            <div class="txt">
                                                                <div class="tit"><?php echo $areaData['name'] ?></div>
                                                                <div class="dtarae">
                                                                    <?php echo Pref::convert($areaData['pref'], CodePattern::$VALUE) ?>
                                                                    > <?php echo $areaData['Area']['name'] ?>　
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if (!empty($imgUrl)) {
                                                                ?>
                                                                <div class="imgbox">
                                                                    <img src="<?php echo $imgUrl ?>" alt="">
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div id="todoufuken" class="tabscontentarea">
                                            <div class="shoplistwrap cf">
                                                <?php
                                                foreach ($othreShops['shop_data'] as $shopData) {
                                                    $url = Router::url(['controller' => 'shops', 'action' => 'detail', $shopData['shop_id']]);
                                                    $noImg = " no_img";
                                                    $imgUrl = null;
                                                    if (!empty($shopData['shop_images'])) {
                                                        $noImg = null;
                                                        $imgUrl = Router::url(array('controller' => 'images', 'action' => 'shopImage', $shopData['shop_images'][0]['shop_image_id']));
                                                    }
                                                    ?>
                                                    <div class="shopitem<?php echo $noImg ?>">
                                                        <a href="<?php echo $url ?>/" class="cf">
                                                            <div class="txt">
                                                                <div class="tit"><?php echo $shopData['name'] ?></div>
                                                                <div class="dtarae">
                                                                    <?php echo Pref::convert($shopData['pref'], CodePattern::$VALUE) ?>
                                                                    > <?php echo $shopData['Area']['name'] ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            if (!empty($imgUrl)) {
                                                                ?>
                                                                <div class="imgbox">
                                                                    <img src="<?php echo $imgUrl ?>" alt="">
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($shop['Brand']['name'])) {
                                    ?>
                                    <div class="search listwrap">
                                        <h2 class="coomontit_h2"><?= $shop['Brand']['name'] ?>の他の店舗を見る</h2>
                                        <div class="result_list">
                                            <div class="btn_box">
                                                <ul class="other-ul">
                                                    <li class="other_shop_btn"><?= $this->Html->link($shop['Brand']['name'] . 'TOPへ', ['controller' => 'brands', 'action' => 'detail', $shop['brand_id']]); ?></li>
                                                    <?php
                                                    if (!empty($shop['affiliate_page_url'])) {
                                                        ?>
                                                        <li class="other_shop_btn"><a
                                                                    href="<?= $shop['affiliate_page_url'] ?>"
                                                                    class="green" 
                                                                    onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});gtag_report_conversion('<?php echo $shop['affiliate_page_url']?>');">公式サイトへ</a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="listwrap column">
                                    <div id="shopbtcolumn">
                                        <h2 class="coomontit_h2"><?php echo $shop['name']; ?>の脱毛に関連するコラム</h2>
                                        <ul class="toc_list">
                                            <?php
                                            if (count($brandUrls) > 0) {
                                                foreach ($brandUrls as $brandUrl) {
                                                    ?>
                                                    <li><a href="<?= $brandUrl['url'] ?>"><?= $brandUrl['title'] ?></a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <li><a href="/column/special/">【まとめ】脱毛したい人必見！脱毛サロン・医療脱毛クリニックのおすすめ人気ランキング15選</a>
                                            </li>
                                            <li><a href="/column/campaign/">脱毛オトク情報｜キャンペーン・モニター情報でオトクに脱毛！</a></li>

                                            <li><a href="/column/qa/advantage/">脱毛の掛け持ちで最高に得する方法とは？</a></li>

                                            <li><a href="/column/useful/">【まとめ】脱毛について100%理解！脱毛の前後で知りたいことあなたも全部わかる！</a></li>

                                            <li>
                                                <a href="/column/useful/cost/">脱毛の費用と効果を比較！サロン？クリニック？自宅？あなたはどれ向き！？</a>

                                            </li>
                                            <li><a href="/column/epilator/">【最新2019】家庭用脱毛器を口コミ・評判で徹底比較！安いおすすめ人気ランキング13選！</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="shopdtbtsnsarea">
                                    <h2 class="coomontit_h2">友達にシェアする</h2>
                                    <div class="snsshare-detail cf">
                                        <ul>
                                            <li class="tw"><a href="//twitter.com/share?url=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_twitter.png', ['alt'=> 'twitter']);?><span class="sns-text">ツイート</span></a></li>
                                            <li class="fb"><a href="//www.facebook.com/sharer/sharer.php?u=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_fb.png', ['alt'=> 'facebook']);?><span class="sns-text">シェア</span></a></li>
                                            <li class="hb"><a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow"><?php echo $this->Html->image('/img/home/header_icon_hatebu.png', ['alt'=> 'hatebu']);?><span class="sns-text">はてぶ</span></a></li>
                                            <li class="li"><a href="//line.me/R/msg/text/?https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_line.png', ['alt'=> 'line']);?><span class="sns-text">シェア</span></a></li>
                                            <li class="ml"><a href="mailto:?body=<?php echo $shareurl ?>"><?php echo $this->Html->image('/img/home/header_icon_mail.png', ['alt'=> 'mail']);?><span class="sns-text">メール</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?= $this->element('Front/SearchResult/side')?>
            </div>
        </div>
    </div>
    <div id="send_msg">
        <div class="fixbox">
            <span class="tit">投稿完了しました。</span>
            <span class="comment">内容を確認のうえ、問題が無い場合は反映いたします。</span>
            <span class="closebtn"></span>
        </div>
        <div class="w_shadow"></div>
    </div>
    <?php
    if (!empty($shop['affiliate_page_url'])) {
        ?>
        <div id="dtfixbtnarea">
            <a href="<?php echo $shop['affiliate_page_url']?>" class="green"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
        </div>
        <?php
    }
    ?>
    <script>
        function initMap(address) {
            var geocoder = new google.maps.Geocoder();
            //住所から座標を取得する
            geocoder.geocode(
                {
                    'address': address,//検索する住所　〒◯◯◯-◯◯◯◯ 住所　みたいな形式でも検索できる
                    'region': 'jp'
                },
                function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        google.maps.event.addDomListener(window, 'load', function () {
                            var map_tag = document.getElementById('map');
                            // 取得した座標をセット緯度経度をセット
                            var map_location = new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng());
                            //マップ表示のオプション
                            var map_options =
                                {
                                    zoom: 17,//縮尺
                                    center: map_location,//地図の中心座標
                                    //ここをfalseにすると地図上に人みたいなアイコンとか表示される
                                    disableDefaultUI: true,
                                    mapTypeId: google.maps.MapTypeId.ROADMAP//地図の種類を指定
                                };

                            //マップを表示する
                            var map = new google.maps.Map(map_tag, map_options);

                            //地図上にマーカーを表示させる
                            var marker = new google.maps.Marker({
                                position: map_location,//マーカーを表示させる座標
                                map: map//マーカーを表示させる地図
                            });
                        });
                    }
                }
            );
        }
        initMap("<?php echo $shop['address']?>");

        // 口コミ投稿処理
        $(function(){
            $("#song-xinsuru").click(function() {

                var $form = $('#form').get()[0];
                var fd = new FormData($form);

                $.ajax({
                    type: 'post',
                    url: "<?=Router::url(['controller'=> 'shops', 'action'=> 'send'], true)?>/",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        var errors = JSON.parse(res).errorMsg;
                        if (errors) {
                            $('.atention').text("");
                            // エラー処理
                            $.each(errors, function(column, error) {
                                $('.'+column).text(error);
                            });
                            return;
                        } else {
                            // 完了処理
                            $('#send_msg').fadeIn().addClass('active');

                            // フォームクリア
                            $('#visit_date').val('');
                            $('#evaluation').val(0);
                            $('.question').val('');
                            $('#nickname').val('');
                            $('#age').val(15);
                            $('#sex').val(2);
                            $('#instagram_account').val('');
                            $('#twitter_account').val('');
                            $('#title').val('');
                            $('#content').val('');
                            return ;
                        }
                    }
                });

                return false;
            });

            $('#send_msg .w_shadow , #send_msg .closebtn').on('click',function(){
                var tagetsend_msg = $('#send_msg');
                if(tagetsend_msg.hasClass('active')){
                    tagetsend_msg.fadeOut().removeClass('active');
                }
            });
        });
    </script>


</div>