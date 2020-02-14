<?php
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Alphabet;
use Cake\Routing\Router;
?>
<body>
<?php
echo $this->Html->css(['css/main', 'css/search']);
?>
<div class="Search">
    <header class="Search__header">
        <div class="Search__header__inner">
            <a href="#" class="Search__header__back"><i class="fas fa-chevron-left"></i></a>
            <div class="Search__header__input">
                <input type="" name="" placeholder="サロン・クリニック名検索" class="input">
                <button class="cancel"><img src="/puril/images/ico_cancel.svg" alt="キャンセル"></button>
            </div>
            <div class="Search__header__refine"><button><img src="/puril/images/ico_refine.svg" alt="絞込み"></button></div>
        </div>
    </header>
    <div class="Search__contents">
        <div class="Search__title"><span>店舗名から探す</span></div>
        <div class="Search__btns">
            <a href="" class="Search__btn" data-color="default">脱毛サロン</a>
            <a href="" class="Search__btn" data-color="white">医療脱毛クリニック</a>
        </div>
        <div>
        <?php
        $jaBlock = 1;
        foreach ($salons['JA'] as $line => $japanesSyllabary) {
            ?>
            <div class="Search__list__header"><span><?=$line?></span></div>
            <ul class="Search__list">
                    <?php
                    foreach ($japanesSyllabary as $japanes) {
                        ?>
                        <?php
                        if (!empty($japanes['data'])) {
                            foreach ($japanes['data'] as $brand) {
                                ?>
                                <li>
                                    <?php
                                    echo $this->Html->link($brand['name'], ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']]);
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <?php
                    }
                    ?>
                </ul>
            <?php
            $jaBlock++;
        }
        ?>
        </div>
        <div>
            <?php
            $jaBlock = 1;
            foreach ($clinics['JA'] as $line => $japanesSyllabary) {
                ?>
                <div class="Search__list__header"><span><?=$line?></span></div>
                <ul class="Search__list">
                    <?php
                    foreach ($japanesSyllabary as $japanes) {
                        ?>
                        <?php
                        if (!empty($japanes['data'])) {
                            foreach ($japanes['data'] as $brand) {
                                ?>
                                <li>
                                    <?php
                                    echo $this->Html->link($brand['name'], ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']]);
                                    ?>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <?php
                    }
                    ?>
                </ul>
                <?php
                $jaBlock++;
            }
            ?>
        </div>

    </div>
    <div class="Search__breadcrumbs">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <span itemprop="name" class="name">店舗名から探す</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </div>
</div>
</body>
</html>
