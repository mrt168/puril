<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;

?>

    <footer class="datsumou-footer">
    <div class="datsumou-footer__inner">
        <ul class="datsumou-footer__category01">
            <li class="datsumou-footer__category__li">
                <a href="/datsumou/" class="datsumou-footer__category__li__link">脱毛</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">リラク</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">痩身</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">フェイシャル</a>
            </li>
        </ul>

        <ul class="datsumou-footer__category02">
            <li class="datsumou-footer__category__li">
                <a href="https://tsuru-tsuru.co.jp/" target="_blank"
                   class="datsumou-footer__category__li__link">運営企業</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/regulation" class="datsumou-footer__category__li__link">利用規約</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/privacy-policy" class="datsumou-footer__category__li__link">プライバシーポリシー</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/sitemap" class="datsumou-footer__category__li__link">サイトマップ</a>
            </li>
        </ul>
        <ul class="datsumou-footer__category03">
            <li class="datsumou-footer__category__li">
                <a href="https://puril.net/campaign/" class="datsumou-footer__category__li__link">口コミキャッシュバック</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/form_user" class="datsumou-footer__category__li__link">ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="datsumou-footer__category__li last">
                <a href="/form_facility" class="datsumou-footer__category__li__link">施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="datsumou-footer__credit">
        <img src="/puril/images/footer-logo-sp.png" alt="">
        <p>Copyright © ツルツル株式会社 All rights reserved.</p>
    </div>
</footer>
<?php
echo $this->element('Front/no_voice_modal') ?>