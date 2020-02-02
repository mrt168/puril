<?php

use App\Vendor\FormUtil;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>
<body>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common','datsumou/reserve/index','datsumou/reserve/common']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
<h1 class="reserve-title">ネット予約</h1>
<?= $this->ExForm->create('Contact', [
    'url'  => [
        'controller' => 'Contacts',
        'action'     => 'reserve'
    ],
    'type' => 'post',
    'class' => 'reserve-form',
    'id'   => 'reserve_exform'
]) ?>
<section class="content-base reserve-section">
    <div class="reserve-question">
        <div class="reserve-question-text">第一希望日を選択してください</div>
        <div class="reserve-tag reserve-tag-required">必須</div>
    </div>
    <div class="reserve-input">
        <div class="reserve-input-inner">
            <?= $this->ExForm->text('visit_date_1', ['class' => 'datepicker', 'placeholder' => '第１希望 例）2020/01/01', 'id' => 'datetimepicker','required' => true]); ?>
        </div>
    </div>
</section>
<section class="content-base reserve-section">
    <div class="reserve-question">
        <div class="reserve-question-text">時間をを選択してください</div>
        <div class="reserve-tag reserve-tag-required">必須</div>
    </div>
    <div class="reserve-question-sub">【営業時間　12:00〜21:00】</div>
    <div class="reserve-scroll-select">
        <input type="hidden" name="time" class="input-time">
        <ul>
            <li><a class="reserve-scroll-select-item" href="#" data-time="12:00">12:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="13:00">13:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="14:00">14:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="15:00">15:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="16:00">16:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="17:00">17:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="18:00">18:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="19:00">19:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="20:00">20:00</a></li>
            <li><a class="reserve-scroll-select-item" href="#" data-time="21:00">21:00</a></li>
        </ul>
    </div>
</section>
<section class="content-base reserve-section">
    <div class="reserve-question reserve-question-mod">
        <div class="reserve-question-text">店舗名</div>
        <div class="reserve-tag reserve-tag-required">必須</div>
    </div>
    <div class="reserve-input">
        <?php
        echo $this->ExForm->text(
            'shop_name', [
                'value'       => $shop['name'],
                'placeholder' => '例）サンプル店舗東京',
                'required'    => true
            ]
        );
        ?>
    </div>
</section>
<section class="content-base reserve-section">
    <div class="reserve-question reserve-question-mod">
        <div class="reserve-question-text">来店希望日時</div>
        <div class="reserve-tag reserve-tag-option">任意</div>
    </div>
    <div class="reserve-input">
        <div class="reserve-input-inner">
            <?= $this->ExForm->text('visit_date_2', ['class' => 'datepicker reserve-input-datetime', 'placeholder' => '第二希望 例）2018/12/06', 'id' => 'datetimepicker1']); ?>
        </div>
        <div class="reserve-input-inner">
            <?= $this->ExForm->text('visit_date_3', ['class' => 'datepicker reserve-input-datetime', 'placeholder' => '第三希望 例）2018/12/06', 'id' => 'datetimepicker2']); ?>
        </div>
        <div class="reserve-input-inner">
            <?= $this->ExForm->text('visit_date_4', ['class' => 'datepicker reserve-input-datetime', 'placeholder' => '第四希望 例）2018/12/06', 'id' => 'datetimepicker3']); ?>
        </div>
    </div>
</section>
<section class="content-base reserve-section">
    <div class="reserve-question">
        <div class="reserve-question-text">ご予約者情報</div>
        <div class="reserve-tag reserve-tag-required">必須</div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-first">
            <div class="reserve-subquestion-first-step">STEP1</div>
            <div class="reserve-subquestion-text reserve-subquestion-first-text">性別</div>
        </div>
        <div class="reserve-input">
            <div class="reserve-input-radio-wrap">
                <label class="reserve-input-radio">
                    <input type="radio" name="gender" value="1" required>
                    <div class="reserve-input-inner"><span>男</span><i class="fas fa-chevron-right reserve-input-arrow"></i></div>
                </label>
                <label class="reserve-input-radio">
                    <input type="radio" name="gender" value="2" required>
                    <div class="reserve-input-inner"><span>女</span><i class="fas fa-chevron-right reserve-input-arrow"></i></div>
                </label>
            </div>
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-input">
            <div class="reserve-input-parent">
                <div class="reserve-input-child">
                    <label class="reserve-subquestion-text">姓</label>
                    <input type="text" name="sei" placeholder="山田" required>
                </div>
                <div class="reserve-input-child">
                    <label class="reserve-subquestion-text">名</label>
                    <input type="text" name="mei" placeholder="花子" required>
                </div>
            </div>
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-input">
            <div class="reserve-input-parent">
                <div class="reserve-input-child">
                    <label class="reserve-subquestion-text">せい</label>
                    <input type="text" name="seihira" placeholder="やまだ" required>
                </div>
                <div class="reserve-input-child">
                    <label class="reserve-subquestion-text">めい</label>
                    <input type="text" name="meihira" placeholder="はなこ" required>
                </div>
            </div>
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-text-top reserve-subquestion-text">生年月日</div>
        <div class="reserve-input">
            <div class="reserve-input-born">
                <div class="reserve-input-born-common reserve-input-year">
                    <div class="reserve-input-inner">
                        <select name="year" required>
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
                    </div><span>年</span>
                </div>
                <div class="reserve-input-born-common reserve-input-month">
                    <div class="reserve-input-inner">
                        <select name="month" required>
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
                    </div><span>月</span>
                </div>
                <div class="reserve-input-born-common reserve-input-day">
                    <div class="reserve-input-inner">
                        <select name="day" required>
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
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-text-top reserve-subquestion-text">連絡先電話番号</div>
        <div class="reserve-input">
            <input type="text" name="tel" placeholder="03-1234-5678" required>
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-text-top reserve-subquestion-text">メールアドレス</div>
        <div class="reserve-input">
            <input type="text" name="mail" placeholder="info@tsuru-tsuru.co.jp" required>
        </div>
        <div class="reserve-step">
          <div class="reserve-step-1st">
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-first">
                <div class="reserve-subquestion-first-step">STEP1</div>
                <div class="reserve-subquestion-text reserve-subquestion-first-text">利用人数</div>
              </div>
              <div class="reserve-input">
                <div class="reserve-input-radio-wrap">
                  <label class="reserve-input-radio">
                    <input type="radio" name="person" value="1">
                    <div class="reserve-input-inner"><span>1名</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                  <label class="reserve-input-radio">
                    <input type="radio" name="person" value="2">
                    <div class="reserve-input-inner"><span>2名</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                </div>
                <div class="reserve-input-radio-wrap">
                  <label class="reserve-input-radio">
                    <input type="radio" name="person" value="3">
                    <div class="reserve-input-inner"><span>3名以上</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                  <label class="reserve-input-radio reserve-input-radio-void"></label>
                </div>
              </div>
            </div>
          </div>
          <div class="reserve-step-2nd">
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-first">
                <div class="reserve-subquestion-first-step">STEP2</div>
              </div>
            </div>
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-text-top reserve-subquestion-text">当日の施術を希望されますか？</div>
              <div class="reserve-input">
                <div class="reserve-input-radio-wrap">
                  <label class="reserve-input-radio">
                    <input type="radio" name="toujitsu" value="y">
                    <div class="reserve-input-inner"><span>はい</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                  <label class="reserve-input-radio">
                    <input type="radio" name="toujitsu" value="n">
                    <div class="reserve-input-inner"><span>いいえ</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="reserve-step-3rd">
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-first">
                <div class="reserve-subquestion-first-step">STEP3</div>
              </div>
            </div>
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-text-top reserve-subquestion-text">脱毛経験はございますか？</div>
              <div class="reserve-input">
                <div class="reserve-input-radio-wrap">
                  <label class="reserve-input-radio">
                    <input type="radio" name="datsumou" value="y">
                    <div class="reserve-input-inner"><span>はい</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                  <label class="reserve-input-radio">
                    <input type="radio" name="datsumou" value="n">
                    <div class="reserve-input-inner"><span>いいえ</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="reserve-step-4th">
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-first">
                <div class="reserve-subquestion-first-step">STEP4</div>
              </div>
            </div>
            <div class="reserve-subquestion">
              <div class="reserve-subquestion-text-top reserve-subquestion-text">キャンペーンの通知を希望しますか？</div>
              <div class="reserve-input">
                <div class="reserve-input-radio-wrap">
                  <label class="reserve-input-radio">
                    <input type="radio" name="canpain" value="y">
                    <div class="reserve-input-inner"><span>はい</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                  <label class="reserve-input-radio">
                    <input type="radio" name="canpain" value="n">
                    <div class="reserve-input-inner"><span>いいえ</span><i
                        class="fas fa-chevron-right reserve-input-arrow"></i>
                    </div>
                  </label>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-text-top reserve-subquestion-text">住所</div>
        <div class="reserve-input">
            <input type="text" name="address" placeholder="サンプル住所">
        </div>
    </div>
    <div class="reserve-subquestion">
        <div class="reserve-subquestion-text-top reserve-subquestion-text">質問など</div>
        <div class="reserve-input">
            <textarea cols="30" rows="10" name="question" placeholder="ご質問があれば入力してください。"></textarea>
        </div>
    </div>
</section>
<section class="content-base reserve-section">
    <div class="reserve-button-area">
        <button class="reserve-button" type="submit">予約前の最終確認へ</button>
    </div>
</section>
<?= $this->ExForm->end() ?>
<?php
echo $this->element('Front/footer') ?>
<script>
    $(function () {
        //ボタン１のイベント処理
        $('.reserve-step-1st .reserve-input-inner').click(function(e) {
            $('.reserve-step').addClass('step-2nd')
        })
        $('.reserve-step-2nd .reserve-input-inner').click(function(e) {
            $('.reserve-step').addClass('step-3rd')
        })
        $('.reserve-step-3rd .reserve-input-inner').click(function(e) {
            $('.reserve-step').addClass('step-4th')
        })
        $(".reserve-scroll-select-item").each(function () {
            $(this).click(function () {
                $(".reserve-scroll-select-item").each(function () {
                   $(this).removeClass("active");
                });
                var time = $(this).data('time');
                $(".input-time").val(time);
                $(this).addClass("active");
            });
        });
    })
</script>
</body>
</html>