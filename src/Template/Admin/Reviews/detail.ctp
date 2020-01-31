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
				<th>生年月日</th>
				<td><?php echo $review['birthday']?></td>
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
				<th>受けた施術等の名前</th>
				<td><?php echo $review['title']?></td>
			</tr>
			<tr>
				<th>この店舗の総合的な感想を、20文字程度で感想を教えてください。</th>
				<td><?php echo nl2br($review['content'])?></td>
			</tr>

			<tr>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th rowspan="2">店舗の「接客／サービス」はいかがでしたか？</th>
				<td><?php echo $review['question1']?></td>
			</tr>
            <tr>
                <td><?php echo $review['question1_evaluation']?></td>
            </tr>
			<tr>
				<th rowspan="2">受けたサービスの「メニューや料金」についてはいかがでしたか？</th>
				<td><?php echo $review['question2']?></td>
			</tr>
            <tr>
                <td><?php echo $review['question2_evaluation']?></td>
            </tr>
			<tr>
				<th rowspan="2">施術の「効果（技術や仕上がり）」はいかがでしたか？</th>
				<td><?php echo $review['question3']?></td>
			</tr>
            <tr>
                <td><?php echo $review['question3_evaluation']?></td>
            </tr>
			<tr>
				<th rowspan="2">店舗の「雰囲気」はいかがでしたか？</th>
				<td><?php echo $review['question4']?></td>
			</tr>
            <tr>
                <td><?php echo $review['question4_evaluation']?></td>
            </tr>
			<tr>
				<th rowspan="2">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</th>
				<td><?php echo $review['question5']?></td>
			</tr>
            <tr>
                <td><?php echo $review['question5_evaluation']?></td>
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

