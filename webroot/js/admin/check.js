var check = {

	disabledInputText : "\\<>\"&'",

	/**
	 * 文字列チェック.
	 * @return 引数に指定された値がNULL or undefined or 空("") の場合はtrue
	 *         それ以外はfalseを返します
	 */
	_isNull : function() {
		for (var i = 0; i < arguments.length; i++) {
			var value = arguments[i];
			if (typeof value === "undefined" || value == null || value.length == 0) {
				return true;
			}
		}
		return false;
	},

	/**
	 * 数値チェック
	 * @return 引数に指定された値が数値でない場合には falseを返し
	 * 		   それ以外はtrueを返す
	 */
	_isNum : function(value) {
		if (check._isNull(value)) {
			return true;
		}
		if (isNaN(value)) {
			return false;
		}
		return true;
	},

	/**
	 * 半角英数チェック
	 * @return 引数に指定された値が半角英数字でない場合には falseを返し
	 * 		   それ以外はtrueを返す
	 */
	_isHankaku : function(value) {
		if (check._isNull(value)) {
			return true;
		}
		if(value.match(/[^0-9A-Za-z\.-]/) == null){
			return true;
		}
		return false;
	},

	/**
	 * メールアドレス書式チェック
	 * @return 引数に指定された値がメールアドレス書式に一致していない場合には falseを返し
	 * 		   それ以外はtrueを返す
	 */
	_isMailAddress : function(value) {
		if (check._isNull(value)) {
			return true;
		}
		if(!value.match(/^[A-Za-z0-9]+[\w-\.]+@[\w\.-]+\.\w{2,}$/)){
			return false;
		}
		return true;
	},

	/**
	 * クロスサイトスクリプティング対策
	 * @return 引数に指定された値が入力不可文字を含んでいる場合false
	 *         それ以外はtrueを返します
	 */
	_crossSiteScriptingCheck : function (value) {
		if (check._isNull(value)) {
			return true;
		}
		// 使用不可文字チェック
		var re = new RegExp("[" + check.disabledInputText + "]", "i");
		if (value.search(re) != -1) {
			// 入力不可文字が見つかった場合
			return false;
		}
		return true;
	},

	/**
	 * 日付型チェック : yyyy/MM/dd or yyyyMMdd
	 */
	_isYYYYMMDD : function() {
		for (var i = 0; i < arguments.length; i++) {
			var value = arguments[i];
			if (check._isNull(value)) {
				return true;
			}
			return check._checkYYYYMMDD(value);
		}
		return true;
	},

	//文字のバイト数を求める関数
	_getByte : function(text){
		count = 0;
		for (i=0; i<text.length; i++)
		{
			n = escape(text.charAt(i));
			if (n.length < 4) count++; else count+=2;
		}
		return count;
	},

	//年月チェック関数
	_checkYYYYMMDD : function(txt){
		var yy
		var mm
		var dd
		var htxt = txt.split("/");
		if (htxt.length != 3) {
			return false;
		}
		if (htxt[0].length == 0 || htxt[1].length == 0 || htxt[2].length == 0) {
			return true;
		}
		yy = Number(htxt[0]);
		mm = Number(htxt[1]);
		dd = Number(htxt[2]);
		if ((mm < 1) || (mm > 12)) {
			return false
		}
			switch(mm){
				case 2:
					if (((yy % 4 == 0) && (yy % 100 != 0)) || (yy % 400 == 0)){
						if ((dd < 1) || (dd > 29)) {
							return false
								}
						}else{
							if((dd < 1) || (dd > 28)) {
								return false
									}
					}
				break

				case 4:
					if ((dd < 1) || (dd > 30)) {
				return false
					}
				break

				case 6:
					if ((dd < 1) || (dd > 30)) {
				return false
					}
				break

				case 9:
					if ((dd < 1) || (dd > 30)) {
				return false
					}
				break

				case 11:
					if ((dd < 1) || (dd > 30)) {
				return false
					}
				break

				default://1,3,5,7,8,10,12
					if ((dd < 1) || (dd > 31)) {
				return false
					}

				break
				}
		return true;
	},

	// 電話番号チェック
	_isTelNo : function(telNo) {
		if (telNo.length != 13 && telNo.length != 12) {
			return false;
		}
		var data1 = telNo.match(/^0[1-9]0-\\d{4}-\\d{4}$/); // mobile
		var data2 = telNo.match(/^0[1-9]-\\d{4}-\\d{4}$/); // home
		var data3 = telNo.match(/^0[0-9]{3}-\\d{3}-\\d{3}$/); // free dial
		if (telNo.length == 13 && data1) {
			return true;
		} else if (telNo.length == 12 && (data2 || data3)) {
			return true;
		}
		return true;
	},

	// 郵便番号チェック
	_isZipCode : function(value) {
		if (check._isNull(value)) {
			return true;
		}
		if (value.indexOf("-") != -1) {
			return false;
		}
		var valueArray = value.split("-");

		if (valueArray.length != 2) {
			return false;
		}
		var value1 = valueArray[0];
		var value2 = valueArray[1];
		if (value1.length  == 3 && !check._isNum(value1)){
			return false;
		}
		if (value2.length != 4 && !check._isNum(value2)) {
			return false;
		}
		return true;
	},

	/**
	 * 全角であるかをチェックします。
	 *
	 * @param チェックする値
	 * @return ture : 全角 / flase : 全角以外
	 */
	_isZenkaku : function(value) {
		for (var i = 0; i < value.length; ++i) {
			var c = value.charCodeAt(i);
			// 半角カタカナは不許可
			if (c < 256 || (c >= 0xff61 && c <= 0xff9f)) {
				return false;
			}
		}
		return true;
    }
}