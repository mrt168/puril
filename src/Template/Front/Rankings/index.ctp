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
<body>
<?php
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/ranking/index']);
?>
<header class="datsumou-header">
    <div class="datsumou-header-inner"><a href="#"><img class="datsumou-header-puril" src="/puril/images/img/puril-colored.png" alt="Puril"></a><a href="#"><i class="fas fa-bars datsumou-header-hamburger"></i></a></div>
</header>
<h1 class="content ranking-title">全国の脱毛サロンの人気ランキング</h1>
<p class="content ranking-text">Purilに寄せられた口コミに基づいて、ランキング形式で人気順にご紹介！全国の店舗ランキングはもちろん、ブランドごとのランキングもご覧いただけます！</p>
<ul class="content-base ranking-category">
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">ブランドランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
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
                        <div class="ranking-shop-comment">
                            <ul class="ranking-shop-comment-list">
                                <?php
                                foreach ($shop['reviews'] as $key => $review) {
                                    ?>
                                    <li class="ranking-shop-comment-item">
                                        <div class="ranking-shop-comment-text"><?=$review['title']?></div>
                                        <div class="ranking-shop-comment-user"><?=$review['nickname']?></div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div></a></li>
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
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">ブランドランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
            <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
</ul>
<div class="content ranking-search-salon">
    <h2 class="ranking-search-salon-title">サロン・クリニックを探す</h2>
    <div class="ranking-search-salon-options"><a class="plain-link ranking-search-salon-option ranking-search-salon-areastation" href="#"><img class="ranking-search-salon-option-img" src="/puril/images/img/datsumou/area-and-station.png" alt="エリア・駅から探す">
            <div class="ranking-search-salon-option-text">エリア・駅から探す</div></a><a class="plain-link ranking-search-salon-option ranking-search-salon-currentsite" href="#"><img class="ranking-search-salon-option-img" src="/puril/images/img/datsumou/current-site.png" alt="現在地から探す">
            <div class="ranking-search-salon-option-text">現在地から探す</div></a></div>
</div>
<ul class="content ranking-searchfrom">
    <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><img class="ranking-searchfrom-item-icon" src="/puril/images/img/japan.png">
            <div class="ranking-searchfrom-item-text">地域から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-user ranking-searchfrom-item-icon"></i>
            <div class="ranking-searchfrom-item-text">脱毛部位から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-newspaper ranking-searchfrom-item-icon"></i>
            <div class="ranking-searchfrom-item-text">脱毛サロン・クリニック一覧から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-comments ranking-searchfrom-item-icon"></i>
            <div class="ranking-searchfrom-item-text">口コミから探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="far fa-hand-point-right ranking-searchfrom-item-icon"></i>
            <div class="ranking-searchfrom-item-text">こだわり条件から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
</ul>
<div class="content-base campaign"><a href="#"><img src="/puril/images/img/datsumou/brand/cashback-campaign.jpg" alt="キャッシュバックキャンペーン"></a></div>
<nav class="content-base breadcrumbs"><i class="fas fa-home home-icon"></i>
    <ul class="breadcrumbs-list">
        <li><a href="#">ホーム</a></li>
        <li><a href="#">脱毛</a></li>
        <li><a href="#">全国脱</a></li>
        <li><a href="#">全国脱毛サ</a></li>
        <li><a href="#">東京脱</a></li>
        <li><a href="#">キレイモ新宿</a></li>
    </ul>
</nav>
<div class="content links">
    <ul class="links-list">
        <li class="links-item"><a href="#">脱毛</a></li>
        <li class="links-item"><a href="#">リラク</a></li>
        <li class="links-item"><a href="#">痩身</a></li>
        <li class="links-item"><a href="#">フェイシャル</a></li>
        <li class="links-item"><a href="#">運営企業</a></li>
        <li class="links-item"><a href="#">利用規約</a></li>
        <li class="links-item"><a href="#">プライバシーポリシー</a></li>
        <li class="links-item"><a href="#">サイトマップ</a></li>
        <li class="links-item"><a href="#">口コミキャッシュバック</a></li>
        <li class="links-item"><a href="#">ユーザーレビューのお問い合わせ</a></li>
        <li class="links-item"><a href="#">施設情報掲載のお問い合わせ</a></li>
    </ul>
</div>
<div class="content-base footer"><img class="footer-puril" src="/puril/images/img/puril.png" alt="Puril">
    <div class="footer-copy">Copyright © ツルツル株式会社 All rights reserved.</div>
</div>
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
</html>