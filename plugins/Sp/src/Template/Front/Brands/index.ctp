<?php
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Alphabet;
use Cake\Routing\Router;
?>
<body>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['css/main', 'css/search']);
?>
<div class="Search"><!-- test -->
    <header class="datsumou-header">
        <?php
        echo $this->element('Front/header')
        ?>
    </header>
    <div class="Search__contents">
        <h1 class="Search__title"><span>店舗名から探す</span></h1>
        <div class="Search__btns">
            <a href="" class="Search__btn active" data-type="salon">脱毛サロン</a>
            <a href="" class="Search__btn" data-type="clinic">医療脱毛クリニック</a>
        </div>
        <div class="Search__brand__wrap" id="salon">
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
        <div class="Search__brand__wrap Search__brand__wrap--none" id="clinic">
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
</div>
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
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
<script>
    $('.Search__brand__wrap--none').hide();
    $('.Search__btn').each(function(){
       $(this).click(function(e){
           e.preventDefault();
           $(this).parent(".Search__btns").find(".Search__btn").each(function(){
               $(this).removeClass("active")
           });
           $(this).addClass("active");
           var type = $(this).data("type");
           $(".Search__brand__wrap").each(function(){
              if($(this).attr("id") == type) {
                  $(this).fadeIn();
              }  else {
                  $(this).hide();
              }
           });
       });
    });
</script>
</body>
</html>
