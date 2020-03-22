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
    <style>
        #map {
            height: 200px;
        }
    </style>
    <?php
    echo $this->Html->css('datsumou');
    echo $this->Html->css('sp/shop-detail');
    echo $this->Html->css(['reset', 'all.min', 'Chart.min', 'common', 'datsumou/common', 'datsumou/shop/common', 'datsumou/shop/index', 'datsumou/photodetail']);
    ?>
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
    <header class="datsumou-header">
        <?php
        echo $this->element('Front/header')
        ?>
    </header>
    <!-- ---------------------------------------------- -->
    <div id="main-entry">
        <section class="section top-section">
            <!-- 店舗画像 -->
            <?php
            $imagenum = count($shop['shop_images']);
            if ($imagenum === 1) :
                foreach ($shop['shop_images'] as $shopImage) {
                    echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'top-img',));
                } elseif ($imagenum > 1) :
                foreach ($shop['shop_images'] as $shopImage) {
                    echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'top-img',));
                    break;
                } else :
                echo '<img class="top-img" src="/puril/images/img/datsumou/no-photo.jpg" alt="' . $shop->name . '">';
            endif;
            ?>
            <div class="top-content">
                <!-- 店舗説明 -->
                <p class="top-catch">
                    <?php echo $shop['description_subject']; ?>
                </p>
                <!-- 店舗名 -->
                <h1 class="top-title">
                    <?php echo $shop['name']; ?>
                </h1>
            </div>
        </section>
        <section class="section">
            <div class="section-padding-inner top-section-inner">
                <!-- カテゴリー -->
                <p class="info-category">
                    <?php
                    if (!empty($shop['station_name'])) {
                    ?>
                        <?php
                        $nearStations = '';
                        foreach ($shop['station_name'] as $key => $stationName) {
                            $nearStations .= $stationName;
                            $nearStations .= '/';
                        }
                        echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                        ?>
                    <?php
                        echo '/';
                    }
                    ?>
                    <?php echo $shop['shop_type'] ?>
                </p>
                <?php
                if (!empty($shop['star']) && !empty($shop['review_cnt'])) {
                ?>
                    <div class="info-content">
                        <div class="info-star-wrap">
                            <!-- 評価（星）表示 -->
                            <ul class="stars">
                                <?php
                                $star = empty($shop['star']) ? 0 : $shop['star'];
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
                            <p class="comment-count"><?php echo $shop['review_cnt']; ?>件</p>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($shop['business_hours'])) { ?>
                    <div class="info-common-tag-wrap">
                        <span class="info-common-icon">時</span>
                        <!-- 営業時間 -->
                        <p class="info-common-content">
                            <?php echo $shop['business_hours']; ?>
                        </p>
                    </div>
                <?php
                }
                if (!empty($shop['holiday'])) { ?>
                    <div class="info-common-tag-wrap">
                        <span class="info-common-icon">休</span>
                        <!-- 休日 -->
                        <p class="info-common-content">
                            <?php echo $shop['holiday']; ?>
                        </p>
                    </div>
                <?php
                }
                ?>
            </div>
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
                    <li class="fix-head" onclick="headNavTapped(this)" id="for-comment-section">
                        <span class="fix-head-text">口コミ</span>
                    </li>
                    <li class="fix-head" onclick="headNavTapped(this)" id="for-gallery-section">
                        <span class="fix-head-text">ギャラリー</span>
                    </li>
                    <li class="fix-head" onclick="headNavTapped(this)" id="for-access-section">
                        <span class="fix-head-text">アクセス</span>
                    </li>
                    <li class="fix-head" onclick="headNavTapped(this)" id="for-interview-section">
                        <span class="fix-head-text">インタビュー</span>
                    </li>
                    <li class="fix-head">
                        <a href="" class="fix-head-text">予約</a>
                    </li>
                </ul>
            </div>
        </section>
        <script>
            function headNavTapped(e) {
                const id = e.id;
                const key = id.split('for-')[1];
                console.log(key)

                $(".fix-head").removeClass("active");
                $(`#${id}`).addClass("active");
                $("html,body").animate({
                    scrollTop: $(`#${key}`).offset().top - 53
                }); // 43pxはfix-head
            }
        </script>
        <section id="top-section" class="section">
            <div class="section-padding-inner section-top-inner">
                <!-- 店舗説明 件名 -->
                <h2 class="section-inner-title">
                    <?php echo $shop['description_subject']; ?>
                </h2>
                <!-- 店舗説明 内容 -->
                <p class="top-section-text">
                    <?php echo $shop['description_content']; ?>
                </p>
            </div>
        </section>
        <div class="separator"></div>
        <?php if (!empty($shop['affiliate_page_url'])) { ?>
            <section class="section">
                <div class="section-padding-inner">
                    <!-- 公式URL -->
                    <a class="simple-button green" href="<?php echo $shop['affiliate_page_url']; ?>">
                        <span class="button-text">公式サイトへ</span>
                    </a>
                </div>
            </section>
            <div class="separator"></div>
        <?php } ?>
        <section id="price-section" class="section">
            <div class="section-padding-inner price-section-inner">
                <div class="inner-elm-padding">
                    <!-- 店舗名+脱毛メニュー+料金プラン -->
                    <h2 class="section-inner-title">
                        <?php echo $shop['name']; ?>の脱毛メニューと料金プラン
                    </h2>
                </div>
                <div class="price-between-margin"></div>
                <div class="inner-elm-padding">
                    <!-- 店舗名+料金プラン -->
                    <h3 class="section-inner-sub-title price-sub-title">
                        <?php echo $shop['name']; ?>の料金プラン
                    </h3>
                </div>
                <div class="price-table-wrap">
                    <!-- DBから取得 -->
                    <ul class="price-table">
                        <li class="price-table-elm">
                            <div class="price-table-elm-part price-table-left">永久メンテナンスコース</div>
                            <div class="price-table-elm-part price-table-middle">月額 5,834円（税抜）</div>
                            <div class="price-table-elm-part price-table-right">
                                全身53パーツ・安心の永久保証　※初回は7,138円・36回支払いを利用した場合の月額料金(別途ボーナス加算あり)</div>
                        </li>
                    </ul>
                </div>
                <div class="inner-elm-padding">
                    <!-- 店舗名+ -->
                    <h3 class="section-inner-sub-title services-sub-title">
                        <?php echo $shop['name']; ?>が対応できる脱毛部位
                    </h3>
                </div>
                <div class="inner-elm-padding">
                    <!-- DBから取得 -->
                    <ul class="services">
                        <?php
                        foreach ($shop['depilation_sites'] as $depilationSite) {
                            echo '<li class="service">';
                            echo '<span class="service-text">' . $depilationSite['name'] . '</span>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <!-- 店舗名+特徴+こだわり -->
                <h2 class="section-inner-title"><?php echo $shop['name']; ?>の特徴・こだわり</h2>
                <div class="kodawaris-wrap">
                    <!-- DBから取得 -->
                    <ul class="kodawaris">
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                        <li class="kodawari">
                            <img class="kodawari-img" src="./img/shop-detail/hospital.png" />
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section id="comment-section" class="section">
            <div class="section-padding-inner comment-section-inner">
                <!-- DBから取得 -->
                <h2 class="section-inner-title comment-section-title">
                    <?php echo $shop['name']; ?>の口コミ（<?php echo count($shop['reviews']) ?>件）
                </h2>
                <?php
                foreach ($shop['reviews'] as $key => $review) {
                ?>
                    <article class="comment-wrap">
                        <input class="comment-input" type="checkbox" id="comment-input-1" />
                        <label class="comment-label" for="comment-input-1">
                            <div class="comment-label-left">
                                <div class="comment-label-top">
                                    <!-- 口コミのタイトル -->
                                    <h4 class="comment-title"><?= $review['title'] ?></h4>
                                </div>
                                <div class="comment-label-second">
                                    <div class="info-star-wrap">
                                        <!-- DBから取得 -->
                                        <ul class="stars">
                                            <?php
                                            $star = empty($review['evaluation']) ? 0 : $review['evaluation'];
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
                                            <?= $review['evaluation'] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="comment-label-third">
                                    <!-- ニックネーム+カウント -->
                                    <a class="comment-user-wrap">
                                        <p class="comment-user-name"><?= $review['nickname'] ?></p>
                                        <p class="comment-user-count">（4,878）</p>
                                    </a>
                                </div>
                                <div class="comment-label-bottom">
                                    <!-- 登校日 -->
                                    <p class="comment-date">
                                        <?php
                                        echo !empty($review['post_date']) ? "投稿日：" . date('Y/m', strtotime($review['post_date'])) : "";
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="comment-label-right">
                                <i class="fas fa-chevron-down"></i>
                                <i class="fas fa-chevron-up"></i>
                            </div>
                        </label>
                        <div class="comment-input-target">
                            <div class="comment-content-wrap">
                                <div class="comment-elm-wrap">
                                    <canvas class="comment-chart" id="commentChart1"></canvas>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">この店舗を選んだ理由を教えてください。</p>
                                    <!-- 店舗を選んだ理由 -->
                                    <p class="comment-elm-text">
                                        <?= nl2br($review['reason']) ?>
                                    </p>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">店舗の「接客／サービス」はいかがでしたか？</p>
                                    <!-- 接客／サービス.評価点 -->
                                    <p class="comment-elm-rate">
                                        評価点
                                        <span class="star-expression comment-elm-rate-expression">
                                            <?= Satisfaction::convert($review['question1'], CodePattern::$VALUE) ?>
                                        </span>
                                    </p>
                                    <!-- 接客／サービス.理由 -->
                                    <p class="comment-elm-text">
                                        <?= $review['question1_evaluation'] ?>
                                    </p>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">受けたサービスの「メニューや料金」については いかがでしたか？</p>
                                    <!-- メニューや料金.評価 -->
                                    <p class="comment-elm-rate">
                                        評価点
                                        <span class="star-expression comment-elm-rate-expression">
                                            <?= Satisfaction::convert($review['question2'], CodePattern::$VALUE) ?>
                                        </span></p>
                                    <!-- メニューや料金.理由 -->
                                    <p class="comment-elm-text">
                                        <?= $review['question2_evaluation'] ?>
                                    </p>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</p>
                                    <!-- 効果（技術や仕上がり）.評価 -->
                                    <p class="comment-elm-rate">
                                        評価点
                                        <span class="star-expression comment-elm-rate-expression">
                                            <?= Satisfaction::convert($review['question3'], CodePattern::$VALUE) ?>
                                        </span>
                                    </p>
                                    <!-- 効果（技術や仕上がり）.理由 -->
                                    <p class="comment-elm-text">
                                        <?= $review['question3_evaluation'] ?>
                                    </p>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">店舗の「雰囲気」はいかがでしたか？</p>
                                    <!-- 雰囲気.評価 -->
                                    <p class="comment-elm-rate">
                                        評価点
                                        <span class="star-expression comment-elm-rate-expression">
                                            <?= Satisfaction::convert($review['question4'], CodePattern::$VALUE) ?>
                                        </span>
                                    </p>
                                    <!-- 雰囲気.理由 -->
                                    <p class="comment-elm-text">
                                        <?= $review['question4_evaluation'] ?>
                                    </p>
                                </div>
                                <div class="comment-elm-wrap">
                                    <p class="comment-elm-title">店舗の「通いやすさ／予約の取りやすさ」は いかがでしたか？</p>
                                    <!-- 通いやすさ／予約の取りやすさ.評価 -->
                                    <p class="comment-elm-rate">
                                        評価点
                                        <span class="star-expression comment-elm-rate-expression">
                                            <?= Satisfaction::convert($review['question5'], CodePattern::$VALUE) ?>
                                        </span>
                                    </p>
                                    <!-- 通いやすさ／予約の取りやすさ.理由 -->
                                    <p class="comment-elm-text">
                                        <?= $review['question5_evaluation'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php } ?>
                <script>
                    function renderCommentChart() {
                        const labels = ["接客・サービス", "メニュー・ 料金", "効果", "雰囲気", "予約・立地"];
                        // DBから取得
                        const testData = [{
                            "接客・サービス": 30,
                            "メニュー・ 料金": 30,
                            "効果": 30,
                            "雰囲気": 30,
                            "予約・立地": 30
                        }, {
                            "接客・サービス": 30,
                            "メニュー・ 料金": 20,
                            "効果": 30,
                            "雰囲気": 40,
                            "予約・立地": 50
                        }, {
                            "接客・サービス": 20,
                            "メニュー・ 料金": 50,
                            "効果": 30,
                            "雰囲気": 20,
                            "予約・立地": 40
                        }]
                        const charts = document.getElementsByClassName('comment-chart');
                        //const width = window.innerWidth - 20;
                        for (let i = 0; i < charts.length; i++) {
                            const setting = {
                                type: 'radar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: null,
                                        data: [30, 30, 30, 30, 30], // パーセントを直す
                                        backgroundColor: 'rgba(106, 173, 191, 0.37)',
                                        borderColor: 'rgba(106, 173, 191, 0.37)',
                                        borderWidth: 1,
                                        pointBackgroundColor: 'transparent'
                                    }]
                                },
                                options: {
                                    title: {
                                        display: false,
                                        text: null
                                    },
                                    scale: {
                                        ticks: {
                                            suggestedMin: 0,
                                            suggestedMax: 50,
                                            stepSize: 10,
                                            display: false
                                        }
                                    },
                                    legend: {
                                        display: false
                                    },
                                    elements: {
                                        point: {
                                            radius: 0
                                        }
                                    }
                                }
                            }
                            const key = `commentChart${i+1}`;
                            // 本来ならデータをindexと照らし合わせてとり、アップデートが必要
                            const data = [];
                            const target = testData[i];
                            console.log(target)
                            for (const key of labels) {
                                data.push(target[key]);
                            }
                            setting.data.datasets[0].data = data;
                            new Chart(document.getElementById(key), setting);
                        }

                    }

                    renderCommentChart();
                </script>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <h2 class="section-inner-title">
                    <?php echo $shop['name']; ?>の口コミ投稿フォーム
                </h2>
                <div class="comment-form-push-button-wrap">
                    <a class="simple-button red fas fa-comments" href="/datsumou/shop/post?shop_id=<?php echo $shop['shop_id']; ?>">
                        <span class="button-text">口コミ投稿でAmazonギフト券1,000円分をGETする</span>
                    </a>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section id="gallery-section" class="section">
            <div class="section-padding-inner">
                <!-- DBから取得 -->
                <h2 class="section-inner-title">
                    <?php echo $shop['name']; ?>のギャラリー
                </h2>
                <div class="gallery-wrap">
                    <!-- DBから取得 -->
                    <ul class="galleries">
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section id="access-section" class="section">
            <div class="section-padding-inner access-section-inner">
                <div class="inner-elm-padding">
                    <!-- DBから取得 -->
                    <h2 class="section-inner-title">キレイモ 新宿本店へのアクセス</h2>
                </div>
                <div class="access-between-margin"></div>
                <div class="inner-elm-padding access-text-wrap">
                    <!-- DBから取得 -->
                    <p class="access-text">東京都新宿区西新宿１-１９-８　新東京ビルディング5F</p>
                    <i class="access-icon fas fa-chevron-right"></i>
                </div>
                <div class="access-map" id="map" style="width:500px; height:300px"></div>
                <script>
                    function initMap(address) {
                        const width = window.innerWidth;
                        const height = Math.round(width / 2);
                        document.getElementById('map').style.width = `${width}px`;
                        document.getElementById('map').style.height = `${height}px`;
                        var geocoder = new google.maps.Geocoder();
                        //住所から座標を取得する
                        geocoder.geocode({
                                'address': address, //検索する住所　〒◯◯◯-◯◯◯◯ 住所　みたいな形式でも検索できる
                                'region': 'jp'
                            },
                            function(results, status) {

                                if (status == google.maps.GeocoderStatus.OK) {
                                    google.maps.event.addDomListener(window, 'load', function() {
                                        var map_tag = document.getElementById('map');
                                        // 取得した座標をセット緯度経度をセット
                                        var map_location = new google.maps.LatLng(results[0].geometry.location.lat(), results[0]
                                            .geometry.location.lng());
                                        //マップ表示のオプション
                                        var map_options = {
                                            zoom: 17, //縮尺
                                            center: map_location, //地図の中心座標
                                            //ここをfalseにすると地図上に人みたいなアイコンとか表示される
                                            disableDefaultUI: true,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP //地図の種類を指定
                                        };

                                        //マップを表示する
                                        var map = new google.maps.Map(map_tag, map_options);

                                        //地図上にマーカーを表示させる
                                        var marker = new google.maps.Marker({
                                            position: map_location, //マーカーを表示させる座標
                                            map: map //マーカーを表示させる地図
                                        });
                                    });
                                }
                            }
                        );
                    }
                    // DBから取得
                    initMap("千葉県柏市旭町1-5-4 プラザパスカビル6F");
                </script>
                <div class="inner-elm-padding">
                    <!-- DBから取得 -->
                    <a class="simple-button blue access-button">
                        <span class="button-text">アプリで地図を開く</span>
                    </a>
                </div>
                <div class="access-details-wrap">
                    <ul class="access-details">
                        <li class="access-detail">
                            <p class="access-detail-left">施設住所</p>
                            <!-- DBから取得 -->
                            <p class="access-detail-right">ダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">最寄り駅</p>
                            <!-- DBから取得 -->
                            <p class="access-detail-right">ダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">路線</p>
                            <!-- DBから取得 -->
                            <p class="access-detail-right">
                                ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <h2 class="section-inner-title">キレイモ 新宿本店への詳細道順</h2>
                <div class="gallery-wrap">
                    <!-- DBから取得 -->
                    <ul class="galleries">
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                        <li class="gallery">
                            <img class="gallery-img" src="./img/shop-detail/sinjuku.png" />
                            <p class="gallery-text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner staffs-padding-inner">
                <div class="inner-elm-padding">
                    <h2 class="section-inner-title">キレイモ 新宿本店のスタッフ紹介</h2>
                </div>
                <div class="staffs-wrap">
                    <div class="inner-elm-padding">
                        <ul class="staffs">
                            <li class="staff">
                                <!-- DBから取得 -->
                                <img class="staff-img" src="./img/shop-detail/staff.png" />
                                <div class="staff-content-wrap">
                                    <div class="staff-content-top">
                                        <p class="staff-name">スタッフ名スタッフ名</p>
                                        <!-- DBから取得 -->
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/insta.png" />
                                        </a>
                                        <!-- DBから取得 -->
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/twitter.png" />
                                        </a>
                                        <!-- DBから取得 -->
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/facebook.png" />
                                        </a>
                                    </div>
                                    <div class="staff-content-middle">
                                        <!-- DBから取得 -->
                                        <p class="staff-furigana">ふりがなふりがな</p>
                                    </div>
                                    <div class="staff-content-bottom">
                                        <!-- DBから取得 -->
                                        <p class="staff-introduction">説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文</p>
                                    </div>
                                </div>
                            </li>
                            <!-- 共通化できるのでDB情報は上と同じ -->
                            <li class="staff">
                                <img class="staff-img" src="./img/shop-detail/staff.png" />
                                <div class="staff-content-wrap">
                                    <div class="staff-content-top">
                                        <p class="staff-name">スタッフ名スタッフ名</p>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                    </div>
                                    <div class="staff-content-middle">
                                        <p class="staff-furigana">ふりがなふりがな</p>
                                    </div>
                                    <div class="staff-content-bottom">
                                        <p class="staff-introduction">説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文</p>
                                    </div>
                                </div>
                            </li>
                            <!-- 共通化できるのでDB情報は上と同じ -->
                            <li class="staff">
                                <img class="staff-img" src="./img/shop-detail/staff.png" />
                                <div class="staff-content-wrap">
                                    <div class="staff-content-top">
                                        <p class="staff-name">スタッフ名スタッフ名</p>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                        <a class="staff-sns">
                                            <img class="staff-sns-img" src="./img/shop-detail/hospital.png" />
                                        </a>
                                    </div>
                                    <div class="staff-content-middle">
                                        <p class="staff-furigana">ふりがなふりがな</p>
                                    </div>
                                    <div class="staff-content-bottom">
                                        <p class="staff-introduction">説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文説明文</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="more-wrap">
                        <!-- DBなど動作がどうなるか確認中 -->
                        <p class="more-text">もっと見る</p>
                        <i class="more-icon fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner news-section-inner">
                <!-- DBから取得 -->
                <div class="inner-elm-padding">
                    <h2 class="section-inner-title">キレイモ 新宿本店のお知らせ・ブログ</h2>
                </div>
                <div class="news-between-margin"></div>
                <div class="news-list-wrap">
                    <!-- DBから取得 -->
                    <div class="inner-elm-padding">
                        <h3 class="section-inner-sub-title price-sub-title">キレイモ 新宿本店のお知らせ</h3>
                    </div>
                    <div class="inner-elm-padding">
                        <ul class="news">
                            <li class="news-elm">
                                <a class="news-wrap">
                                    <!-- DBから取得 -->
                                    <p class="news-date">2020/02/12</p>
                                    <!-- DBから取得 -->
                                    <p class="news-title">お知らせダミーお知らせダミーお知らせダミー</p>
                                </a>
                            </li>
                            <li class="news-elm">
                                <a class="news-wrap">
                                    <!-- DBから取得 -->
                                    <p class="news-date">2020/02/12</p>
                                    <!-- DBから取得 -->
                                    <p class="news-title">お知らせダミーお知らせダミーお知らせダミー</p>
                                </a>
                            </li>
                            <li class="news-elm">
                                <a class="news-wrap">
                                    <!-- DBから取得 -->
                                    <p class="news-date">2020/02/12</p>
                                    <!-- DBから取得 -->
                                    <p class="news-title">お知らせダミーお知らせダミーお知らせダミー</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="more-wrap bottom-border">
                        <!-- DBなど動作がどうなるか確認中 -->
                        <p class="more-text">もっと見る</p>
                        <i class="more-icon fas fa-chevron-right"></i>
                    </div>
                    <div class="blogs-wrap">
                        <!-- DBから取得 -->
                        <div class="inner-elm-padding">
                            <h3 class="section-inner-sub-title price-sub-title">キレイモ 新宿本店のブログ</h3>
                        </div>
                        <div class="inner-elm-padding">
                            <ul class="blogs">
                                <li class="blog">
                                    <a class="blog-wrap">
                                        <!-- DBから取得 -->
                                        <img class="blog-img" src="./img/shop-detail/blog1.png" />
                                        <div class="blog-info-wrap">
                                            <!-- DBから取得 -->
                                            <p class="blog-date">2020/02/12</p>
                                            <!-- DBから取得 -->
                                            <p class="blog-title">ブログタイトルダミーブログタイトルダミー</p>
                                        </div>
                                        <i class="blog-icon fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li class="blog">
                                    <a class="blog-wrap">
                                        <!-- DBから取得 -->
                                        <img class="blog-img" src="./img/shop-detail/blog1.png" />
                                        <div class="blog-info-wrap">
                                            <!-- DBから取得 -->
                                            <p class="blog-date">2020/02/12</p>
                                            <!-- DBから取得 -->
                                            <p class="blog-title">ブログタイトルダミーブログタイトルダミー</p>
                                        </div>
                                        <i class="blog-icon fas fa-chevron-right"></i>
                                    </a>
                                </li>
                                <li class="blog">
                                    <a class="blog-wrap">
                                        <!-- DBから取得 -->
                                        <img class="blog-img" src="./img/shop-detail/blog1.png" />
                                        <div class="blog-info-wrap">
                                            <!-- DBから取得 -->
                                            <p class="blog-date">2020/02/12</p>
                                            <!-- DBから取得 -->
                                            <p class="blog-title">ブログタイトルダミーブログタイトルダミー</p>
                                        </div>
                                        <i class="blog-icon fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="more-wrap">
                            <!-- DBなど動作がどうなるか確認中 -->
                            <p class="more-text">もっと見る</p>
                            <i class="more-icon fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
        </section>
        <div class="separator"></div>
        <section id="access-section" class="section">
            <div class="section-padding-inner base-info-section-inner">
                <div class="inner-elm-padding">
                    <!-- 店舗名+基本情報 -->
                    <h2 class="section-inner-title">
                        <?php echo $shop['name']; ?>の基本情報
                    </h2>
                </div>
                <div class="access-between-margin"></div>
                <div class="inner-elm-padding">
                    <!-- 店舗名+概要 -->
                    <h3 class="section-inner-sub-title price-sub-title">
                        <?php echo $shop['name']; ?>の概要
                    </h3>
                </div>
                <div class="access-details-wrap">
                    <ul class="access-details">
                        <li class="access-detail">
                            <p class="access-detail-left">店舗名</p>
                            <!-- 店舗名 -->
                            <p class="access-detail-right">
                                <?php echo $shop['name']; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">住所</p>
                            <!-- 住所 -->
                            <p class="access-detail-right">
                                <?php echo $shop['address'] ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">最寄り駅</p>
                            <!-- 最寄駅 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['station'])) :
                                    echo $shop['station'];
                                endif; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">営業時間</p>
                            <!-- 営業時間 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['business_hours'])) :
                                    echo $shop['business_hours'];
                                endif; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">定休日</p>
                            <!-- 定休日 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['holiday'])) :
                                    echo $shop['holiday'];
                                endif; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">クレジットカード</p>
                            <!-- 支払い方法 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['credit_card'])) :
                                    echo $shop['credit_card'];
                                endif; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">スタッフ人数</p>
                            <!-- スタッフ人数 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['staff'])) :
                                    echo $shop['staff'];
                                endif; ?>
                            </p>
                        </li>
                        <li class="access-detail">
                            <p class="access-detail-left">駐車場</p>
                            <!-- 駐車場 -->
                            <p class="access-detail-right">
                                <?php if (!empty($shop['parking'])) :
                                    echo $shop['parking'];
                                endif; ?>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="related-info-separator"></div>
                <div class="inner-elm-padding">
                    <h3 class="section-inner-sub-title price-sub-title">特徴・関連情報</h3>
                </div>
                <div class="access-details-wrap">
                    <ul class="access-details">
                        <li class="access-detail">
                            <p class="access-detail-left">ホームページ</p>
                            <!-- DBから取得 -->
                            <p class="access-detail-right">
                                <a href="<?php echo $shop['affiliate_page_url']; ?>">
                                    公式サイトから予約する
                                </a>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="inner-elm-padding">
                    <p class="in-case-wrong-info-text">●●の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</p>
                    <div class="in-case-wrong-info-button-wrap">
                        <!-- DBから生成 -->
                        <?php echo $this->Html->link(
                            '<span class="button-text">誤りを報告する</span>',
                            ['controller' => 'contacts', 'action' => 'contact'],
                            ['class' => 'simple-button simple button-13', 'escape' =>  false]
                        ); ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <h2 class="section-inner-title">シェア</h2>
                <div class="share-button-wrap">
                    <a href="//twitter.com/share?url=https://puril.net" class="simple-button simple button-13 fab fa-twitter twitter-icon">
                        <span class="button-text">Twitter</span>
                    </a>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <!-- DBから取得 -->
                <h2 class="section-inner-title">キレイモ 新宿本店からの一言</h2>
                <div class="one-point">
                    <!-- DBから取得 -->
                    <img class="one-point-img" src="./img/shop-detail/staff.png" />
                    <!-- DBから取得 -->
                    <p class="one-point-text">
                        ひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミーひとことダミー。
                    </p>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section" id="interview-section">
            <div class="section-padding-inner">
                <!-- DBから取得 -->
                <h2 class="section-inner-title">キレイモ 新宿本店のインタビュー</h2>
                <div class="interviews-wrap">
                    <ul class="interviews">
                        <li class="interview">
                            <!-- DBから取得 -->
                            <img class="interview-img" src="./img/shop-detail/interview.png" />
                            <p class="interview-title">この店舗を選んだ理由を教えてください。</p>
                            <!-- DBから取得 -->
                            <p class="interview-text">
                                ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
                            </p>
                        </li>
                        <li class="interview">
                            <!-- DBから取得 -->
                            <img class="interview-img" src="./img/shop-detail/interview.png" />
                            <p class="interview-title">この店舗を選んだ理由を教えてください。</p>
                            <!-- DBから取得 -->
                            <p class="interview-text">
                                ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
                            </p>
                        </li>
                        <li class="interview">
                            <!-- DBから取得 -->
                            <img class="interview-img" src="./img/shop-detail/interview.png" />
                            <p class="interview-title">この店舗を選んだ理由を教えてください。</p>
                            <!-- DBから取得 -->
                            <p class="interview-text">
                                ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner related-section-inner">
                <!-- DBから取得 -->
                <div class="inner-elm-padding">
                    <h2 class="section-inner-title">キレイモ 新宿本店を見た方はこんな施設もご覧になっています</h2>
                </div>
                <ul class="related-term-tabs">
                    <li class="related-term active" onclick="relatedTermTapped(this)" id="related-nearby">
                        <span class="related-term-text">最寄駅が同じ</span>
                    </li>
                    <li class="related-term" onclick="relatedTermTapped(this)" id="related-town">
                        <span class="related-term-text">市区町村が同じ</span>
                    </li>
                    <li class="related-term" onclick="relatedTermTapped(this)" id="related-prefecture">
                        <span class="related-term-text">都道府県が同じ</span>
                    </li>
                </ul>
                <script>
                    function relatedTermTapped(e) {
                        const id = e.id;

                        $(".related-term").removeClass("active");
                        $(`#${id}`).addClass("active");
                        $('.relateds').css('display', 'none');
                        $(`.${id}`).css('display', 'block')
                    }
                </script>
                <!-- 確かコードがありました。 -->
                <div class="inner-elm-padding">
                    <div class="blogs-wrap">
                        <ul class="blogs related-nearby relateds">
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                        <ul style="display: none;" class="blogs related-town relateds">
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">2.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">2.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">2.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                        <ul style="display: none;" class="blogs related-prefecture relateds">
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">3.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">3.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="blog">
                                <a class="blog-wrap">
                                    <img class="blog-img" src="./img/shop-detail/another-shop.png" />
                                    <div class="blog-info-wrap">
                                        <p class="blog-title related-shop-title">3.脱毛サロン ラココ 渋谷店(la coco)</p>
                                        <p class="blog-date">東京都 / 新宿区</p>
                                    </div>
                                    <i class="blog-icon fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <div class="separator"></div>
        <section class="section">
            <div class="section-padding-inner">
                <h2 class="section-inner-title">キレイモの他の店舗を見る</h2>
                <div class="other-shops-buttons-wrap">
                    <a class="simple-button simple-blue">
                        <span class="button-text">キレイモ TOPへ</span>
                    </a>
                    <div class="other-shops-buttons-margin"></div>
                    <a class="simple-button green">
                        <span class="button-text">公式サイトへ</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <script>
        window.addEventListener('load', () => {
            const nav = $('#head-nav');
            const navHeight = nav.outerHeight();
            const navTop = nav.offset().top;
            $(window).scroll(function() {
                const winTop = $(this).scrollTop();
                if (winTop >= navTop) {
                    nav.addClass('fixed');
                    $('#head-nav-section').css('height', `${navHeight}px`);
                } else if (winTop <= navTop) {
                    nav.removeClass('fixed')
                    $('#head-nav-section').css('height', `auto`);
                }
                console.log(winTop - navTop)
            });
        });
    </script>

    <!-- 削除予定データ（もともとのデータ） ---------------------------------------------------------- -->
    <section class="content shop-top">
        <div class="shop-top-img-area">
            <div class="shop-top-img-base">
                <?php
                $imagenum = count($shop['shop_images']);
                if ($imagenum === 1) :
                    foreach ($shop['shop_images'] as $shopImage) {
                        echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'shop-top-img',));
                    } elseif ($imagenum > 1) :
                    foreach ($shop['shop_images'] as $shopImage) {
                        echo $this->Html->image(['controller' => 'images', 'action' => 'shopImage', $shopImage['shop_image_id']], array('class' => 'shop-top-img',));
                        break;
                    } else :
                    echo '<img class="shop-top-img" src="/puril/images/img/datsumou/no-photo.jpg" alt="' . $shop->name . '">';
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
                <?php
                if (!empty($shop['station_name'])) {
                ?>
                    <?php
                    $nearStations = '';
                    foreach ($shop['station_name'] as $key => $stationName) {
                        $nearStations .= $stationName;
                        $nearStations .= '/';
                    }
                    echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                    ?>
                <?php
                    echo '/';
                }
                ?>
                <?php echo $shop['shop_type'] ?>
                <?php
                //            foreach ($shop['depilation_sites'] as $depilationSite) {
                //                echo "・{$depilationSite['name']}";
                //            }
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
                            <div class="shop-point"><?= number_format($star, 2) ?></div>
                        </div>
                        <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                            <div class="shop-comment-count"><?php echo $shop['review_cnt']; ?>件</div>
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
    if ($shop['price_plan_html']) {
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
                echo '<li class="shop-part-common shop-part-active">' . $depilationSite['name'] . '</li>';
            }
            ?>
        </ul>
    </section>
    <?php
    if ($imagenum > 0) :
    ?>
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
                            <div class="shop-kuchikomi-title">今回脱毛した部位:<?= $review['title'] ?></div>
                            <div class="shop-user-star-area">
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
                    </li>
                <?php } ?>
            </ul>
        </section>
    <?php } ?>
    <section class="content middle-content shop-kuchikomi-post" id="kuchikomi-post">
        <h2 class="content-title">口コミ投稿</h2>
        <div class="shop-kuchikomi-button-area"><a class="kuchikomi-button" href="/datsumou/shop/post?shop_id=<?php echo $shop['shop_id']; ?>">
                <img src="/puril/images/review_btn_long.png" class="button-base-img kuchikomi-button-img" alt=""></a></div>
    </section>
    <section class="content middle-content shop-address" id="address">
        <h2 class="content-title">住所</h2>
        <a class="clickable-button shop-address-detail" href="">
            <div class="shop-address-text"><?php echo $shop['address'] ?></div>
        </a>
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
                        if (!empty($shop['holiday']) || !empty($shop['holiday'])) { ?>
                            <tr>
                                <th>営業時間・定休日</th>
                                <td>
                                    <?php if (!empty($shop['business_hours'])) : ?>
                                        <dt>営業時間</dt>
                                        <dd><?php echo $shop['business_hours']; ?></dd>
                                    <?php endif;
                                    if (!empty($shop['holiday'])) :
                                    ?>
                                        <dt>定休日</dt>
                                        <dd><?php echo $shop['holiday']; ?></dd>
                                </td>
                            <?php endif; ?>
                            </tr>
                        <?php } ?>
                        <!--                <tr>-->
                        <!--                    <th>予算</th>-->
                        <!--                    <td>月額9,500円〜</td>-->
                        <!--                </tr>-->
                        <?php if (!empty($shop['station'])) { ?>
                            <tr>
                                <th>交通手段</th>
                                <td><?php echo $shop['station']; ?></td>
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
                        </tbody>
                    </table>
                </div>
            <?php } ?>
            <?php
            if (false) {
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
                                <td><a href="<?php echo $shop['affiliate_page_url']; ?>">公式サイトから予約する</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="shop-info-detail-remark"><?php echo $shop['name']; ?>の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
        <div class="shop-info-detail-report">
            <?php echo $this->Html->link('誤りを報告する', ['controller' => 'contacts', 'action' => 'contact'], ['class' => 'clickable-button shop-info-detail-report-button']); ?></div>
    </section>
    <section class="content shop-share">
        <h2 class="content-title">シェア</h2>
        <div class="share-twitter"><a class="clickable-button share-twitter-button" href="//twitter.com/share?url=https://puril.net"><i class="fab fa-twitter twitter-icon"></i>
                <div class="share-twitter-text">Twitter</div>
            </a></div>
    </section>
    <?php if (FormUtil::checkUseForm($shop['name'], $shop['shop_id'])) { ?>
        <footer class="content shop-footer">
            <a class="button-base kuchikomi-button" href="/datsumou/shop/post?shop_id=<?php echo $shop['shop_id']; ?>">
                <img src="/puril/images/review_btn.png" class="button-base-img kuchikomi-button-img" alt=""></a>
            <a class="button-base reservatopn-button" href="/datsumou/shop/reserve?shop_id=<?= $shop['shop_id'] ?>">
                <img src="/puril/images/reserve_btn.png" class="button-base-img reservatopn-button-img" alt=""></a></footer>
    <?php } else {
    ?>
        <footer class="content shop-footer">
            <a class="button-base kuchikomi-button kuchikomi-only" href="/datsumou/shop/post?shop_id=<?php echo $shop['shop_id']; ?>">
                <img src="/puril/images/review_btn_long.png" class="button-base-img kuchikomi-button-img" alt=""></a></footer>
    <?php
    }
    ?>
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
                        <div class="photo-detail-like-text">いいね！</div>
                    </a><a class="photo-detail-like-kuchikomi" href="/datsumou/shopuser/kuchikomi.html">この写真の口コミをみる</a></div>
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
            geocoder.geocode({
                    'address': address, //検索する住所　〒◯◯◯-◯◯◯◯ 住所　みたいな形式でも検索できる
                    'region': 'jp'
                },
                function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        google.maps.event.addDomListener(window, 'load', function() {
                            var map_tag = document.getElementById('map');
                            // 取得した座標をセット緯度経度をセット
                            var map_location = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                            //マップ表示のオプション
                            var map_options = {
                                zoom: 17, //縮尺
                                center: map_location, //地図の中心座標
                                //ここをfalseにすると地図上に人みたいなアイコンとか表示される
                                disableDefaultUI: true,
                                mapTypeId: google.maps.MapTypeId.ROADMAP //地図の種類を指定
                            };

                            //マップを表示する
                            var map = new google.maps.Map(map_tag, map_options);

                            //地図上にマーカーを表示させる
                            var marker = new google.maps.Marker({
                                position: map_location, //マーカーを表示させる座標
                                map: map //マーカーを表示させる地図
                            });
                        });
                    }
                }
            );
        }
        initMap("<?php echo $shop['address'] ?>");

        // 口コミ投稿処理
        $(function() {
            $("#song-xinsuru").click(function() {

                var $form = $('#form').get()[0];
                var fd = new FormData($form);

                $.ajax({
                    type: 'post',
                    url: "<?= Router::url(['controller' => 'shops', 'action' => 'send'], true) ?>/",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        var errors = JSON.parse(res).errorMsg;
                        if (errors) {
                            $('.atention').text("");
                            // エラー処理
                            $.each(errors, function(column, error) {
                                $('.' + column).text(error);
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
                            return;
                        }
                    }
                });

                return false;
            });

            $('#send_msg .w_shadow , #send_msg .closebtn').on('click', function() {
                var tagetsend_msg = $('#send_msg');
                if (tagetsend_msg.hasClass('active')) {
                    tagetsend_msg.fadeOut().removeClass('active');
                }
            });
        });
    </script>
    <a href="https://puril.net/campaign/">
        <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
    </a>

    <div class="Search__breadcrumbs">
        <ol>
            <li>
                <a href="<?= Router::url('/') ?>"><span itemprop="name" class="name">TOP</span></a>
                <meta itemprop="position" content="1">
            </li>
            <li>
                <a href="<?= Router::url('/datsumou') ?>"><span itemprop="name" class="name">脱毛</span></a>
                <meta itemprop="position" content="2">
            </li>
            <li>
                <a href="<?= Router::url('/datsumou/search') ?>"><span itemprop="name" class="name">全国の脱毛施設</span></a>
                <meta itemprop="position" content="3">
            </li>
            <li>
                <a href="<?= Router::url('/datsumou/search') ?>"><span itemprop="name" class="name">全国の<?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE) ?></span></a>
                <meta itemprop="position" content="4">
            </li>
            <li>
                <?php echo $this->Html->link("<span>{$shop['pref']}" . ShopType::convert($shop['shop_type'], CodePattern::$VALUE) . "</span>", ['controller' => 'searchs', 'action' => 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape' => false, 'itemscope' => '', 'itemtype' => 'http://schema.org/Thing', 'itemprop' => 'item']) ?>
                <meta itemprop="position" content="5">
            </li>

            <li>
                <?php echo $this->Html->link("<span>{$shop['Area']['name']}の" . ShopType::convert($shop['shop_type'], CodePattern::$VALUE) . "</span>", ['controller' => 'searchs', 'action' => 'search', $shop['PrefData']['url_text'], URLUtil::CITY . $shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape' => false, 'itemscope' => '', 'itemtype' => 'http://schema.org/Thing', 'itemprop' => 'item']) ?>
                <meta itemprop="position" content="6">
            </li>

            <li>
                <?php echo "<span itemprop='name' class='name'>{$shop['name']}</span>" ?>
                <meta itemprop="position" content="7">
            </li>
        </ol>
    </div>
    <?php
    echo $this->element('Front/footer') ?>
</body>

</html>