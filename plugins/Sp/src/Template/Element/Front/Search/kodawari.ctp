<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;

?>
<?php
echo $this->Html->css('datsumou/search');
?>
<div class="Search bg-wht">
    <header class="Search__header">
        <div class="Search__header__inner">
            <a href="#" class="Search__header__close"><img src="images/ico_close.svg" alt="閉じる"></a>
            <div class="Search__header__title">こだわり条件</div>
        </div>
    </header>
    <div class="Search__contents">
        <div class="Search__kodawari__header">
            <input type="text" name="" placeholder="エリア、駅名入力" class="input">
            <button class="arw"><i class="fas fa-chevron-circle-right"></i></button>
        </div>
        <dl class="Search__kodawari__list">
            <dt>脱毛部位</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>眉毛脱毛</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>価格</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>安い・低価格</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>支払い方法</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>現金可</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>脱毛タイプ</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>メンズ脱毛</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>診療料(医療脱毛の場合)</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>皮膚科</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>サポート体制</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>アフターケアつき</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>予約・受付・キャンセル</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>年中無休</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
            <dt>立地・施設</dt>
            <dd>
                <div class="Search__select">
                    <select>
                        <option>駅チカ</option>
                        <option>テキスト</option>
                        <option>テキスト</option>
                    </select>
                </div>
            </dd>
        </dl>
        <dl class="Search__kodawari__selected">
            <dt>現在設定している条件</dt>
            <dd>東京 新宿、キレイモ 、眉毛脱毛、安い・低価格、現金可、メンズ脱毛、皮膚科、アフターケアつき、年中無休、駅チカ</dd>
        </dl>
        <div class="Search__kodawari__btns">
            <button class="Search__kodawari__btn" data-type="clear">クリア</button>
            <button class="Search__kodawari__btn" data-type="search">検索</button>
        </div>
        <div class="Search__kodawari__ranking"><a href=""><i class="fas fa-crown"></i>ランキングで検索する</a></div>
    </div>
    <div class="Search__breadcrumbs">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <span itemprop="name">脱毛</span>
                <meta itemprop="position" content="2" />
            </li>
        </ol>
    </div>
</div>
