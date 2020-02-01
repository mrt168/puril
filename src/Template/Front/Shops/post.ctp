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
    echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/brand/common',  'datsumou/kuchikomi-entry']);
    ?>
    <header class="brand-header">
      <div class="brand-header-inner"><a class="brand-header-back" href="/datsumou/"><i class="fas fa-chevron-left"></i></a>
        <div class="brand-header-title">キレイモ</div>
        <div class="brand-header-void"></div>
      </div>
    </header>
    <h1 class="content kuchikomi-entry-title">キレイモ 新宿本店</h1>
    <form action="#">
      <div class="content middle-content rating-area">
        <div class="rating-star"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png"><img class="rating-star-icon" src="/puril/images/img/datsumou/star-off-large.png">
        </div>
        <div class="rating-number"><span id="rating-number-span"></span></div>
      </div>
      <div class="content question-title">合計9つのご質問にお答えください</div>
      <div class="content-base question-area">
        <table>
          <tbody>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">1</div>
                  <div class="question-text">受けた施術等の名前を教えてください。</div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <input type="text" placeholder="（回答例）全身脱毛">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">2</div>
                  <div class="question-text">あなたの性別と、生年月日を教えてください。</div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="gender">
                      <option value="">性別</option>
                      <option value="woman">女性</option>
                      <option value="man">男性</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="age">
                      <option value="">生年月日</option>
                      <option value="2010">2010</option>
                      <option value="2009">2009</option>
                      <option value="2008">2008</option>
                      <option value="2007">2007</option>
                      <option value="2006">2006</option>
                      <option value="2005">2005</option>
                      <option value="2004">2004</option>
                      <option value="2003">2003</option>
                      <option value="2002">2002</option>
                      <option value="2001">2001</option>
                      <option value="2000">2000</option>
                      <option value="1999">1999</option>
                      <option value="1998">1998</option>
                      <option value="1997">1997</option>
                      <option value="1996">1996</option>
                      <option value="1995">1995</option>
                      <option value="1994">1994</option>
                      <option value="1993">1993</option>
                      <option value="1992">1992</option>
                      <option value="1991">1991</option>
                      <option value="1990">1990</option>
                      <option value="1989">1989</option>
                      <option value="1988">1988</option>
                      <option value="1987">1987</option>
                      <option value="1986">1986</option>
                      <option value="1985">1985</option>
                      <option value="1984">1984</option>
                      <option value="1983">1983</option>
                      <option value="1982">1982</option>
                      <option value="1981">1981</option>
                      <option value="1980">1980</option>
                      <option value="1979">1979</option>
                      <option value="1978">1978</option>
                      <option value="1977">1977</option>
                      <option value="1976">1976</option>
                      <option value="1975">1975</option>
                      <option value="1974">1974</option>
                      <option value="1973">1973</option>
                      <option value="1972">1972</option>
                      <option value="1971">1971</option>
                      <option value="1970">1970</option>
                      <option value="1969">1969</option>
                      <option value="1968">1968</option>
                      <option value="1967">1967</option>
                      <option value="1966">1966</option>
                      <option value="1965">1965</option>
                      <option value="1964">1964</option>
                      <option value="1963">1963</option>
                      <option value="1962">1962</option>
                      <option value="1961">1961</option>
                      <option value="1960">1960</option>
                      <option value="1959">1959</option>
                      <option value="1958">1958</option>
                      <option value="1957">1957</option>
                      <option value="1956">1956</option>
                      <option value="1955">1955</option>
                      <option value="1954">1954</option>
                      <option value="1953">1953</option>
                      <option value="1952">1952</option>
                      <option value="1951">1951</option>
                      <option value="1950">1950</option>
                    </select>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">3</div>
                  <div class="question-text">あなたが現在居住している都道府県や、最寄り駅を教えてください。</div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="prefecture">
                      <option value="">居住している都道府県</option>
                      <option value="1">北海道</option>
                      <option value="2">青森県</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="station">
                      <option value="">最寄駅</option>
                      <option value="1">〇〇駅</option>
                      <option value="2">◇◇駅</option>
                    </select>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">4</div>
                  <div class="question-text">この店舗の総合的な感想を、20文字程度で感想を教えてください。</div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment" cols="30" rows="10" placeholder="（回答例）駅近で好立地で、仕事帰りに通いやすいのがとても良いです。スタッフの皆さんも親切で、施術に関する不安もありませんでした！"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">5</div>
                  <div class="question-text">この店舗を選んだ理由を教えてください。</div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="reason" cols="30" rows="10" placeholder="（回答例）HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">6</div>
                  <div class="question-text">
                    <p>店舗の「接客／サービス」はいかがでしたか？</p>
                    <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                  </div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="rating-1" id="rating1">
                      <option value="">評価点</option>
                      <option value="5">5</option>
                      <option value="4.9">4.9</option>
                      <option value="4.8">4.8</option>
                      <option value="4.7">4.7</option>
                      <option value="4.6">4.6</option>
                      <option value="4.5">4.5</option>
                      <option value="4.4">4.4</option>
                      <option value="4.3">4.3</option>
                      <option value="4.2">4.2</option>
                      <option value="4.1">4.1</option>
                      <option value="4">4</option>
                      <option value="3.9">3.9</option>
                      <option value="3.8">3.8</option>
                      <option value="3.7">3.7</option>
                      <option value="3.6">3.6</option>
                      <option value="3.5">3.5</option>
                      <option value="3.4">3.4</option>
                      <option value="3.3">3.3</option>
                      <option value="3.2">3.2</option>
                      <option value="3.1">3.1</option>
                      <option value="3">3</option>
                      <option value="2.9">2.9</option>
                      <option value="2.8">2.8</option>
                      <option value="2.7">2.7</option>
                      <option value="2.6">2.6</option>
                      <option value="2.5">2.5</option>
                      <option value="2.4">2.4</option>
                      <option value="2.3">2.3</option>
                      <option value="2.2">2.2</option>
                      <option value="2.1">2.1</option>
                      <option value="2">2</option>
                      <option value="1.9">1.9</option>
                      <option value="1.8">1.8</option>
                      <option value="1.7">1.7</option>
                      <option value="1.6">1.6</option>
                      <option value="1.5">1.5</option>
                      <option value="1.4">1.4</option>
                      <option value="1.3">1.3</option>
                      <option value="1.2">1.2</option>
                      <option value="1.1">1.1</option>
                      <option value="1">1</option>
                      <option value="0.9">0.9</option>
                      <option value="0.8">0.8</option>
                      <option value="0.7">0.7</option>
                      <option value="0.6">0.6</option>
                      <option value="0.5">0.5</option>
                      <option value="0.4">0.4</option>
                      <option value="0.3">0.3</option>
                      <option value="0.2">0.2</option>
                      <option value="0.1">0.1</option>
                      <option value="0">0</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment-1" cols="30" rows="10" placeholder="スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">7</div>
                  <div class="question-text">
                    <p>受けたサービスの「メニューや料金」についてはいかがでしたか？</p>
                    <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                  </div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="rating-2" id="rating2">
                      <option value="">評価点</option>
                      <option value="5">5</option>
                      <option value="4.9">4.9</option>
                      <option value="4.8">4.8</option>
                      <option value="4.7">4.7</option>
                      <option value="4.6">4.6</option>
                      <option value="4.5">4.5</option>
                      <option value="4.4">4.4</option>
                      <option value="4.3">4.3</option>
                      <option value="4.2">4.2</option>
                      <option value="4.1">4.1</option>
                      <option value="4">4</option>
                      <option value="3.9">3.9</option>
                      <option value="3.8">3.8</option>
                      <option value="3.7">3.7</option>
                      <option value="3.6">3.6</option>
                      <option value="3.5">3.5</option>
                      <option value="3.4">3.4</option>
                      <option value="3.3">3.3</option>
                      <option value="3.2">3.2</option>
                      <option value="3.1">3.1</option>
                      <option value="3">3</option>
                      <option value="2.9">2.9</option>
                      <option value="2.8">2.8</option>
                      <option value="2.7">2.7</option>
                      <option value="2.6">2.6</option>
                      <option value="2.5">2.5</option>
                      <option value="2.4">2.4</option>
                      <option value="2.3">2.3</option>
                      <option value="2.2">2.2</option>
                      <option value="2.1">2.1</option>
                      <option value="2">2</option>
                      <option value="1.9">1.9</option>
                      <option value="1.8">1.8</option>
                      <option value="1.7">1.7</option>
                      <option value="1.6">1.6</option>
                      <option value="1.5">1.5</option>
                      <option value="1.4">1.4</option>
                      <option value="1.3">1.3</option>
                      <option value="1.2">1.2</option>
                      <option value="1.1">1.1</option>
                      <option value="1">1</option>
                      <option value="0.9">0.9</option>
                      <option value="0.8">0.8</option>
                      <option value="0.7">0.7</option>
                      <option value="0.6">0.6</option>
                      <option value="0.5">0.5</option>
                      <option value="0.4">0.4</option>
                      <option value="0.3">0.3</option>
                      <option value="0.2">0.2</option>
                      <option value="0.1">0.1</option>
                      <option value="0">0</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment-2" cols="30" rows="10" placeholder="料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">8</div>
                  <div class="question-text">
                    <p>施術の「効果（技術や仕上がり）」はいかがでしたか？</p>
                    <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                  </div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="rating-3" id="rating3">
                      <option value="">評価点</option>
                      <option value="5">5</option>
                      <option value="4.9">4.9</option>
                      <option value="4.8">4.8</option>
                      <option value="4.7">4.7</option>
                      <option value="4.6">4.6</option>
                      <option value="4.5">4.5</option>
                      <option value="4.4">4.4</option>
                      <option value="4.3">4.3</option>
                      <option value="4.2">4.2</option>
                      <option value="4.1">4.1</option>
                      <option value="4">4</option>
                      <option value="3.9">3.9</option>
                      <option value="3.8">3.8</option>
                      <option value="3.7">3.7</option>
                      <option value="3.6">3.6</option>
                      <option value="3.5">3.5</option>
                      <option value="3.4">3.4</option>
                      <option value="3.3">3.3</option>
                      <option value="3.2">3.2</option>
                      <option value="3.1">3.1</option>
                      <option value="3">3</option>
                      <option value="2.9">2.9</option>
                      <option value="2.8">2.8</option>
                      <option value="2.7">2.7</option>
                      <option value="2.6">2.6</option>
                      <option value="2.5">2.5</option>
                      <option value="2.4">2.4</option>
                      <option value="2.3">2.3</option>
                      <option value="2.2">2.2</option>
                      <option value="2.1">2.1</option>
                      <option value="2">2</option>
                      <option value="1.9">1.9</option>
                      <option value="1.8">1.8</option>
                      <option value="1.7">1.7</option>
                      <option value="1.6">1.6</option>
                      <option value="1.5">1.5</option>
                      <option value="1.4">1.4</option>
                      <option value="1.3">1.3</option>
                      <option value="1.2">1.2</option>
                      <option value="1.1">1.1</option>
                      <option value="1">1</option>
                      <option value="0.9">0.9</option>
                      <option value="0.8">0.8</option>
                      <option value="0.7">0.7</option>
                      <option value="0.6">0.6</option>
                      <option value="0.5">0.5</option>
                      <option value="0.4">0.4</option>
                      <option value="0.3">0.3</option>
                      <option value="0.2">0.2</option>
                      <option value="0.1">0.1</option>
                      <option value="0">0</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment-3" cols="30" rows="10" placeholder="念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">9</div>
                  <div class="question-text">
                    <p>店舗の「雰囲気」はいかがでしたか？</p>
                    <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                  </div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="rating-4" id="rating4">
                      <option value="">評価点</option>
                      <option value="5">5</option>
                      <option value="4.9">4.9</option>
                      <option value="4.8">4.8</option>
                      <option value="4.7">4.7</option>
                      <option value="4.6">4.6</option>
                      <option value="4.5">4.5</option>
                      <option value="4.4">4.4</option>
                      <option value="4.3">4.3</option>
                      <option value="4.2">4.2</option>
                      <option value="4.1">4.1</option>
                      <option value="4">4</option>
                      <option value="3.9">3.9</option>
                      <option value="3.8">3.8</option>
                      <option value="3.7">3.7</option>
                      <option value="3.6">3.6</option>
                      <option value="3.5">3.5</option>
                      <option value="3.4">3.4</option>
                      <option value="3.3">3.3</option>
                      <option value="3.2">3.2</option>
                      <option value="3.1">3.1</option>
                      <option value="3">3</option>
                      <option value="2.9">2.9</option>
                      <option value="2.8">2.8</option>
                      <option value="2.7">2.7</option>
                      <option value="2.6">2.6</option>
                      <option value="2.5">2.5</option>
                      <option value="2.4">2.4</option>
                      <option value="2.3">2.3</option>
                      <option value="2.2">2.2</option>
                      <option value="2.1">2.1</option>
                      <option value="2">2</option>
                      <option value="1.9">1.9</option>
                      <option value="1.8">1.8</option>
                      <option value="1.7">1.7</option>
                      <option value="1.6">1.6</option>
                      <option value="1.5">1.5</option>
                      <option value="1.4">1.4</option>
                      <option value="1.3">1.3</option>
                      <option value="1.2">1.2</option>
                      <option value="1.1">1.1</option>
                      <option value="1">1</option>
                      <option value="0.9">0.9</option>
                      <option value="0.8">0.8</option>
                      <option value="0.7">0.7</option>
                      <option value="0.6">0.6</option>
                      <option value="0.5">0.5</option>
                      <option value="0.4">0.4</option>
                      <option value="0.3">0.3</option>
                      <option value="0.2">0.2</option>
                      <option value="0.1">0.1</option>
                      <option value="0">0</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment-4" cols="30" rows="10" placeholder="雑居ビル内にあるので、少し入るときに抵抗がありました。しかし、店内に入るとすごくキレイで清潔感があって、よかったです！女性用のアメニティもそろっていたので、その辺の気遣いも感じられました♪"></textarea>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <th>
                <div class="th-inner">
                  <div class="question-number">10</div>
                  <div class="question-text">
                    <p>店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</p>
                    <p>「5点満点の数字＆100文字以上の感想」をお願いします！</p>
                  </div>
                </div>
              </th>
              <td>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <select name="rating-5" id="rating5">
                      <option value="">評価点</option>
                      <option value="5">5</option>
                      <option value="4.9">4.9</option>
                      <option value="4.8">4.8</option>
                      <option value="4.7">4.7</option>
                      <option value="4.6">4.6</option>
                      <option value="4.5">4.5</option>
                      <option value="4.4">4.4</option>
                      <option value="4.3">4.3</option>
                      <option value="4.2">4.2</option>
                      <option value="4.1">4.1</option>
                      <option value="4">4</option>
                      <option value="3.9">3.9</option>
                      <option value="3.8">3.8</option>
                      <option value="3.7">3.7</option>
                      <option value="3.6">3.6</option>
                      <option value="3.5">3.5</option>
                      <option value="3.4">3.4</option>
                      <option value="3.3">3.3</option>
                      <option value="3.2">3.2</option>
                      <option value="3.1">3.1</option>
                      <option value="3">3</option>
                      <option value="2.9">2.9</option>
                      <option value="2.8">2.8</option>
                      <option value="2.7">2.7</option>
                      <option value="2.6">2.6</option>
                      <option value="2.5">2.5</option>
                      <option value="2.4">2.4</option>
                      <option value="2.3">2.3</option>
                      <option value="2.2">2.2</option>
                      <option value="2.1">2.1</option>
                      <option value="2">2</option>
                      <option value="1.9">1.9</option>
                      <option value="1.8">1.8</option>
                      <option value="1.7">1.7</option>
                      <option value="1.6">1.6</option>
                      <option value="1.5">1.5</option>
                      <option value="1.4">1.4</option>
                      <option value="1.3">1.3</option>
                      <option value="1.2">1.2</option>
                      <option value="1.1">1.1</option>
                      <option value="1">1</option>
                      <option value="0.9">0.9</option>
                      <option value="0.8">0.8</option>
                      <option value="0.7">0.7</option>
                      <option value="0.6">0.6</option>
                      <option value="0.5">0.5</option>
                      <option value="0.4">0.4</option>
                      <option value="0.3">0.3</option>
                      <option value="0.2">0.2</option>
                      <option value="0.1">0.1</option>
                      <option value="0">0</option>
                    </select>
                  </div>
                </div>
                <div class="td-inner-wrap">
                  <div class="td-inner">
                    <textarea name="comment-5" cols="30" rows="10" placeholder="施術時に次回の予約案内があるため、スムーズに通えています。ただし、直前の変更がなかなか難しいこと、直前にキャンセルした場合にはなかなか予約が空いていない点は、少し注意が必要です。"></textarea>
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
        <p>次は写真を投稿してください☆</p>
      </div>
      <div class="content middle-content image-upload">
        <ul class="image-upload-area">
          <li class="image-upload-item" id="image-preview1">
            <label class="input-image"><img src="/puril/images/img/datsumou/camera.png">
              <input type="file" accept="image/*" name="image1" id="image-add1">
            </label>
          </li>
          <li class="image-upload-item" id="image-preview2">
            <label class="input-image"><img src="/puril/images/img/datsumou/camera.png">
              <input type="file" accept="image/*" name="image2" id="image-add2">
            </label>
          </li>
          <li class="image-upload-item" id="image-preview3">
            <label class="input-image"><img src="/puril/images/img/datsumou/camera.png">
              <input type="file" accept="image/*" name="image3" id="image-add3">
            </label>
          </li>
          <li class="image-upload-item" id="image-preview4">
            <label class="input-image"><img src="/puril/images/img/datsumou/camera.png">
              <input type="file" accept="image/*" name="image4" id="image-add4">
            </label>
          </li>
          <li class="image-upload-item" id="image-preview5">
            <label class="input-image"><img src="/puril/images/img/datsumou/camera.png">
              <input type="file" accept="image/*" name="image5" id="image-add5">
            </label>
          </li>
        </ul>
      </div>
      <div class="content question-thanks">
        <p>お疲れ様でした！</p>
      </div>
      <div class="content question-thanks">
        <p>内容に問題がなければ、下の「口コミを投稿する」ボタンを押してください。</p>
      </div>
      <div class="content kuchikomi-entry-post">
        <button class="button-base kuchikomi-entry-button" type="submit"><i class="fas fa-comments kuchikomi-entry-button-icon"></i>
          <div class="kuchikomi-entry-button-text">口コミを投稿する</div>
        </button>
      </div>
    </form>
    <nav class="content-base breadcrumbs"><i class="fas fa-home home-icon"></i>
      <ul class="breadcrumbs-list">
        <li><a href="#">ホーム</a></li>
        <li><a href="#">脱毛</a></li>
        <li><a href="#">全国脱</a></li>
        <li><a href="#">全国脱毛サ</a></li>
        <li><a href="#">東京脱</a></li>
        <li><a href="#">キレイモ新宿</a></li>
      </ul>
    </nav>
    <script type="text/javascript" src="/js/datsumou/kuchikomi-entry.js"></script>
  </body>