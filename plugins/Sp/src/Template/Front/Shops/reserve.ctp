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
    echo $this->Html->script('sp/reserve');
    echo $this->Html->css(['reset', 'all.min', 'Chart.min', 'common', 'datsumou/common', 'datsumou/reserve/index', 'datsumou/reserve/common']);
    echo $this->Html->css('datsumou');
    echo $this->Html->css('sp/reserve');
    ?>
    <?php
    echo $this->Html->script(
        [
            '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js',
            '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js',
            '/js/front/jquery-ui-timepicker-addon.min.js',
            '/js/front/jquery-ui-timepicker-ja.js',
        ],
        ['type' => 'text/javascript', 'defer' => true]
    ); ?>

    <?= $this->Html->css('front/jquery-ui-timepicker-addon.min.css') ?>
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
        <div class="reserve-question reserve-question-mod">
            <div class="reserve-question-text reserve-subquestion-text color-main">店舗名</div>
            <div class="reserve-tag reserve-tag-required">必須</div>
        </div>
        <div class="reserve-input">
            <?php
            echo $this->ExForm->text(
                'shop_name',
                [
                    'id' => 'shop_name',
                    'readonly' => 'readonly',
                    'value'       => $shop['name'],
                    'placeholder' => '例）サンプル店舗東京',
                    'required'    => true
                ]
            );
            ?>
        </div>
    </section>
    <section class="content-base reserve-section">
        <div class="reserve-subquestion">
            <div>
                <div class="reserve-subquestion-first main_text">
                    <div class="reserve-subquestion-text color-main" id="calendar-title">第<span id="calendar-title-number">1</span>希望日を選択してください</div>
                    <div class="reserve-tag reserve-tag-required">必須</div>
                </div>
                <p style="font-size: 10px;padding-left: 10px;margin: -8px 0 16px;color: #ef00e5;opacity: 0.8;">※希望日時をタップしてください</p>
                <div class="calendar-weeks" style="margin: 0px 10px 16px;">
                    <a id="pre7days" class="calendar-week disable" href="#" onclick="pre7days();return false;">
                        <i class="fas fa-chevron-left reserve-input-arrow fas-left"></i>
                        前の１週間
                    </a>
                    <a id="next7days" class="calendar-week" href="#" onclick="next7days();return false;">
                        次の１週間
                        <i class="fas fa-chevron-right reserve-input-arrow fas-right"></i>
                    </a>
                </div>
            </div>
            <script src="./reserve.js" type="text/javascript"></script>
            <div style="height: 345px;overflow: scroll;margin: -10px 0 24px;">
                <table id="reserve_table" data-date-options="8" data-time-start="9" data-time-end="21" data-probability="25" data-visit-options="3" data-week-options-en="sunday,monday,tuesday,wednesday,thursday,friday,saturday" data-week-options-jp="日,月,火,水,木,金,土">
                    <thead>
                        <tr>
                            <!-- 
                            ここは複雑のため、解説を書いておきます。
                            日時ですが、基本的に24:00時を起点として、2日後の日付を取得して、その順に表示します。
                            例）12日現在だとしたら、14日から表示です。
                        -->
                            <th rowspan="2">
                                日時
                            </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/26" class="calendar-date thursday_en">
                                03/26<br><span>（木）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/27" class="calendar-date friday_en">
                                03/27<br><span>（金）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/28" class="calendar-date saturday_en">
                                03/28<br><span>（土）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/29" class="calendar-date sunday_en">
                                03/29<br><span>（日）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/30" class="calendar-date monday_en">
                                03/30<br><span>（月）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/03/31" class="calendar-date tuesday_en">
                                03/31<br><span>（火）</span> </th>
                            <!-- DBから取得 -->
                            <th scope="col" id="2020/04/01" class="calendar-date wednesday_en">
                                04/01<br><span>（水）</span> </th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" id="time_9">
                                9:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_10">
                                10:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_11">
                                11:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_12">
                                12:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_13">
                                13:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_14">
                                14:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_15">
                                15:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_16">
                                16:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_17">
                                17:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_18">
                                18:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_19">
                                19:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_20">
                                20:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                        <tr>
                            <th scope="row" id="time_21">
                                21:00 </th>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                            <td class="calendar-cell" onclick="calendarCellTapped(this)"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div>
                    <div class="reserve-subquestion-first want_day" style="padding:0;">
                        <div style="width:100%;padding: 0 10px;">
                            <div class="reserve-subquestion-text color-main">来店希望日時</div>
                            <ul class="calendar-date-time-wrap">
                                <li class="calendar-date-time">
                                    <p>第1希望　<span id="calendar-date-1"></span></p>
                                    <p><span id="calendar-time-1"></span></p>
                                </li>
                                <li class="calendar-date-time">
                                    <p>第2希望　<span id="calendar-date-2"></span></p>
                                    <p><span id="calendar-time-2"></span></p>
                                </li>
                                <li class="calendar-date-time">
                                    <p>第3希望　<span id="calendar-date-3"></span></p>
                                    <p><span id="calendar-time-3"></span></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="calendar-input-area">
                    <input type="text" name="visit_date_1" id="visit_date_1" class="datepicker visit_dates hasDatepicker" required="required" autocomplete="off">
                    <input type="hidden" name="time_01" id="time_01" class="input-time">
                    <input type="text" name="visit_date_2" id="visit_date_2" class="datepicker visit_dates hasDatepicker" required="required" autocomplete="off">
                    <input type="hidden" name="time_02" id="time_02" class="input-time">
                    <input type="text" name="visit_date_3" id="visit_date_3" class="datepicker visit_dates hasDatepicker" required="required" autocomplete="off">
                    <input type="hidden" name="time_03" id="time_03" class="input-time">
                </div>
            </div>
    </section>
    <section class="content-base reserve-section">
        <div class="reserve-question">
            <div class="reserve-question-text color-main">ご予約者情報</div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-input">
                <div class="reserve-input-parent">
                    <div class="reserve-input-child">
                        <label class="reserve-subquestion-text color-sub">姓<div class="reserve-tag reserve-tag-required">必須
                            </div></label>
                        <input type="text" id="last_name" name="last_name" placeholder="山田" required="">
                    </div>
                    <div class="reserve-input-child">
                        <label class="reserve-subquestion-text color-sub">名<div class="reserve-tag reserve-tag-required">必須
                            </div></label>
                        <input type="text" id="first_name" name="first_name" placeholder="花子" required="">
                    </div>
                </div>
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-input">
                <div class="reserve-input-parent pt-10">
                    <div class="reserve-input-child">
                        <label class="reserve-subquestion-text color-sub">せい<div class="reserve-tag reserve-tag-required">必須
                            </div></label>
                        <input type="text" id="last_kana" name="last_kana" placeholder="やまだ" required="">
                    </div>
                    <div class="reserve-input-child">
                        <label class="reserve-subquestion-text color-sub">めい<div class="reserve-tag reserve-tag-required">必須
                            </div></label>
                        <input type="text" id="first_kana" name="first_kana" placeholder="はなこ" required="">
                    </div>
                </div>
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-first">
                <div class="reserve-subquestion-text color-sub">性別</div>
                <div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div style="padding-top: 0;" class="reserve-input">
                <div class="reserve-input-radio-wrap">
                    <label class="reserve-input-radio">
                        <input type="radio" checked="" name="sex" value="2" required="" id="woman">
                        <div class="reserve-input-inner"><span>女性</span></div>
                    </label>
                    <label class="reserve-input-radio">
                        <input type="radio" name="sex" value="1" required="" id="man">
                        <div class="reserve-input-inner"><span>男性</span></div>
                    </label>
                </div>
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-text-top reserve-subquestion-text pt-15 color-sub">生年月日<div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <div class="reserve-input-born">
                    <div class="reserve-input-born-common reserve-input-year">
                        <div class="reserve-input-inner">
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
                        </div><span>年</span>
                    </div>
                    <div class="reserve-input-born-common reserve-input-month">
                        <div class="reserve-input-inner">
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
                        </div><span>月</span>
                    </div>
                    <div class="reserve-input-born-common reserve-input-day">
                        <div class="reserve-input-inner">
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
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-text-top reserve-subquestion-text pt-15 color-sub">連絡先電話番号<div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <input type="text" id="tel" name="tel" placeholder="03-1234-5678" required="">
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-text-top reserve-subquestion-text pt-20 color-sub">メールアドレス<div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <input type="text" id="mail" name="mail" placeholder="info@tsuru-tsuru.co.jp" required="">
            </div>
            <div class="reserve-email-desc">
                ※docomo.ne.jp、softbank.jp、ezweb.ne.jpなどの携帯メールアドレスでは、パソコンからのメールを受信拒否する初期設定をされている場合がございます。tsuru-tsuru.co.jpからの受信許可の設定をお願いいたします。
            </div>
        </div>
        <div class="reserve-question">
            <div class="reserve-question-text color-main">その他お客様情報</div>
            <div class="reserve-tag reserve-tag-option">任意</div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-step reserve-step-other">
                <div class="reserve-step-1st">
                    <div class="reserve-subquestion">
                        <div class="reserve-subquestion-first" style="padding-top: 5px;">
                            <div class="reserve-subquestion-first-step">STEP1</div>
                            <div class="reserve-subquestion-text reserve-subquestion-first-text color-sub">利用人数</div>
                        </div>
                        <div class="reserve-input" style="padding-top: 0;">
                            <div class="reserve-input-radio-wrap">
                                <label class="reserve-input-radio">
                                    <input type="radio" name="customer_count" value="1名">
                                    <div class="reserve-input-inner"><span>1名</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                                <label class="reserve-input-radio">
                                    <input type="radio" name="customer_count" value="2名">
                                    <div class="reserve-input-inner"><span>2名</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                            </div>
                            <div class="reserve-input-radio-wrap">
                                <label class="reserve-input-radio">
                                    <input type="radio" name="customer_count" value="3名以上">
                                    <div class="reserve-input-inner"><span>3名以上</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
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
                        <div class="reserve-subquestion-text-top reserve-subquestion-text color-sub">当日の施術を希望されますか？</div>
                        <div class="reserve-input">
                            <div class="reserve-input-radio-wrap">
                                <label class="reserve-input-radio">
                                    <input type="radio" name="is_same_date" value="はい">
                                    <div class="reserve-input-inner"><span>はい</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                                <label class="reserve-input-radio">
                                    <input type="radio" name="toujitsu" value="いいえ">
                                    <div class="reserve-input-inner"><span>いいえ</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
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
                        <div class="reserve-subquestion-text-top reserve-subquestion-text color-sub">脱毛経験はございますか？</div>
                        <div class="reserve-input">
                            <div class="reserve-input-radio-wrap">
                                <label class="reserve-input-radio">
                                    <input type="radio" name="is_experienced" value="はい">
                                    <div class="reserve-input-inner"><span>はい</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                                <label class="reserve-input-radio">
                                    <input type="radio" name="is_experienced" value="いいえ">
                                    <div class="reserve-input-inner"><span>いいえ</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
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
                        <div class="reserve-subquestion-text-top reserve-subquestion-text color-sub">キャンペーンの通知を希望しますか？</div>
                        <div class="reserve-input">
                            <div class="reserve-input-radio-wrap">
                                <label class="reserve-input-radio">
                                    <input type="radio" name="is_campaign" value="はい">
                                    <div class="reserve-input-inner"><span>はい</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                                <label class="reserve-input-radio">
                                    <input type="radio" name="is_campaign" value="いいえ">
                                    <div class="reserve-input-inner"><span>いいえ</span><i class="fas fa-chevron-right reserve-input-arrow"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-text-top reserve-subquestion-text color-sub" style="margin-top: 15px;">住所</div>
            <div class="reserve-input">
                <input type="text" name="address" placeholder="例）東京都新宿区新宿">
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-subquestion-text-top reserve-subquestion-text pt-15 color-sub">質問など</div>
            <div class="reserve-input">
                <textarea cols="30" rows="10" name="question" placeholder="ご質問があれば入力してください。"></textarea>
            </div>
        </div>
        <div class="reserve-confirm-content">
            <div class="reserve-confirm-content-policy-area">
                <p class="reserve-confirm-content-policy" style="text-align: center;"><span>ご予約の際には、</span><a href="/regulation">利用規約</a><span>をご確認ください。</span></p>
            </div>
        </div>
    </section>
    <section class="content-base reserve-section">
        <div class="reserve-button-area">
            <button class="reserve-button" type="submit">規約に同意し、上記内容で予約を確定する</button>
        </div>
    </section>
    <?= $this->ExForm->end() ?>
    <?php
    echo $this->element('Front/search_breadcrumbs');
    echo $this->element('Front/footer'); ?>
    <script>
        $(function() {
            //ボタン１のイベント処理
            $('.reserve-step-1st .reserve-input-inner').click(function(e) {
                $('.reserve-step-other').addClass('step-2nd');
            });
            $('.reserve-step-2nd .reserve-input-inner').click(function(e) {
                $('.reserve-step-other').addClass('step-3rd')
            });
            $('.reserve-step-3rd .reserve-input-inner').click(function(e) {
                $('.reserve-step-other').addClass('step-4th')
            });
            //ボタン１のイベント処理
            $('.reserve-step-1st .reserve-btn-second').click(function(e) {
                if ($("#visit_date_1").val() == '') {
                    alert("第1希望日の日付をまず入力してください");
                } else if ($("#time_01").val() == '') {
                    alert("第1希望日の時間を入力してください");
                } else {
                    $('.reserve-step-date').addClass('step-2nd');
                }
            });
            $('.reserve-step-2nd .reserve-btn-second').click(function(e) {
                $('.reserve-step-date').removeClass('step-2nd');
            });
            $('.reserve-step-2nd .reserve-btn-third').click(function(e) {
                $('.reserve-step-date').addClass('step-3rd');
            });
            $('.reserve-step-3rd .reserve-btn-second').click(function(e) {
                $('.reserve-step-date').removeClass('step-3rd');
            });
            $(".reserve-scroll-select-item").each(function() {
                $(this).click(function() {
                    $(this).parents(".reserve-scroll-select").find(".reserve-scroll-select-item").each(function() {
                        $(this).removeClass("active");
                    });
                    var time = $(this).data('time');
                    $(this).parents(".reserve-scroll-select").find(".input-time").val(time);
                    $(this).addClass("active");
                });
            });
            $(".reserve-button").click(function() {
                var visit_date_1 = $('#visit_date_1'),
                    shop_name = $('#shop_name'),
                    last_name = $('#last_name'),
                    first_name = $('#first_name'),
                    last_kana = $('#last_kana'),
                    first_kana = $('#first_kana'),

                    birthday_y = $('#birthday_y'),
                    birthday_m = $('#birthday_m'),
                    birthday_d = $('#birthday_d'),
                    tel = $('#tel'),
                    mail = $('#mail');
                var formData = [visit_date_1,
                    shop_name,
                    last_name,
                    first_name,
                    last_kana,
                    first_kana,
                    birthday_y,
                    birthday_m,
                    birthday_d,
                    tel,
                    mail,
                ];
                var isOk = true;
                var errorId = '';
                formData.map(function(form) {
                    if (form.val() == '') {
                        form.addClass("errorColor");
                        if (errorId == '') {
                            errorId = form.attr("id");
                        }
                        isOk = false;
                    } else {
                        form.removeClass("errorColor");
                    }
                });
                if (!isOk) {
                    $("html,body").animate({
                        scrollTop: $('#' + errorId).offset().top - $(".datsumou-header-inner").height() - 20
                    });
                }
                return isOk;
            });

            $(document).ready(function() {
                $(function() {
                    // $.datetimepicker.setLocale('ja');
                    $('input.datetimepicker').datetimepicker({
                        step: 30
                    }).keydown(function(e) {}).dblclick(function() {
                        // ダブルクリックで現在時刻セット
                        var hiduke = new Date();

                        //年・月・日・曜日を取得する
                        var date = hiduke.getFullYear() + '-' + all._addZero((hiduke.getMonth() + 1), 2) + '-' + all._addZero(hiduke.getDate(), 2);
                        date += ' ' + all._addZero(hiduke.getHours(), 2) + ':' + all._addZero(hiduke.getMinutes(), 2);
                        $(this).val(date);
                    });
                });

                var all = {
                    _addZero: function(num, len) {
                        num += "";
                        if (num.length < len) {
                            for (var i = num.length; i < len; i++) {
                                num = "0" + num;
                            }
                        }
                        return num;
                    }
                }
            });

        })
    </script>
</body>

</html>