<?php
use App\Vendor\Code\ContactType;
use Cake\Routing\Router;
use App\Vendor\Code\CodePattern;
?>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/reserve/common', 'datsumou/reserve/index', 'jquery.datetimepicker.min']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<h1 class="contact-title">お問い合わせありがとうございます。</h1>
<?php echo $this->ExForm->create('Contact', ['url'=> ['controller' => 'Contacts', 'action'=> 'sendContactUser'], 'type'=> 'post', 'class' =>'reserve-form form-contact']);?>
<section class="contact-content">
    <div class="contact-content-text" style="margin: 20px 0;">
        <p>お問い合わせを受け付けました。数営業日内に、担当者より折り返しのご連絡をさせていただきます。（内容によってはご返信にお時間を頂戴する場合があること、予めご了承ください。）<br>引き続き、Purilのコンテンツをお楽しみください。</p>
    </div>
</section>
<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>

<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span itemprop="name"  class="name">TOP</span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/form_user')?>"><span
                        itemprop="name" class="home">お問い合わせ</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span itemprop='name' class='name'>お問い合わせありがとうございます。</span>
            <meta itemprop="position" content="3">
        </li>
    </ol>
</div>
<script type="text/javascript" src="/js/datsumou/reserve/index.js"></script>

<?php echo $this->element('Front/footer') ?>
