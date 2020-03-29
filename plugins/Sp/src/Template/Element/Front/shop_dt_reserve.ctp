<?php
use App\Vendor\FormUtil;
?>



<?php if ( FormUtil::checkUseForm($shop['name'],$shop['shop_id'] ) ){ ?>
    <div id="shop_dt_reserve" class="shopinfo">
        <a onclick="return gtag_report_conversion('/shop/reserve?shop_id=<?php echo $shop['shop_id'] ?>');" href="/shop/reserve?shop_id=<?php echo $shop['shop_id'] ?>" class="reserve_btn flex-row flex-center align-stretch" >
            <div class="reserve_btn_text">
               <?php if ( FormUtil::checkAfb($shop['name'],$shop['shop_id'],FormUtil::$afbList ) ){ ?>
			Purilから予約する<br>
            <span class="reserve_btn_sub">メンドウな日程調整をお任せ！</span>
			<?php } else { ?>
			Purilから<span class="reserve_emphasis">おトクに</span>予約する<br>
            <span class="reserve_btn_sub">★契約で<span class="reserve_price">5,000</span>円〜のキャッシュバック</span>
            <?php } ?>
            </div>
            <div class="reserve_arrow flex-column flex-center align-center">
                カンタン<br>30秒<br><?php echo $this->Html->image('/img/Shop/right_arrow.png', ['alt'=> '右矢印'])?>
            </div>
        </a>
    </div>
<?php } ?>