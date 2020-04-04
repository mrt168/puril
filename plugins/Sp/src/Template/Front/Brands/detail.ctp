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
echo $this->Html->script('sp/chart');
echo $this->Html->css(['reset', 'all.min', 'Chart.min', 'common', 'datsumou/common', 'datsumou/brand/common', 'datsumou/brand/index']);
echo $this->Html->css('sp/shop-detail');
echo $this->Html->css('Chart.min.css');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<!--<nav class="content-base brand-breadcrumbs">-->
<!--      <ul class="brand-breadcrumbs-list">-->
<!--        <li><a href="--><? //=Router::url('/')
                            ?>
<!--">Purilトップ</a></li>-->
<!--        <li>--><?php //echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])
                    ?>
<!--</li>-->
<!--        <li>--><? //=$brand['name']
                    ?>
<!--</li>-->
<!--      </ul>-->
<!--    </nav>-->
<section class="content brand-top">
    <div class="brand-top-img-area">
        <div class="brand-top-img-base">
            <?php
            if (!empty($this->Html->image(['controller' => 'images', 'action' => 'brandImage', $brand['brand_id']], ['class' => 'brand-top-img', 'alt' => '']))) {
                echo $this->Html->image(['controller' => 'images', 'action' => 'brandImage', $brand['brand_id']], ['class' => 'brand-top-img', 'alt' => '']);
            } else {
                echo $this->Html->image('Shop/noimage.jpg', ['alt' => 'NoImage']);
            }
            ?>
            <div class="top-content">
                <!-- 店舗名 -->
                <h1 class="top-title">
                    <?php echo $brand['name']; ?>
                </h1>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="section-padding-inner top-section-inner">
            <!-- カテゴリー -->
            <p class="info-category">
                <?php
                if (!empty($brand['shop_type'])) {
                ?>
                    <?php
                    echo ShopType::convert($brand['shop_type'], CodePattern::$VALUE)
                    ?>
                <?php
                }
                ?>
            </p>
            <?php
            if (!empty($totalReview)) {
            ?>
                <div class="info-content">
                    <div class="info-star-wrap">
                        <!-- 評価（星）表示 -->
                        <ul class="stars">
                            <?php
                            $star = empty($totalReview['star']) ? 0 : $totalReview['star'];
                            $reviewCount = 0;
                            while ($reviewCount < $star) :
                                echo '<li class="star">';
                                echo '<img src="/puril/images/img/star-on.png">';
                                echo '</li>';
                                $reviewCount++;
                            endwhile;
                            ?>
                            <?php
                            while (5 - $reviewCount > 0) :
                                echo '<li class="star">';
                                echo '<img src="/puril/images/img/star-off.png">';
                                echo '</li>';
                                $reviewCount++;
                            endwhile;
                            ?>
                        </ul>
                        <!-- 評価 -->
                        <p class="star-expression">
                            <?= number_format($star, 2) ?>
                        </p>
                    </div>
                    <div class="info-comment-wrap">
                        <i class="comment-icon fas fa-comments"></i>
                        <!-- 評価件数 -->
                        <p class="comment-count"><?php echo $totalReview['review_cnt']; ?>件</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</section>
<section class="section" id="head-nav-section">
    <div id="head-nav">
        <ul class="fix-head-tabs">
            <li class="fix-head active" onclick="headNavTapped(this)" id="for-top-section">
                <span class="fix-head-text">トップ</span>
            </li>
            <li class="fix-head" onclick="headNavTapped(this)" id="for-price-section">
                <span class="fix-head-text">料金プラン</span>
            </li>
            <li class="fix-head" onclick="headNavTapped(this)" id="for-pamphlet-section">
                <span class="fix-head-text">脱毛部位</span>
            </li>
            <li class="fix-head" onclick="headNavTapped(this)" id="for-comment-section">
                <span class="fix-head-text">口コミ</span>
            </li>
            <li class="fix-head" onclick="headNavTapped(this)" id="for-shops-section">
                <span class="fix-head-text">運営店舗</span>
            </li>
        </ul>
    </div>
</section>
<script>
    function headNavTapped(e) {
        const id = e.id;
        const key = id.split('for-')[1];
        console.log(key)

        //headNavActivate(id);

        $("html,body").animate({
            scrollTop: $(`#${key}`).offset().top - 53
        }); // 43pxはfix-head
    }

    function headNavActivate(id) {
        $(".fix-head").removeClass("active");
        $(`#${id}`).addClass("active");
    }
</script>
<section id="top-section" class="section">
    <div class="section-padding-inner section-top-inner">
        <!-- 店舗説明 件名 -->
        <h2 class="section-inner-title">
            店舗情報
        </h2>
        <!-- 店舗説明 内容 -->
        <p class="top-section-text">
            <?php echo $brand['feature_html'] ?>
        </p>
    </div>
</section>
<div class="separator"></div>
<section id="price-section" class="section">
    <div class="section-padding-inner price-section-inner">
        <?php if (!empty($brand['price_plan_html'])) { ?>
            <div class="inner-elm-padding">
                <!-- 店舗名+脱毛メニュー+料金プラン -->
                <h2 class="section-inner-title">
                    <?php echo $brand['name']; ?>の脱毛メニューと料金プラン
                </h2>
            </div>
            <div class="price-between-margin"></div>
            <div class="inner-elm-padding">
                <!-- 店舗名+料金プラン -->
                <h3 class="section-inner-sub-title price-sub-title">
                    <?php echo $brand['name']; ?>の料金プラン
                </h3>
            </div>
            <div class="price-table-wrap">
                <?= $brand['price_plan_html'] ?>
            </div>
        <?php } ?>
        <script>
            function extractFromShopPlanHTML() {
                const shopPlanParent = document.getElementById('price');
                const title = shopPlanParent.getElementsByTagName('H2')[0].innerText.trim();
                const plans = [];
                const trs = shopPlanParent.getElementsByTagName('TR');
                for (let i = 0; i < trs.length; i++) {
                    const tr = trs[i];
                    const children = tr.children;
                    const menu = children.length >= 1 ? children[0].innerText.trim() : "";
                    const price = children.length >= 2 ? children[1].innerText.trim() : "";
                    const description = children.length >= 3 ? children[2].innerText.trim() : "";
                    plans.push({
                        menu,
                        price,
                        description
                    })
                }
                console.log(plans);
                return plans;
            }
        </script>
    </div>
</section>
<?php if (!empty($brand['price_plan_html'])) { ?>
    <div class="separator"></div>
<?php } ?>
<section id="pamphlet-section" class="content middle-content brand-datsumou" id="brand_depilation">
    <?php
    if (!empty($brand['depilation_sites'])) { ?>
        <h2 class="section-inner-title">
            <?php echo $brand['name']; ?>が対応できる脱毛部位
        </h2>
        <div class="price-between-margin"></div>
        <div class="inner-elm-padding">
            <!-- サービス内容 -->
            <ul class="services">
                <?php
                $depilation_site_num = 0;
                $depilation_sites_length = count($brand['depilation_sites']);
                foreach ($brand['depilation_sites'] as $depilationSite) {
                    echo '<li class="service">';
                    echo '<span class="service-text">' . $depilationSite['name'] . '</span>';
                    echo '</li>';

                    $depilation_site_num++;
                    if ($depilation_site_num == $depilation_sites_length) {
                        for ($i = 0; $i < 3 - ($depilation_sites_length % 3); $i++) {
                            echo '<li style="border:none" class="service">';
                            echo '<div></div>';
                            echo '</li>';
                        }
                    }
                }
                ?>
            </ul>
        </div>
    <?php } ?>
</section>
<?php if (!empty($brand['depilation_sites'])) { ?>
    <div class="separator"></div>
<?php } ?>
<section id="comment-section" class="content middle-content brand-kuchikomi" id="brand_reviews">
    <?php
    $testData = array();
    if (count($reviews) > 0) {
    ?>
        <div class="section-padding-inner comment-section-inner">
            <h2 class="section-inner-title comment-section-title">
                <?php echo $brand['name']; ?>の口コミ
            </h2>
            <ul class="brand-kuchikomi-list">
                <?php
                $reviewContentCount = 0;
                foreach ($reviews as $key => $review) {
                    $reviewContentCount++;
                    $reviewData = array(
                        "接客・サービス" => Satisfaction::convert($review['question1'], CodePattern::$VALUE) * 10,
                        "メニュー・ 料金" => Satisfaction::convert($review['question2'], CodePattern::$VALUE) * 10,
                        "効果" => Satisfaction::convert($review['question3'], CodePattern::$VALUE) * 10,
                        "雰囲気" => Satisfaction::convert($review['question4'], CodePattern::$VALUE) * 10,
                        "予約・立地" => Satisfaction::convert($review['question5'], CodePattern::$VALUE) * 10
                    );
                    array_push($testData, $reviewData);
                ?>
                    <li class="brand-kuchikomi-item">
                        <div class="brand-kuchikomi-item-wrap">
                            <div class="brand-kuchikomi-item-above">
                                <div class="brand-kuchikomi-title"><?= $this->Html->link(
                                                                        $review['Shop']['name'] . "[" . Pref::convert($review['Shop']['pref'], CodePattern::$VALUE) . "]",
                                                                        ['controller' => 'shops', 'action' => 'detail', $review['Shop']['shop_id']]
                                                                    ) ?></div>
                                <div class="brand-user-star-area">
                                    <div class="shop-star-area">
                                        <div class="shop-star">
                                            <?php
                                            $star = empty($review['evaluation']) ? 0 : $review['evaluation'];
                                            $reviewCount = 0;
                                            while ($reviewCount < $star) :
                                                echo '<img src="/puril/images/img/star-on.png">';
                                                $reviewCount++;
                                            endwhile;
                                            ?>
                                            <?php
                                            while (5 - $reviewCount > 0) :
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
                                </div>
                                <div class="brand-kuchikomi-month">
                                    <?php
                                    echo !empty($review['visit_date']) ? "<span>来店日：" . date('Y/m/d', strtotime($review['visit_date'])) . "</span>" : "";
                                    echo !empty($review['post_date']) ? "<span>投稿日：" . date('Y/m/d', strtotime($review['post_date'])) . "</span>" : "";
                                    ?>
                                </div>
                                <i class="fas fa-chevron-down brand-kuchikomi-arrow"></i>
                            </div>
                            <div class="brand-kuchikomi-item-below">
                                <div class="shop-kuchikomi-item-detail-wrap">
                                    <div class="comment-elm-wrap">
                                        <canvas class="comment-chart" id="commentChart<?= $reviewContentCount ?>"></canvas>
                                    </div>
                                    <?php if (!empty($review['content'])) : ?>
                                        <div class="shop-kuchikomi-item-detail">
                                            <div class="shop-kuchikomi-item-detail-title">この店舗の総合的な感想を教えて下さい</div>
                                            <p class="shop-kuchikomi-item-detail-text"><?= nl2br($review['content']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($review['reason'])) : ?>
                                        <div class="shop-kuchikomi-item-detail">
                                            <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                                            <p class="shop-kuchikomi-item-detail-text"><?= nl2br($review['reason']) ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">店舗の「接客／サービス」はいかがでしたか？</div>
                                        <div class="shop-kuchikomi-item-detail-review">
                                            <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                            <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question1'], CodePattern::$VALUE) ?></div>
                                        </div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= $review['question1_evaluation'] ?></p>
                                    </div>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">受けたサービスの「メニューや料金」についてはいかがでしたか？</div>
                                        <div class="shop-kuchikomi-item-detail-review">
                                            <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                            <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question2'], CodePattern::$VALUE) ?></div>
                                        </div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= $review['question2_evaluation'] ?></p>
                                    </div>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</div>
                                        <div class="shop-kuchikomi-item-detail-review">
                                            <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                            <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question3'], CodePattern::$VALUE) ?></div>
                                        </div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= $review['question3_evaluation'] ?></p>
                                    </div>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">店舗の「雰囲気」はいかがでしたか？</div>
                                        <div class="shop-kuchikomi-item-detail-review">
                                            <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                            <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question4'], CodePattern::$VALUE) ?></div>
                                        </div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= $review['question4_evaluation'] ?></p>
                                    </div>
                                    <div class="shop-kuchikomi-item-detail">
                                        <div class="shop-kuchikomi-item-detail-title">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</div>
                                        <div class="shop-kuchikomi-item-detail-review">
                                            <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                                            <div class="shop-kuchikomi-item-detail-review-point"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE) ?></div>
                                        </div>
                                        <p class="shop-kuchikomi-item-detail-text"><?= $review['question5_evaluation'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <?php $testData = json_encode($testData) ?>
            <script>
                const testData = <?php echo $testData; ?>;
                console.log(testData)
                renderCommentChart(testData);
            </script>
        </div>
        <!--<a class="show-more clickable-button" href="#">口コミをもっと見る（4件）</a>-->
    <?php } ?>
</section>
<?php if (count($reviews) > 0) { ?>
    <div class="separator"></div>
<?php } ?>
<section class="content middle-content brand-info-detail">
    <div class="brand-info-detail-area-wrap">
        <?php
        if (!empty($brand['affiliate_page_url'])) {
        ?>
            <div class="brand-info-detail-area">
                <h3 class="brand-info-detail-title">特徴・関連情報</h3>
                <a class="simple-button green" href="<?php echo $brand['affiliate_page_url']; ?>">
                    <span class="button-text">公式サイトへ</span>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="brand-info-detail-remark"><?= $brand['name']; ?>の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
    <div class="brand-info-detail-report">
        <?php echo $this->Html->link(
            '<span class="button-text">誤りを報告する</span>',
            ['controller' => 'contacts', 'action' => 'contact'],
            ['class' => 'simple-button simple button-13', 'escape' =>  false]
        ); ?>
    </div>
</section>
<div class="separator"></div>
<section class="section">
    <div class="section-padding-inner">
        <h2 class="section-inner-title">シェア</h2>
        <div class="share-button-wrap">
            <a class="simple-button simple button-13 fab fa-twitter twitter-icon">
                <span class="button-text">Twitter</span>
            </a>
        </div>
    </div>
</section>
<div class="separator"></div>
<section id="shops-section" class="content brand-shops" id="brand_shops">
    <?php if (!empty($brand['shops'])) {
    ?>
        <h2 class="content-title"><?= $brand['name'] ?>の運営店舗一覧</h2>
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
                            <?= $this->Html->link(Pref::convert($shop['pref'], CodePattern::$VALUE), ['controller' => 'searchs', 'action' => 'search', ShopType::convert($brand['shop_type'], CodePattern::$VALUE2), $shop['pref_url_text']]) ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($shop['StationG'])) {
                                foreach ($shop['StationG'] as $stationG) {

                                    $connection = ",";
                                    if ($stationG === reset($shop['StationG'])) {
                                        $connection = "";
                                    }

                                    echo $connection . $this->Html->link(
                                        $stationG['name'],
                                        ['controller' => 'searchs', 'action' => 'search', ShopType::convert($brand['shop_type'], CodePattern::$VALUE2), $shop['pref_url_text'], URLUtil::CITY . $stationG['area_id'], URLUtil::STATION_G . $stationG['station_g_cd']]
                                    );
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?= $this->Html->link($shop['name'], ['controller' => 'shops', 'action' => 'detail', $shop['shop_id']]) ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } ?>
</section>
<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>
<?php
echo $this->element('Front/search_breadcrumbs');
echo $this->element('Front/footer') ?>
<script type="text/javascript" src="/js/datsumou/brand/common.js"></script>
<script>
    $('.brand-nav-item').on('touchend', function() {
        $(this).addClass('active').siblings('.brand-nav-item').removeClass('active');
        let contentName = $(this).data('content');
    });
</script>
<script>
    window.onload = function() {
        const nav = $('#head-nav');
        const navHeight = nav.outerHeight();
        const navTop = nav.offset().top;
        const topSection = $("#top-section").offset().top;
        const priceSection = $("#price-section").offset().top;
        const pamphletSection = $("#pamphlet-section").offset().top;
        const commentSection = $("#comment-section").offset().top;
        const shopsSection = $("#shops-section").offset().top;
        /*const sectionScrollTopList = [topSection, priceSection, commentSection, gallerySection, accessSection,
            interviewSection
        ];*/

        function detectWhichActive(winTop) {
            winTop += 100; // いい感じに高さ調整
            if (topSection > winTop) {
                return 'for-top-section'
            } else if (priceSection >= winTop) {
                return 'for-top-section'
            } else if (pamphletSection >= winTop) {
                return 'for-price-section'
            } else if (commentSection >= winTop) {
                return 'for-pamphlet-section'
            } else if (shopsSection >= winTop) {
                return 'for-comment-section'
            } else {
                return 'for-shops-section'
            }
        }

        $(window).scroll(function() {
            const winTop = $(this).scrollTop();
            if (winTop >= navTop) {
                nav.addClass('fixed');
                $('#head-nav-section').css('height', `${navHeight}px`);
                $('.datsumou-header-inner').css('display', 'none');
            } else if (winTop <= navTop) {
                nav.removeClass('fixed')
                $('#head-nav-section').css('height', `auto`);
                $('.datsumou-header-inner').css('display', 'flex');
            }
            headNavActivate(detectWhichActive(winTop));
        });
    };
</script>
</body>

</html>