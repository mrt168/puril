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
<?= $this->ExForm->create('Reviews', ['url' => false, 'type' => 'post', 'id' => 'form', 'enctype' => 'multipart/form-data']) ?>
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
<div class="content question-title">合計11個のご質問にお答えください</div>
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
                        <?= $this->ExForm->text('Reviews.nickname', ['id' => 'nickname','required' => 'required', 'placeholder' => '例）脱毛 花子']); ?>
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
                        <!-- <?= $this->ExForm->sex('Reviews.sex', ['id' => 'sex', 'type' => 'radio', 'default' => Sex::$WOMAN[CodePattern::$CODE]]); ?> -->
                        <div class="input radio">
                            <input type="hidden" name="Reviews[sex]" value="">
                            <label for="reviews-sex-2" class="active"><input type="radio" name="Reviews[sex]" value="2" id="reviews-sex-2" checked="checked">女性</label>
                            <label for="reviews-sex-1"><input type="radio" name="Reviews[sex]" value="1" id="reviews-sex-1">男性</label>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->hidden('Reviews.birthday', ['id' => 'birthday']); ?>
                    </div>
                    <div class="td-inner flex">
                        <div class="wrap select border">
                            <select name="birthday_y" id="birthday_y" required="">
                                <option value="1920">1920</option>
                                <option value="1921">1921</option>
                                <option value="1922">1922</option>
                                <option value="1923">1923</option>
                                <option value="1924">1924</option>
                                <option value="1925">1925</option>
                                <option value="1926">1926</option>
                                <option value="1927">1927</option>
                                <option value="1928">1928</option>
                                <option value="1929">1929</option>
                                <option value="1930">1930</option>
                                <option value="1931">1931</option>
                                <option value="1932">1932</option>
                                <option value="1933">1933</option>
                                <option value="1934">1934</option>
                                <option value="1935">1935</option>
                                <option value="1936">1936</option>
                                <option value="1937">1937</option>
                                <option value="1938">1938</option>
                                <option value="1939">1939</option>
                                <option value="1940">1940</option>
                                <option value="1941">1941</option>
                                <option value="1942">1942</option>
                                <option value="1943">1943</option>
                                <option value="1944">1944</option>
                                <option value="1945">1945</option>
                                <option value="1946">1946</option>
                                <option value="1947">1947</option>
                                <option value="1948">1948</option>
                                <option value="1949">1949</option>
                                <option value="1950">1950</option>
                                <option value="1951">1951</option>
                                <option value="1952">1952</option>
                                <option value="1953">1953</option>
                                <option value="1954">1954</option>
                                <option value="1955">1955</option>
                                <option value="1956">1956</option>
                                <option value="1957">1957</option>
                                <option value="1958">1958</option>
                                <option value="1959">1959</option>
                                <option value="1960">1960</option>
                                <option value="1961">1961</option>
                                <option value="1962">1962</option>
                                <option value="1963">1963</option>
                                <option value="1964">1964</option>
                                <option value="1965">1965</option>
                                <option value="1966">1966</option>
                                <option value="1967">1967</option>
                                <option value="1968">1968</option>
                                <option value="1969">1969</option>
                                <option value="1970">1970</option>
                                <option value="1971">1971</option>
                                <option value="1972">1972</option>
                                <option value="1973">1973</option>
                                <option value="1974">1974</option>
                                <option value="1975">1975</option>
                                <option value="1976">1976</option>
                                <option value="1977">1977</option>
                                <option value="1978">1978</option>
                                <option value="1979">1979</option>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995" selected="">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select><i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div><span class="mr-10">年</span>
                        <div class="wrap select border">
                            <select name="birthday_m" id="birthday_m" required="">
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select><i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div><span class="mr-10">月</span>
                        <div class="wrap select border">
                            <select name="birthday_d" id="birthday_d" required="">
                                <option value="">--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select><i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div><span>日</span>
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
                        <div class="wrap select">
                            <?php
                            echo $this->ExForm->pref('Reviews.pref', array('id'=> 'pref', 'required' => 'required','class'=> 'form-control'));
                            ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->text('Reviews.station', ['id' => 'station', 'autocomplete'=>'off', 'required' => 'required','placeholder' => '（回答例）東京駅']); ?>
                        <div id="suggest" style="display:none;"></div>
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
                        <?= $this->ExForm->textarea('Reviews.content', ['id' => 'content', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'（回答例）駅近で好立地で、仕事帰りに通いやすいのがとても良いです。スタッフの皆さんも親切で、施術に関する不安もありませんでした！']); ?>
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
                        <?= $this->ExForm->textarea('Reviews.reason', ['id' => 'reason', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'（回答例）HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。']); ?>
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
                        <div class="wrap select">
                            <?= $this->ExForm->satisfaction('Reviews.question1', ['class' => 'question', 'id' => 'question1', 'required' => 'required','type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->textarea('Reviews.question1_evaluation', ['id' => 'question1_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！']); ?>
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
                        <div class="wrap select">
                            <?= $this->ExForm->satisfaction('Reviews.question2', ['class' => 'question', 'id' => 'question2','required' => 'required', 'type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->textarea('Reviews.question2_evaluation', ['id' => 'question2_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。']); ?>
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
                        <div class="wrap select">
                            <?= $this->ExForm->satisfaction('Reviews.question3', ['class' => 'question', 'id' => 'question3', 'type' => 'select','required' => 'required','placeholder'=>'評価点', 'empty' => true]); ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->textarea('Reviews.question3_evaluation', ['id' => 'question3_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。']); ?>
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
                        <div class="wrap select">
                            <?= $this->ExForm->satisfaction('Reviews.question4', ['class' => 'question', 'id' => 'question4', 'required' => 'required','type' => 'select','placeholder'=>'評価点', 'empty' => true]); ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->textarea('Reviews.question4_evaluation', ['id' => 'question4_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'雑居ビル内にあるので、少し入るときに抵抗がありました。しかし、店内に入るとすごくキレイで清潔感があって、よかったです！女性用のアメニティもそろっていたので、その辺の気遣いも感じられました♪']); ?>
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
                        <div class="wrap select">
                            <?= $this->ExForm->satisfaction('Reviews.question5', ['class' => 'question', 'id' => 'question5', 'type' => 'select','required' => 'required','placeholder'=>'評価点', 'empty' => true]); ?>
                            <i class="fas fa-chevron-down reserve-input-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="td-inner-wrap">
                    <div class="td-inner">
                        <?= $this->ExForm->textarea('Reviews.question5_evaluation', ['id' => 'question5_evaluation', 'class'=>'evaluation', 'required' => 'required', 'cols' => 30, 'rows' => 6, 'placeholder'=>'施術時に次回の予約案内があるため、スムーズに通えています。ただし、直前の変更がなかなか難しいこと、直前にキャンセルした場合にはなかなか予約が空いていない点は、少し注意が必要です。']); ?>
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
            <?php echo $this->Html->link("<span itemprop='name' class='name'>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false,'itemscope'=>'','itemtype'=>'http://schema.org/Thing','itemprop'=>'item'])?>
            <meta itemprop="position" content="4">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo $this->Html->link("<span itemprop='name' class='name'>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false,'itemscope'=>'','itemtype'=>'http://schema.org/Thing','itemprop'=>'item'])?>
            <meta itemprop="position" content="5">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo $this->Html->link("<span itemprop='name' class='name'>{$shop['name']}</span>", ['controller' => 'shops', 'action' => 'detail', $shop['shop_id']], ['escape' => false,'itemscope'=>'','itemtype'=>'http://schema.org/Thing','itemprop'=>'item']) ?>
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
        $("#song-xinsuru").click(function(e) {

            var $form = $('#form').get()[0];
            var fd = new FormData($form);
            var formNickname = $('#nickname'),
                formTitle = $('#title'),
                birthday_y = $('#birthday_y'),
                birthday_m = $('#birthday_m'),
                birthday_d = $('#birthday_d'),
                pref = $('#pref'),
                station = $('#station'),
                content = $('#content'),
                reason = $('#reason'),
                question1 = $('#question1'),
                question1_evaluation = $('#question1_evaluation'),
                question2 = $('#question2'),
                question2_evaluation = $('#question2_evaluation'),
                question3 = $('#question3'),
                question3_evaluation = $('#question3_evaluation'),
                question4 = $('#question4'),
                question4_evaluation = $('#question4_evaluation'),
                question5 = $('#question5'),
                question5_evaluation = $('#question5_evaluation');
            var formData = [formNickname,
                formTitle,
                birthday_y,
                birthday_m,
                birthday_d,
                pref,
                station,
                content,
                reason,
                question1,
                question1_evaluation,
                question2,
                question2_evaluation,
                question3,
                question3_evaluation,
                question4,
                question4_evaluation,
                question5,
                question5_evaluation];
            var isOk = true;
            var errorId = '';
            formData.map(function (form) {
                if(form.val() == '' || form.val() == 99) {
                    form.addClass("errorColor");
                    if(errorId == '') {
                        errorId = form.attr("id");
                    }
                    isOk = false;
                } else {
                    form.removeClass("errorColor");
                }
            });
            if(isOk) {
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
            } else {
                $("html,body").animate({scrollTop:$('#'+ errorId).offset().top - $(".datsumou-header-inner").height() - 20});
            }
            return false;


        });
        $('[id^="reviews-sex"]').each(function(){
            if($(this).prop('checked')){
                $(this).parent('label').addClass('active');
            }
        });
        $('[id^="reviews-sex"]').click(function(){
            if($(this).prop('checked')){
                $(this).parent('label').addClass('active').siblings().removeClass('active');
            }
        });
        $('[name^="birthday_"]').each(function(index,elm){
            $(elm).change(function(){
                $('#birthday').val($("#birthday_y").val() + '/' + $("#birthday_m").val() + '/' + $("#birthday_d").val());
            });
        });
        <?php
        $js_array = json_encode($stations);
        echo "var stations = ". $js_array . ";";
        ?>
        var station_names =[];
        stations.map(function (station) {
            station_names.push(station.station_name+'駅');
        });
        function startSuggest() {
            new Suggest.Local(
                "station",    // 入力のエレメントID
                "suggest", // 補完候補を表示するエリアのID
                station_names,      // 補完候補の検索対象となる配列
                {dispMax: 10, interval: 1000}); // オプション
        }

        window.addEventListener ?
            window.addEventListener('load', startSuggest, false) :
            window.attachEvent('onload', startSuggest);
    });
</script>
<?php
echo $this->element('Front/footer') ?>
</body>
