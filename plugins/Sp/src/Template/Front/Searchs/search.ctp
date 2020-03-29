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
    $placeName = $place.'/';
} else if (!empty($prefCodes)) {
    $prefNames = [];
    foreach ($prefCodes as $prefCode) {
        array_push($prefNames, Pref::convert($prefCode, CodePattern::$VALUE));
    }

    if (!empty($prefNames)) {
        $placeName = implode('、', $prefNames).' / ';
    }
} else {
    $placeName = "全国 / ";
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
    $condition = '/ '. implode(' / ', $conditions);
}
?>
<body>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/search/index']);
?>
<?php
echo $this->Html->css('datsumou/search');
?>
<div class="Search bg-wht">
    <header class="Search__header">
        <div class="Search__header__inner">
            <a href="#" class="Search__header__close"><i class="fas fa-angle-left"></i> 戻る</a>
            <h1 class="Search__header__title">こだわり条件</h1>
        </div>
    </header>
    <div class="Search__contents">
        <?php
        echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post','id'=>'Form', 'novalidate' => true]);
        ?>
        <dl class="Search__kodawari__list">
            <dt>脱毛部位</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[depilation_site_id]" id="Datsumouparts">
                        <option value=""></option>
                        <?php
                        $this->ExForm->depilationSiteSelect('Make.depilation_site_id.', $searchWheres['depilation_site_id']);
                        ?>
                    </select>
                </div>
            </dd>
            <dt>価格</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[price_id]">
                        <option value=""></option>
                        <?php
                        $this->ExForm->priceSelect('Make.price_id.', $searchWheres['price_id']);
                        ?>
                    </select>
                </div>
            </dd>
            <dt>支払い方法</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[payment_id]">
                        <option value=""></option>
                        <?php $this->ExForm->paymentSelect('Make.payment_id.', $searchWheres['payment_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>特典・割引</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[discount_id]">
                        <option value=""></option>
                        <?php $this->ExForm->discountSelect('Make.discount_id.', $searchWheres['discount_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>脱毛タイプ</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->depilationSelect('Make.other_condition_id.', $searchWheres['other_condition_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>診療料(医療脱毛の場合)</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->departmentSelect('Make.other_condition_id.', $searchWheres['other_condition_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>サポート体制</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->supportSelect('Make.other_condition_id.', $searchWheres['other_condition_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>予約・受付・キャンセル</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->receptionistSelect('Make.other_condition_id.', $searchWheres['other_condition_id']); ?>
                    </select>
                </div>
            </dd>
            <dt>立地・施設</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->locationSelect('Make.other_condition_id.', $searchWheres['other_condition_id']); ?>
                    </select>
                </div>
            </dd>
        </dl>
        <dl id="" class="Search__kodawari__selected">
            <dt>現在設定している条件</dt>
            <dd id="Output"><span id="OutputArea"></span><span id="OutputDatsumouparts"></span><span id="OutputPrice"></span><span id="OutputPayment"></span><span id="OutputDatsumoutype"></span><span id="OutputConsultation"></span><span id="OutputSupport"></span><span id="OutputReception"></span><span id="OutputStation"></span></dd>
        </dl>
        <div class="Search__kodawari__btns">

            <button type="reset" id="clear" class="Search__kodawari__btn" data-type="clear">クリア</button>
            <button class="Search__kodawari__btn" data-type="search" type="submit" name="search">検索</button>
        </div>
        <?php
        echo $this->ExForm->end();
        ?>
        <!--        <div class="Search__kodawari__ranking"><a href=""><i class="fas fa-crown"></i>ランキングで検索する</a></div>-->
    </div>
</div>
<div class="top-main">
    <header class="datsumou-header">
        <?php
        echo $this->element('Front/header')
        ?>
    </header>
    <div class="content search-condition">
        <h1 class="search-condition-text"><?php echo $placeName;?> <?php echo $shopTypeVal;	?> <?php echo $condition;?></h1>
        <div class="button-base search-condition-change"><a class="plain-link search-condition-change-text" href="">条件変更</a></div>
    </div>
    <div class="content-base search-shop">
        <ul class="search-shop-list">
            <?php
            foreach ($shops as $shop) {
                ?>
                <li class="content search-shop-item"><a class="plain-link" href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $shop->shop_id], true);?>">
                        <h2 class="search-shop-title">
                            <span class="search-shop-title-text"><?php echo $shop->name;?></span>
                        </h2>
                        <div class="search-shop-title-sub"><?php
                            if (!empty($shop->station_name)) {
                                ?>
                                <?php
                                $nearStations = '';
                                foreach ($shop->station_name as $key => $stationName) {
                                    $nearStations .= $this->Html->link($stationName, '/datsumou/search/'.$shop->PrefData['url_text'].'/'. URLUtil::CITY. $shop->area_id[$key]. "/". URLUtil::STATION_G. $shop->station_g_cd[$key]);
                                    $nearStations .= '/';
                                }
                                echo mb_substr($nearStations, 0, mb_strlen($nearStations) - 1);
                                ?>
                                <?php
                            }
                            ?> / <a href="/datsumou/search/<?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE2); ?>">
                                <?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE); ?>
                            </a></div>

                        <a href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $shop->shop_id], true);?>" class="search-shop-photo-area">
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
                                <div class="search-shop-photo"><img src="<?php echo $imgUrl;?>" alt="<?php echo $shop->name;?>"></div>
                                <?php
                                $img_count++;
                                if($img_count > 2) {
                                    break;
                                }
                            }
                            ?>
                            <?php while($img_count < 3):?>
                                <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>

                                <?php
                                $img_count++;
                            endwhile;?>
                        </a>
                        <!--                <div class="search-shop-tips">--><?php //echo $shop->description_subject;?><!--</div>-->
                        <?php
                        if($shop->review_cnt > 0):?>
                            <div class="search-shop-label">
                                <div class="search-shop-review">
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
                                <!--                    <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>-->
                            </div>
                        <?php endif;?>
                        <a href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $shop->shop_id], true);?>" class="search-shop-desc">
                            <h3 class="search-shop-desc-title"><?php echo $shop->description_subject;?></h3>
                            <div class="search-shop-desc-text">
                                <p><?= $shop->description_content?></p>
                            </div>
                        </a>
                        <div class="search-shop-info">
                            <table>
                                <tbody>
                                <tr>
                                    <th>住所</th>
                                    <td><?= $shop->address ?></td>
                                </tr>
                                <?php
                                if (!empty($shop->station)) {
                                    ?>
                                    <tr>
                                        <th>最寄り駅</th>
                                        <td>
                                            <?php echo $shop->station;?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if (!empty($shop->business_hours)) { ?>
                                    <tr>
                                        <th>営業時間</th>
                                        <td><?php echo $shop->business_hours; ?></td>
                                    </tr>

                                    <?php
                                }
                                if (!empty($shop->holiday)) { ?>
                                    <tr>
                                        <th>定休日</th>
                                        <td><?php echo $shop->holiday; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
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
    </div>
    <div class="content-base search-shop-best">
        <ul class="search-shop-best-list">
            <?php
            $osusumes = [
                '恋肌'=> [
                    'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O',
                    'img'=> '/img/Top/koihada_top.jpg',
                    'star' => '4.87',
                ],
                'ストラッシュ'=> [
                    'url'=> 'https://track.affiliate-b.com/visit.php?guid=ON&a=47719r-V298788m&p=j648053O',
                    'img'=> '/img/stlassh.jpg',
                    'star' => '4.82',
                ],
                'ラココ'=> [
                    'url'=> 'https://www.tcs-asp.net/alink?AC=C102738&LC=MBTY1&SQ=0&isq=100',
                    'img'=> '/shop_img/466',
                    'star' => '4.71',
                ],
            ];

            $count = 0;
            foreach ($osusumes as $name => $osusume) {
                $countCss = '';
                switch ($count):
                    case 0:
                        $countCss = 'first';
                        break;
                    case 1:
                        $countCss = 'second';
                        break;
                    case 2:
                        $countCss = 'third';
                        break;
                endswitch;
                ?>
                <li class="search-shop-best-item">
                    <a class="plain-link" href="<?=$osusume['url']?>">
                        <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-<?php echo $countCss;?>"></i>
                            <div class="search-shop-best-rank-point"><?=number_format($osusume['star'],2)?></div>
                        </div><?php echo $this->Html->image($osusume['img'], ['alt'=> '','class'=>'search-shop-best-img'])?>
                        <div class="search-shop-best-name"><?=$name?></div>
                    </a>
                </li>
                <?php
                $count++;
            }
            ?>
        </ul>
        <div class="search-shop-ranking"><a class="button-base search-shop-rainking-button" href="<?php echo Router::url('/datsumou/ranking')?>">ランキングを見る</a></div>
    </div>
</div>
<div class="Search__breadcrumbs">
    <ol>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span itemprop="name"  class="name">TOP</span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou')?>"><span itemprop="name" class="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou/search')?>"><span itemprop="name" class="name">全国の脱毛施設</span></a>
            <meta itemprop="position" content="3">
        </li>
        <?php
        $i = 1;
        $pankzuCnt = count($pankuzus);
        foreach ($pankuzus as  $pankuzu) {
            if ($i == $pankzuCnt) {

                ?>
                <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <?php echo "<span itemprop='name' class='name'>{$pankuzu['val']}</span>"?>
                    <meta itemprop="position" content="<?php echo $i + 3;?>">
                </li>
                <?php
                continue;
            }
            ?>
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemtype="http://schema.org/Thing" itemprop="item"
                   href="<?=$pankuzu['url']. "/"?>"><span itemprop="name" class="name"><?php echo $pankuzu['val']?></span></a>
                <meta itemprop="position" content="<?php echo $i + 3;?>">
            </li>
            <?php
            $i++;
        }
        ?>
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
<script>
    $(function () {
        $('.search-condition-change-text').click(function (e) {
            e.preventDefault();
            $('.Search').addClass('active')
            $('.top-main').hide()
            $(window).scrollTop(0)
        })
        $('.Search__header__close').click(function (e) {
            e.preventDefault();
            $('.Search').removeClass('active')
            $('.top-main').show()
        })
    });
    window.onload = function () {
        var $formObject = document.getElementById( "Form" );
        for( var $i = 0; $i < $formObject.length; $i++ ) {
            $formObject.elements[$i].onkeyup = function(){
                getValue();
            };
            $formObject.elements[$i].onchange = function(){
                getValue();
            };
        }
        getValue();
    }
    function getValue() {
        var $formObject = document.getElementById( "Form" );
        console.log($("#Datsumouparts").val());
        // document.getElementById( "OutputArea" ).innerHTML = $formObject.["Make.price_id"].value + '&nbsp;';
        document.getElementById( "OutputDatsumouparts" ).innerHTML = $('[name="Make[depilation_site_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputPrice" ).innerHTML = $('[name="Make[price_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputPayment" ).innerHTML =$('[name="Make[payment_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputDatsumoutype" ).innerHTML = $('[name="Make[discount_id]"] option:selected').text() + '&nbsp;';
        var otherText = '';
        $('[name="Make[other_condition_id][]"] option:selected').each(function(){
            if($(this).text() != '') {
                otherText+= $(this).text() + ' ';
            }
        });
        document.getElementById( "OutputConsultation" ).innerHTML = otherText + '&nbsp;';
        // document.getElementById( "OutputSupport" ).innerHTML = $formObject.supportArea.value + '&nbsp;';
        // document.getElementById( "OutputReception" ).innerHTML = $formObject.receptionArea.value + '&nbsp;';
        // document.getElementById( "OutputStation" ).innerHTML = $formObject.stationArea.value + '&nbsp;';
    }
    document.getElementById("clear").onclick = function() {
        document.getElementById( "OutputArea" ).innerHTML = "";
        document.getElementById( "OutputDatsumouparts" ).innerHTML = "";
        document.getElementById( "OutputPrice" ).innerHTML = "";
        document.getElementById( "OutputPayment" ).innerHTML = "";
        document.getElementById( "OutputDatsumoutype" ).innerHTML = "";
        document.getElementById( "OutputConsultation" ).innerHTML = "";
        document.getElementById( "OutputSupport" ).innerHTML = "";
        document.getElementById( "OutputReception" ).innerHTML = "";
        document.getElementById( "OutputStation" ).innerHTML = "";
    };
</script>
</body>