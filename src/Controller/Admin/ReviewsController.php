<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\PagingUtil;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Messages;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use Cake\Datasource\ConnectionManager;
use App\Controller\Component\CsvComponent;

class ReviewsController extends AdminAppController {

    const INDEX_PAGE = 'index';
    const EDIT_PAGE = 'edit';
    const POPUP_PAGE = 'popup';
    const DETAIL_PAGE = 'detail';
    const CSV_PAEGE = 'csv_import';

    const SEARCH_SESSION_NAME = "BgMRCz7yRjxFjUPk";

    //口コミCSVレイアウト
    private static $CSV_INDEX = array(
        0=> 'shop_id'					// 店舗ID
    ,1=> 'shop_name'				// 店舗名
    ,2=> 'review_id'				// ID
    ,3=> 'evaluation'				// 評価
    ,4=> 'question1'				// 治療前の説明は十分でしたか？
    ,5=> 'question1_evaluation'				// 治療前の説明は十分でしたか？
    ,6=> 'question2'				// 痛みへの配慮はいかがでしたか？
    ,7=> 'question2_evaluation'				// 治療前の説明は十分でしたか？
    ,8=> 'question3'				// スタッフの態度、対応はいかがでしたか？
    ,9=> 'question3_evaluation'				// 治療前の説明は十分でしたか？
    ,10=> 'question4'				// 店舗の雰囲気、設備、清潔感はいかがでしたか？
    ,11=> 'question4_evaluation'				// 治療前の説明は十分でしたか？
    ,12=> 'question5'				// 待ち時間、予約対応はいかがでしたか？
    ,13=> 'question5_evaluation'				// 治療前の説明は十分でしたか？
    ,14=> 'reason'					// この店舗を選んだ理由
    ,15=> 'nickname'					// 定休日
    ,16=> 'sex'						// 性別
    ,17=> 'pref'						// 都道府県
    ,18=> 'station'						// 最寄り駅
    ,19=> 'birthday'						// 生年月日
    ,20=> 'instagram_account'		// Instagramアカウント
    ,21=> 'twitter_account'			// Twitterアカウント
    ,22=> 'post_date'				// 投稿日
    ,23=> 'visit_date'				// 来店日
    ,24=> 'title'					// 受けた施術等の名前
    ,25=> 'content'					// この店舗の総合的な感想を、20文字程度で感想を教えてください。
    ,26=> 'show_flg'				// 表示フラグ
    ,27=> 'age'				// 表示フラグ

    );

    /**
     * 口コミ一覧画面へ遷移します.
     *
     * @click_url(review_view)
     */
    public function index() {
        $this->Session->delete(self::SEARCH_SESSION_NAME);
        $this->search();
    }

    /**
     * 口コミ検索処理をします.
     *
     * @click_url(review_view)
     */
    public function search() {
        $wheres = array();
        if (isset($this->request->data['search'])) {
            $wheres = $this->request->data['Reviews'];

        } else {
            if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
                $wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
                $wheres = json_decode($wheresJson, true);

                $this->request->data['Reviews'] = $wheres;
            } else {
                $wheres = array();
            }
        }
        $wheresJson = json_encode($wheres);
        parent::setSession(self::SEARCH_SESSION_NAME, $wheresJson);

        $this->set('wheres', $wheres);

        // 店舗名アンド検索用処理
        if (!empty($wheres['shop_name'])) {
            $shopName = $wheres['shop_name'];
            $wheres['shop_name'] = [];

            $shopName = str_replace('　', ' ', $shopName);
            $shopName = trim($shopName);
            $shopName = preg_replace('/\s+/', ' ', $shopName);
            $wheres['shop_name'] = explode(' ', $shopName);
        }

        $reviewTable = TableRegistry::get('Reviews');
        $this->paginate = $reviewTable->makeFindByDelFlgOrderById($wheres, PagingUtil::REVIEW_APP);
        $reviews = $this->paginate('Reviews');


        ConvertItems::convertObjectValue($reviews)
            ->codeConverter(ShowFlg::toString(), CodePattern::$VALUE, 'show_flg');

        $this->set('reviews', $reviews);

        parent::move(ClickUrl::$REVIEW_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
    }

    /**
     * 店舗詳細画面へ遷移します.
     *
     * @click_url(review_view)
     */
    public function detail($reviewId) {
        $reviewTable= TableRegistry::get('Reviews');
        $review = $reviewTable->findByIdAndDelFlg($reviewId);
        if (empty($reviewId) || empty($review)) {
            $this->redirect(array('controller'=> 'reviews', 'action'=> 'index'));
            return;
        }

        $review = $review->toArray();
        ConvertItems::convertValue($review)
            ->codeConverter(Sex::toString(), CodePattern::$VALUE, 'sex')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question1')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question2')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question3')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question4')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question5')
            ->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, 'question6');

        $this->set('review', $review);

        parent::move(ClickUrl::$REVIEW_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::DETAIL_PAGE);
    }

    /**
     * 口コミ登録画面へ遷移します.
     *
     * @click_url(review_reg)
     */
    public function moveRegist() {

        parent::move(ClickUrl::$REVIEW_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
    }

    /**
     * 口コミ編集画面へ遷移します.
     *
     * @click_url(review_reg)
     */
    public function moveEdit($reviewId = null) {
        if (!empty($reviewId)) {
            $reviewTable = TableRegistry::get('Reviews');
            $review = $reviewTable->findByIdAndDelFlg($reviewId);

            if (!empty($review)) {
                $this->request->data['Reviews'] = $review;
                $this->request->data['Reviews']['shop_name'] = $review['Shop']['name'];
            }
        }

        parent::move(ClickUrl::$REVIEW_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
    }

    /**
     * 口コミ更新処理を実施します
     *
     * @click_url(review_reg)
     */
    public function edit() {
        $reviewTable = TableRegistry::get('Reviews');

        if (isset($this->request->data['regist'])) {
            // 新規登録
            $review = $reviewTable->newEntity($this->request->getData(), ['validate'=> 'edit']);
        } else if (isset($this->request->data['update'])) {
            // 更新
            $review = $reviewTable->get($this->request->getData('Reviews.review_id'));
            $reviewTable->patchEntity($review, $this->request->getData(), ['validate'=> 'edit']);
        } else {
            // 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
            $this->setAction('moveRegist');
            return;
        }

        if (!$review->getErrors()) {
            $saveReview = $reviewTable->save($review);

            $this->Flash->set(Messages::UPDATE);
            $this->redirect(array('controller'=> 'reviews', 'action'=> 'index'));
            return;
        }
        $this->set('review', $review);
        $this->setAction('moveRegist');
    }

    /**
     * 店舗抽出Windowを表示します.
     *
     * @click_url(exclude)
     */
    public function extraction() {
        parent::move(ClickUrl::$REVIEW_REG, Layout::ADMIN_AFTER_NO_MENU_LAYOUT, self::POPUP_PAGE);
    }

    /**
     * 店舗抽出Window検索処理を実施します.
     *
     * @click_url(exclude)
     */
    public function extractionSearch() {
        $wheres = [];
        if (isset($this->request->data['search'])) {
            $wheres = $this->request->data['Shops'];

        } else {
            if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
                $wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
                $wheres = json_decode($wheresJson, true);

                $this->request->data['Shops'] = $wheres;
            } else {
                $wheres = array();
            }
        }
        $wheresJson = json_encode($wheres);
        parent::setSession(self::SEARCH_SESSION_NAME, $wheresJson);

        // 店舗名アンド検索用処理
        if (!empty($wheres['name'])) {
            $shopName = $wheres['name'];
            $wheres['name'] = [];

            $shopName = str_replace('　', ' ', $shopName);
            $shopName = trim($shopName);
            $shopName = preg_replace('/\s+/', ' ', $shopName);
            $wheres['names'] = explode(' ', $shopName);
        }

        $shopTable = TableRegistry::get('Shops');
        $this->paginate = $shopTable->makeFindByDelFlgOrderById($wheres, PagingUtil::SHOP_APP);
        $shops = $this->paginate('Shops');

        $this->set('shops', $shops);

        $this->extraction();
    }

    /**
     * CSVエクスポート.
     *
     * @click_url(review_reg)
     */
    public function csvExport() {

        ini_set('memory_limit', "-1");
        set_time_limit(0);

        if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
            $wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
            $wheres = json_decode($wheresJson, true);
        } else {
            $wheres = array();
        }
        $reviewTable = TableRegistry::get('Reviews');
        $reviews = $reviewTable->findByDelFlgOrderById($wheres);

        if (empty($reviews->toArray())) {
            $this->redirect(array('controller'=> 'reviews', 'action'=> 'index'));
            return ;
        }

        $data=[];
        $this->ssTable = TableRegistry::get('ShopStations');
        foreach ($reviews as $key => $review) {
            $data[$key] = [];
            array_push($data[$key], $review['Shop']['shop_id']);
            array_push($data[$key], $review['Shop']['name']);
            array_push($data[$key], $review['review_id']);
            array_push($data[$key], $review['evaluation']);
            array_push($data[$key], $review['question1']);
            array_push($data[$key], $review['question2']);
            array_push($data[$key], $review['question3']);
            array_push($data[$key], $review['question4']);
            array_push($data[$key], $review['question5']);
            array_push($data[$key], $review['question6']);
            array_push($data[$key], $review['nickname']);
            array_push($data[$key], $review['age']);
            array_push($data[$key], $review['sex']);
            array_push($data[$key], $review['instagram_account']);
            array_push($data[$key], $review['twitter_account']);
            array_push($data[$key], !empty($review['post_date']) ? date('Y/m/d H:i:s', strtotime($review['post_date'])) : null);
            array_push($data[$key], !empty($review['visit_date']) ? date('Y/m/d H:i:s', strtotime($review['visit_date'])) : null);
            array_push($data[$key], $review['title']);
            array_push($data[$key], $review['content']);
            array_push($data[$key], $review['show_flg']);
        }

        //CSVの定義です。なお変数名は任意のものはダメで_headerでないと入りません。
        $_header = [
            '店舗名(ID)','店舗名','ID','評価',
            '治療前の説明は十分でしたか？','痛みへの配慮はいかがでしたか？','スタッフの態度、対応はいかがでしたか？',
            '店舗の雰囲気、設備、清潔感はいかがでしたか？','待ち時間、予約対応はいかがでしたか？','術前、術中、術後の対応はいかがでしたか？',
            '氏名(ニックネーム)','年齢','性別','Instagramアカウント','Twitterアカウント','投稿日','来店日','口コミ タイトル','口コミ 本文','表示フラグ'
        ];

        //本データを_serializeに入れます。
        $_serialize = 'data';
        //これいれないと文字エンコーディング変換が有効になりません
        $_extension = 'mbstring';
        // 変換前の文字コード
        $_dataEncoding = 'UTF-8';
        // 変換後の文字エンコーディング
        $_csvEncoding = 'sjis-win';

        $this->response->download(date('Ymd').'口コミ情報' . '.csv');
        $this->viewBuilder()->className('CsvView.Csv');
        $this->set(compact('data', '_header', '_serialize', '_extension', '_dataEncoding', '_csvEncoding'));
    }

    /**
     * 口コミCSVインポート画面へ遷移します..
     *
     * @click_url(review_csv)
     */
    public function moveCsv() {
        parent::move(ClickUrl::$REVIEW_CSV, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::CSV_PAEGE);
    }

    /**
     * 口コミCSVインポート登録処理を実施します.
     *
     * @click_url(review_csv)
     */
    public function csvImport() {

        if (empty($this->request->data['Reviews']['csv_file'])) {
            $this->setAction('moveCsv');
            return;
        }
        $data = $this->request->data['Reviews'];

        if (!isset($data['csv_file']) || empty($data['csv_file']['name'])) {
            $this->Flash->set('CSVファイルを選択して下さい。');
            $this->setAction('moveCsv');
            return;
        }
        //レイアウト作成
        $this->viewBuilder()->setLayout(Layout::ADMIN_AFTER_LOGIN_LAYOUT);
        $this->render('csv_result');

        $body = $this->response->body();
        $this->autoRender = false;
        echo $body;

        set_time_limit(0);
        $data = mb_convert_encoding(file_get_contents($data['csv_file']['tmp_name']), 'UTF-8', 'SJIS-win');
        $temp = tmpfile();
        fwrite($temp, $data);
        rewind($temp);

        $count = 0; // 行目はヘッダー扱いするので
        $importCount = 0;
        $errorCount = 0;
        $deleteCount = 0;
        $regex = 'count_target';
        $jogaiRegex = 'jogai_data';
        $reigaiRegex = 'reigai_data';
        $deleteRegex = 'delete_data';
        $proc = 'proc';

        $this->Review = TableRegistry::get('Reviews');
        $this->Shop = TableRegistry::get('Shops');

        while (($data = fgetcsv($temp, 0, ",")) !== false) {
            $count++;
            try {
                if ($count == 1) {
                    $this->Csv->output_message($count, 'ヘッダー', $jogaiRegex);
                    $errorCount++;
                    continue ;
                }

                if ($count > 5001) {
                    $this->Csv->output_message($count, '一度に5000件以上はインポートできません', $jogaiRegex);
                    break;
                }

                $review = [];
                foreach (self::$CSV_INDEX as $csvIndex=> $columnName) {
                    if (isset($data[$csvIndex])) {
                        $val = trim($data[$csvIndex]);
                        $review['Reviews'][$columnName] = $val;
                    }
                }

                ConvertItems::convertValue($review)
                    ->codeConverter(Pref::toString(), CodePattern::$CODE, 'pref');
                if (!ctype_digit($review['Reviews']['pref'])) {
                    $this->Csv->output_message($count, '都道府県の入力に誤りがあります。', $jogaiRegex);
                    $errorCount++;
                    continue ;
                }

                // 店舗ID
                if (!empty($review['Reviews']['shop_id'])) {
                    $shop = $this->Shop->findById($review['Reviews']['shop_id']);
                    if (empty($shop)) {
                        $this->Csv->output_message($count, '店舗IDの入力に誤りがあります。', $jogaiRegex);
                        $errorCount++;
                        continue ;
                    }
                } else {
                    $this->Csv->output_message($count, '店舗IDを入力してください。', $jogaiRegex);
                    $errorCount++;
                    continue ;
                }

                // 口コミデータ保存
                if (!empty($review['Reviews']['review_id'])) {
                    $reviewData = $this->Review->findByIdAndDelFlg($review['Reviews']['review_id']);
                    if (empty($reviewData)) {
                        $this->Csv->output_message($count, '口コミIDの入力に誤りがあります。', $jogaiRegex);
                        $errorCount++;
                        continue ;
                    }

                    $this->Review->patchEntity($reviewData, $review, ['validate'=> 'edit']);
                } else {
                    $reviewData = $this->Review->newEntity($review['Reviews'], ['validate'=> 'edit']);
                }

                if ($reviewData->errors()) {
                    $this->Csv->output_message($count, $this->Csv->implode_recursive(",", $reviewData->errors()), $jogaiRegex);
                    $errorCount++;
                    continue;
                }
                $connection = ConnectionManager::get('default');
                $connection->begin();
                $saveReview = $this->Review->save($reviewData);

                $connection->commit();
                $importCount++;
            } catch (\Exception $e) {
                $this->Csv->output_message($count, $e->getMessage(), $jogaiRegex);
                $errorCount++;
                $connection->rollback();
            }
            if ($count%5 == 0) {
                CsvComponent::script_message($regex, $count);
            }
        }
        $this->Csv->csv_comp($regex, $count, $importCount, $deleteCount, $errorCount, $proc);
        exit(0);
    }

    /**
     * 削除処理を実施します.
     *
     * @click_url(review_view)
     */
    public function delete($reviewId = null) {
        if (!empty($reviewId)) {
            $reviewTable = TableRegistry::get('Reviews');
            $reviewTable->deleteById($reviewId);

            $this->Flash->set(Messages::DELETE);
        }
        $this->redirect(array('controller'=> 'reviews', 'action'=> 'index'));
    }
}