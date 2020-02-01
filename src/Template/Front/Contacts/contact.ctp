
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/reserve/common', 'datsumou/reserve/index', 'jquery.datetimepicker.min']);
?>
		<header class="datsumou-header">
				<?php
				echo $this->element('Front/header')
				?>
		</header>
    <form class="reserve-form form-user" action="#">
		<section class="contact-content">
            <h2 class="reserve-title">お問い合わせ</h2>
            <div class="contact-content-text">
            <p>Purilへの情報掲載は【完全無料】です！</p>
						<p>掲載をご希望の施設様は、下記よりお気軽にお問い合わせください。</p>
						<p>また、すでに掲載されている施設様において、施設の内観画像や情報の充実などのご要望を承ることも可能です。 お問い合わせをいただきましたら、内容を確認のうえ、担当者より数営業日内にご返信させていただきます。どうぞよろしくお願いいたします。</p>
            </div>
        </section>
      <section class="content-base reserve-section">
      <div class="reserve-subquestion">
            <div class="reserve-question">
                <div class="reserve-subquestion-text">施設名</div>
                <div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <input type="text" name="facility" placeholder="施設名">
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-question">
                <div class="reserve-subquestion-text">ご担当者名</div>
                <div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <input type="text" name="name" placeholder="ご担当者名"">
            </div>
        </div>
        <div class="reserve-subquestion">
            <div class="reserve-question">
                <div class="reserve-subquestion-text-top reserve-subquestion-text">メールアドレス</div>
                <div class="reserve-tag reserve-tag-required">必須</div>
            </div>
          <div class="reserve-input">
            <input type="text" name="mail" placeholder="info@tsuru-tsuru.co.jp">
          </div>
          <div class="reserve-email-desc">※docomo.ne.jp、softbank.jp、ezweb.ne.jpなどの携帯メールアドレスでは、パソコンからのメールを受信拒否する初期設定をされている場合がございます。tsuru-tsuru.co.jpからの受信許可の設定をお願いいたします。</div>
        </div>
        
        <div class="reserve-subquestion">
            <div class="reserve-question">
                <div class="reserve-subquestion-text">電話番号</div>
                <div class="reserve-tag reserve-tag-required">必須</div>
            </div>
            <div class="reserve-input">
                <input type="text" name="tel" placeholder="03-1234-5678">
            </div>
        </div>
      </section>
      <section class="content-base reserve-section">
        <div class="reserve-subquestion">
            <div class="reserve-question">
                <div class="reserve-subquestion-text-top reserve-subquestion-text">お問い合わせ内容</div>
                <div class="reserve-tag reserve-tag-option">任意</div>
            </div>
          <div class="reserve-input">
            <textarea cols="30" rows="10" name="comment" placeholder="お問い合わせ内容"></textarea>
          </div>
        </div>
      </section>
        <section class="content-base terms-section">
        <p>利用規約</p>
      <h2 class="terms-section-title">第１条（Puril）</h2>
      <div class="terms-section-text-wrap">
        <p>Puril（以下「本サービス」といいます）は、ツルツル株式会社（以下「当社」といいます）が提供する、美容店舗の比較・検討ができるサービスです。本サービスは、美容店舗の運営事業者（以下「事業者」といいます）と本サービスの利用者（以下「ユーザー」といいます）との間の交流を通じ、事業者の情報発信の機会やユーザーの来店機会を提供するものにすぎません。したがって、事業者とユーザーの間で問題が生じた場合、それらの問題は当事者同士で解決されるものとします。 当社は、当サービスの利用に関し各店舗とユーザー間で発生する問題についてはいかなる場合においても一切義務を負わないものとします。 ユーザーはそれらの問題により発生する申し立て、法的責任、および第三者からの弁護士費用等の全てを保証し、当社とその従業員に対し、損害を与えない事に同意するものとします。</p>
      </div>
      <h2 class="terms-section-title">第２条（定義）</h2>
      <div class="terms-section-text-wrap">
        <p>本サービスは、当社が運営する本サイトを通じた、インターネット上の情報サービス及び、それに関連するサービスの総称です。用語の定義について</p>
        <p>(１)プライバシー情報とは：個人情報と行動履歴情報等を合わせてプライバシー情報といいます。</p>
        <p>(２)個人情報とは：本規約でいう個人情報とは、個人情報保護法にいう「個人情報」を指し、生存する個人の情報であって、特定の個人を識別できる情報（氏名、住所、電話番号、メールアドレス、その他の記述により個人を識別できるもの）をいいます。また、その情報のみでは識別できない場合でも、他の情報と容易に照合することができ、結果的に個人を識別できるものも個人情報に含むものとします。</p>
        <p>(３)行動履歴情報等とは：本規約でいう「行動履歴情報等」とは、プライバシー情報のうち、上記に定める「個人情報」以外のものを指し、ご利用いただいたサービス・サイト内での閲覧履歴、IPアドレス、Cookie、位置情報、端末固有の識別情報などを指します。ただし、行動履歴情報等を他の情報と照合することにより個人を識別できる場合には、個人情報として取り扱います。</p>
      </div>
      <h2 class="terms-section-title">第３条（禁止事項）</h2>
      <div class="terms-section-text-wrap">
        <p>ユーザーは、以下の行為を行うことを禁止します。</p>
        <ul>
          <li>
            <p>・虚偽の情報を登録する行為</p>
          </li>
          <li>
            <p>・公序良俗・法令・条例等に反する行為</p>
          </li>
          <li>
            <p>・社会常識・通念を逸脱した行為</p>
          </li>
          <li>
            <p>・当社・企業・ユーザー及び第三者の財産権（特許権、商標権、著作権等のあらゆる知的財産権を含む）または個人情報に関する権利等、あらゆる法的権利を侵害する行為</p>
          </li>
          <li>
            <p>・当社・企業・ユーザー及び第三者を誹謗中傷する行為</p>
          </li>
          <li>
            <p>・本サービスの運営、当社の経営を妨げる恐れのある一切の行為</p>
          </li>
          <li>
            <p>・本サービスを通常に利用する行為を超え、サーバーに負荷をかける行為、もしくはそれを助長するような行為、HTMLデータを収集して特定のデータを抽出する行為、その他本サービスの運営・提供、もしくはユーザーによる本サービスの利用を妨害し、またはそれらに支障をきたす行為</p>
          </li>
          <li>
            <p>・サーバー等のアクセス制御機能を解除または回避するための情報、機器、ソフトウェア等を流通させる行為</p>
          </li>
          <li>
            <p>・本サービスによって提供される機能を複製、修正、転載、改変、変更、リバースエンジニアリング、逆アセンブル、逆コンパイル、翻訳あるいは解析する行為</p>
          </li>
          <li>
            <p>・その他、当社が不適切と判断する一切の行為</p>
          </li>
        </ul>
      </div>
      <h2 class="terms-section-title">第４条（情報の削除）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は事業者およびユーザーが投稿したコンテンツを削除、編集、再構成できる権利を有するものとし、利用者はこれらに対し、意義を申し立てないものとします。また当社の削除、編集により、利用者もしくは第三者に何らかの損害が発生したとしても、当社は一切の責任を負わないものとします。</p>
      </div>
      <h2 class="terms-section-title">第５条（サービスの一時的な中止、変更、廃止）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は、以下の事由に該当すると判断した場合には、事前の通知や承諾なしに、本サービスの一時的な中断を行うことがあります。</p>
        <p>(１)システムの保守または変更を行う場合</p>
        <p>(２)天災事変その他非常事態が発生し、または発生するおそれがあり、本サービスの運営が困難な場合</p>
        <p>(３)その他当社が必要やむをえないと認めた場合</p>
        <p>本サービスのサービスや情報、URLは、予告なしに変更または廃止される場合があります。</p>
      </div>
      <h2 class="terms-section-title">第６条（著作権等の取扱）</h2>
      <div class="terms-section-text-wrap">
        <p>本サービス上に含まれている全てのコンテンツ及び個々の情報､商標､画像､広告､デザイン等に関する著作権､商標権その他の知的財産権、及びその他の財産権は全て当社又は正当な権利者に帰属しています｡本サービスで使用されている全てのソフトウェアは､知的財産権に関する法令等により保護されている財産権を含んでいます｡</p>
        <p>企業・ユーザー及び第三者は､当社若しくは著作権その他の知的財産権及びその他の財産権を有する第三者から利用･使用を許諾されている場合､又は､法令により権利者からの許諾なく利用若しくは使用することを許容されている場合を除き、本サービスの内容について複製､編集､改変､掲載､転載､公衆送信､配布､販売､提供､翻訳・翻案その他あらゆる利用又は使用を行ってはなりません｡</p>
        <p>企業・ユーザー及び第三者が前各号に反する行為によって被った損害については､当社は一切の責任を負わないものとします｡また､これらの行為によって利益を得た場合､当社はその利益相当額を請求できる権利を有するものとします｡</p>
      </div>
      <h2 class="terms-section-title">第７条（不可抗力）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は、通常講ずるべきウィルス対策では防止できないウィルス被害もしくは天変地異による被害が生じた場合、またはその他当社の責によらない事由（以下「不可抗力」といいます）による被害が生じた場合には、一切責任を負わないものとします。</p>
        <p>当社は、これらの不可抗力に起因して本サービスにおけるデータが消去・変更されないことを保証するものではなく、ユーザーは、必要に応じてかかるデータを自己の責任において保存するものとします。</p>
      </div>
      <h2 class="terms-section-title">第８条（掲示内容の不保証等）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は、本サービスにおいて提供される情報（本サービスの掲載企業等の第三者の情報、広告その他第三者により提供される情報を含みます）、および本サービスの掲載企業等における個人情報の取扱等に関して、その正確性、完全性、目的適合性、有用性、適法性および第三者の権利を侵害していないことについて、一切保証しないものとします。</p>
        <p>当社は、本サービスとして送信される電子メールおよびWEBコンテンツに、コンピュータウィルス等の有害なものが含まれていないことを保証しないものとします。</p>
      </div>
      <h2 class="terms-section-title">第９条（免責）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は、本サービス上の情報内容の正確性、有用性等について何らの保証をしないものとします。</p>
        <p>当社は、本サービス上の情報内容及び本サービスの利用によって、企業・ユーザー及び第三者に発生する一切の損害に対し、何らの責任も負担しないものとします。</p>
        <p>当社は本サービスの中断や停止、内容の変更や追加によって、企業・ユーザー及び第三者が受けた損害に関して、何ら責任も負わないものとします。</p>
      </div>
      <h2 class="terms-section-title">第10条（反社会的勢力の排除）</h2>
      <div class="terms-section-text-wrap">
        <p>ユーザーは、反社会的勢力（暴力団、暴力団員、暴力団員でなくなった時から5年を経過しない者、暴力団準構成員、暴力団関係企業、総会屋等、社会運動等標ぼうゴロまたは特殊知能暴力集団等、その他これらに準ずる者をいいます。）に該当しないこと、また暴力的行為、詐術・脅迫行為、業務妨害行為等違法行為を行わないことを、将来にわたっても表明するものとします。ユーザーは、自らまたは第三者を利用して次の各号の一にでも該当する行為を行わないことを確約するものとします。</p>
        <p>(１)暴力的な要求行為</p>
        <p>(２)法的な責任を超えた不当な要求行為</p>
        <p>(３)取引に関して、脅迫的な言動をし、または暴力を用いる行為</p>
        <p>(４)風説を流布し、偽計を用いまたは威力を用いて当社の信用を毀損し、または当社の業務を妨害する行為</p>
        <p>(５)その他前各号に準ずる行為</p>
        <p>当社は、ユーザーが前二項の表明に違反したときは、何らの催告をせず、本規約に基づく一切の契約を解除することができ、ユーザーはこれになんら異議を申し立てないものとします。なお、この場合、ユーザーは、期限の利益を喪失し、直ちに当社に対する債務の弁済を行うものとします。</p>
      </div>
      <h2 class="terms-section-title">第11条（個人情報保護方針）</h2>
      <div class="terms-section-text-wrap">
        <p><span>当社は、「</span><a href="#">プライバシーポリシー</a><span>」に則り、会員の個人情報を取り扱うものとします。</span></p>
      </div>
      <h2 class="terms-section-title">第12条（口コミの利用について）</h2>
      <div class="terms-section-text-wrap">
        <p>本サイトを介した店舗、口コミ情報の閲覧、ご利用はお客様の責任で行っていただきますようお願いいたします。本サイト内に掲載されている店舗情報及び口コミ情報は、店舗もしくは一般ユーザーからの投稿情報を元に作成しております。</p>
        <p>本サイトでは、これらの情報について、内容が正確であること、不快な内容を含まないものであること、利用者が意図していない情報を含まないものであることなどを一切保証いたしません。</p>
      </div>
      <h2 class="terms-section-title">第13条（キャッシュバックの利用について）</h2>
      <div class="terms-section-text-wrap">
        <p>本サイトを介して店舗を知り、新たに契約金30,000円以上の契約した場合（本サイト経由での契約以前に一度でも店舗と契約していた場合を除く）、5,000円キャッシュバックいたします。</p>
        <p>キャッシュバックをご利用の際は、店舗と契約した旨を弊社お問合せフォームまでご連絡いただきますようお願いいたします。</p>
      </div>
      <h2 class="terms-section-title">第14条（規約の変更）</h2>
      <div class="terms-section-text-wrap">
        <p>当社は、ユーザーの承諾を得ることなく、本規約を随時変更することができます。変更の内容は、本サービスに掲載し、その掲載をもって、すべてのユーザーが了承したものとみなします。</p>
      </div>
      <h2 class="terms-section-title">第15条（損害賠償）</h2>
      <div class="terms-section-text-wrap">
        <p>ユーザーが本規約に違反し、当社・企業及び第三者に対し損害を与えた場合、ユーザーは、当社・企業及び第三者に対し、損害賠償義務を負担します。</p>
      </div>
      <h2 class="terms-section-title">第15条（損害賠償）</h2>
      <div class="terms-section-text-wrap">
        <p>本規約に関する紛争については、東京地方裁判所を第一審の管轄裁判所とします。</p>
      </div>
    </section>
    </form>
		<img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
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
		<script type="text/javascript" src="/js/datsumou/reserve/index.js"></script>
		<?php echo $this->element('Front/footer') ?>

