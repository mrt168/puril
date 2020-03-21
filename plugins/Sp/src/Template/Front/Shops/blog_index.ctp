<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\PagingUtil;
?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<div id="bread">
	<div class="inner cf">
		<span class="breaditem"><a href="<?=Router::url('/')?>"><span>TOP</span></a></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>全国の脱毛施設</span>", ['controller'=> 'searchs'], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>全国の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['name']}</span>", ['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']], ['escape'=> false]);?></span>
		<span class="breaditem">ブログ</span>
	</div>
</div>
<div id="container">
	<div class="inner">
		<div class="undercontentwrap cf">
			<main id="maincolumn">
				<div class="commonyellowbox">
					<div id="shopdetailwrap">
						<div class="leadwrap">
							<div id="shop_dt_blog" class="listwrap shopblog result_list">
								<h1 class="coomontit_h1"><?php echo $shop['name'];?>のブログ一覧</h1>
								<div class="shopblogarea list">
									<?php
									foreach ($blogs as $blog) {
										$url = Router::url(['controller'=> 'shops', 'action'=> 'blogDetail', 'shop_id'=> $blog['shop_id'], $blog['blog_id']]);
									?>
									<a href="<?=$url?>" class="blogbox cf">
										<div class="imgbox">
											<?php
											echo $this->Html->image(['controller'=> 'images', 'action'=> 'blogImage', $blog['blog_id']], ['alt'=> '']);
											?>
										</div>
										<div class="textbox">
											<div class="day"><?php echo !empty($blog['date']) ? date('Y.m.d', strtotime($blog['date'])) : null?></div>
											<div class="tit"><?php echo $blog['title']?></div>
											<div class="txt"><?php echo mb_strimwidth($blog['content'], 0, 150, "...", "UTF-8" );?></div>
										</div>
									</a>
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

								<?php
								/**
								?>
								<div class="pager">
									<div class="pagenation pagenation-hover">
										<div class="pagenation-prev">
											<a rel="prev" class="prev" href="">前の20件</a>
										</div>
										<div class="pagenation-page-list-wrap">
											<ul class="pagenation-page-list-all">
												<li class="pagenation-page-list-current">
													<ul class="pagenation-page-list">
														<span class="page-numbers active">1</span>
														<li class="page-numbers"><a href="">2</a></li>
														<li class="page-numbers"><a href="">3</a></li>
														<li class="page-numbers"><a href="">4</a></li>
														<li class="page-numbers"><a href="">5</a></li>
														<li class="page-numbers"><a href="">6</a></li>
														<li class="page-numbers"><a href="">7</a></li>
													</ul>
												</li>
												<li class="pagenation-page-list-after">
													<ul class="pagenation-page-list">
														<li class="page-numbers"><a href="">8</a></li>
														<li class="page-numbers"><a href="">9</a></li>
														<li class="page-numbers"><a href="">10</a></li>
													</ul>
												</li>
											</ul>
										</div>
										<div class="pagenation-next">
											<a rel="next" class="next" href="">次の20件</a>
										</div>
									</div>
								</div>
								*/?>

							</div>
						</div>
					</div>
				</div>
			</main>
			<?= $this->element('Front/SearchResult/side')?>
		</div>
	</div>
</div>