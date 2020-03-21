<?php
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ShowFlg;
?>
<div class="header"><h1 class="page-title">口コミ登録</h1></div>
<div class="row">
	<div class="col-md-4">
		<?php
		echo $this->Flash->render();
		if (empty($review)) {
			$review = "Review";
		}
		echo $this->ExForm->create($review, array('url'=> array('action'=> 'edit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
					<label><?php echo $this->Html->link('店舗', array('controller'=> 'reviews', 'action'=> 'extraction'), array('id'=> 'popup_station_cd'));?></label><br>
					<?php
					echo $this->ExForm->text('Reviews.shop_name', array('id'=> 'shop_name', 'class'=> 'form-control', 'readonly'=> true));
					echo $this->ExForm->hidden('Reviews.shop_id', array('id'=> 'shop_id', 'class'=> 'form-control'));
					echo $this->ExForm->error('Reviews.shop_id');
					?>
				</div>
				<div class="form-group">
					<label>評価<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Reviews.evaluation', array('id'=> 'evaluation', 'class'=> 'form-control inline', 'style'=> 'width: 80px;'));
					echo $this->ExForm->error('Reviews.evaluation');
					?>
				</div>
				<hr>
				<div class="form-group">
					<label>店舗の「接客／サービス」はいかがでしたか？</label><br>
					<?php
					echo $this->ExForm->satisfaction('Reviews.question1', array('id'=> 'question1', 'type'=> 'radio'));
					echo $this->ExForm->error('Reviews.question1');
					?>
                    <?php
                    echo $this->ExForm->textarea('Reviews.question1_evaluation', array('id'=> 'question1_evaluation', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.question1_evaluation');
                    ?>
				</div>
				<div class="form-group">
					<label>受けたサービスの「メニューや料金」についてはいかがでしたか？</label><br>
					<?php
					echo $this->ExForm->satisfaction('Reviews.question2', array('id'=> 'question2', 'type'=> 'radio'));
					echo $this->ExForm->error('Reviews.question2');
					?>

                    <?php
                    echo $this->ExForm->textarea('Reviews.question2_evaluation', array('id'=> 'question2_evaluation', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.question2_evaluation');
                    ?>
				</div>
				<div class="form-group">
					<label>施術の「効果（技術や仕上がり）」はいかがでしたか？</label><br>
					<?php
					echo $this->ExForm->satisfaction('Reviews.question3', array('id'=> 'question3', 'type'=> 'radio'));
					echo $this->ExForm->error('Reviews.question3');
					?>
                    <?php
                    echo $this->ExForm->textarea('Reviews.question3_evaluation', array('id'=> 'question3_evaluation', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.question3_evaluation');
                    ?>
				</div>
				<div class="form-group">
					<label>店舗の「雰囲気」はいかがでしたか？</label><br>
					<?php
					echo $this->ExForm->satisfaction('Reviews.question4', array('id'=> 'question4', 'type'=> 'radio'));
					echo $this->ExForm->error('Reviews.question4');
					?>
                    <?php
                    echo $this->ExForm->textarea('Reviews.question4_evaluation', array('id'=> 'question4_evaluation', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.question4_evaluation');
                    ?>
				</div>
				<div class="form-group">
					<label>店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</label><br>
					<?php
					echo $this->ExForm->satisfaction('Reviews.question5', array('id'=> 'question5', 'type'=> 'radio'));
					echo $this->ExForm->error('Reviews.question5');
					?>
                    <?php
                    echo $this->ExForm->textarea('Reviews.question5_evaluation', array('id'=> 'question5_evaluation', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.question5_evaluation');
                    ?>
				</div>
				<hr>
				<div class="form-group">
					<label>氏名(ニックネーム)<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Reviews.nickname', array('id'=> 'nickname', 'class'=> 'form-control'));
					echo $this->ExForm->error('Reviews.nickname');
					?>
				</div>
				<div class="form-group">
					<label>生年月日<span class="required-mark">※</span></label><br>
                    <?php
                    echo $this->ExForm->text('Reviews.birthday', array('class'=> 'form-control inline datetimepicker', 'style'=>'width: 40%'));
                    echo $this->ExForm->error('Reviews.birthday');
                    ?>
				</div>
				<div class="form-group">
					<label>性別<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->sex('Reviews.sex', array('id'=> 'sex', 'type'=> 'radio', 'default'=> Sex::$MAN[CodePattern::$CODE]));
					echo $this->ExForm->error('Reviews.sex');
					?>
				</div>
				<div class="form-group">
					<label>投稿日</label><br>
					<?php
					echo $this->ExForm->text('Reviews.post_date', array('class'=> 'form-control inline datetimepicker', 'style'=>'width: 40%'));
					echo $this->ExForm->error('Reviews.post_date');
					?>
				</div>
				<div class="form-group">
					<label>来店日</label><br>
					<?php
					echo $this->ExForm->text('Reviews.visit_date', array('class'=> 'form-control inline datetimepicker', 'style'=>'width: 40%'));
					echo $this->ExForm->error('Reviews.visit_date');
					?>
				</div>
				<div class="form-group">
					<label>受けた施術等の名前<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Reviews.title', array('id'=> 'title', 'class'=> 'form-control'));
					echo $this->ExForm->error('Reviews.title');
					?>
				</div>
				<div class="form-group">
					<label>この店舗の総合的な感想を、50文字程度で感想を教えてください。<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->textarea('Reviews.content', array('id'=> 'content', 'class'=> 'form-control'));
					echo $this->ExForm->error('Reviews.content');
					?>
				</div>
                <div class="form-group">
                    <label>この店舗を選んだ理由を教えてください。</label><br>
                    <?php
                    echo $this->ExForm->textarea('Reviews.reason', array('id'=> 'content', 'class'=> 'form-control'));
                    echo $this->ExForm->error('Reviews.reason');
                    ?>
                </div>
				<div class="form-group">
					<label>表示フラグ</label><br>
					<?php
					echo $this->ExForm->showFlg('Reviews.show_flg', array('type'=> 'radio', 'default'=> ShowFlg::$SHOW[CodePattern::$CODE]));
					echo $this->ExForm->error('Reviews.show_flg');
					?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Reviews.review_id');
			if (isset($this->request->data['Reviews']['review_id']) && !empty($this->request->data['Reviews']['review_id'])) {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			} else {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			}
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>

<script>
$(function() {
	$('#popup_station_cd').click(function() {
		window.open($(this).attr('href'), 'subwin', 'width=800,height=600');
		return false;
	});
})
</script>
