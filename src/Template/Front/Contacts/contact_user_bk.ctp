<?php
use App\Vendor\Code\ContactType;
use App\Vendor\Code\CodePattern;
?>
<div id="bread" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div class="inner cf">
        <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breaditem"><a itemprop="item" href="/"><span itemprop="name">TOP</span></a><meta itemprop="position" content="1" /></span>
        <span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breaditem"><a style="color:#434343;text-decoration:none;pointer-events:none;" itemprop="item" href="/form_user"><span itemprop="name">ユーザーレビューのお問い合わせ</span></a><meta itemprop="position" content="3" /></span>
    </div>
</div>
<div id="container">
    <div class="inner no-sp-padding">
        <div class="undercontentwrap cf">
            <div id="contact_userclum">
                <h1>ユーザーレビューのお問い合わせ</h1>
                <div class="contactbox">
                    <div class="text_box">
                        <div class="textarea">
                            Purilへのユーザーレビューはこちらからお問い合わせください。<br>
                            ご質問・ご意見はもちろん、口コミなども行うことが可能です。
                        </div>
                        <div class="textarea">
                            お問い合わせをいただきましたら、内容を確認のうえ、担当者より数営業日内にご返信させていただきます。（内容によっては返信ができない場合がございます。）<br>
                            どうぞよろしくお願いいたします。
                        </div>
                    </div>
                </div>
                <?php echo "<font color='red'>".$this->Flash->render(). "</font>";?>
                <h2>お問い合わせフォーム</h2>
                <?php echo $this->ExForm->create('Contact', ['url'=> ['controller' => 'Contacts', 'action'=> 'sendContactUser'], 'type'=> 'post']);?>
                <table class="contact_form">
                    <tr>
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">お問い合わせ種別</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->contactType('type', ['required'=> true, 'id'=> 'contact-type']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">メールアドレス</span>
                        </th>
                        <td class="mailform">
                            <?php echo $this->ExForm->text('mail', ['placeholder'=> '例）info@tsuru-tsuru.co.jp', 'required'=> true]); ?>

                            <p class="atention">
                                ※docomo.ne.jp、softbank.jp、ezweb.ne.jpなどの携帯メールアドレスでは、パソコンからのメールを受信拒否する初期設定をされている場合がございます。tsuru-tsuru.co.jpからの受信許可の設定をお願いいたします。
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="any">任意</span><span class="reserve-text">電話番号</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('tell', ['placeholder'=> '例）03-1234-5678']); ?>
                        </td>
                    </tr>

                    <tr class="query-type query-type-<?=ContactType::$REQUEST[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">口コミ掲載URL</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('review_url', ['placeholder'=> '例）https://puril.net/']); ?>
                        </td>
                    </tr>

                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="any">任意</span><span class="reserve-text">来店日</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('visit_date', ['placeholder'=> sprintf('例）%s', date('Y/m/d')), 'class'=> 'datepicker']); ?>
                        </td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">来店店舗</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('shop_name', ['placeholder'=> '例）サンプル店舗東京']); ?>
                        </td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">評価</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->evaluation('evaluation', ['required'=> true]); ?>
                        </td>
                    </tr>
                    <tr class="valuetion-tr query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">

                        <th class="table_title">
                            <span class="any">任意</span><span class="reserve-text">評価詳細</span>
                        </th>
                        <td class="valuetion-td">
                            <table class="valuetion-table">
                                <tr>
                                <th class="valuetion">治療前の説明は十分でしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question1', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                                <tr>
                                <th class="valuetion">痛みへの配慮はいかがでしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question2', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                                <tr>
                                <th class="valuetion">スタッフの態度、対応はいかがでしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question3', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                                <tr>
                                <th class="valuetion">店舗の雰囲気、設備、清潔感はいかがでしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question4', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                                <tr>
                                <th class="valuetion">待ち時間、予約対応はいかがでしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question5', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                                <tr>
                                <th class="valuetion">術前、術中、術後の対応はいかがでしたか？</th>
                                <td class="valuetion">
                                    <?php echo $this->ExForm->satisfaction('question6', ['type'=> 'select', 'empty'=> true]);?>
                                </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?> query-type-<?=ContactType::$REQUEST[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">氏名・ニックネーム</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('nickname', ['placeholder'=> '例）脱毛 花子']); ?>
                        </td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">年齢</span>
                        </th>
                        <td><?php echo $this->ExForm->age('age', ['required'=> true]); ?></td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">性別</span>
                        </th>
                        <td><?php echo $this->ExForm->sex('sex', ['required'=> true]); ?></td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="any">任意</span><span class="reserve-text">Instagramアカウント</span>
                        </th>
                        <td><?php echo $this->ExForm->text('instagram_account'); ?></td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="any">任意</span><span class="reserve-text">Twitterアカウント</span>
                        </th>
                        <td><?php echo $this->ExForm->text('twitter_account'); ?></td>
                    </tr>
                    <tr class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">
                        <th>
                            <span class="imp">必須</span><span class="reserve-text">口コミタイトル</span>
                        </th>
                        <td>
                            <?php echo $this->ExForm->text('title', ['placeholder'=> '例）スタッフさんの対応がよかった']); ?>
                            <p class="atention">
                                ※25文字以内でご記入ください。
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <span class="imp">必須</span>
                            <div class="reserve-text">
                                <span class="query-type query-type-<?=ContactType::$QUESTION[CodePattern::$CODE]?>">お問い合わせ内容</span>
                                <span class="query-type query-type-<?=ContactType::$REVIEW[CodePattern::$CODE]?>">口コミ詳細</span>
                                <span class="query-type query-type-<?=ContactType::$REQUEST[CodePattern::$CODE]?>">ご依頼詳細</span>
                            </div>
                        </th>
                        <td>
                            <?php
                            echo $this->ExForm->textarea('content', ['placeholder'=> '例）Purilへの掲載依頼', 'row'=> '4', 'required'=> true]);
                            ?>
                        </td>
                    </tr>
                </table>
                <?php
                echo $this->ExForm->input('送信する', ['type'=> 'submit', 'name'=> 'contact_user', 'class'=> 'submit_button']);
                echo $this->element('Front/Contact/agreement');
                ?>
                <?php
                echo $this->ExForm->end();
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#contact-type').change(function() {
            $('.query-type').hide();
            $('.query-type-'+$(this).val()).show(100);
        }).trigger('change');
    })
</script>