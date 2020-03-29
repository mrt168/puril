<div class="header"><h1 class="page-title">店舗CSVインポート</h1></div>
<ul class="nav nav-tabs">
  <li class="active"><a href="#maint" data-toggle="tab">店舗CSVインポート</a></li>
</ul>
<div class="row">
	<div class="col-md-4">
		<br>
		<?php
		echo $this->Flash->render();
		echo $this->ExForm->create('Shops', array('url'=> array('action'=> 'csv_import'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="main">
				<div class="form-group">
				<label>CSVファイル<span class="required-mark">※</span></label>
					<?php
					echo $this->ExForm->file('Shops.csv_file');
					?>
					<br><span class="required-mark">一度にインポートできる件数は5000件までです。</span>
				</div>
			</div>
		</div>
		<?php
		echo $this->ExForm->button('<i class="fa fa-save"></i> インポート', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
		?>
	</div>
</div>
<hr>
<div class="panel">
	<div class="panel-heading">CSV項目</div>
	<table class="csv-items table">
		<tr>
			<th width="5%">列</th>
			<th width="10%">項目名</th>
			<th width="5%">必須</th>
			<th width="40%">注意事項</th>
			<th>例</th>
		</tr>
		<tr>
			<td>1</td>
			<td>ID</td>
			<td></td>
			<td>数値で入力</td>
			<td>1234</td>
		</tr>
		<tr>
			<td>2</td>
			<td>店舗名</td>
			<td><span class="required-mark">○</span></td>
			<td>256文字以内</td>
			<td>サンプル店</td>
		</tr>
		<tr>
			<td>3</td>
			<td>施設種類</td>
			<td><span class="required-mark">○</span></td>
			<td>1 OR 2 を半角数字で指定 1=脱毛サロン 2=医療脱毛クリニック</td>
			<td>1</td>
		</tr>
		<tr>
			<td>4</td>
			<td>ブランド名</td>
			<td></td>
			<td>登録されているブランド名を入力</td>
			<td>サンプルブランド</td>
		</tr>
		<tr>
			<td>5</td>
			<td>都道府県</td>
			<td><span class="required-mark">○</span></td>
			<td>都道府県名を指定（道・府・都・県まで入力）</td>
			<td>東京都</td>
		</tr>
		<tr>
			<td>6</td>
			<td>市区町村</td>
			<td><span class="required-mark">○</span></td>
			<td>市区町村名を指定（市まで入力）</td>
			<td>新宿区</td>
		</tr>
		<tr>
			<td>7</td>
			<td>住所</td>
			<td><span class="required-mark">○</span></td>
			<td>1024文字以内で入力</td>
			<td>新宿区1-2-3</td>
		</tr>
		<tr>
			<td>8</td>
			<td>アクセス/道案内</td>
			<td></td>
			<td>同上</td>
			<td>新宿駅東口を出て徒歩3分</td>
		</tr>
		<tr>
			<td>9</td>
			<td>営業時間</td>
			<td></td>
			<td>同上</td>
			<td>10時～20時</td>
		</tr>
		<tr>
			<td>10</td>
			<td>定休日</td>
			<td></td>
			<td>同上</td>
			<td>土日・祝日</td>
		</tr>
		<tr>
			<td>11</td>
			<td>クレジットカード</td>
			<td></td>
			<td>同上</td>
			<td>アメックス・JCB</td>
		</tr>
		<tr>
			<td>12</td>
			<td>設備</td>
			<td></td>
			<td>同上</td>
			<td>お風呂あり</td>
		</tr>
		<tr>
			<td>13</td>
			<td>スタッフ数</td>
			<td></td>
			<td>同上</td>
			<td>３名</td>
		</tr>
		<tr>
			<td>14</td>
			<td>駐車場</td>
			<td></td>
			<td>同上</td>
			<td>無し</td>
		</tr>
		<tr>
			<td>15</td>
			<td>こだわり条件</td>
			<td></td>
			<td>2048文字以内で入力</td>
			<td></td>
		</tr>
		<tr>
			<td>16</td>
			<td>備考</td>
			<td></td>
			<td>同上</td>
			<td></td>
		</tr>
		<tr>
			<td>17</td>
			<td>最寄り駅/バスetc</td>
			<td></td>
			<td>1024文字以内で入力</td>
			<td>新宿駅から徒歩３分</td>
		</tr>
		<tr>
			<td>18</td>
			<td>最寄り駅</td>
			<td></td>
			<td>正式な駅名を入力</td>
			<td>新宿駅</td>
		</tr>

		<tr>
			<td>19</td>
			<td>料金プラン(HTML)</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>20</td>
			<td>店舗からのひとこと</td>
			<td></td>
			<td>512文字以内で入力</td>
			<td></td>
		</tr>
		<tr>
			<td>21</td>
			<td>インタビュー動画URL</td>
			<td></td>
			<td>512文字以内で入力</td>
			<td></td>
		</tr>

		<tr>
			<td>22</td>
			<td>スクレイピングURL</td>
			<td></td>
			<td>512文字以内で入力</td>
			<td></td>
		</tr>
		<tr>
			<td>23</td>
			<td>店舗説明文 件名</td>
			<td></td>
			<td>256文字以内で入力</td>
			<td>脱毛ラブサロン新宿店では2万円で脱毛が可能</td>
		</tr>
		<tr>
			<td>24</td>
			<td>店舗説明文 内容</td>
			<td></td>
			<td></td>
			<td>メンズ脱毛サロンとして全身脱毛をはじめて導入。ヒゲパックプランや選べる3か所パックプランなどその他プランも充実！フラッシュ脱毛で、痛くない脱毛をお探しなら脱毛ラブサロン</td>
		</tr>
		<tr>
			<td>25</td>
			<td>アフィリエイトページURL</td>
			<td></td>
			<td>256文字以内で入力</td>
			<td></td>
		</tr>
		<tr>
			<td>26</td>
			<td>アフィリエイトバナーURL</td>
			<td></td>
			<td>256文字以内で入力</td>
			<td></td>
		</tr>
		<tr>
			<td>27</td>
			<td>脱毛部位</td>
			<td></td>
			<td>部位IDを半角数字で指定（複数入力可能）「&amp;」区切りで入力</td>
			<td>1&amp;2&amp;4&amp;5&amp;7</td>
		</tr>
		<tr>
			<td>28</td>
			<td>脱毛部位名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>29</td>
			<td>支払方法</td>
			<td></td>
			<td>支払い方法IDを半角数字で指定（複数入力可能）「&amp;」区切りで入力</td>
			<td>1&amp;3&amp;4&amp;5</td>
		</tr>
		<tr>
			<td>30</td>
			<td>支払方法名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>31</td>
			<td>特典・割引</td>
			<td></td>
			<td>特典・割引IDを半角数字で指定（複数入力可能）「&amp;」区切りで入力</td>
			<td>2&amp;4</td>
		</tr>
		<tr>
			<td>32</td>
			<td>特典・割引名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>33</td>
			<td>その他こだわり条件</td>
			<td></td>
			<td>その他こだわり条件IDを半角数字で指定（複数入力可能）「&amp;」区切りで入力</td>
			<td>2&amp;5&amp;11&amp;13&amp;15</td>
		</tr>
		<tr>
			<td>34</td>
			<td>その他こだわり条件名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>35</td>
			<td>価格</td>
			<td></td>
			<td>価格IDを半角数字で指定（複数入力可能）「&amp;」区切りで入力</td>
			<td>1&amp;3</td>
		</tr>
		<tr>
			<td>36</td>
			<td>価格名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>37</td>
			<td>表示フラグ</td>
			<td><span class="required-mark">○</span></td>
			<td>1 OR 2 を半角数字で指定 1=表示 2=非表示</td>
			<td>1</td>
		</tr>
		<tr>
			<td>38</td>
			<td>表示フラグ名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
	</table>
</div>