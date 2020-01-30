<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\PagingUtil;
use App\Vendor\Code\Sex;
use App\Vendor\Code\Satisfaction;
?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<div id="bread">
	<div class="inner cf">
		<span class="breaditem"><a href="<?=Router::url('/')?>"><span>TOP</span></a></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$brand['name']}</span>", ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']], ['escape'=> false])?></span>
		<span class="breaditem">口コミ一覧</span>
	</div>
</div>
<div id="container">
	<div class="inner">
		<div class="undercontentwrap cf">
			<main id="maincolumn">
				<div class="commonyellowbox">
					<div id="shopdetailwrap">
						<div class="leadwrap">
							<div id="brands_dt_reviews" class="listwrap reviews result_list">
								<h1 class="coomontit_h1"><?php echo $brand['name'];?>の評判・口コミ一覧【<?=count($reviews)?>件】</h1>
								<div class="reviewslist_wrap">
									<?php
									foreach ($reviews as $review) {
									?>
									<div class="itembox" id="review<?=$review['review_id']?>">
										<div class="titlearea cf">
											<div class="shopnamebox">
												<?=$this->Html->link($review['Shop']['name']. "[". Pref::convert($review['Shop']['pref'], CodePattern::$VALUE). "]",
													['controller'=> 'shops', 'action'=> 'detail', $review['Shop']['shop_id']])?>
											</div>
											<div class="titbox cf">
												<div class="usericon">
													<?php
													$imgPath = "/img/reviews_icon_";
													if ($review['sex'] == Sex::$MAN[CodePattern::$CODE]) {
														$imgPath .= Sex::$MAN[CodePattern::$VALUE2];
													} else {
														$imgPath .= Sex::$WOMAN[CodePattern::$VALUE2];
													}

													if ($review['evaluation'] < 3) {
														$imgPath .= "_b";
													} else if ($review['evaluation'] >= 3 && $review['evaluation'] < 4) {
														$imgPath .= "_n";
													} else {
														$imgPath .= "_g";
													}

													$imgPath .= ".png";

													echo $this->Html->image($imgPath, ['alt'=> $review['nickname']]);
													?>
												</div>
												<div class="namewrap">
													<div class="name"><?=$review['nickname']?></div>
													<div class="star_box">
														<div class="star-rating-box">
															<div class="empty-star">☆☆☆☆☆</div>
															<div class="filled-star" style=" width: <?=$review['evaluation'] * 20?>%;">★★★★★</div>
														</div>
														<span class="points"><?=$review['evaluation']?></span>
													</div>
												</div>
											</div>
											<ul class="snsarea cf">
												<?php if (!empty($review['instagram_account'])) {?>
												<li><a href="https://www.instagram.com/<?=$review['instagram_account']?>" target="_blank"><?php echo $this->Html->image('/img/auther_icon_inst.png', ['alt'=> ''])?></a></li>
												<?php }?>
												<?php if (!empty($review['twitter_account'])) {?>
												<li><a href="https://twitter.com/<?=$review['twitter_account']?>" target="_blank"><?php echo $this->Html->image('/img/auther_icon_twt.png', ['alt'=> ''])?></a></li>
												<?php }?>
												<li><a href="https://www.instagram.com/Instagram/" target="_blank"><img src="img/auther_icon_inst.png" alt=""/></a></li>
												<li><a href="https://twitter.com/Twitter" target="_blank"><img src="img/auther_icon_twt.png" alt=""/></a></li>
											</ul>
										</div>
										<div class="contentwrap">
											<div class="tit"><?=$review['title']?></div>
											<div class="txtarea"><?=$review['content']?></div>
											<div class="underbox cf">
												<div class="daycont">
													<?php
													echo !empty($review['visit_date']) ? "<span>来店日：". date('m/d', strtotime($review['visit_date'])). "</span>" : "";
													echo !empty($review['post_date']) ? "<span>投稿日：". date('m/d', strtotime($review['post_date'])). "</span>" : "";
													?>
												</div>
												<?php
												$isQuestion = false;
												for ($i=1; $i<=6; $i++) {
													$questionColumn = "question". $i;
													if (!empty($review[$questionColumn])) {
														$isQuestion = true;
														break;
													}
												}
												if ($isQuestion) {
												?>
												<div class="cntlbtn">
													<a href="" class="btn">評価をもっと見る</a>
												</div>
												<?php
												}
												?>
											</div>
											<div class="dolwcont">
												<ul>
													<?php
													if (!empty($review['question1'])) {
													?>
													<li class="cf">
														<p class="txt">
															治療前の説明は十分でしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?=Satisfaction::convert($review['question1'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question1'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													if (!empty($review['question2'])) {
													?>
													<li class="cf">
														<p class="txt">
															痛みへの配慮はいかがでしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?= Satisfaction::convert($review['question2'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question2'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													if (!empty($review['question3'])) {
													?>
													<li class="cf">
														<p class="txt">
															スタッフの態度、対応はいかがでしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?= Satisfaction::convert($review['question3'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question3'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													if (!empty($review['question4'])) {
													?>
													<li class="cf">
														<p class="txt">
															店舗の雰囲気、設備、清潔感はいかがでしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?= Satisfaction::convert($review['question4'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													if (!empty($review['question5'])) {
													?>
													<li class="cf">
														<p class="txt">
															待ち時間、予約対応はいかがでしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?= Satisfaction::convert($review['question5'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question5'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													if (!empty($review['question6'])) {
													?>
													<li class="cf">
														<p class="txt">
															術前、術中、術後の対応はいかがでしたか？
														</p>
														<div class="star_box">
															<div class="star-rating-box">
																<div class="empty-star">☆☆☆☆☆</div>
																<div class="filled-star" style=" width: <?= Satisfaction::convert($review['question6'], CodePattern::$VALUE2)?>%;">★★★★★</div>
															</div>
															<span class="points"><?= Satisfaction::convert($review['question6'], CodePattern::$VALUE)?></span>
														</div>
													</li>
													<?php
													}
													?>
												</ul>
												<div class="result_list">
													<div class="btn_box">
														<ul>
															<li class="btn orange">
																<?=$this->Html->link('<span>施設詳細へ</span>', ['controller'=> 'shops', 'action'=> 'detail', $review['Shop']['shop_id']], ['escape'=> false])?>
															</li>
															<?php
															if (!empty($review['Shop']['affiliate_page_url'])) {
															?>
															<li class="btn green">
																<a href="<?=$review['Shop']['affiliate_page_url']?>" class="green"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
																	公式サイトへ
																</a>
															</li>
															<?php
															}
															?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
									}
									?>
								</div>

								<div class="pager">
									<div class="pagenation pagenation-hover">
										<div class="pagenation-prev">
											<?php
											$getUrl = null;
											if (!empty($_GET)) {
												foreach ($_GET as $key => $get) {
													if ($key == "page") {
														continue;
													}
													$getUrl .= "&". $key. "=". $get;
												}
											}

											$this->Paginator->options(['url' => ['brand_id' => $brand['brand_id']]]);

											if ($this->Paginator->hasPrev()) {
												echo $this->Paginator->prev('前の20件', ['class'=> 'prev', 'tag'=> 'div']);
											}
											?>
										</div>
										<?php
										$pageCnt = $this->Paginator->param('pageCount');
										if ($pageCnt > 1) {
										?>
										<div class="pagenation-page-list-wrap">
											<ul class="pagenation-page-list-all">
												<li class="pagenation-page-list-current">
													<ul class="pagenation-page-list">
														<?php
														for($i=1; $i<=ceil($pageCnt/PagingUtil::FRON_PAGINATE); $i++) {
															if ($this->Paginator->current() <= $i*PagingUtil::FRON_PAGINATE) {
																$lineCnt = $i;
																break;
															}
														}

														$page = ($lineCnt-1)*PagingUtil::FRON_PAGINATE + 1;
														$maxPage = $lineCnt*PagingUtil::FRON_PAGINATE;

														for ($i=$page; $i<=$maxPage; $i++) {
															$url = Router::url(null,true). "?page={$i}".$getUrl;

															if ($i > $pageCnt) {
																echo "<span class='page-numbers'></span>";
															} else if ($i != $this->Paginator->current()) {
														?>
															<li class="page-numbers"><a href="<?=$url?>"><?=$i?></a></li>
														<?php
															} else {
																echo "<span class='page-numbers active'>{$i}</span>";
															}
														}
														?>
													</ul>
												</li>
												<?php
												if ($this->Paginator->current() > PagingUtil::FRON_PAGINATE) {
												?>
												<li class="pagenation-page-list-before">
													<ul class="pagenation-page-list">
														<?php
														$maxPage = $lineCnt*PagingUtil::FRON_PAGINATE-PagingUtil::FRON_PAGINATE;
														for ($i=1; $i<=$maxPage; $i++) {
															$url = Router::url(null,true). "?page={$i}".$getUrl;
														?>
															<li class="page-numbers"><a href="<?=$url?>"><?=$i?></a></li>
														<?php
														}
														?>
													</ul>
												</li>
												<?php
												}
												?>
												<li class="pagenation-page-list-after">
													<ul class="pagenation-page-list">
														<?php
														$page = ($lineCnt-1)*PagingUtil::FRON_PAGINATE + 1 + PagingUtil::FRON_PAGINATE;
														for ($i=$page; $i<=$pageCnt; $i++) {
															$url = Router::url(null,true). "?page={$i}".$getUrl;
														?>
															<li class="page-numbers"><a href="<?=$url?>"><?php echo $i?></a></li>
														<?php
														}
														?>
													</ul>
												</li>
											</ul>
										</div>

										<?php
										}
										?>
										<div class="pagenation-next">
											<?php
											if ($this->Paginator->hasNext()) {
												echo $this->Paginator->next('次の20件', ['class'=> 'next', 'tag'=> false]);
											}
											?>
										</div>
									</div>
								</div>
								<div class="result_list">
									<div class="btn_box">
										<ul>
											<li class="btn orange"><?=$this->Html->link('<span>ブランドTOPへ</span>', ['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']], ['escape'=> false]);?>
											<?php if (!empty($brand['affiliate_page_url'])) {?>
											</li><li class="btn green"><a href="<?=$brand['affiliate_page_url']?>" class="green" >公式サイトへ</a></li>
											<?php }?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?= $this->element('Front/SearchResult/side')?>
		</div>
	</div>
</div>
<?php if (!empty($brand['affiliate_page_url'])) {?>
<div id="dtfixbtnarea">
	<a href="<?=$brand['affiliate_page_url']?>" class="green" >公式サイトへ</a>
</div>
<?php }?>
