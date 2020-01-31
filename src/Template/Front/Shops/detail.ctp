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
<body>
<?php
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/shop/common', 'datsumou/shop/index', 'datsumou/photodetail']);
?>
<header class="shop-header">
    <div class="shop-header-inner"><a class="shop-header-back" href="/datsumou/brand"><i class="fas fa-chevron-left"></i></a>
        <div class="shop-header-title">キレイモ新宿本店</div><a class="shop-header-post" href="#">投稿</a>
    </div>
</header>
<nav class="content shop-nav">
    <div class="shop-nav-item active"><a class="shop-nav-item-text" href="/datsumou/shop/">トップ</a></div>
    <div class="shop-nav-item"><a class="shop-nav-item-text" href="#price">料金プラン</a></div>
    <div class="shop-nav-item"><a class="shop-nav-item-text" href="#photo">写真</a></div>
    <div class="shop-nav-item"><a class="shop-nav-item-text" href="#kuchikomi">口コミ</a></div>
    <!--
    <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/campaign.html">キャンペーン</a></div>
    -->
    <div class="shop-nav-item"><a class="shop-nav-item-text" href="#address">地図</a></div>
</nav>
<section class="content shop-top">
    <div class="shop-top-img-area">
        <div class="shop-top-img-base">
            <?php
            $imagenum = count($shop['shop_images']);
            if($imagenum === 1):
                foreach ($shop['shop_images'] as $shopImage) {
                    echo $this->Html->image(['controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']],array('class'=>'shop-top-img', ));
                }
            elseif($imagenum > 1):
                foreach ($shop['shop_images'] as $shopImage) {
                    echo $this->Html->image(['controller'=> 'images', 'action'=> 'shopImage', $shopImage['shop_image_id']],array('class'=>'shop-top-img', ));
                }
            else:
                echo '<img class="shop-top-img" src="/puril/images/img/datsumou/no-photo.jpg" alt="'.$shop->name.'">';
            endif;
            ?></div>
        <div class="shop-top-img-desc">
            <div class="shop-top-img-desc-sub">
                <div class="shop-top-img-sub-text"><?php echo $shop['description_subject']; ?></div>
            </div>
            <h1 class="shop-top-img-desc-text"><?php echo $shop['name']; ?> </h1>
        </div>
    </div>
    <div class="shop-top-desc-area">
        <div class="shop-top-desc-category">
            <?php echo $shop['shop_type'] ?>
            <?php
            foreach ($shop['depilation_sites'] as $depilationSite) {
                if ($depilationSite['depilation_site_id'] == 1) {
                    echo "・{$depilationSite['name']}";
                    break;
                }
                echo "・{$depilationSite['name']}";
            }
            ?>
        </div>        
        <?php
        if (!empty($shop['star']) && !empty($shop['review_cnt'])) {
            ?>
            <div class="shop-top-desc-middle">
                <div class="shop-top-desc-review">
                    <div class="shop-star-area">
                        <div class="shop-star">
                            <?php
                            $star = empty($shop['star']) ? 0 : $shop['star'];
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
                    <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                        <div class="shop-comment-count"><?php echo $shop['review_cnt'];?>件</div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="shop-top-desc-info">
            <?php if (!empty($shop['business_hours'])) { ?>
                <div class="shop-top-desc-info-common shop-top-desc-info-business">
                    <div class="shop-top-desc-info-common-tag shop-top-desc-info-business-tag">時</div>
                    <div class="shop-top-desc-info-common-text shop-top-desc-info-business-text"><?php echo $shop['business_hours']; ?></div>
                </div>
                <?php
            }
            if (!empty($shop['holiday'])) { ?>
                <div class="shop-top-desc-info-common shop-top-desc-info-holiday">
                    <div class="shop-top-desc-info-common-tag shop-top-desc-info-holiday-tag">休</div>
                    <div class="shop-top-desc-info-common-text shop-top-desc-info-holiday-text"><?php echo $shop['holiday']; ?></div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<section class="content middle-content shop-info">
    <h2 class="content-title">店舗情報</h2>
    <p class="content-feature"><span>最大</span><span class="content-feature-large">5,000</span><span>円のキャッシュバックあり！</span></p>
    <h3 class="content-title-sub"><?php echo $shop['description_subject']; ?></h3>
    <p class="content-text"><?php echo nl2br($shop['description_content']); ?></p>
</section>
<?php
if (!empty($shop['price_plan_html'])) {
    ?>
    <section class="content middle-content shop-plan" id="price">
        <h2 class="content-title">料金プラン</h2>
        <div>
            <?php
            echo $shop['price_plan_html'];
            ?>
        </div>
    </section>
    <?php
}
?>
<section class="content middle-content shop-datsumou">
    <h2 class="content-title">脱毛部位</h2>
    <ul class="shop-part-list">
        <?php
        foreach ($shop['depilation_sites'] as $depilationSite) {
            if ($depilationSite['depilation_site_id'] == 1) {
                echo '<li class="shop-part-common shop-part-active">'.$depilationSite['name'].'</li>';
                break;
            }
            echo '<li class="shop-part-common shop-part-active">'.$depilationSite['name'].'</li>';
        }
        ?>
    </ul>
</section>
<!--<section class="content middle-content shop-campaign">-->
<!--    <h2 class="content-title">キャンペーン</h2>-->
<!--    <ul class="shop-campaign-list">-->
<!--        <li class="shop-campain-item-wrap"><a class="clickable-button shop-campain-item" href="#">-->
<!--                <div class="shop-campain-item-tri"></div>-->
<!--                <div class="shop-campain-item-text">～クルーズ旅行やホテルレストランコースなどが当たる！～ 「旅・体験・食・生活」選べる秋のLove yourselfキャンペーン！</div><i class="fas fa-chevron-right shop-campain-item-arrow"></i></a></li>-->
<!--        <li class="shop-campain-item-wrap"><a class="clickable-button shop-campain-item" href="#">-->
<!--                <div class="shop-campain-item-tri"></div>-->
<!--                <div class="shop-campain-item-text">ハンド脱毛体験無料プレゼント</div><i class="fas fa-chevron-right shop-campain-item-arrow"></i></a></li>-->
<!--    </ul><a class="show-more clickable-button" href="/datsumou/shop/campaign.html">キャンペーンをもっと見る（4件）</a>-->
<!--</section>-->
<?php
$imagenum = count($shop['shop_images']);
if($imagenum > 0):
    ?>
    <section class="content middle-content shop-photo" id="photo">
        <h2 class="content-title">投稿写真</h2>
        <div class="shop-photo-list">
            <ul class="shop-photo-list-sub">
                <?php
                $count = 0;
                foreach ($shop['shop_images'] as $shopImage) {
                    if($count == 5) {
                        ?>
                        <li class="shop-photo-item"><a href="#">
                                <a href="/datsumou/shop/photo.html">
                                    <?php echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'modal-trigger',)); ?>
                                    <div class="shop-photo-over">
                                        <img class="shop-photo-icon" src="/puril/images/img/datsumou/camera.png">
                                        <div class="shop-photo-count"><?php echo $imagenum?>>
                                        </div>
                                    </div>
                                </a>
                            </a>
                        </li>
                        <?php
                    } elseif($count > 6 ) {
                        break;
                    } else {
                        ?>
                        <li class="shop-photo-item">
                            <a href="#">
                                <?php echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'modal-trigger',)); ?>
                            </a>
                        </li>
                        <?php
                    }
                    $count++;
                }
                ?>
            </ul>
        </div>
    </section>
<?php
endif;
?>
<?php
if (!empty($shop['reviews'])) {
    ?>
    <section class="content middle-content shop-kuchikomi" id="kuchikomi">
        <h2 class="content-title">口コミ</h2>
        <ul class="shop-kuchikomi-list">
            <?php
            foreach ($shop['reviews'] as $key => $review) {
                ?>
                <li class="shop-kuchikomi-item-wrap shop-kuchikomi-item">
                    <div class="shop-kuchikomi-item-above">
                        <div class="shop-kuchikomi-title"><?= $review['title'] ?></div>
                        <div class="shop-user-star-area">
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
                                <div class="shop-reviewer-name"><?= $review['nickname'] ?></div>
                            </div>
                            <!--                            <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>-->
                            <!--                                <div class="shop-reviewer-good-count">24件</div>-->
                            <!--                            </div>-->
                        </div>
                        <div class="shop-kuchikomi-month">
                            <?php
                            echo !empty($review['visit_date']) ? "<span>来店日：" . date('m/d', strtotime($review['visit_date'])) . "</span>" : "";
                            echo !empty($review['post_date']) ? "<span>投稿日：" . date('m/d', strtotime($review['post_date'])) . "</span>" : "";
                            ?>
                        </div><i class="fas fa-chevron-down shop-kuchikomi-arrow"></i>
                    </div>
                    <div class="shop-kuchikomi-item-below">
                        <div class="shop-kuchikomi-item-detail-wrap">
                            <div class="shop-kuchikomi-item-detail">
                                <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                                <p class="shop-kuchikomi-item-detail-text"><?= nl2br($review['content']) ?></p>
                            </div>
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
                </li>
            <?php } ?>
        </ul>
        <?php
        if(count($shop['reviews']) > 4) {
            ?>
            <a class="show-more clickable-button" href="/datsumou/shop/kuchikomi.html">口コミをもっと見る（<?php echo count($shop['reviews']);?>件）</a>
        <?php } ?>
    </section>
<?php } ?>
<section class="content middle-content shop-kuchikomi-post">
    <h2 class="content-title">口コミ投稿</h2>
    <div class="shop-kuchikomi-button-area"><a class="kuchikomi-button" href="#"><i class="fas fa-comments kuchikomi-button-icon"></i>
            <div class="kuchikomi-button-text">口コミを書く</div></a></div>
</section>
<section class="content middle-content shop-address" id="address">
    <h2 class="content-title">住所</h2>
    <a class="clickable-button shop-address-detail" href="">
        <div class="shop-address-text"><?php echo $shop['address']?></div></a>
    <div class="shop-address-map">
        <div id="map"></div>
    </div>
</section>
<section class="content middle-content shop-info-detail">
    <h2 class="content-title">店舗情報（詳細）</h2>
    <div class="shop-info-detail-area-wrap">
        <div class="shop-info-detail-area">
            <h3 class="shop-info-detail-title">店舗基本情報</h3>
            <table class="shop-info-detail-table">
                <tbody>
                <!--                <tr>-->
                <!--                    <th>予約・お問い合わせ</th>-->
                <!--                    <td class="tel-area-wrap"><a class="clickable-button tel-area" href="#"><i class="fas fa-phone-alt tel-icon"></i>-->
                <!--                            <div class="tel-number">0120-444-680</div></a></td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <th>予約可否</th>-->
                <!--                    <td>予約可</td>-->
                <!--                </tr>-->
                <?php
                if (!empty($shop['holiday']) || !empty($shop['holiday']) ) { ?>
                    <tr>
                        <th>営業時間・定休日</th>
                        <td>
                            <?php if(!empty($shop['business_hours'])):?>
                                <dt>営業時間</dt>
                                <dd><?php echo $shop['business_hours'];?></dd>
                            <?php endif;
                            if(!empty($shop['holiday'])):
                            ?>
                            <dt>定休日</dt>
                            <dd><?php echo $shop['holiday'];?></dd>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php } ?>
                <!--                <tr>-->
                <!--                    <th>予算</th>-->
                <!--                    <td>月額9,500円〜</td>-->
                <!--                </tr>-->
                <?php  if (!empty($shop['station'])) { ?>
                    <tr>
                        <th>交通手段</th>
                        <td><?php echo $shop['station'];?></td>
                    </tr>

                <?php }
                if (!empty($shop['credit_card'])) { ?>
                    <tr>
                        <th>支払い方法</th>
                        <td><?php echo $shop['credit_card']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        if (!empty($shop['staff']) || !empty($shop['parking'])) { ?>
            <div class="shop-info-detail-area">
                <h3 class="shop-info-detail-title">スタッフ・駐車場</h3>
                <table class="shop-info-detail-table">
                    <tbody>
                    <?php
                    if (!empty($shop['staff'])){?>
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
                    </tbody>
                </table>
            </div>
        <?php } ?>
        <?php
        if (!empty($shop['price_plan_html'])) {
            ?>
            <div class="shop-info-detail-area">
                <h3 class="shop-info-detail-title">料金プラン</h3>
                <div>
                    <?php
                    echo $shop['price_plan_html'];
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if (!empty($shop['affiliate_page_url'])) {
        ?>
        <div class="shop-info-detail-area">
            <h3 class="shop-info-detail-title">特徴・関連情報</h3>
            <table class="shop-info-detail-table">
                <tbody>

                    <tr>
                        <th>ホームページ</th>
                        <td><a href="<?php echo $shop['affiliate_page_url'];?>" target="_blank">公式サイトから予約する</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
            <?php
        }
        ?>
    </div>
    <div class="shop-info-detail-remark"><?php echo $shop['name'];?>の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
    <div class="shop-info-detail-report">
        <?php echo $this->Html->link('誤りを報告する', ['controller'=> 'contacts', 'action'=> 'contact'],['class'=>'clickable-button shop-info-detail-report-button']);?></div>
</section>
<section class="content shop-share">
    <h2 class="content-title">シェア</h2>
    <div class="share-twitter"><a class="clickable-button share-twitter-button" href="//twitter.com/share?url=https://puril.net"><i class="fab fa-twitter twitter-icon"></i>
            <div class="share-twitter-text">Twitter</div></a></div>
</section>
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
<footer class="content shop-footer"><a class="button-base kuchikomi-button" href="/datsumou/kuchikomi-entry.html"><i class="fas fa-phone-alt kuchikomi-button-icon"></i>
        <div class="kuchikomi-button-text">口コミを書く</div></a><a class="button-base reservatopn-button" href="#"><i class="fas fa-phone-alt reservatopn-button-icon"></i>
        <div class="reservatopn-button-text">電話・ネット予約</div></a></footer>
<div class="content photo-modal" id="photo-modal">
    <div class="photo-detail-wrap">
        <header class="datsumou-photo-header">
            <div class="datsumou-photo-header-inner"><a class="clickable-button" href="#" id="photo-modal-close"><i class="fas fa-times datsumou-photo-header-cancel"></i></a>
                <div class="datsumou-photo-header-main">1/6</div>
                <div class="datsumou-photo-header-void"></div>
            </div>
        </header>
        <div class="photo-detail-main"><img class="photo-detail-img" src="/puril/images/img/datsumou/post/post-image-2-large.jpg" alt="投稿写真2" id="photo-detail-img"></div>
        <div class="photo-detail-below">
            <div class="photo-detail-info">
                <div class="photo-detail-info-date">2019/07</div>
                <div class="photo-detail-info-name">by taro</div>
            </div>
            <div class="photo-detail-like"><a class="clickable-button photo-detail-like-area" href="#"><i class="fas fa-heart photo-detail-like-icon"></i>
                    <div class="photo-detail-like-text">いいね！</div></a><a class="photo-detail-like-kuchikomi" href="/datsumou/shopuser/kuchikomi.html">この写真の口コミをみる</a></div>
            <div class="datsumou-photo-footer">
                <div class="datsumou-photo-footer-inner">※写真はユーザーが通院した当時の内容ですので、最新の情報とは異なる可能性があります。</div>
            </div>
            <div class="photo-detail-see-all">全ての写真を見る（143枚）</div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/datsumou/shop/common.js"></script>
<script type="text/javascript" src="/js/datsumou/photo-modal.js"></script>
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
</body>
</html>