<?php
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title">口コミの詳細画面</h1></div>
<?php
echo $this->Flash->render();
echo $this->Html->link('<i class="fa fa-chevron-left"></i> 一覧に戻る', ['controller'=> 'shops', 'action'=> 'index'], array('class'=> 'btn btn-primary', 'escape'=> false));
?>
<div class="row">
	<div class="col-md-7">
		<table class="table">
			<tr>
				<th width=350>ID</th>
				<td><?php echo $review['review_id']?></td>
			</tr>
			<tr>
				<th>店名</th>
				<td><?php echo $review['Shop']['name']?></td>
			</tr>
			<tr>
				<th>評価</th>
				<td><?php echo $review['evaluation']?></td>
			</tr>
			<tr>
				<th>氏名(ニックネーム)</th>
				<td><?php echo $review['nickname']?></td>
			</tr>
			<tr>
				<th>年齢</th>
				<td><?php echo $review['age']?>歳</td>
			</tr>
			<tr>
				<th>性別</th>
				<td><?php echo $review['sex']?></td>
			</tr>
			<tr>
				<th>Instagramアカウント</th>
				<td><?php echo $review['instagram_account']?></td>
			</tr>
			<tr>
				<th>Twitterアカウント</th>
				<td><?php echo $review['twitter_account']?></td>
			</tr>
			<tr>
				<th>口コミ タイトル</th>
				<td><?php echo $review['title']?></td>
			</tr>
			<tr>
				<th>口コミ 本文</th>
				<td><?php echo nl2br($review['content'])?></td>
			</tr>

			<tr>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th>治療前の説明は十分でしたか？</th>
				<td><?php echo $review['question1']?></td>
			</tr>
			<tr>
				<th>痛みへの配慮はいかがでしたか？</th>
				<td><?php echo $review['question2']?></td>
			</tr>
			<tr>
				<th>スタッフの態度、対応はいかがでしたか？</th>
				<td><?php echo $review['question3']?></td>
			</tr>
			<tr>
				<th>店舗の雰囲気、設備、清潔感はいかがでしたか？</th>
				<td><?php echo $review['question4']?></td>
			</tr>
			<tr>
				<th>待ち時間、予約対応はいかがでしたか？</th>
				<td><?php echo $review['question5']?></td>
			</tr>
			<tr>
				<th>術前、術中、術後の対応はいかがでしたか？</th>
				<td><?php echo $review['question6']?></td>
			</tr>
			<tr>
				<th></th>
				<td>
					<?php
					echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'reviews', 'action'=> 'moveEdit', $review['review_id']), array('class'=> 'btn btn-primary', 'escape'=> false));
					echo '&nbsp;&nbsp;&nbsp;';
					echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'reviews', 'action'=> 'delete', $review['review_id']), array('class'=> 'btn btn-primary', 'escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>

