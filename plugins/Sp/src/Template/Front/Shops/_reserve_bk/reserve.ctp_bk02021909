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

<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>

<?php
echo $this->Html->script(
    [
        '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js',
        '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ja.js',
        '/js/front/reserve.js',
        '/js/front/jquery-ui-timepicker-addon.min.js',
        '/js/jquery-ui-timepicker-ja.js',
    ],
    ['type'=> 'text/javascript','defer' => true]);?>

<?= $this->Html->css('front/jquery-ui-timepicker-addon.min.css') ?>

<style type="text/css">
    .send_error {
        color: red;
    }

    .terms {
        color: gray;
        font-size: 8px;
    }

    .saturday_en {
        background-color: #bdd3eb !important;
    }
    .sunday_en {
        background-color: #f1c5cf !important;
    }
    .saturday_jp {
        background-color: #d3e3f3 !important;
    }
    .sunday_jp {
        background-color: #f5dce7 !important;
    }

    #pm_scroll, #night_scroll {
        margin: 0px 5px;
        /*color: rgb(0, 0, 238);*/
        color: #4885bc;
        text-decoration-line: underline;
    }
</style>

<div id="bread">
    <div class="inner cf">
        <span class="breaditem"><a href="<?=Router::url('/')?>"><span>脱毛LOVEトップ</span></a></span>
        <span class="breaditem"><?php echo $this->Html->link("<span>全国の脱毛施設</span>", ['controller'=> 'searchs'], ['escape'=> false])?></span>
        <span class="breaditem"><?php echo $this->Html->link("<span>全国の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
        <span class="breaditem"><?php echo $this->Html->link("<span>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
        <span class="breaditem"><?php echo $this->Html->link("<span>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
        <span class="breaditem"><?php echo $this->Html->link("<span>{$shop['name']}</span>", ['controller' => 'shops', 'action' => 'detail', $shop['shop_id']], ['escape' => false]) ?></span>
        <span class="breaditem">予約フォーム</span>
    </div>
</div>

<div id="container">
    <div class="inner no-sp-padding">
        <div class="undercontentwrap cf">
            <div id="reserve_form">
                <h1>
                    脱毛LOVEから<span class="clinic-name"><?= $shop['name'] ?></span>を今スグ予約する
                </h1>
                <h2 id="reserve_help">
                    第1希望日を選択してください
                    <?php if (!empty($shop['business_hours'])) { ?>
                    <br><br>
                    <span style="font-size: 14px;font-weight: normal;">営業時間<?php echo $shop['business_hours']; ?></span>
                    <?php } ?>
                </h2>

                <?= '<font color="red">'.$this->Flash->render().'</font>'; ?>

                <section class="reserve_section">
                    <div class="prev disabled">
                        < 前の1週間
                    </div>
                    <div class="next">
                        次の1週間 >
                    </div>
                </section>

                <table
                        id="reserve_table"
                        data-date-options="<?=    RESERVE_TABLE['DATE_OPTIONS']  ?>"
                        data-time-start="<?=      RESERVE_TABLE['TIME_START']    ?>"
                        data-time-end="<?=        RESERVE_TABLE['TIME_END']      ?>"
                        data-probability="<?=     RESERVE_TABLE['PROBABILITY']   ?>"
                        data-visit-options="<?=   RESERVE_TABLE['VISIT_OPTIONS'] ?>"
                        data-week-options-en="<?= implode(',', RESERVE_TABLE['WEEK_OPTIONS_EN']) ?>"
                        data-week-options-jp="<?= implode(',', RESERVE_TABLE['WEEK_OPTIONS_JP']) ?>">
                    <thead>
                    <tr>
                        <th rowspan="2">
                            日時
                        </th>
                        <?php for ($d = 2; $d <= RESERVE_TABLE['DATE_OPTIONS']; $d++): ?>
                            <th scope="col" class="<?= RESERVE_TABLE['WEEK_OPTIONS_EN'][date('w', strtotime('+'.$d.'day'))] ?>_en">
                                <?= date('m/d', strtotime('+'.$d.'day')) ?>
                            </th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <?php for ($d = 2; $d <= RESERVE_TABLE['DATE_OPTIONS']; $d++): ?>
                            <th scope="col" class="<?= RESERVE_TABLE['WEEK_OPTIONS_EN'][date('w', strtotime('+'.$d.'day'))] ?>_jp">
                                <?= RESERVE_TABLE['WEEK_OPTIONS_JP'][date('w', strtotime('+'.$d.'day'))] ?>
                            </th>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <th></th>
                        <th colspan="<?= RESERVE_TABLE['DATE_OPTIONS'] ?>">
                            <span id="pm_scroll" data-target="#time_12">午後（12:00-18:00）</span>
                            <span id="night_scroll" data-target="#time_18">夜（18:00-）</span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (range(RESERVE_TABLE['TIME_START'], RESERVE_TABLE['TIME_END']) as $H): ?>
                        <tr>
                            <th scope="row" id="time_<?= $H ?>">
                                <?= $H.':00' ?>
                            </th>
                            <?php for ($d = 2; $d <= RESERVE_TABLE['DATE_OPTIONS']; $d++): ?>
                                <td data-time="<?= date('Y/m/d', strtotime('+'.$d.'day')).' '.$H.':00' ?>">
                                    □
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <section class="reserve_section">
                    <div class="prev disabled">
                        < 前の1週間
                    </div>
                    <div class="next">
                        次の1週間 >
                    </div>
                </section>
                <h2 style="margin-top: 20px;">仮予約フォーム</h2>
                <?= $this->ExForm->create('Contact', [
                    'url'  => [
                        'controller' => 'Contacts',
                        'action'     => 'reserve'
                    ],
                    'type' => 'post',
                    'id'   => 'reserve_exform'
                ]) ?>
                <table class="contact_form">
                    <tr>
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">店舗名</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->text(
                                'shop_name', [
                                    'value'       => $shop['name'],
                                    'placeholder' => '例）サンプル店舗東京',
                                    'required'    => true
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">来店希望日時</span>
                        </th>
                        <td>
                            <?php for ($i = 1; $i <= RESERVE_TABLE['VISIT_OPTIONS']; $i++): ?>
                                <div style="margin: 10px 0;">
                                    <?php
                                    echo $this->ExForm->text(
                                        'visit_date_'.$i, [
                                            'placeholder' => '第'.$i.'希望 例）'.date('Y/m/d H:00'),
                                            'id'          => 'visit_date_'.$i,
                                            'class'       => 'datetimepicker visit_dates',
                                            'required'    => $i
                                        ]
                                    );
                                    ?>
                                </div>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">氏名</span>
                        </th>
                        <td>
                            <div style="display: flex;">
                                <?php
                                echo $this->ExForm->text(
                                    'last_name', [
                                        'placeholder' => '例）脱毛',
                                        'required'    => true,
                                        'style'       => 'margin-right: 10px;'
                                    ]
                                );
                                ?>
                                <?php
                                echo $this->ExForm->text(
                                    'first_name', [
                                        'placeholder' => '例）花子',
                                        'required'    => true,
                                        'style'       => 'margin-left: 10px;'
                                    ]
                                );
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">フリガナ</span>
                        </th>
                        <td>
                            <div style="display: flex;">
                                <?php
                                echo $this->ExForm->text(
                                    'last_kana', [
                                        'placeholder' => '例）ダツモウ',
                                        'required'    => true,
                                        'style'       => 'margin-right: 10px;'
                                    ]
                                );
                                ?>
                                <?php
                                echo $this->ExForm->text(
                                    'first_kana', [
                                        'placeholder' => '例）ハナコ',
                                        'required'    => true,
                                        'style'       => 'margin-left: 10px;'
                                    ]
                                );
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr class="query-type query-type-">
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">生年月日</span>
                        </th>
                        <td>
                            <div class="birthday">
                                <?php
                                // echo $this->ExForm->text(
                                // 	'birthday', [
                                // 		'placeholder' => '例）'.date('Y/m/d'),
                                // 		'class'       => 'datepicker',
                                // 		'required'    => true
                                // 	]
                                // );
                                ?>

                                <?php
                                $options_y = [];
                                foreach (range(date('Y')-100, date('Y')) as $y) {
                                    $options_y[$y] = $y;
                                };

                                echo $this->ExForm->control(
                                    'birthday_y', [
                                        'type'     => 'select',
                                        'options'  => $options_y,
                                        'empty'    => '--',
                                        'default'  => date('Y')-25,
                                        'label'    => false,
                                        'style'    => 'margin-right: 10px;',
                                        'required' => true
                                    ]
                                );
                                ?>
                                <div class="birthday__unit">年</div>
                                <?php
                                $options_m = [];
                                foreach (range(1, 12) as $m) {
                                    $options_m[$m] = $m;
                                };

                                echo $this->ExForm->control(
                                    'birthday_m', [
                                        'type'     => 'select',
                                        'options'  => $options_m,
                                        'empty'    => '--',
                                        'label'    => false,
                                        'style'    => 'margin-right: 10px;',
                                        'required' => true
                                    ]
                                );
                                ?>
                                <div class="birthday__unit">月</div>
                                <?php
                                $options_d = [];
                                foreach (range(1, 31) as $d) {
                                    $options_d[$d] = $d;
                                };

                                echo $this->ExForm->control(
                                    'birthday_d', [
                                        'type'     => 'select',
                                        'options'  => $options_d,
                                        'empty'    => '--',
                                        'label'    => false,
                                        'style'    => 'margin-right: 10px;',
                                        'required' => true
                                    ]
                                );
                                ?>
                                <div class="birthday__unit">日</div>
                            </div>
                        </td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span>
                            <span class="reserve-text">性別</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->sex(
                                'sex', [
                                    'required' => true,
                                    'default'  => 2
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">脱毛希望部位</span>
                        </th>
                        <td class="">
                            <div class="depilation-box">
                            <?php
                            echo $this->ExForm->depilationSite(
                                'depilation_site', [
                                    'required' => true,
                                    'multiple' => 'checkbox',
                                    'style'    => 'height: 100%;',
                                    'class' => 'depilation-check'
                                ]
                            );
                            ?>
                            </div>
                            <p class="depilation-more">
                                <span class="depilation-more-text">脱毛部位をもっと見る</span>
                                <?php echo $this->Html->image('/img/Shop/blue_down_arrow.png', ['class'=> 'depilation-more-img','alt'=> '']); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="imp">必須</span>
                            <span class="reserve-text">連絡先番号</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->text(
                                'tell', [
                                    'placeholder' => '例）03-1234-5678',
                                    'required'    => true
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="imp">必須</span>
                            <span class="reserve-text">メールアドレス</span>
                        </th>
                        <td class="mailform">
                            <?php
                            echo $this->ExForm->text(
                                'mail', [
                                    'placeholder' => '例）info@tsuru-tsuru.co.jp',
                                    'required'    => true
                                ]
                            );
                            ?>
                            <p class="atention">
                                ※docomo.ne.jp、softbank.jp、ezweb.ne.jpなどの携帯メールアドレスでは、パソコンからのメールを受信拒否する初期設定をされている場合がございます。tsuru-tsuru.co.jpからの受信許可の設定をお願いいたします。
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">住所</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->text(
                                'address', [
                                    'placeholder' => '例）サンプル住所'
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">利用人数</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->control(
                                'customer_count', [
                                    'label'   => false,
                                    'type'    => 'select',
                                    'options' => [
                                        '1名'    => '1名',
                                        '2名'    => '2名',
                                        '3名以上' => '3名以上'
                                    ]
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">当日の施術を希望されますか？</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->control(
                                'is_same_date', [
                                    'label'   => false,
                                    'type'    => 'select',
                                    'options' => [
                                        'いいえ' => 'いいえ',
                                        'はい'   => 'はい'
                                    ]
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">脱毛経験はございますか？</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->control(
                                'is_experienced', [
                                    'label'   => false,
                                    'type'    => 'select',
                                    'options' => [
                                        'いいえ' => 'いいえ',
                                        'はい'   => 'はい'
                                    ]
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">キャンペーンの通知を希望しますか？</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->control(
                                'is_campaign', [
                                    'label'   => false,
                                    'type'    => 'select',
                                    'options' => [
                                        'いいえ' => 'いいえ',
                                        'はい'   => 'はい'
                                    ]
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <span class="any">任意</span>
                            <span class="reserve-text">質問など</span>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->textarea(
                                'question', [
                                    'placeholder' => '例）料金について'
                                ]
                            );
                            ?>
                        </td>
                    </tr>
                </table>

                <div>
                    <?php
                    // echo $this->ExForm->input(
                    // 	'送信する', [
                    // 		'type'  => 'submit',
                    // 		'name'  => 'contact_user',
                    // 		'class' => 'submit_button'
                    // 	]
                    // );
                    echo $this->Form->button(
                        '<div class="terms" style="margin-bottom: 10px;">利用規約に同意して</div>無料カウンセリングを申し込む', [
                            'id'       => 'reserve_submit',
                            'class'    => 'submit_button',
                            // 'disabled' => true
                        ]
                    );

                    // echo $this->element('Front/Contact/agreement');
                    ?>
                </div>
                <?= $this->ExForm->end() ?>

                <div style="">
                    <a href="/regulation/" class="terms" target="_blank">
                        利用規約はこちら
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
