<section id="common_footer">
    <div class="FooterAbout">
        <div class="FooterAbout__img">
            <?php
            echo $this->Html->image('/img/home/header_logo.png', array('alt'=> 'Purilについて'));
            ?>
        </div>
        <div class="FooterAbout__text">
            <p class="FooterAbout__text__text">
                『Puril』は、<span class="FooterAbout__text__text__color">【脱毛人口1億人】を本気で目指す、脱毛総合情報サイト</span>です。<br>
                脱毛サロン、医療脱毛クリニックをはじめ、脱毛器、脱毛クリーム、脱毛石鹸ならびに<br>
                メンズ脱毛など、脱毛に必要な"すべて"の情報が集まるサイト作りを目指しています。<br><br>
                『Puril』を利用すれば、あなたに適した脱毛方法、<br>
                お得な脱毛情報、脱毛トレンドなどがわかります！<br>
                <span class="FooterAbout__text__text__color">脱毛サロン掲載物件も、日本最大級の規模！</span><br>
                どうぞ、『Puril』の圧倒的な情報量から、比較・検討してください！
            </p>
        </div>
    </div>
    <div class="bnr_area type02 pc">
        <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_1080200.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
    </div>
    <div class="bnr_area type02 sp">
        <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_600500.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
    </div>
    <div class="bnr_area mgn pc">
        <?php echo $this->Html->link($this->Html->image('/img/bnr02.jpg', ['alt'=> '広告掲載をお考えの施設運営者のみなさまへ']), ['controller'=> 'contacts', 'action'=> 'contact'], ['escape'=> false]);?>
    </div>
    <div class="bnr_area mgn sp">
        <?php echo $this->Html->link($this->Html->image('/img/sp_bnr02.png', ['alt'=> '広告掲載をお考えの施設運営者のみなさまへ']), ['controller'=> 'contacts', 'action'=> 'contact'], ['escape'=> false]);?>
    </div>
</section><!--/#common_footer-->
<footer id="footer">
    <div class="inner">
        <ul class="txt_link">
            <li><a href="https://tsuru-tsuru.co.jp/" target="_blank">運営企業</a></li>
            <li><?php echo $this->Html->link('利用規約', ['controller'=> 'indexes', 'action'=> 'terms']);?></li>
            <li><?php echo $this->Html->link('プライバシーポリシー', ['controller'=> 'indexes', 'action'=> 'privacyPolicy']);?></li>
            <li><?php echo $this->Html->link('サイトマップ', ['controller'=> 'indexes', 'action'=> 'siteMap']);?></li>
            <li><?php echo $this->Html->link('ユーザーレビューのお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact_user']);?></li>
            <li><?php echo $this->Html->link('施設情報掲載のお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact']);?></li>
        </ul>
        <div class="snsshare cf">
            <ul>
                <li class="in"><a href="//www.instagram.com/datsumou.love?ref=badge" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_insta.png', ['alt'=> 'instagram']);?></a></li>
                <li class="tw"><a href="//twitter.com/share?url=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_twitter.png', ['alt'=> 'twitter']);?></a></li>
                <li class="fb"><a href="//www.facebook.com/sharer/sharer.php?u=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_fb.png', ['alt'=> 'facebook']);?></a></li>
                <li class="hb"><a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow"><?php echo $this->Html->image('/img/home/header_icon_hatebu.png', ['alt'=> 'hatebu']);?></a></li>
                <li class="li"><a href="//line.me/R/msg/text/?https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_line.png', ['alt'=> 'line']);?></a></li>
            </ul>
        </div>
    </div>
    <div id="copy"><span>Copyright © ツルツル株式会社 All rights reserved.</span></div>
</footer><!--/#footer-->
<!-- 【始まり】mensリタゲタグ  -->
<script async>
ytag({
  "type":"yjad_retargeting",
  "config":{
    "yahoo_retargeting_id": "OO2MZS86PT",
    "yahoo_retargeting_label": "",
    "yahoo_retargeting_page_type": "",
    "yahoo_retargeting_items":[
      {item_id: 'i1', category_id: '', price: '', quantity: ''},
      {item_id: 'i2', category_id: '', price: '', quantity: ''},
      {item_id: 'i3', category_id: '', price: '', quantity: ''}
    ]
  }
});
</script>
<!-- 【終わり】mensリタゲタグ  -->