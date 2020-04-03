<?php

use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\URLUtil;

?>

<div class="Search__breadcrumbs">
  <ol>
    <li>
      <a href="<?= Router::url('/datsumou') ?>"><span class="footer-elm-text fas fa-home"></span></a></a>
      <meta itemprop="position" content="2">
    </li>
    <li>
      <a href="<?= Router::url('/datsumou/search') ?>"><span itemprop="name" class="name">全国の脱毛施設</span></a>
      <meta itemprop="position" content="3">
    </li>
    <?php if(!empty($shop)) { ?>
    <li>
      <a href="<?= Router::url('/datsumou/search') ?>"><span itemprop="name" class="name">全国の<?php echo ShopType::convert($shop['shop_type'], CodePattern::$VALUE) ?></span></a>
      <meta itemprop="position" content="4">
    </li>
    <li>
      <?php echo $this->Html->link("<span>{$shop['pref']}" . ShopType::convert($shop['shop_type'], CodePattern::$VALUE) . "</span>", ['controller' => 'searchs', 'action' => 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape' => false, 'itemscope' => '', 'itemtype' => 'http://schema.org/Thing', 'itemprop' => 'item']) ?>
      <meta itemprop="position" content="5">
    </li>

    <li>
      <?php echo $this->Html->link("<span>{$shop['Area']['name']}の" . ShopType::convert($shop['shop_type'], CodePattern::$VALUE) . "</span>", ['controller' => 'searchs', 'action' => 'search', $shop['PrefData']['url_text'], URLUtil::CITY . $shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape' => false, 'itemscope' => '', 'itemtype' => 'http://schema.org/Thing', 'itemprop' => 'item']) ?>
      <meta itemprop="position" content="6">
    </li>

    <li>
      <?php echo "<span itemprop='name' class='name'>{$shop['name']}</span>" ?>
      <meta itemprop="position" content="7">
    </li>
    <?php } ?>
  </ol>
</div>