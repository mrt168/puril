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
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<!--<nav class="content-base brand-breadcrumbs">-->
<!--      <ul class="brand-breadcrumbs-list">-->
<!--        <li><a href="--><?//=Router::url('/')?><!--">Purilトップ</a></li>-->
<!--        <li>--><?php //echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?><!--</li>-->
<!--        <li>--><?//=$brand['name']?><!--</li>-->
<!--      </ul>-->
<!--    </nav>-->
<nav class="content brand-nav">
    <div class="brand-nav-item active" data-content="brand-top"><span class="brand-nav-item-text">トップ</span></div>
    <?php if (!empty($brand['price_plan_html'])) {?>
        <a href="#brand_price" class="brand-nav-item" data-content="brand-plan"><span class="brand-nav-item-text">料金プラン</span></a>
    <?php }?>
    <?php if (!empty($brand['depilation_sites'])) {?>
        <a href="#brand_depilation" class="brand-nav-item" data-content="brand-datsumou"><span class="brand-nav-item-text">脱毛部位</span></a>
    <?php }?>
    <?php if (count($reviews) > 0) {?>
        <a href="#brand_reviews" class="brand-nav-item" data-content="brand-kuchikomi"><span class="brand-nav-item-text">口コミ</span></a>
    <?php }?>
    <!--      <div class="brand-nav-item" data-content="brand-campaign"><span class="brand-nav-item-text">キャンペーン</span></div>-->
    <?php if (!empty($brand['shops'])) { ?>
        <a href="#brand_shops" class="brand-nav-item" data-content="brand-shop"><span class="brand-nav-item-text">運営店舗</span></a>
    <?php }?>
</nav>
<section class="content brand-top">
    <?php
    if(!empty($brand['image_path'])) {
        ?>
        <div class="brand-top-img-area">
            <div class="brand-top-img-base">
                <?php echo $this->Html->image(['controller'=> 'images', 'action'=> 'brandImage', $brand['brand_id']], ['class'=>'brand-top-img','alt'=> ''])?>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="brand-top-desc-area">
        <div class="brand-top-desc-category">
            <?php echo ShopType::convert($brand['shop_type'], CodePattern::$VALUE) ?></div>

        <?php if(!empty($totalReview)):?>
        <div class="brand-top-desc-middle">
            <div class="brand-top-desc-review">
                <div class="shop-star-area">
                    <div class="shop-star">
                        <?php
                        $star = empty($totalReview['star']) ? 0 : $totalReview['star'];
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
                </div>
                <div class="shop-point"><?=number_format($totalReview['star'], 1)?></div>
            </div>
            <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                <div class="shop-comment-count"><?=$totalReview['review_cnt']?>件</div>
            </div>
        </div>
        <?php endif;?>
    </div>
</section>
<section class="content middle-content brand-info">
    <h2 class="content-title">店舗情報</h2>
    <p class="content-feature"><span>最大</span><span class="content-feature-large">5,000</span><span>円のキャッシュバックあり！</span></p>
    <div class="content-text"><?=$brand['feature_html']?></div>
</section>
<?php if (!empty($brand['price_plan_html'])) {?>
<section class="content middle-content brand-plan" id="brand_price">
    <h2 class="content-title">料金プラン</h2>
    <div>
        <?=	$brand['price_plan_html']?>
    </div>
</section>
<?php }
if (!empty($brand['depilation_sites'])) { ?>
    <section class="content middle-content brand-datsumou" id="brand_depilation">
        <h2 class="content-title">脱毛部位</h2>
        <ul class="brand-part-list">
            <?php
            foreach ($brand['depilation_sites'] as $depilationSite) {
                echo '<li class="brand-part-common brand-part-active">' . $depilationSite['name'] . '</li>';
            }
            ?>
        </ul>
    </section>
    <?php
}
if (count($reviews) > 0) {
    ?>
    <section class="content middle-content brand-kuchikomi" id="brand_reviews">
        <h2 class="content-title">口コミ</h2>
        <ul class="brand-kuchikomi-list">
            <?php
            foreach ($reviews as $key => $review) {
                ?>
                <li class="brand-kuchikomi-item">
                    <div class="brand-kuchikomi-item-wrap">
                        <div class="brand-kuchikomi-item-above">
                            <div class="brand-kuchikomi-title"><?=$this->Html->link($review['Shop']['name']. "[". Pref::convert($review['Shop']['pref'], CodePattern::$VALUE). "]",
                                    ['controller'=> 'shops', 'action'=> 'detail', $review['Shop']['shop_id']])?></div>
                            <div class="brand-user-star-area">
                                <div class="shop-star-area">
                                    <div class="shop-star">
                                        <?php
                                        $star = empty($review['evaluation']) ? 0 : $review['evaluation'];
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
                                    <div class="shop-point"><?= $review['evaluation'] ?></div>
                                </div>
                            </div>
                            <div class="shop-reviewer-area">
                                <div class="shop-reviewer-name-area">
                                    <div class="shop-reviewer-name"><?=$review['nickname']?></div>
                                </div>
                            </div>
                            <div class="brand-kuchikomi-month">
                                <?php
                                echo !empty($review['visit_date']) ? "<span>来店日：". date('Y/m/d', strtotime($review['visit_date'])). "</span>" : "";
                                echo !empty($review['post_date']) ? "<span>投稿日：". date('Y/m/d', strtotime($review['post_date'])). "</span>" : "";
                                ?>
                            </div>
                            <i class="fas fa-chevron-down brand-kuchikomi-arrow"></i>
                        </div>
                        <div class="brand-kuchikomi-item-below">
                            <div class="shop-kuchikomi-item-detail-wrap">
                                <?php if(!empty($review['content'])):?>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">この店舗の総合的な感想を教えて下さい</div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= nl2br($review['content']) ?></p>
                                    </div>
                                <?php endif;?>
                                <?php if(!empty($review['reason'])):?>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= nl2br($review['reason']) ?></p>
                                    </div>
                                <?php endif;?>
                                <div class="shop-kuchikomi-item-detail">
                                    <div class="shop-kuchikomi-item-detail-title">店舗の「接客／サービス」はいかがでしたか？</div>
                                    <div class="shop-kuchikomi-item-detail-review">
                                        <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                        <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question1'], CodePattern::$VALUE) ?></div>
                                    </div>
                                    <p class="shop-kuchikomi-item-detail-text"><?= $review['question1_evaluation']?></p>
                                </div>
                                <div class="shop-kuchikomi-item-detail">
                                    <div class="shop-kuchikomi-item-detail-title">受けたサービスの「メニューや料金」についてはいかがでしたか？</div>
                                    <div class="shop-kuchikomi-item-detail-review">
                                        <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                        <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question2'], CodePattern::$VALUE) ?></div>
                                    </div>
                                    <p class="shop-kuchikomi-item-detail-text"><?= $review['question2_evaluation']?></p>
                                </div>
                                <div class="shop-kuchikomi-item-detail">
                                    <div class="shop-kuchikomi-item-detail-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</div>
                                    <div class="shop-kuchikomi-item-detail-review">
                                        <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                        <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question3'], CodePattern::$VALUE) ?></div>
                                    </div>
                                    <p class="shop-kuchikomi-item-detail-text"><?= $review['question3_evaluation']?></p>
                                </div>
                                <div class="shop-kuchikomi-item-detail">
                                    <div class="shop-kuchikomi-item-detail-title">店舗の「雰囲気」はいかがでしたか？</div>
                                    <div class="shop-kuchikomi-item-detail-review">
                                        <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                        <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question4'], CodePattern::$VALUE) ?></div>
                                    </div>
                                    <p class="shop-kuchikomi-item-detail-text"><?= $review['question4_evaluation']?></p>
                                </div>
                                <div class="shop-kuchikomi-item-detail">
                                    <div class="shop-kuchikomi-item-detail-title">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</div>
                                    <div class="shop-kuchikomi-item-detail-review">
                                        <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                        <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE) ?></div>
                                    </div>
                                    <p class="shop-kuchikomi-item-detail-text"><?= $review['question5_evaluation']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <!--<a class="show-more clickable-button" href="#">口コミをもっと見る（4件）</a>-->
    </section>
<?php } ?>
<section class="content middle-content brand-info-detail">
    <div class="brand-info-detail-area-wrap">
        <?php
        if (!empty($brand['affiliate_page_url'])) {
        ?>
        <div class="brand-info-detail-area">
            <h3 class="brand-info-detail-title">特徴・関連情報</h3>
            <table class="brand-info-detail-table">
                <tbody>
                <tr>
                    <th>ホームページ</th>
                    <td><a href="<?php echo $brand['affiliate_page_url'];?>">公式サイトから予約する</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </div>
    <div class="brand-info-detail-remark"><?= $brand['name'];?>の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
    <div class="brand-info-detail-report">
        <?php echo $this->Html->link('誤りを報告する', ['controller'=> 'contacts', 'action'=> 'contact'],['class'=>'clickable-button brand-info-detail-report-button']);?>
        </div>
</section>
<section class="content middle-content brand-share">
    <h2 class="content-title">シェア</h2>
    <?php $shareurl = Router::url(null,true);?>
    <div class="share-twitter"><a class="clickable-button share-twitter-button" href="//twitter.com/share?url=<?php echo $shareurl ?>"><i class="fab fa-twitter twitter-icon"></i>
            <div class="share-twitter-text">Twitter</div></a></div>
</section>
<?php if (!empty($brand['shops'])) {
?>
<section class="content brand-shops" id="brand_shops">
    <h2 class="content-title"><?=$brand['name']?>の運営店舗一覧</h2>
    <table class="shop-list">
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
    <?php
    }?>
</section>
<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>

<div class="Search__breadcrumbs">
    <ol>
        <li>
            <a href="<?=Router::url('/')?>"><span itemprop="name"  class="name">TOP</span></a>
            <meta itemprop="position" content="1">
        </li>
        <li>
            <a href="<?=Router::url('/datsumou')?>"><span itemprop="name" class="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li>
            <?php echo $this->Html->link("<span itemprop='name' class='name'>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?>
            <meta itemprop="position" content="3">
        </li>
        <li>
            <?php echo "<span itemprop='name' class='name'>{$brand['name']}</span>"?>
            <meta itemprop="position" content="4">
        </li>
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
<script type="text/javascript" src="/js/datsumou/brand/common.js"></script>
<script>
    $('.brand-nav-item').on('touchend',function(){
        $(this).addClass('active').siblings('.brand-nav-item').removeClass('active');
        let contentName = $(this).data('content');
    });

</script>
</body>
</html>