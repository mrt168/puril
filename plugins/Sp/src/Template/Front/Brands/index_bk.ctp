<?php
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Alphabet;
use Cake\Routing\Router;
?>
<div id="bread">
    <div class="inner cf">
        <span class="breaditem"><a href="<?=Router::url('/')?>"><span>Purilトップ</span></a></span>
        <span class="breaditem">店舗名から探す</span>
    </div>
</div>
<div id="container">
    <div class="inner">
        <div class="undercontentwrap cf">
            <main id="maincolumn" class="search">
                <div id="mainclum_brands">
                    <div class="cf">
                        <h1 class="maintit">脱毛サロン・医療脱毛クリニック<span>を店舗名から探す</span></h1>
                    </div>
                    <div class="sharearea cf">
                        <ul>
                            <li class="tw"><a href="http://twitter.com/share?url=https://puril.net/brands/" target="_blank">ツイート</a></li>
                            <li class="fb"><a href="https://www.facebook.com/sharer/sharer.php?u=https://puril.net/brands/" target="_blank">シェア</a></li>
                            <li class="hb"><a href="https://b.hatena.ne.jp/add?mode=confirm&amp;url=https://puril.net/brands/" target="_blank" rel="nofollow">はてぶ</a></li>
                            <li class="li"><a href="https://line.me/R/msg/text/?https://puril.net/brands/" target="_blank">シェア</a></li>
                        </ul>
                    </div>
                    <div id="brands_tabjscontrol" class="leadwrap cf">
                        <a href="#brands_salon" class="scrollbtn">
                            <span>脱毛サロン</span>
                        </a>
                        <a href="#brands_clinic" class="scrollbtn">
                            <span>医療脱毛クリニック</span>
                        </a>
                    </div>
                    <div id="brands_salon" class="tabjswrap">
                        <h2 class="commontit">全国の脱毛サロン</h2>
                        <div id="salon_jalist" class="tabscontentarea">
                            <div class="nav_list pc">
                                <div class="navitit">50音で脱毛サロンを探す</div>
                                <ul>
                                    <?php
                                    $jaBlock = 1;
                                    foreach ($salons['JA'] as $line => $japanesSyllabary) {
                                        ?>

                                        <li class="bchara_nav_list">
                                            <a href="#salon_ja_block<?=$jaBlock?>" class="list"><?=$line?></a>
                                            <ul class="moreselect">
                                                <?php
                                                foreach ($japanesSyllabary as $japanes) {
                                                    ?>
                                                    <li><a href="#salon_ja<?=$japanes[CodePattern::$CODE]?>"><?=$japanes[CodePattern::$VALUE]?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                        $jaBlock++;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            $jaBlock = 1;
                            foreach ($salons['JA'] as $line => $japanesSyllabary) {
                                ?>
                                <div class="list_block">
                                    <h3 id="salon_ja_block<?=$jaBlock?>" class="coomontit_h3"><?=$line?></h3>
                                    <?php
                                    foreach ($japanesSyllabary as $japanes) {
                                        ?>
                                        <div class="list_sub_block">
                                            <div id="salon_ja<?=$japanes[CodePattern::$CODE]?>" class="minitit pc"><?=$japanes[CodePattern::$VALUE]?></div>
                                            <div class="cf">
                                                <?php
                                                if (!empty($japanes['data'])) {
                                                    foreach ($japanes['data'] as $brand) {
                                                        echo $this->Html->link($brand['name'], ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']]);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                $jaBlock++;
                            }
                            ?>
                        </div>
                    </div>
                    <div id="brands_clinic" class="tabjswrap">
                        <h2 class="commontit">全国の医療脱毛クリニック</h2>
                        <div id="clinic_jalist" class="tabscontentarea">
                            <div class="nav_list pc">
                                <div class="navitit">50音で医療脱毛クリニックを探す</div>
                                <ul>
                                    <?php
                                    foreach ($clinics['JA'] as $line => $japanesSyllabary) {

                                        $jaBlock = 1;
                                        ?>

                                        <li class="bchara_nav_list">
                                            <a href="#clinic_ja_block<?=$jaBlock?>" class="list"><?=$line?></a>
                                            <ul class="moreselect">
                                                <?php
                                                foreach ($japanesSyllabary as $japanes) {
                                                    ?>
                                                    <li><a href="#clinic_ja<?=$japanes[CodePattern::$CODE]?>"><?=$japanes[CodePattern::$VALUE]?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                        $jaBlock++;
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            $jaBlock = 1;
                            foreach ($clinics['JA'] as $line => $japanesSyllabary) {
                                ?>
                                <div class="list_block">
                                    <h3 id="clinic_ja_block<?=$jaBlock?>" class="coomontit_h3"><?=$line?></h3>
                                    <?php
                                    foreach ($japanesSyllabary as $japanes) {
                                        ?>
                                        <div class="list_sub_block">
                                            <div id="clinic_ja<?=$japanes[CodePattern::$CODE]?>" class="minitit pc"><?=$japanes[CodePattern::$VALUE]?></div>
                                            <div class="cf">
                                                <?php
                                                if (!empty($japanes['data'])) {
                                                    foreach ($japanes['data'] as $brand) {
                                                        echo $this->Html->link($brand['name'], ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']]);
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                $jaBlock++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
            <?= $this->element('Front/SearchResult/side')?>
        </div>
    </div>
</div>