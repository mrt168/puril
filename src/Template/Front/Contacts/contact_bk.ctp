<div id="bread" itemscope itemtype="http://schema.org/BreadcrumbList">
	<div class="inner cf">
		<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breaditem"><a itemprop="item" href="/"><span itemprop="name" class="name">TOP</span></a><meta itemprop="position" content="1" /></span>
		<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="breaditem"><a style="color:#434343;text-decoration:none;pointer-events:none;" itemprop="item" href="/form_facility"><span itemprop="name" class="name">施設情報掲載のお問い合わせ</span></a><meta itemprop="position" content="3" /></span>
	</div>
</div>
<div id="container">
	<div class="inner no-sp-padding">
		<div class="undercontentwrap cf">
			<div id="contactclum">
				<h1>施設情報掲載のお問い合わせ</h1>
				<div class="contactbox">
					<?php
					echo $this->Html->image('/img/contact_image1.jpg', ['class'=> 'pc']);
					echo $this->Html->image('/img/contact_image1_sp.jpg', ['class'=> 'sp']);
					?>
					<div class="text_box">
						<div class="textarea">
							Purilへの情報掲載は【完全無料】です！<br>
							掲載をご希望の施設様は、下記よりお気軽にお問い合わせください。<br>
							また、すでに掲載されている施設様において、施設の内観画像や情報の充実などのご要望を承ることも可能です。
						</div>
						<div class="textarea">
							お問い合わせをいただきましたら、内容を確認のうえ、担当者より数営業日内にご返信させていただきます。どうぞよろしくお願いいたします。
						</div>
					</div>
				</div>
				<?php echo "<font color='red'>".$this->Flash->render(). "</font>";?>
				<h2>お問い合わせフォーム</h2>
				<?php echo $this->ExForm->create('Contact', ['url'=> ['controller' => 'Contacts', 'action'=> 'sendContact'], 'type'=> 'post']);?>
					<table class="contact_form">
						<tr>
							<th>
								<span class="imp">必須</span><span class="reserve-text">施設名</span>
							</th>
							<td>
								<?php
								echo $this->ExForm->text('shop_name', ['placeholder'=> '例）〇〇エステサロン', 'required'=> true]);
								?>
							</td>
						</tr>
						<tr>
							<th>
								<span class="imp">必須</span><span class="reserve-text">ご担当者名</span>
							</th>
							<td>
								<?php
								echo $this->ExForm->text('name', ['placeholder'=> '例）脱毛　花子', 'required'=> true]);
								?>
							</td>
						</tr>
						<tr>
							<th>
								<span class="imp">必須</span><span class="reserve-text">電話番号</span>
							</th>
							<td>
								<?php
								echo $this->ExForm->text('tell', ['placeholder'=> '例）03-1234-5678', 'required'=> true]);
								?>
							</td>
						</tr>
						<tr>
							<th>
								<span class="imp">必須</span><span class="reserve-text">メールアドレス</span>
							</th>
							<td class="mailform">
								<?php
								echo $this->ExForm->text('mail', ['placeholder'=> '例）info@tsuru-tsuru.co.jp', 'required'=> true]);
								?>
                                <p class="atention">
                                    ※docomo.ne.jp、softbank.jp、ezweb.ne.jpなどの携帯メールアドレスでは、パソコンからのメールを受信拒否する初期設定をされている場合がございます。tsuru-tsuru.co.jpからの受信許可の設定をお願いいたします。
                                </p>
							</td>
						</tr>
						<tr>
							<th>
								<span class="any">任意</span><span class="reserve-text">お問い合わせ内容</span>
							</th>
							<td>
								<?php
								echo $this->ExForm->textarea('content', ['placeholder'=> '例）Purilへの掲載依頼', 'row'=> '4']);
								?>
							</td>
						</tr>
					</table>
					<?php
					echo $this->ExForm->input('送信する', ['type'=> 'submit', 'name'=> 'contact', 'class'=> 'submit_button']);
					echo $this->element('Front/Contact/agreement');
					?>
				<?php
				echo $this->ExForm->end()
				;?>
			</div>
		</div>
	</div>
</div>