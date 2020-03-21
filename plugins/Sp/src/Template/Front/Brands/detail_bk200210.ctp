<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\DepilationType;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/brand/common', 'datsumou/brand/index']);
?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<!-- <?php var_dump($brand);?>-->
<header class="brand-header">
      <div class="brand-header-inner"><a class="brand-header-back" href="/datsumou/"><i class="fas fa-chevron-left"></i></a>
        <div class="brand-header-title"><?=$brand['name']?></div>
        <div class="brand-header-void"></div>
      </div>
    </header>
<nav class="content-base brand-breadcrumbs">
      <ul class="brand-breadcrumbs-list">
        <li><a href="<?=Router::url('/')?>">Purilトップ</a></li>
        <li><?php echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?></li>
        <li><?=$brand['name']?></li>
      </ul>
    </nav>
<nav class="content brand-nav">
      <div class="brand-nav-item active"><a class="brand-nav-item-text" href="/datsumou/brand/">トップ</a></div>
      <div class="brand-nav-item"><a class="brand-nav-item-text" href="/datsumou/brand/#">料金プラン</a></div>
      <div class="brand-nav-item"><a class="brand-nav-item-text" href="/datsumou/brand/#">脱毛部位</a></div>
      <div class="brand-nav-item"><a class="brand-nav-item-text" href="/datsumou/brand/#">口コミ</a></div>
      <div class="brand-nav-item"><a class="brand-nav-item-text" href="/datsumou/brand/#">キャンペーン</a></div>
      <div class="brand-nav-item"><a class="brand-nav-item-text" href="/datsumou/brand/#">運営店舗</a></div>
    </nav>
<section class="content brand-top">
      <div class="brand-top-img-area">
        <div class="brand-top-img-base">
                                <?php //保留
                                if(!empty($brand['image_path'])) {
                                    ?>
                                        <?php echo $this->Html->image(['controller'=> 'images', 'action'=> 'brandImage', $brand['brand_id']], ['alt'=> ''])?>
                                    <?php  }?>
      </div>
      <div class="brand-top-desc-area">
        <div class="brand-top-desc-category"><?=$this->Html->link(ShopType::convert($brand['shop_type'],CodePattern::$VALUE), ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($brand['shop_type'],CodePattern::$VALUE2)]);?></div>
        <div class="brand-top-desc-middle">
          <div class="brand-top-desc-review">
            <div class="shop-star-area">
              <div class="shop-star"><img src="/img/star-on.png"><img src="/img/star-on.png"><img src="/img/star-on.png"><img src="/img/star-off.png"><img src="/img/star-off.png">
              </div>
              <div class="shop-point">4.6</div>
            </div>
            <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
              <div class="shop-comment-count">142件</div>
            </div>
          </div>
        </div>
      </div>
    </section>
<div class="ShopDetail">
    <div id="bread">
        <div class="inner cf">
            <span class="breaditem"><a href="<?=Router::url('/')?>"><span>Purilトップ</span></a></span>
            <span class="breaditem"><?php echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?></span>
            <span class="breaditem"><?=$brand['name']?></span>
        </div>
    </div>
    <div id="container">
        <div class="inner">
            <div class="undercontentwrap cf">
                <main id="maincolumn">
                    <div class="">
                        <div id="shopdetailwrap" class="brands">
                            <div class="leadwrap">
                                <div class="tag">
                                    <ul>
                                        <li><?=$this->Html->link(ShopType::convert($brand['shop_type'],CodePattern::$VALUE), ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($brand['shop_type'],CodePattern::$VALUE2)]);?></li>
                                    </ul>
                                </div>
                                <h1 class="coomontit_h1"><?=$brand['name']?></h1>
                                <div class="flex-row flex-space align-center mb20">
                                    <div class="ratingwrap cf">
                                        <?php
                                        if (!empty($totalReview['star'])) {
                                            $percent = $totalReview['star'] * 20;
                                            ?>
                                            <div class="star_rating_box">
                                                <div class="star_rating">
                                                    <div class="empty_star">★★★★★</div>
                                                    <div class="filled_star" style=" width: <?=$percent?>%">★★★★★</div>
                                                </div>

                                                <div class="number_and_reviews">
                                                    <span class="number"><?=number_format($totalReview['star'], 2)?></span>
                                                    <span class="reviews"><a href="#shop_dt_reviews"><?php echo $this->Html->image('/img/Shop/icon_comment.png', ['alt'=> '口コミ'])?><?=$totalReview['review_cnt']?>件</a></span>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="snsshare">
                                        <ul class="snsshare cf">
                                            <li class="tw"><a href="//twitter.com/share?url=<?php echo $shareurl ?>" target="_blank">ツイート</a></li>
                                            <li class="fb"><a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $shareurl ?>" target="_blank">シェア</a></li>
                                            <li class="hb"><a href="//b.hatena.ne.jp/add?mode=confirm&url=<?php echo $shareurl ?>" target="_blank" rel="nofollow">はてぶ</a></li>
                                            <li class="li"><a href="//line.me/R/msg/text/?<?php echo $shareurl ?>" target="_blank">シェア</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="menu pc">
                                    <ul class="cf">

                                        <li><a href="#shop_dt_feature" class="<?php if (empty($brand['feature_html'])) { echo 'disable';}?>">特徴</a></li>
                                        <li><a href="#shop_dt_menu" class="<?php if (empty($brand['depilation_sites'])) { echo 'disable';}?>">対応部位</a></li>
                                        <li><a href="#shop_dt_price" class="<?php if (empty($brand['price_plan_html'])) { echo 'disable';}?>">料金プラン</a></li>
                                        <li><a href="#shop_dt_campaign" class="<?php if (empty($brand['campaign_html'])) { echo 'disable';}?>">キャンペーン</a></li>
                                        <li><a href="#shop_dt_reviews" class="<?php if (count($reviews) > 0) { echo 'disable';}?>">口コミ</a></li>
                                        <li><a href="#shop_dt_shop" class="<?php if (empty($brand['shops'])) { echo 'disable';}?>">運営店舗</a></li>
                                        <li><a href="#shop_dt_interview" class="<?php if (empty($interviews)) { echo 'disable';}?>">インタビュー</a></li>
                                    </ul>
                                </div>
                                <div class="menu-box">
                                    <div class="menu sp">
                                        <?php
                                        $count = 0;
                                        if (!empty($brand['feature_html'])) {
                                            $count++;
                                        }
                                        if (!empty($brand['depilation_sites'])) {
                                            $count++;
                                        }
                                        if (!empty($brand['price_plan_html'])) {
                                            $count++;
                                        }
                                        if (!empty($brand['campaign_html'])) {
                                            $count++;
                                        }
                                        if (count($reviews) > 0) {
                                            $count++;
                                        }
                                        if (!empty($brand['shops'])) {
                                            $count++;
                                        }
                                        if (!empty($interviews)) {
                                            $count++;
                                        }
                                        $width = 96 * $count;
                                        ?>
                                        <ul class="cf sp" style="width: <?php echo $width; ?>px;">
                                            <?php if (!empty($brand['feature_html'])) {?>
                                                <li><a href="#shop_dt_feature">特徴</a></li>
                                            <?php }?>
                                            <?php if (!empty($brand['depilation_sites'])) {?>
                                                <li><a href="#shop_dt_menu">対応部位</a></li>
                                            <?php }?>
                                            <?php if (!empty($brand['price_plan_html'])) {?>
                                                <li><a href="#shop_dt_price">料金プラン</a></li>
                                            <?php }?>
                                            <?php if (!empty($brand['campaign_html'])) {?>
                                                <li><a href="#shop_dt_campaign">キャンペーン</a></li>
                                            <?php }?>
                                            <?php if (count($reviews) > 0) {?>
                                                <li><a href="#shop_dt_reviews">口コミ</a></li>
                                            <?php }?>
                                            <?php if (!empty($brand['shops'])) {?>
                                                <li><a href="#shop_dt_shop">運営店舗</a></li>
                                            <?php }?>
                                            <?php if (!empty($interviews)) {?>
                                                <li><a href="#shop_dt_interview">インタビュー</a></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                                if(!empty($brand['image_path'])) {
                                    ?>
                                    <div class="imgbox">
                                        <?php echo $this->Html->image(['controller'=> 'images', 'action'=> 'brandImage', $brand['brand_id']], ['alt'=> ''])?>
                                    </div>
                                    <?php
                                }
                                if (!empty($brand['affiliate_page_url'])) {
                                    ?>
                                    <div class="btnarea">
                                        <a href="<?=$brand['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                            if (!empty($brand['feature_html'])) {
                                ?>
                                <div id="shop_dt_feature" class="listwrap shopinfo brands">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>の特徴</h2>
                                    <?=$brand['feature_html']?>
                                    <?php
                                    if (!empty($brand['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?=$brand['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            if (!empty($brand['depilation_sites'])) {

                                $mens = "";
                                if ($brand['depilation_type'] == DepilationType::$MENS[CodePattern::$CODE]) {
                                    $mens = '_mens';
                                }
                                ?>
                                <div id="shop_dt_menu<?=$mens?>" class="listwrap shopmenu<?=!empty($mens) ? " mens" : ""?>">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>が対応している脱毛部位</h2>
                                    <div class="partwrap">
                                        <div class="imgbox">
                                            <?php
                                            echo $this->Html->image('/img/shop_dt_part_img'.$mens.'.gif', ['alt'=> '']);
                                            foreach ($brand['depilation_sites'] as $depilationSite) {
                                                ?>
                                                <span class="pointcircle <?php echo $depilationSite['url_text']?>"></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="partbox cf">
                                            <div class="part_list left">
                                                <ul>
                                                    <?php
                                                    foreach ($brand['depilation_sites'] as $depilationSite) {
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
                                </div>
                                <?php
                            }
                            if (!empty($brand['price_plan_html'])) {
                                ?>
                                <div id="shop_dt_price" class="listwrap shopmenu">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>の料金プラン</h2>
                                    <div class="scroll">
                                        <?=	$brand['price_plan_html']?>
                                    </div>
                                    <?php
                                    if (!empty($brand['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?=$brand['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            if (!empty($brand['campaign_html'])) {
                                ?>
                                <div id="shop_dt_campaign" class="listwrap shopmenu">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>のキャンペーン</h2>
                                    <?=$brand['campaign_html']?>
                                    <?php
                                    if (!empty($brand['affiliate_page_url'])) {
                                        ?>
                                        <div class="btnarea">
                                            <a href="<?=$brand['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            if (count($reviews) > 0) {
                                ?>
                                <div id="shop_dt_reviews" class="listwrap shopblog reviews">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>の評判・口コミ</h2>
                                    <div class="reviewslist_wrap">
                                        <?php
                                        foreach ($reviews as $key => $review) {
                                            $moreview = "";
                                            if ($key >= 3) {
                                                $moreview = " moreview hide";
                                            }
                                            ?>
                                            <div class="itembox<?=$moreview?>">
                                                <div class="titlearea cf">
                                                    <div class="shopnamebox">
                                                        <?=$this->Html->link($review['Shop']['name']. "[". Pref::convert($review['Shop']['pref'], CodePattern::$VALUE). "]",
                                                            ['controller'=> 'shops', 'action'=> 'detail', $review['Shop']['shop_id']])?>
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
                                                                    <div class="empty-star">★★★★★</div>
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
                                                    <div class="txtarea"><?=nl2br($review['content'])?></div>
                                                    <div class="underbox cf">
                                                        <div class="daycont">
                                                            <?php
                                                            echo !empty($review['visit_date']) ? "<span>来店日：". date('m/d', strtotime($review['visit_date'])). "</span>" : "";
                                                            echo !empty($review['post_date']) ? "<span>投稿日：". date('m/d', strtotime($review['post_date'])). "</span>" : "";
                                                            ?>
                                                        </div>
                                                        <?php
                                                        $isQuestion = false;
                                                        for ($i=1; $i<=6; $i++) {
                                                            $questionColumn = "question". $i;
                                                            if (!empty($review[$questionColumn])) {
                                                                $isQuestion = true;
                                                                break;
                                                            }
                                                        }
                                                        if ($isQuestion) {
                                                            ?>
                                                            <div class="cntlbtn">
                                                                <a href="" class="btn">評価をもっと見る</a>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question1'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question1'], CodePattern::$VALUE)?></span>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question2'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question2'], CodePattern::$VALUE)?></span>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question3'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question3'], CodePattern::$VALUE)?></span>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question4'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question4'], CodePattern::$VALUE)?></span>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question5'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE)?></span>
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
                                                                            <div class="filled-star" style=" width: <?= Satisfaction::convert($review['question6'], CodePattern::$VALUE2)?>%;">★★★★★</div>
                                                                        </div>
                                                                        <span class="points"><?= Satisfaction::convert($review['question6'], CodePattern::$VALUE)?></span>
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
                                        <div class="linkbtn">
                                            <?php
                                            echo $this->Html->link('<span>口コミ一覧はこちら</span>', ['controller'=> 'brands', 'action'=> 'reviewIndex', 'brand_id'=> $brand['brand_id']], ['escape'=> false]);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            if (!empty($brand['shops'])) {
                                ?>
                                <div id="shop_dt_shop" class="listwrap search">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>の運営店舗一覧</h2>
                                    <ul class="jp_map">
                                        <?php
                                        $prefs = Pref::getPrefForBrandDetail();
                                        foreach ($prefs as $pref) {

                                            $active = null;
                                            if (in_array($pref[CodePattern::$CODE], $brand['pref_cds'])) {
                                                $active = " class='active'";
                                            }
                                            ?>
                                            <li><a href="javascript:void(0);"<?=$active?>><span><?=$pref[CodePattern::$VALUE2]?></span></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="published_wrap">
                                        <div class="tbl">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <th>都道府県</th>
                                                    <th>最寄駅</th>
                                                    <th>店舗名</th>
                                                </tr>
                                                <?php
                                                foreach ($brand['shops'] as $shop) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?=$this->Html->link(Pref::convert($shop['pref'], CodePattern::$VALUE), ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($brand['shop_type'], CodePattern::$VALUE2), $shop['pref_url_text']])?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($shop['StationG'])) {
                                                                foreach ($shop['StationG'] as $stationG) {

                                                                    $connection = ",";
                                                                    if ($stationG === reset($shop['StationG'])) {
                                                                        $connection = "";
                                                                    }

                                                                    echo $connection. $this->Html->link($stationG['name'],
                                                                            ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($brand['shop_type'], CodePattern::$VALUE2), $shop['pref_url_text'], URLUtil::CITY.$stationG['area_id'], URLUtil::STATION_G. $stationG['station_g_cd']]);
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?=$this->Html->link($shop['name'], ['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']])?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        if (!empty($brand['affiliate_page_url'])) {
                                            ?>
                                            <div class="btnarea">
                                                <a href="<?=$brand['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            if (count($interviews) > 0) {
                                ?>
                                <div id="shop_dt_interview" class="listwrap shopblog">
                                    <h2 class="coomontit_h2"><?=$brand['name']?>のインタビュー</h2>
                                    <div class="shopblogarea">
                                        <?php
                                        foreach ($interviews as $interview) {
                                            $url = Router::url(['controller'=> 'shops', 'action'=> 'detail', $interview['shop_id']]);
                                            ?>
                                            <a href="<?=$url?>/" class="blogbox cf">
                                                <?php
                                                if (!empty($interview['interview_image_path'])) {
                                                    ?>
                                                    <div class="imgbox">
                                                        <?=$this->Html->image(['controller'=> 'images', 'action'=> 'interviewShopImage', $interview['shop_id']]);?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="textbox">
                                                    <div class="day"><?=$interview['name']?>[<?=Pref::convert($interview['pref'], CodePattern::$VALUE)?>]</div>
                                                    <div class="tit"><?=$interview['interview_title']?></div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                        if (count($interviews) > 3) {
                                            ?>
                                            <div class="morebtn">
                                                <a href="" class="btn"><span>もっと見る</span></a>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            if (!empty($brand['affiliate_banner_url'])) {
                                ?>
                                <div class="ad_banner_area listwrap">
                                    <a href="<?= $brand['affiliate_page_url']?>" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                        <?php echo $this->Html->image($brand['affiliate_banner_url'], ['alt'=> ''])?>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="listwrap shopblog reviews">
                                <h2 class="coomontit_h2">Purilがおすすめする<?= ShopType::convert($brand['shop_type'], CodePattern::$VALUE)?></h2>
                                <div class="recommend_box">
                                    <ul class="cf">
                                        <?php
                                        if ($brand['shop_type'] == ShopType::$DEPILATION_SALON[CodePattern::$CODE]) {
                                            $osusumes = [
                                                '恋肌'=> [
                                                    'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O',
                                                    'img'=> '/img/Top/koihada_top.jpg'
                                                ],
                                                'ストラッシュ'=> [
                                                    'url'=> 'https://track.affiliate-b.com/visit.php?guid=ON&a=47719r-V298788m&p=j648053O',
                                                    'img'=> '/img/stlassh.jpg'
                                                ],
                                                'ラココ'=> [
                                                    'url'=> 'https://www.tcs-asp.net/alink?AC=C102738&LC=MBTY1&SQ=0&isq=100',
                                                    'img'=> '/shop_img/466'
                                                ],
                                            ];
                                        } else {
                                            $osusumes = [
                                                'レジーナクリニック'=> [
                                                    'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=B8551a-G303613s&p=j648053O',
                                                    'img'=> 'https://puril.net/shop_img/576'
                                                ],
                                                'HMRクリニック'=> [
                                                    'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=x10802l-5364750L&p=j648053O',
                                                    'img'=> 'https://www.afi-b.com/upload_image/10802-1553274671-3.jpg'
                                                ],
                                                'リゼクリニック'=> [
                                                    'url'=> 'https://track.affiliate-b.com/visit.php?guid=ON&a=O5974K-t195506G&p=j648053O',
                                                    'img'=> 'https://www.affiliate-b.com/upload_image/5974-1379886349-3.gif'
                                                ]
                                            ];
                                        }

                                        foreach ($osusumes as $name => $osusume) {
                                            ?>
                                            <li>
                                                <a href="<?=$osusume['url']?>" target='_blank'>
                                                    <div class="logo"><?php echo $this->Html->image($osusume['img'], ['alt'=> ''])?></div>
                                                    <span><?=$name?></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <div class="linkbtn">
                                        <a href="<?=Router::url(['controller'=> 'brands', 'action'=> 'index'])?>/#brands_<?=ShopType::convert($brand['shop_type'], CodePattern::$VALUE2)?>">
                                            <span><?=$brand['shop_type'] == ShopType::$DEPILATION_SALON[CodePattern::$CODE] ? "サロン一覧へ" : "クリニック一覧へ";?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="listwrap column">
                                <div id="shopbtcolumn">
                                    <h2 class="coomontit_h2"><?php echo $brand['name'];?>の脱毛に関連するコラム</h2>
                                    <ul class="toc_list">
                                        <?php
                                        if (!empty($brand['brand_urls'])) {
                                            foreach ($brand['brand_urls'] as $brandUrl) {
                                                ?>
                                                <li><a href="<?=$brandUrl['url']?>"><?=$brandUrl['title']?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <li><a href="/column/special/">脱毛したい人必見！脱毛サロン・医療脱毛クリニックのおすすめ総合ランキング</a></li>
                                        <li><a href="/column/campaign/">脱毛オトク情報｜キャンペーン・モニター情報でオトクに脱毛！</a></li>
                                        <li><a href="/column/qa/advantage/">脱毛の掛け持ちで最高に得する方法とは？</a></li>
                                        <li><a href="/column/useful/">脱毛について完全理解！脱毛前後で知りたいこと、全部まとめました！</a></li>
                                        <li><a href="/column/useful/cost/">脱毛の費用と効果を比較！サロン？クリニック？自宅？あなたはどれ向き！？</a></li>
                                        <li><a href="/column/epilator/">家庭用脱毛器を徹底比較！おすすめ人気ランキングBEST20</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="shopdtbtsnsarea">
                                <h2 class="coomontit_h2">友達にシェアする</h2>
                                <?php $shareurl = Router::url(null,true);?>
                                <ul class="snsshare cf">
                                    <li class="tw"><a href="//twitter.com/share?url=<?php echo $shareurl ?>" target="_blank">ツイート</a></li>
                                    <li class="fb"><a href="//www.facebook.com/sharer/sharer.php?u=<?php echo $shareurl ?>" target="_blank">シェア</a></li>
                                    <li class="hb"><a href="//b.hatena.ne.jp/add?mode=confirm&url=<?php echo $shareurl ?>" target="_blank" rel="nofollow">はてぶ</a></li>
                                    <li class="li"><a href="//line.me/R/msg/text/?<?php echo $shareurl ?>" target="_blank">シェア</a></li>
                                    <li class="ml"><a href="mailto:?body=<?php echo $shareurl ?>">メール</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </main>
                <?= $this->element('Front/SearchResult/side')?>
            </div>
        </div>
    </div>
    <?php
    if (!empty($shop['affiliate_page_url'])) {
        ?>
        <div id="dtfixbtnarea">
            <a href="<?php echo $shop['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
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
    </script>
</div>
