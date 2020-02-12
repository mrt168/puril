<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\DepilationType;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>
<!-- <?php var_dump($brand);?>-->
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/brand/common', 'datsumou/brand/index']);
?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<nav class="content-base brand-breadcrumbs">
      <ul class="brand-breadcrumbs-list">
        <li><a href="/datsumou/">Top</a></li>
        <li><?=$brand['name']?></li>
      </ul>
    </nav>
<header class="brand-header">
      <div class="brand-header-inner"><a class="brand-header-back" href="/datsumou/"><i class="fas fa-chevron-left"></i></a>
        <div class="brand-header-title"><?=$brand['name']?></div>
        <div class="brand-header-void"></div>
      </div>
    </header>
<nav class="content-base brand-breadcrumbs">
      <ul class="brand-breadcrumbs-list">
        <li><a href="<?=Router::url('/')?>">Purilトップ</a></li>
        <li><?php echo $this->Html->link("<span>店舗名から探す</span>", ['controller'=> 'brands'], ['escape'=> false])?></li>
        <li><?=$brand['name']?></li>
      </ul>
    </nav>
<nav class="content brand-nav">
      <div class="brand-nav-item active" data-content="brand-top"><span class="brand-nav-item-text">トップ</span></div>
      <div class="brand-nav-item" data-content="brand-plan"><span class="brand-nav-item-text">料金プラン</span></div>
      <div class="brand-nav-item" data-content="brand-datsumou"><span class="brand-nav-item-text">脱毛部位</span></div>
      <div class="brand-nav-item" data-content="brand-kuchikomi"><span class="brand-nav-item-text">口コミ</span></div>
      <div class="brand-nav-item" data-content="brand-campaign"><span class="brand-nav-item-text">キャンペーン</span></div>
      <div class="brand-nav-item" data-content="brand-shop"><span class="brand-nav-item-text">運営店舗</span></div>
    </nav>
<section class="content brand-top">
      <div class="brand-top-img-area">
      <div class="brand-top-img-base"><img class="brand-top-img" src="https://datsumou.love/shop_img/366" alt="<?=$brand['name']?>"></div>
      </div>
      <div class="brand-top-desc-area">
        <div class="brand-top-desc-category">脱毛サロン・全身</div>
        <div class="brand-top-desc-middle">
          <div class="brand-top-desc-review">
            <div class="shop-star-area">
              <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
              </div>
              <div class="shop-point">4.6</div>
            </div>
            <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
              <div class="shop-comment-count">142件</div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="content middle-content brand-info">
      <h2 class="content-title">店舗情報</h2>
      <p class="content-feature"><span>最大</span><span class="content-feature-large">5,000</span><span>円のキャッシュバックあり！</span></p>
      <h3 class="content-title-sub">業界口コミ＆予約が取りやすい脱毛サロンNo.1</h3>
      <p class="content-text">タレントやモデルの来店多数で業界口コミNo.1！スリムアップ美容全身脱毛で脱毛しながら美しいボディラインを実現します。予約も取りやすいから忙しくても通いやすい♪キレイモ一号店でありプロフェッショナルのスタッフが、お客様のキレイのために全力でサポートしていますよ！各線「新宿駅」から近く便利◎</p>
    </section>
    <section class="content middle-content brand-plan">
      <h2 class="content-title">料金プラン</h2>
<div>
    <table class="price_list">
        <tbody>
            <tr>
                <th>月額定額プラン　スリムアップ脱毛</th>
                <td class="price">4,800円</td>
                <td> </td>
            </tr>
</tbody>
</table>
</div>
<!--
      <ul class="brand-plan-line">
        <li class="brand-plan-line-item-wrap"><a class="clickable-button brand-plan-line-item" href="#"><img class="brand-plan-line-item-img" src="/puril/images/img/datsumou/brand/slimplan.jpg" alt="スリムアップ脱毛">
            <div class="brand-plan-line-item-desc">
              <div class="brand-plan-lin-item-desc-title">月額定額プラン　スリムアップ脱毛</div>
              <div class="brand-plan-lin-item-desc-price">
                <div class="brand-plan-lin-item-desc-price-amount">4,800円</div>
                <div class="brand-plan-lin-item-desc-price-tax">（税抜）</div>
              </div><i class="fas fa-chevron-right brand-plan-lin-item-desc-arrow"></i>
            </div></a></li>
      </ul><a class="show-more clickable-button" href="#">プランをもっと見る（4件）</a>
-->
    </section>
    <section class="content middle-content brand-datsumou">
          <h2 class="content-title">脱毛部位</h2>
          <ul class="brand-part-list">
            <li class="brand-part-common brand-part-active">全身</li>
          </ul>
    </section>
<section class="content middle-content brand-kuchikomi">
      <h2 class="content-title">口コミ</h2>
      <ul class="brand-kuchikomi-list">
<!--
        <li class="brand-kuchikomi-item brand-kuchikomi-item-pickup">
          <div class="brand-kuchikomi-item-pickup-wrap">
            <div class="brand-kuchikomi-item-pickup-text">Purilが選ぶピックアップ！口コミ</div>
            <div class="brand-kuchikomi-item-pickup-star"><img src="/puril/images/img/datsumou/ribbon-star.png"></div>
          </div>
-->
        <li class="brand-kuchikomi-item">
          <div class="brand-kuchikomi-item-wrap">
            <div class="brand-kuchikomi-item-above">
              <div class="brand-kuchikomi-title">キレイモ 新宿本店</div>
              <!--<div class="brand-kuchikomi-title-sub">スタッフが一番よかった。</div>-->
              <div class="brand-user-star-area">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
              </div>
              <div class="shop-reviewer-area">
                <div class="shop-reviewer-name-area">
                  <div class="shop-reviewer-name">yazawasuzu0127</div>
                  <div class="shop-reviewer-count">（4,878）</div>
                </div>
                <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                  <div class="shop-reviewer-good-count">24件</div>
                </div>
              </div>
              <div class="brand-kuchikomi-month">2020/01/18(土)</div><i class="fas fa-chevron-down brand-kuchikomi-arrow"></i>
            </div>
            <div class="brand-kuchikomi-item-below">
              <div class="brand-kuchikomi-item-detail">
                <p>腕と脚の毛の脱毛はしていなかったのでカミソリで自己処置をしていました。</p>
                <p>カミソリを使うことでポツポツして痒くなったり、翌日にはすぐに生えてくるのでチクチクしていました。</p>
                <p>脱毛はずっとしたいと思っていたので、ネットで検索してスリムアップ効果もできる脱毛、キレイモで施術することに決めて通い始めました。</p>
                <p>まだスリムの効果はわからないですが、自己処理していたストレスは軽減しています。そしてローションのおかげで肌はスベスベで彼氏には褒められます。スタッフさんはテキパキ施術をしてくれるので不安はないです。</p>
              </div>
              <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                  <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                  <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
            </div>
          </div>
        </li>
        <li class="brand-kuchikomi-item brand-kuchikomi-item-wrap">
          <div class="brand-kuchikomi-item-above">
            <div class="brand-kuchikomi-title">キレイモ 新宿本店</div>
            <!--<div class="brand-kuchikomi-title-sub">ストレスフリー</div>-->
            <div class="brand-user-star-area">
              <div class="shop-star-area">
                <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                </div>
                <div class="shop-point">4.6</div>
              </div>
            </div>
            <div class="shop-reviewer-area">
              <div class="shop-reviewer-name-area">
                <div class="shop-reviewer-name">yazawasuzu0127</div>
                <div class="shop-reviewer-count">（4,878）</div>
              </div>
              <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                <div class="shop-reviewer-good-count">24件</div>
              </div>
            </div>
            <div class="brand-kuchikomi-month">投稿日：01/18</div><i class="fas fa-chevron-down brand-kuchikomi-arrow"></i>
          </div>
          <div class="brand-kuchikomi-item-below">
            <div class="brand-kuchikomi-item-detail">
              <p>腕と脚の毛の脱毛はしていなかったのでカミソリで自己処置をしていました。</p>
              <p>カミソリを使うことでポツポツして痒くなったり、翌日にはすぐに生えてくるのでチクチクしていました。</p>
              <p>脱毛はずっとしたいと思っていたので、ネットで検索してスリムアップ効果もできる脱毛、キレイモで施術することに決めて通い始めました。</p>
              <p>まだスリムの効果はわからないですが、自己処理していたストレスは軽減しています。そしてローションのおかげで肌はスベスベで彼氏には褒められます。スタッフさんはテキパキ施術をしてくれるので不安はないです。</p>
            </div>
            <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
          </div>
        </li>
        <li class="brand-kuchikomi-item brand-kuchikomi-item-wrap">
          <div class="brand-kuchikomi-item-above">
            <div class="brand-kuchikomi-title">キレイモ 新宿本店</div>
            <div class="brand-kuchikomi-title-sub">周りを気にせず施術が受けられる。</div>
            <div class="brand-user-star-area">
              <div class="shop-star-area">
                <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                </div>
                <div class="shop-point">4.6</div>
              </div>
            </div>
            <div class="shop-reviewer-area">
              <div class="shop-reviewer-name-area">
                <div class="shop-reviewer-name">yazawasuzu0127</div>
                <div class="shop-reviewer-count">（4,878）</div>
              </div>
              <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                <div class="shop-reviewer-good-count">24件</div>
              </div>
            </div>
            <div class="brand-kuchikomi-month">2020/01/18(土)</div><i class="fas fa-chevron-down brand-kuchikomi-arrow"></i>
          </div>
          <div class="brand-kuchikomi-item-below">
            <div class="brand-kuchikomi-item-detail">
              <p>腕と脚の毛の脱毛はしていなかったのでカミソリで自己処置をしていました。</p>
              <p>カミソリを使うことでポツポツして痒くなったり、翌日にはすぐに生えてくるのでチクチクしていました。</p>
              <p>脱毛はずっとしたいと思っていたので、ネットで検索してスリムアップ効果もできる脱毛、キレイモで施術することに決めて通い始めました。</p>
              <p>まだスリムの効果はわからないですが、自己処理していたストレスは軽減しています。そしてローションのおかげで肌はスベスベで彼氏には褒められます。スタッフさんはテキパキ施術をしてくれるので不安はないです。</p>
            </div>
            <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
          </div>
        </li>
      </ul>
<!--<a class="show-more clickable-button" href="#">口コミをもっと見る（4件）</a>-->
    </section>
<section class="content middle-content brand-info-detail">
      <div class="brand-info-detail-area-wrap">
        <div class="brand-info-detail-area">
          <h3 class="brand-info-detail-title">料金プラン</h3>
          <table class="brand-info-detail-table">
            <tbody>
              <tr>
                <th>月額定額プラン</th>
                <td>
                  <dd>
                    <p>スリムアップ脱毛…月額9,500円(税抜)</p>
                    <p>脱毛部位：全身</p>
                  </dd>
                  <dd>
                    <p>プレミアム美白脱毛…月額12,800円(税抜)</p>
                    <p>脱毛部位：全身</p>
                  </dd>
                </td>
              </tr>
              <tr>
                <th>パックプラン</th>
                <td>
                  <dd>
                    <p>6回…114,000円(税抜)</p>
                    <p>脱毛部位：全身　回数：6回</p>
                  </dd>
                  <dd>
                    <p>12回…212,040円(税抜)</p>
                    <p>脱毛部位：全身　回数：12回</p>
                  </dd>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="brand-info-detail-area">
          <h3 class="brand-info-detail-title">特徴・関連情報</h3>
          <table class="brand-info-detail-table">
            <tbody>
              <tr>
                <th>ホームページ</th>
                <td><a href="https://kireimo.jp/lp181019/?adcode=aaaf_06&amp;hc_uus=750da4f43047826f16d914aaed697ee6">https://kireimo.jp/lp181019/?adcode=aaaf_06&amp;hc_uus=750da4f43047826f16d914aaed697ee6</a></td>
              </tr>
              <tr>
                <th>公式アカウント</th>
                <td><a href="#"><i class="fab fa-twitter twitter-icon"></i></a></td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>0120-444-680</td>
              </tr>
              <tr>
                <th>備考</th>
                <td>※備考ダミー備考ダミー備考ダミー備考ダミー備考備考ダミー備考ダミー備考ダミー備考ダミー備考ダ備考ダミー備考ダミー</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="brand-info-detail-remark">●●の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
      <div class="brand-info-detail-report"><a class="clickable-button brand-info-detail-report-button" href="#">誤りを報告する</a></div>
    </section>
<section class="content middle-content brand-share">
      <h2 class="content-title">シェア</h2>
      <div class="share-twitter"><a class="clickable-button share-twitter-button" href="#"><i class="fab fa-twitter twitter-icon"></i>
          <div class="share-twitter-text">Twitter</div></a></div>
    </section>
<section class="content brand-shops">
      <h2 class="content-title">キレイモの運営店舗一覧</h2>
      <div class="brand-shops-search"><img class="brand-shops-search-icon" src="/puril/images/img/japan.png">
        <div class="brand-shops-search-text">全国から探す</div><i class="fas fa-chevron-right brand-shops-search-arrow"></i>
      </div>
    </section>
<div class="content-base campaign"><a href="#"><img src="/puril/images/img/datsumou/brand/cashback-campaign.jpg" alt="キャッシュバックキャンペーン"></a></div>
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
<footer class="datsumou-footer">
    <div class="datsumou-footer__inner">
        <ul class="datsumou-footer__category01">
            <li class="datsumou-footer__category__li">
                <a href="/datsumou/" class="datsumou-footer__category__li__link">脱毛</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">リラク</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">痩身</a>
            </li>
            <li class="datsumou-footer__category__li no-link">
                <a href="" class="datsumou-footer__category__li__link">フェイシャル</a>
            </li>
        </ul>

        <ul class="datsumou-footer__category02">
            <li class="datsumou-footer__category__li">
                <a href="https://tsuru-tsuru.co.jp/" target="_blank" class="datsumou-footer__category__li__link">運営企業</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/regulation" class="datsumou-footer__category__li__link">利用規約</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/privacy-policy" class="datsumou-footer__category__li__link">プライバシーポリシー</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/sitemap" class="datsumou-footer__category__li__link">サイトマップ</a>
            </li>
        </ul>
        <ul class="datsumou-footer__category03">
            <li class="datsumou-footer__category__li">
                <a href="https://puril.net/campaign/" class="datsumou-footer__category__li__link">口コミキャッシュバック</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/form_user" class="datsumou-footer__category__li__link">ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="datsumou-footer__category__li last">
                <a href="/form_facility" class="datsumou-footer__category__li__link">施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="datsumou-footer__credit">
        <a href="/">
            <img src="/puril/images/footer-logo-sp.png" alt="">
        </a>
        <p>Copyright © ツルツル株式会社 All rights reserved.</p>
    </div>
      <ul class="datsumou-footer-list">
        <li class="datsumou-footer-item active"><a href="/datsumou/search/"><i class="fas fa-search datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">探す</div></a></li>
        <li class="datsumou-footer-item"><a href="#"><i class="fas fa-comments datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">口コミ</div></a></li>
        <li class="datsumou-footer-item"><a href="/datsumou/ranking/"><i class="fas fa-crown datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">ランキング</div></a></li>
        <li class="datsumou-footer-item"><a class="brand-footer-kuchikomi-button-wrap" href="#">
            <div class="brand-footer-kuchikomi-button">               <i class="fas fa-edit brand-footer-kuchikomi-icon">    </i>
              <div class="brand-footer-kuchikomi-text">口コミ投稿</div>
            </div></a></li>
      </ul>
</footer>
<script type="text/javascript" src="/js/datsumou/brand/common.js"></script>
<script>
    $('.brand-nav-item').on('touchend',function(){
        $(this).addClass('active').siblings('.brand-nav-item').removeClass('active');
        console.log($(this).data('content'));
        let contentName = $(this).data('content');
    });

</script>
