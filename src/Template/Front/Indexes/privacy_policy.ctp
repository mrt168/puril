<?php
use Cake\Routing\Router;
?>
<body>
<?php
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'terms']);
echo $this->Html->css('datsumou');
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<section class="content-base terms-head">
    <h1 class="content-base terms-head-title">Puril プライバシーポリシー</h1>
</section>
<section class="content-base terms-section">
    <div class="terms-section-text-wrap">
        <p>ツルツル株式会社（以下「当社」といいます）は、個人情報の重要性とその保護に対する社会的責務を認識し、以下のプライバシーポリシーに基づいて、個人情報の適切な取り扱いに努めます。</p>
    </div>
    <h2 class="terms-section-title">1. 法令その他の規範の遵守</h2>
    <div class="terms-section-text-wrap">
        <p>当社は個人情報の保護に関する法令及びその他の規範を遵守します。</p>
    </div>
    <h2 class="terms-section-title">2. 個人情報の取得</h2>
    <div class="terms-section-text-wrap">
        <p>Puril（以下、本サイトといいます）のご利用、ご登録が必要なサービスのご利用に際して、お名前や電子メールアドレス、電話番号、居住地域などの個人情報を送信していただく場合があります。<br>また本サイトへの投稿やお問い合わせの際には、IPアドレスが自動的に検出され、ログとして保存されます。これは単独で個人を特定できるものではなく、厳密な意味での個人情報には当たりませんが、個人情報に準じた取り扱いを行います。</p>
    </div>
    <h2 class="terms-section-title">3. 利用の範囲</h2>
    <div class="terms-section-text-wrap">
        <p>ご提供いただいた個人情報は当社からの連絡先、あるいは当社が提供するサービスをご利用頂く場合、あるいはサービスご利用の際に提携店舗が利用者を特定する為に提供される場合のみ利用され、それ以外の用途で利用されることはありません。 またより良いサービスを提供するために、利用者の閲覧履歴や投稿履歴情報、サービスのご利用状況等に統計・分析処理を施し、個人を特定できない情報に加工した上で、マーケティングデータとして活用させていただく場合があります。</p>
    </div>
    <h2 class="terms-section-title">4. cookie（クッキー）の使用について</h2>
    <div class="terms-section-text-wrap">
        <p>当社は、お客様によりよいサービスを提供するため、cookie （クッキー）を使用することがありますが、これにより個人を特定できる情報の収集を行えるものではなく、お客様のプライバシーを侵害することはございません。
            また、cookieの受け入れを希望されない場合は、ブラウザの設定で変更することができます。<br></p>
        <p>※cookieは、サーバーコンピュータからお客様のブラウザに送信され、お客様が使用しているコンピュータのハードディスクに蓄積される情報です。</p>
    </div>
    <h2 class="terms-section-title">5. 第三者による広告配信サービスでの情報利用について</h2>
    <div class="terms-section-text-wrap">
        <p>本サイトでは、第三者配信の広告サービス（Googleアドセンス）を利用しています。<br>このような広告配信事業者は、ユーザーの興味に応じた商品やサービスの広告を表示するため、本サイトや他サイトへのアクセスに関する情報 『Cookie』(氏名、住所、メール アドレス、電話番号は含まれません) を使用することがあります。<br>またGoogleアドセンスに関して、このプロセスの詳細やこのような情報が広告配信事業者に使用されないようにする方法については、<a href="https://www.google.com/analytics/terms/jp.html" target="_blank">こちら</a> をクリックしてください。</p>
    </div>
    <h2 class="terms-section-title">6. アクセス解析ツールでの情報利用について</h2>
    <div class="terms-section-text-wrap">
        <p>本サイトでは、Googleによるアクセス解析ツール「Googleアナリティクス」を利用しています。<br>
            このGoogleアナリティクスはトラフィックデータの収集のためにCookieを使用しています。<br>
            このトラフィックデータは匿名で収集されており、個人を特定するものではありません。<br>
            この機能はCookieを無効にすることで収集を拒否することが出来ますので、お使いのブラウザの設定をご確認ください。<br>
            この規約に関して、詳しくは <a href="https://www.google.com/analytics/terms/jp.html" target="_blank">こちら</a> をクリックしてください。</p>
    </div>
    <h2 class="terms-section-title">7. 個人情報の保護・管理</h2>
    <div class="terms-section-text-wrap">
        <p>当社は個人情報の取り扱いに関して適切な管理を実施します。個人情報を販売したり貸し出したりすることはありません。</p>
    </div>
    <h2 class="terms-section-title">8. 提供の制限</h2>
    <div class="terms-section-text-wrap">
        <p>当社は、サービス提供の上で必要な医院及び業務委託先に対して、必要最小限な情報に限り情報を提供します。</p>
    </div>
    <h2 class="terms-section-title">9. プライバシーポリシーの変更</h2>
    <div class="terms-section-text-wrap">
        <p>本サイトでは、収集する個人情報の変更、利用目的の変更、またはその他プライバシーポリシーの変更を行う際は、本ページへの公開をもって変更とさせて頂きます。</p>
        <p class="bottom_text">ツルツル株式会社 2018年10月12日 制定</p>
    </div>
</section>
<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>

<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span
                        itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span itemprop="name">プライバシーポリシー</span>
            <meta itemprop="position" content="2">
        </li>
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
</body>