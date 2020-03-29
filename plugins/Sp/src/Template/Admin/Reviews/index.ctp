<?php
use App\Vendor\Messages;
use Cake\Routing\Router;
use App\Vendor\StringUtil;
use App\Vendor\Constants;
use App\Vendor\Code\UserStatus;
use App\Vendor\Code\CodePattern;
?>
<div class="header"><h1 class="page-title">口コミ一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<div class="btn-toolbar list-toolbar">
	<?php
	echo $this->ExForm->create('Reviews', array('url'=> array('action'=> 'search'), 'type'=> 'post'));

	$showClass = '';
	foreach ($wheres as $where) {
		if (!StringUtil::isEmpty($where)) {
			$showClass = 'in';
			break;
		}
	}
	?>
	<div class="panel panel-default">
		<a href="#page-stats" class="panel-heading" data-toggle="collapse">絞り込み</a>
		<div id="page-stats" class="panel-collapse panel-body collapse <?php echo $showClass?>" style="height: auto;">
			<?php
			echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
			<div  class='form-group'>
			<table class="table">
				<tr>
					<td width="15%">ID</td>
					<td width="35%">
						<?php
						echo $this->ExForm->text('Reviews.review_id_from', array('class'=> 'form-control inline', 'style'=>'width: 40%'));
						echo ' ～ ';
						echo $this->ExForm->text('Reviews.review_id_to', array('class'=> 'form-control inline', 'style'=>'width: 40%'));
						?>
					</td>
					<td width="15%">店舗名<span class="attention">部分一致</span></td>
					<td width="35%"><?php echo $this->ExForm->text('Reviews.shop_name', array('class'=> 'form-control inline')); ?></td>
				</tr>
			</table>
			</div>
			<?php
			echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
	</div>
	<?php
	echo $this->ExForm->end();
	?>
</div>


<?php
if (!empty($reviews)) {
	echo $this->Paginator->counter('<p>(<span>{{count}} 件中 </span> <span>{{start}}件～{{end}}件</span> を表示)');
?>
<ul class="pagination">
	<?php
	if ($this->Paginator->hasPrev()) {
		echo $this->Paginator->prev('<<', array('rel'=> 'prev', 'class'=> 'prev', 'tag'=> 'li'));
	}
	echo $this->Paginator->numbers(array('separator'=> false, 'tag'=> 'li'));
	if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next('>>', array('rel'=> 'next', 'class'=> 'next', 'tag'=> 'li'));
	}
	?>
</ul>
<div>
<?php
echo $this->Html->link('CSV EXPORT', ['controller'=> 'reviews', 'action'=> 'csvExport'], ['class'=> 'btn btn-primar'])
?>
</div>
<table class="table">
	<thead>
		<tr>
			<th width="50"><?php echo $this->Paginator->sort('Reviews.review_id', 'ID', ['direction' => 'desc']);?></th>
			<th width="120">店舗</th>
			<th width="120">評価</th>
			<th width="120">来店日</th>
			<th width="120">投稿日</th>
			<th width="120">更新日</th>
			<th width="120">表示フラグ</th>
			<th style="width: 4.0em;"></th>
		</tr>
	</thead>
	<tbody class='trhover'>
		<?php
		foreach ($reviews as $review) {
		?>
		<tr>
			<td>
				<?php
				echo $this->Html->link($review['review_id'], array('controller'=> 'reviews', 'action'=> 'detail', $review['review_id']), array('class'=> 'btn btn-primary'));
				?>
			</td>
			<td><?php echo $review['Shop']['name']?></td>
			<td><?php echo $review['evaluation']?></td>
			<td><?php echo $review['visit_date']?></td>
			<td><?php echo $review['post_date']?></td>
			<td><?php echo $review['modified']?></td>
			<td><?php echo $review['show_flg']?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'reviews', 'action'=> 'moveEdit', $review['review_id']), array('escape'=> false));
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'reviews', 'action'=> 'delete', $review['review_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
				?>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>

<ul class="pagination">
	<?php
	if ($this->Paginator->hasPrev()) {
		echo $this->Paginator->prev('<<', array('rel'=> 'prev', 'class'=> 'prev', 'tag'=> 'li'));
	}
	echo $this->Paginator->numbers(array('separator'=> false, 'tag'=> 'li'));
	if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next('>>', array('rel'=> 'next', 'class'=> 'next', 'tag'=> 'li'));
	}
	?>
</ul>
<?php
	echo $this->Paginator->counter('<p>(<span>{{count}} 件中 </span> <span>{{start}}件～{{end}}件</span> を表示)');
} else {
	echo '<div class="attention">口コミが登録されていません</div>';
}
?>
