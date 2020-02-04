<?php
use Cake\Routing\Router;
use App\Vendor\Constants;

if (empty($title_for_layout) && !empty($this->fetch('title'))) {
    $title_for_layout = $this->fetch('title');
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="<?php echo Router::url('/img/favicon.ico') ?>" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo Router::url('/img/apple-touch-icon.png')?>" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo Router::url('/img/apple-touch-icon-57x57.png')?>" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo Router::url('/img/apple-touch-icon-72x72.png')?>" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo Router::url('/img/apple-touch-icon-76x76.png')?>" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo Router::url('/img/apple-touch-icon-114x114.png')?>" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo Router::url('/img/apple-touch-icon-120x120.png')?>" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo Router::url('/img/apple-touch-icon-144x144.png')?>" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo Router::url('/img/apple-touch-icon-152x152.png')?>" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo Router::url('/img/apple-touch-icon-180x180.png')?>" />
<?php
if (!empty($description_for_layout)) {
    ?>
    <meta name='description' content='<?php echo $description_for_layout?>'>
    <meta property="og:description" content="<?php echo $description_for_layout?>" />
    <meta name="twitter:description" content="<?php echo $description_for_layout?>" />
    <?php
}
?>
<meta property="og:title" content="<?php echo $title_for_layout?>" /><!-- 今いるページのタイトル -->
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo Router::url(null, true)?>" /><!-- 今いるページのURL -->
<meta property="og:image" content="https://puril.net/img/OGP.jpg" />
<meta property="og:site_name" content="<?php echo Constants::FRONT_TITLE?>" /><!-- サイトの名前 -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?php echo $title_for_layout?>" /><!-- 今いるページのタイトル -->
<meta name="twitter:image" content="https://puril.net/img/OGP.jpg" />
<meta itemprop="image" content="https://puril.net/img/OGP.jpg" />
<meta name="robots" content="noindex">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php
if (isset($isNoIndex)) {
    echo $isNoIndex ? '<meta name="robots" content="noindex"/>' : null;
}
echo $this->Html->css(
    [
        'https://puril.net/css/front/swiper.min.css',
        'https://puril.net/css/front/drawer.css',
        'https://puril.net/css/front/animate.css',
        //'https://puril.net/css/front/common.css',
        'https://puril.net/css/front/page.css',
        '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
    ],
    ['type'=> 'text/css']);

// ブログ詳細ページ用CSS
if ($this->name == 'Shops' && $this->request->action == 'blogDetail') {
    echo $this->Html->css([
        'https://puril.net/webroot/column/wp-content/themes/datsumoulove/editor-style',
        'https://puril.net/webroot/column/wp-content/themes/datsumoulove/column'
    ],
        ['type'=> 'text/css']);
}

echo $this->Html->script(
    [
        '//code.jquery.com/jquery-1.10.2.min.js',
        '/js/datsumou/suggest.js',
    ],
    ['type'=> 'text/javascript']);
echo $this->Html->script(
    [
        '/js/front/swiper.min.js',
        '/js/front/drawer.min.js',
        '//cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js',
        '/js/front/animatedModal.min.js',
        '/js/front/all.js',
        '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js',
        '//code.jquery.com/ui/1.12.1/jquery-ui.min.js',
        '/js/front/datepicker-ja.js',
        '/js/front/gmaps.min.js',
    ],
    ['type'=> 'text/javascript','defer' => true]);

// ページネイション用メタタグ（SEO）
echo str_replace("amp;", "", $this->Paginator->meta());

// 構造化データ
if (!empty($structureds)) {
    echo "\n";
    foreach ($structureds as $structured) {
        echo "<script type='application/ld+json'>";
        echo $structured;
        echo "</script>";
    }
    echo "\n";
}

// canonical
if (!empty($_GET)) {
    $url = Router::url(null, true);
    echo "<link rel='canonical' href='{$url}'>";
}
?>
<!-- Begin Mieruca Embed Code -->
<script type="text/javascript" id="mierucajs">
    window.__fid = window.__fid || [];__fid.push([295321200]);
    (function() {
        function mieruca(){if(typeof window.__fjsld != "undefined") return; window.__fjsld = 1; var fjs = document.createElement('script'); fjs.type = 'text/javascript'; fjs.async = true; fjs.id = "fjssync"; var timestamp = new Date;fjs.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://hm.mieru-ca.com/service/js/mieruca-hm.js?v='+ timestamp.getTime(); var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(fjs, x); };
        setTimeout(mieruca, 500); document.readyState != "complete" ? (window.attachEvent ? window.attachEvent("onload", mieruca) : window.addEventListener("load", mieruca, false)) : mieruca();
    })();
</script>
<!-- End Mieruca Embed Code -->
<!-- 【始まり】mensリタゲタグ  -->
<script async src="https://s.yimg.jp/images/listing/tool/cv/ytag.js"></script>
<script>
    window.yjDataLayer = window.yjDataLayer || [];
    function ytag() { yjDataLayer.push(arguments); }
</script>
<!-- 【終わり】mensリタゲタグ  -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-150484464-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-150484464-1');
</script>
<!-- Event snippet for 脱毛love_CV conversion page
In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
<script>
    function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof(url) != 'undefined') {
                window.location = url;
            }
        };
        gtag('event', 'conversion', {
            'send_to': 'AW-781853385/RBRRCLqnoKcBEMnF6PQC',
            'event_callback': callback
        });
        return false;
    }
</script>

