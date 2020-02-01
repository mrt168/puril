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
<body>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/ranking/index']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<h1 class="content ranking-title">
    <span class="area"><?php echo $placeName;?></span><span class="small">の</span><span class="facility"><?php echo $shopTypeVal;	?></span><span class="small"><?php echo !empty($condition) ? $condition."の":"" ;?>ランキング</span></h1>
<p class="content ranking-text">Purilに寄せられた口コミに基づいて、ランキング形式で人気順にご紹介！全国の店舗ランキングもご覧いただけます！</p>
<ul class="content-base ranking-category">
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="<?=Router::url('/datsumou/'. URLUtil::RANKING. "/salon")?>"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の脱毛サロンの人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="<?=Router::url('/datsumou/'. URLUtil::RANKING. "/clinic")?>"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
<!--    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>-->
<!--            <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>-->
</ul>
<div class="content-base ranking-shop">
    <ul class="ranking-shop-list">
        <?php
        foreach ($shops as $key => $shop) {
            if (!$isBrandRanking) {
                ?>
                <li class="content ranking-shop-item"><a class="plain-link" href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $shop->shop_id], true);?>">
                        <div class="ranking-shop-title"><i class="fas fa-crown ranking-shop-title-icon crown-first"></i>
                            <div class="ranking-shop-title-text"><?php echo $shop->name;?></div>
                        </div>
                        <div class="ranking-shop-photo-area">
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
                                <div class="ranking-shop-photo"><img src="<?php echo $imgUrl;?>" alt="<?php echo $shop->name;?>"></div>
                                <?php
                                $img_count++;
                                if($img_count > 2) {
                                    break;
                                }
                            }
                            ?>
                            <?php while($img_count < 3):?>
                                <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>

                                <?php
                                $img_count++;
                            endwhile;?>
                        </div>
                        <?php
                        if($shop->review_cnt > 0):?>
                            <div class="ranking-shop-label">
                                <div class="ranking-shop-review">
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
                            </div>
                            <!--                    <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>-->
                        <?php endif;?>
                        <?php
                        if(!empty($shop['reviews'])) {?>
                            <div class="ranking-shop-comment">
                                <ul class="ranking-shop-comment-list">
                                    <?php

                                    foreach ($shop['reviews'] as $key => $review) {
                                        ?>
                                        <li class="ranking-shop-comment-item">
                                            <div class="ranking-shop-comment-text"><?= $review['title'] ?></div>
                                            <div class="ranking-shop-comment-user"><?= $review['nickname'] ?></div>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        <?php }
                        ?>
                    </a></li>
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
        ?>
    </ul>
</div>
<ul class="content-base ranking-category">

    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="<?=Router::url('/datsumou/'. URLUtil::RANKING. "/salon")?>"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の脱毛サロンの人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="<?=Router::url('/datsumou/'. URLUtil::RANKING. "/clinic")?>"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <!-- <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">ブランドランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li> -->
<!--    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>-->
<!--            <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>-->
</ul>

<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>

<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span
                        itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou')?>"><span itemprop="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <span class="breaditem"><a href="<?=Router::url('/'. URLUtil::RANKING. "/")?>"><span>全国の脱毛施設の口コミランキング</span></a></span>
        <?php
        if (!empty($pankuzus)) {
            $i = 1;
            $pankzuCnt = count($pankuzus);
            foreach ($pankuzus as  $pankuzu) {
                if ($i == $pankzuCnt) {

                    ?>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <span itemprop='name'><?php echo $pankuzu['val']?>口コミランキング</span>
                        <meta itemprop="position" content="<?php echo $i + 2;?>">
                    </li>
                    <?php
                    continue;
                }
                ?>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
                       href="<?=$pankuzu['url']. "/"?>"><span itemprop="name"><?php echo $pankuzu['val']?><</span></a>
                    <meta itemprop="position" content="<?php echo $i + 2;?>">
                </li>
                <?php
                $i++;
            }
        }
        ?>

    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
</body>
</html>