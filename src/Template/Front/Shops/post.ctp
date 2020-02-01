<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\ContactType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;

const RESERVE_TABLE = [
    // 日付の選択肢の数
    'DATE_OPTIONS'    => 8,
    // 予約の時刻帯の開始
    'TIME_START'      => 9,
    // 予約の時刻帯の終了
    'TIME_END'        => 21,
    // バツの確率
    'PROBABILITY'     => 25,
    // 希望日を取る数
    'VISIT_OPTIONS'   => 3,
    // 曜日の表現(en)
    'WEEK_OPTIONS_EN' => ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'],
    // 曜日の表現(jp)
    'WEEK_OPTIONS_JP' => ['日','月','火','水','木','金','土']
];
?>
<body>
<?php

echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/brand/common',  'datsumou/kuchikomi-entry']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<h1 class="content kuchikomi-entry-title"><?php echo $shop['name'];?></h1>
<?= $this->ExForm->create('Reviews', ['url' => false, 'type' => 'post', 'novalidate' => true, 'id' => 'form', 'enctype' => 'multipart/form-data']) ?>
<?php
echo $this->ExForm->hidden('Reviews.shop_name', ['class' => '', 'value' => $shop['name'], 'readonly' => 'readonly']);
echo $this->ExForm->hidden('Reviews.shop_id', ['value' => $shop['shop_id']]);
?>
<div class="content middle-content rating-area">
        <div class="rating-star"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png">
        </div>
        <div class="rating-number"><span id="rating-number-span">0.0</span></div>
        <?= $this->ExForm->hidden('Reviews.evaluation', ['id' => 'evaluation',]); ?>
    </div>
    <div class="content question-title">合計9つのご質問にお答えください</div>
    <div class="content-base question-area">
        <table>
            <tbody>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">1</div>
                        <div class="question-text">あなたのニックネームを教えて下さい。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->text('Reviews.nickname', ['id' => 'nickname', 'placeholder' => '例）脱毛 花子']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">2</div>
                        <div class="question-text">受けた施術等の名前を教えてください。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->text('Reviews.title', ['id' => 'title', 'required' => 'required', 'placeholder' => '（回答例）全身脱毛']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">3</div>
                        <div class="question-text">あなたの性別と、生年月日を教えてください。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->sex('Reviews.sex', ['id' => 'sex', 'type' => 'select', 'default' => Sex::$WOMAN[CodePattern::$CODE]]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->text('Reviews.birthday', ['class' => 'datepicker', 'placeholder' => '例）2018/12/06', 'id' => 'birthday']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">4</div>
                        <div class="question-text">あなたが現在居住している都道府県や、最寄り駅を教えてください。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?php
                            echo $this->ExForm->pref('Reviews.pref', array('id'=> 'pref', 'class'=> 'form-control'));
                            ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->text('Reviews.station', ['id' => 'title', 'placeholder' => '（回答例）東京駅']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">5</div>
                        <div class="question-text">この店舗の総合的な感想を、50文字程度で感想を教えてください。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.content', ['id' => 'content', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'（回答例）駅近で好立地で、仕事帰りに通いやすいのがとても良いです。スタッフの皆さんも親切で、施術に関する不安もありませんでした！']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">6</div>
                        <div class="question-text">この店舗を選んだ理由を教えてください。</div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.reason', ['id' => 'content', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'（回答例）HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">7</div>
                        <div class="question-text">
                            <p>店舗の「接客／サービス」はいかがでしたか？</p>
                            <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner flex">
                            <span style="color: #B5B5B5">評価点</span>
                            <?= $this->ExForm->satisfaction('Reviews.question1', ['class' => 'question', 'id' => 'rating1', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.question1_evaluation', ['id' => 'question1_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">8</div>
                        <div class="question-text">
                            <p>受けたサービスの「メニューや料金」についてはいかがでしたか？</p>
                            <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner flex">
                            <span style="color: #B5B5B5">評価点</span>
                            <?= $this->ExForm->satisfaction('Reviews.question2', ['class' => 'question', 'id' => 'rating2', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.question2_evaluation', ['id' => 'question2_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">9</div>
                        <div class="question-text">
                            <p>施術の「効果（技術や仕上がり）」はいかがでしたか？</p>
                            <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner flex">
                            <span style="color: #B5B5B5">評価点</span>
                            <?= $this->ExForm->satisfaction('Reviews.question3', ['class' => 'question', 'id' => 'rating3', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.question3_evaluation', ['id' => 'question3_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">10</div>
                        <div class="question-text">
                            <p>店舗の「雰囲気」はいかがでしたか？</p>
                            <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner flex">
                            <span style="color: #B5B5B5">評価点</span>
                            <?= $this->ExForm->satisfaction('Reviews.question4', ['class' => 'question', 'id' => 'rating4', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.question4_evaluation', ['id' => 'question4_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'雑居ビル内にあるので、少し入るときに抵抗がありました。しかし、店内に入るとすごくキレイで清潔感があって、よかったです！女性用のアメニティもそろっていたので、その辺の気遣いも感じられました♪']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="th-inner">
                        <div class="question-number">11</div>
                        <div class="question-text">
                            <p>店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</p>
                            <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                        </div>
                    </div>
                </th>
                <td>
                    <div class="td-inner-wrap">
                        <div class="td-inner flex">
                            <span style="color: #B5B5B5">評価点</span>
                            <?= $this->ExForm->satisfaction('Reviews.question5', ['class' => 'question', 'id' => 'rating5', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                        </div>
                    </div>
                    <div class="td-inner-wrap">
                        <div class="td-inner">
                            <?= $this->ExForm->textarea('Reviews.question5_evaluation', ['id' => 'question5_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 10, 'placeholder'=>'施術時に次回の予約案内があるため、スムーズに通えています。ただし、直前の変更がなかなか難しいこと、直前にキャンセルした場合にはなかなか予約が空いていない点は、少し注意が必要です。']); ?>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="content question-thanks">
        <p>お疲れ様でした！</p>
        <p>ご回答、誠にありがとうございました♪</p>
    </div>
    <div class="content question-thanks">
        <p>内容に問題がなければ、下の「口コミを投稿する」ボタンを押してください。</p>
    </div>
<div class="send_error"></div>
    <div class="content kuchikomi-entry-post">
        <button id="song-xinsuru" class="button-base kuchikomi-entry-button" type="submit"><i class="fas fa-comments kuchikomi-entry-button-icon"></i>
            <div class="kuchikomi-entry-button-text">口コミを投稿する</div>
        </button>
    </div>
<?= $this->ExForm->end(); ?>
<script type="text/javascript" src="/js/datsumou/kuchikomi-entry.js"></script>
<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span itemprop="name"  class="name">TOP</span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou')?>"><span itemprop="name" class="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou/search')?>"><span itemprop="name" class="name">全国の脱毛施設</span></a>
            <meta itemprop="position" content="3">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo $this->Html->link("<span>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?>
            <meta itemprop="position" content="4">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo $this->Html->link("<span>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?>
            <meta itemprop="position" content="5">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo $this->Html->link("<span>{$shop['name']}</span>", ['controller' => 'shops', 'action' => 'detail', $shop['shop_id']], ['escape' => false]) ?>
            <meta itemprop="position" content="6">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span itemprop='name' class='name'>口コミ投稿</span>
            <meta itemprop="position" content="7">
        </li>
    </ol>
</div>
<script type="text/javascript">
    $(function () {
        $("#song-xinsuru").click(function() {

            var $form = $('#form').get()[0];
            var fd = new FormData($form);

            $.ajax({
                type: 'post',
                url: "<?=Router::url(['controller'=> 'shops', 'action'=> 'send'], true)?>/",
                data: fd,
                processData: false,
                contentType: false,
                success: function(res) {
                    var errors = JSON.parse(res).errorMsg;
                    if (errors) {
                        $('.atention').text("");
                        // エラー処理
                        $.each(errors, function(column, error) {
                            $('.'+column).text(error);
                        });
                        return;
                    } else {
                        alert('口コミを投稿しました！');
                        location.href = '<?=Router::url(['controller'=> 'shops', 'action'=> 'detail'], true)?>/<?=$shop['shop_id']?>';
                    }
                }
            });

            return false;
        });
    });
</script>
<?php
echo $this->element('Front/footer') ?>
</body>