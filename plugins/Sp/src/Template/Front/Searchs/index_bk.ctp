<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
?>
<div id="bread">
    <div class="inner cf">
        <span class="breaditem"><a href="/"><span>TOP</span></a></span>
        <span class="breaditem"><span>全国の脱毛施設</span></span>
    </div>
</div>
<div id="container">
    <div class="inner no-sp-padding">
        <div class="undercontentwrap cf">
            <main id="maincolumn" class="search">
                <div class="cf search-title">
                    <h1 class="maintit">脱毛サロン・医療脱毛クリニック<span>を全国から探す</span></h1>
                    <div class="counter">
                        <div class="counter_tbl">
                            <?php
                            for ($i = 0; $i < mb_strlen($shopCnt); $i++) {
                                $cntStr = mb_substr($shopCnt, $i, 1);
                                echo "<span class=\"num\">{$cntStr}</span>";
                            }
                            ?>
                        </div>
                        <span class="txt">件</span>
                    </div>
                </div>

                <div class="SearchBox SearchBox--page">
                    <div class="SearchBox__inner">
                        <div class="SearchBox__inner__search SearchBox__inner__search--page SearchBox__inner__search--page-pc">
                            <?php
                            echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form01', 'class'=> 'cf']);
                            echo $this->ExForm->text('Make.free_word', ['id'=> 'input01', 'placeholder'=> '地名、サロン名、駅名などで検索']);
                            echo $this->ExForm->input('', ['name'=> 'free_word_search', 'id'=> 'submit01', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                            echo $this->ExForm->end();
                            ?>
                        </div>
                        <div class="SearchBox__inner__search SearchBox__inner__search--page SearchBox__inner__search--page-sp">
                            <?php
                            echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form02', 'class'=> 'cf']);
                            echo $this->ExForm->text('Make.free_word', ['id'=> 'input02', 'placeholder'=> '地名、サロン名、駅名などで検索']);
                            echo $this->ExForm->input("", ['name'=> 'free_word_search', 'id'=> 'submit02', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                            echo $this->ExForm->end();
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                if (!$this->request->isMobile()) {
                    ?>
                    <div id="pcsearch" class="search_wrap pc">
                        <h2 class="tit">条件を入力して、ジブンにピッタリの脱毛サロン・クリニックを見つけましょう！</h2>
                        <?php
                        echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);
                        ?>
                        <div class="search_inner pad">
                            <div class="check_box">
                                <h3 class="sub_tit">施設の種類で絞り込む</h3>
                                <ul class="cf">
                                    <?php
                                    // 										echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']]);
                                    echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']]);
                                    ?>
                                </ul>
                            </div>
                            <div class="check_box w20 slide">
                                <h3 class="sub_tit">都道府県で絞り込む</h3>
                                <?php echo $this->ExForm->byRegion('Make.pref'); ?>
                            </div>
                            <div class="form_btn">
                                <?php
                                echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                                ?>
                            </div>
                        </div>
                        <div class="more_btn pc active"><span>さらに条件を絞って探す</span></div>
                        <div class="more_btn_sp sp"><span>さらに詳しい条件で絞る</span></a></div>
                        <div class="search_inner slide_down active">
                            <div class="modal-content">
                                <div class="md_inner">
                                    <div class="depilation_site pc check_box w33">
                                        <h3 class="sub_tit">脱毛部位</h3>
                                        <ul class="prt cf">
                                            <?php
                                            $this->ExForm->depilationSiteCnt('Make.depilation_site_id.');
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">価格</h3>
                                        <ul class="cf"><?php echo $this->ExForm->priceCnt('Make.price_id.'); ?></ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">支払い方法</h3>
                                        <ul class="cf"><?php echo $this->ExForm->paymentCnt('Make.payment_id.'); ?></ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">特典・割引</h3>
                                        <ul class="cf"><?php echo $this->ExForm->discountCnt('Make.discount_id'); ?></ul>
                                    </div>
                                    <div class="check_box w50 other">
                                        <h3 class="sub_tit">その他こだわり</h3>
                                        <?php
                                        echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
                                            'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']
                                        ]);
                                        ?>
                                    </div>
                                </div>
                                <div class="form_btn">
                                    <?php
                                    echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $this->ExForm->end();
                        ?>
                    </div><!--/#pcearch-->
                    <?php
                } else {
                    ?>
                    <div id="spsearch" class="search_wrap sp">
                        <h2 class="tit">条件を入力して、ジブンにピッタリの<br>脱毛サロン・クリニックを見つけましょう！</h2>
                        <?php
                        echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);
                        ?>
                        <div class="search_inner pad">
                            <div class="check_box">
                                <h3 class="sub_tit">施設の種類で絞り込む</h3>
                                <ul class="cf">
                                    <?php
                                    // 										echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']], false);
                                    echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], false);
                                    ?>
                                </ul>
                            </div>
                            <div class="check_box w20 slide">
                                <h3 class="sub_tit">都道府県で絞り込む</h3>
                                <?php echo $this->ExForm->byRegion('Make.pref', [], false); ?>
                            </div>
                            <div class="form_btn">
                                <?php
                                echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                                ?>
                            </div>
                        </div>
                        <div class="more_btn_sp sp"><a href="#sp_search_detail" id="sp_search"><span>さらに詳しい条件で絞る</span></a></div>
                        <div id="sp_search_detail" class="search_inner sp_search_detail">
                            <div class="modal-content">
                                <div class="cat_head">さらに詳しい条件で絞る<span class="close-sp_search_detail close">×</span></div>
                                <div class="md_inner">


                                    <!-- ↓michikami↓ -->
                                    <div class="depilation_site sp check_box w33">
                                        <h3 class="sub_tit">脱毛部位</h3>
                                        <ul class="prt cf">
                                            <?php
                                            $this->ExForm->depilationSiteCnt('Make.depilation_site_id.', [], false);
                                            ?>
                                        </ul>
                                    </div>
                                    <!-- ↑michikami↑ -->
                                    <div class="check_box">
                                        <h3 class="sub_tit">価格</h3>
                                        <ul class="cf">
                                            <?php
                                            echo $this->ExForm->priceCnt('Make.price_id', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>', 'div'=> false]], false);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">支払い方法</h3>
                                        <ul class="cf">
                                            <?php
                                            echo $this->ExForm->paymentCnt('Make.payment_id', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']], false);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="check_box">
                                        <h3 class="sub_tit">特典・割引</h3>
                                        <ul class="cf">
                                            <?php
                                            echo $this->ExForm->discountCnt('Make.discount_id', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']], false);
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="check_box w50 slide">
                                        <h3 class="sub_tit">その他こだわり</h3>
                                        <?php
                                        // 											echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
                                        // 													'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']
                                        // 											], false);

                                        echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
                                            'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']
                                        ], false);
                                        ?>
                                    </div>
                                </div>
                                <div class="form_btn02">
                                    <?php
                                    echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                                    ?>
                                </div>
                                <?php
                                echo $this->ExForm->end();
                                ?>
                            </div>
                        </div>
                    </div><!--/#spsearch-->
                    <?php
                }
                ?>
                <div class="published_wrap">
                    <h2 class="tit">脱毛サロン・医療脱毛クリニックの<br class="only-sp">都道府県別掲載数</h2>
                    <div class="tbl">
                        <table>
                            <tbody>
                            <tr>
                                <th>都道府県</th>
                                <th>脱毛サロン</th>
                                <th>脱毛医療<br class="sp">クリニック</th>
                            </tr>
                            <?php
                            foreach ($prefs as $pref) {
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        echo $this->Html->link($pref['pref'], ['controller'=> 'searchs', 'action'=> 'search', $pref['url_text']]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Html->link($pref['salon_cnt'].'件', ['controller'=> 'searchs', 'action'=> 'search', $pref['url_text'], ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]]);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo $this->Html->link($pref['medical_cnt'].'件', ['controller'=> 'searchs', 'action'=> 'search', $pref['url_text'], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <?= $this->element('Front/SearchResult/side')?>
        </div><!--/.undercontentwrap-->
    </div><!--/.inner-->
</div><!--/#container-->