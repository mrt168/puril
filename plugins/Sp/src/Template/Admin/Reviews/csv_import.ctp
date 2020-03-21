<div class="header"><h1 class="page-title">口コミCSVインポート</h1></div>
<ul class="nav nav-tabs">
  <li class="active"><a href="#maint" data-toggle="tab">店舗CSVインポート</a></li>
</ul>
<div class="row">
	<div class="col-md-4">
		<br>
		<?php
		echo $this->Flash->render();
		echo $this->ExForm->create('Reviews', array('url'=> array('action'=> 'csv_import'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="main">
				<div class="form-group">
				<label>CSVファイル<span class="required-mark">※</span></label>
					<?php
					echo $this->ExForm->file('Reviews.csv_file');
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
<span class="required-mark">※赤字のものは未記入の場合に設定されるデータ</span><br>
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
			<td>店舗ID</td>
			<td><span class="required-mark">○</span></td>
			<td>店舗IDを指定してください</td>
			<td>2031</td>
		</tr>
		<tr>
			<td>2</td>
			<td>店舗名</td>
			<td></td>
			<td><font color="#F78181">インポートの際はスルー</font></td>
			<td></td>
		</tr>
		<tr>
			<td>3</td>
			<td>ID</td>
			<td></td>
			<td>数値で入力</td>
			<td>1234</td>
		</tr>
		<tr>
			<td>4</td>
			<td>評価</td>
			<td><span class="required-mark">○</span></td>
			<td>0～5までの0.5区切りで入力</td>
			<td>3.5</td>
		</tr>
		<tr>
			<td>5</td>
			<td>治療前の説明は十分でしたか？</td>
			<td></td>
			<td>1～5の数値を入力</td>
			<td>3</td>
		</tr>
		<tr>
			<td>6</td>
			<td>痛みへの配慮はいかがでしたか？</td>
			<td></td>
			<td>同上</td>
			<td>2</td>
		</tr>
		<tr>
			<td>7</td>
			<td>スタッフの態度、対応はいかがでしたか？</td>
			<td></td>
			<td>同上</td>
			<td>4</td>
		</tr>
		<tr>
			<td>8</td>
			<td>店舗の雰囲気、設備、清潔感はいかがでしたか？</td>
			<td></td>
			<td>同上</td>
			<td>3</td>
		</tr>
		<tr>
			<td>9</td>
			<td>待ち時間、予約対応はいかがでしたか？</td>
			<td></td>
			<td>同上</td>
			<td>2</td>
		</tr>
		<tr>
			<td>10</td>
			<td>術前、術中、術後の対応はいかがでしたか？</td>
			<td></td>
			<td>同上</td>
			<td>2</td>
		</tr>
		<tr>
			<td>11</td>
			<td>氏名(ニックネーム)</td>
			<td><span class="required-mark">○</span></td>
			<td>30文字以内で入力してください。</td>
			<td>テスト太郎</td>
		</tr>
		<tr>
			<td>12</td>
			<td>年齢</td>
			<td><span class="required-mark">○</span></td>
			<td>15～65の数値を入力</td>
			<td>35</td>
		</tr>
		<tr>
			<td>13</td>
			<td>性別</td>
			<td><span class="required-mark">○</span></td>
			<td>1 OR 2を入力 1=男性 2=女性</td>
			<td>1</td>
		</tr>
		<tr>
			<td>14</td>
			<td>Instagramアカウント</td>
			<td></td>
			<td>256文字以内で入力してください。</td>
			<td></td>
		</tr>
		<tr>
			<td>15</td>
			<td>Twitterアカウント</td>
			<td></td>
			<td>256文字以内で入力してください。</td>
			<td></td>
		</tr>
		<tr>
			<td>16</td>
			<td>投稿日</td>
			<td></td>
			<td>YYYY/mm/dd 00:00:00 で入力</td>
			<td>2018/12/15 00:00:00</td>
		</tr>
		<tr>
			<td>17</td>
			<td>来店日</td>
			<td></td>
			<td>YYYY/mm/dd 00:00:00 で入力</td>
			<td>2018/12/15 0:00:00</td>
		</tr>
		<tr>
			<td>18</td>
			<td>口コミ タイトル</td>
			<td><span class="required-mark">○</span></td>
			<td>256文字以内で入力</td>
			<td>脱毛と同時に肌ケア効果！</td>
		</tr>
		<tr>
			<td>19</td>
			<td>口コミ 本文</td>
			<td><span class="required-mark">○</span></td>
			<td></td>
			<td>脱毛を受けるようになってから、毛穴が小さくなって肌がキレイになってきました。脱毛しながらエステに通ってるように肌への効果がみられるのは嬉しいです。駅からのアクセスは良く、スタッフさんも優しいです。</td>
		</tr>
		<tr>
			<td>20</td>
			<td>表示フラグ</td>
			<td><span class="required-mark">○</span></td>
			<td>1 OR 2を入力 1=表示 2=非表示</td>
			<td>1</td>
		</tr>
	</table>
</div>