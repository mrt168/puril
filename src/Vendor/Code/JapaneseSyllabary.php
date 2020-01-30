<?php
namespace App\Vendor\Code;

class JapaneseSyllabary extends AAbstractCode implements AACodeImpl {

	// あ
	public static $A;
	public static $I;
	public static $U;
	public static $E;
	public static $O;

	//か
	public static $KA;
	public static $KI;
	public static $KU;
	public static $KE;
	public static $KO;

	//さ
	public static $SA;
	public static $SI;
	public static $SU;
	public static $SE;
	public static $SO;

	// た
	public static $TA;
	public static $TI;
	public static $TU;
	public static $TE;
	public static $TO;

	// な
	public static $NA;
	public static $NI;
	public static $NU;
	public static $NE;
	public static $NO;

	// は
	public static $HA;
	public static $HI;
	public static $HU;
	public static $HE;
	public static $HO;

	// ま
	public static $MA;
	public static $MI;
	public static $MU;
	public static $ME;
	public static $MO;

	// や
	public static $YA;
	public static $YU;
	public static $YO;

	// ら
	public static $RA;
	public static $RI;
	public static $RU;
	public static $RE;
	public static $RO;

	// わ
	public static $WA;
	public static $WO;
// 	public static $NN;

	public static function init() {

		self::$A = [CodePattern::$CODE => '1', CodePattern::$VALUE => 'あ'];
		self::$I = [CodePattern::$CODE => '2', CodePattern::$VALUE => 'い'];
		self::$U = [CodePattern::$CODE => '3', CodePattern::$VALUE => 'う'];
		self::$E = [CodePattern::$CODE => '4', CodePattern::$VALUE => 'え'];
		self::$O = [CodePattern::$CODE => '5', CodePattern::$VALUE => 'お'];

		self::$KA = [CodePattern::$CODE => '6', CodePattern::$VALUE => 'か'];
		self::$KI = [CodePattern::$CODE => '7', CodePattern::$VALUE => 'き'];
		self::$KU = [CodePattern::$CODE => '8', CodePattern::$VALUE => 'く'];
		self::$KE = [CodePattern::$CODE => '9', CodePattern::$VALUE => 'け'];
		self::$KO = [CodePattern::$CODE => '10', CodePattern::$VALUE => 'こ'];

		self::$SA = [CodePattern::$CODE => '11', CodePattern::$VALUE => 'さ'];
		self::$SI = [CodePattern::$CODE => '12', CodePattern::$VALUE => 'し'];
		self::$SU = [CodePattern::$CODE => '13', CodePattern::$VALUE => 'す'];
		self::$SE = [CodePattern::$CODE => '14', CodePattern::$VALUE => 'せ'];
		self::$SO = [CodePattern::$CODE => '15', CodePattern::$VALUE => 'そ'];

		self::$TA = [CodePattern::$CODE => '16', CodePattern::$VALUE => 'た'];
		self::$TI = [CodePattern::$CODE => '17', CodePattern::$VALUE => 'ち'];
		self::$TU = [CodePattern::$CODE => '18', CodePattern::$VALUE => 'つ'];
		self::$TE = [CodePattern::$CODE => '19', CodePattern::$VALUE => 'て'];
		self::$TO = [CodePattern::$CODE => '20', CodePattern::$VALUE => 'と'];

		self::$NA = [CodePattern::$CODE => '21', CodePattern::$VALUE => 'な'];
		self::$NI = [CodePattern::$CODE => '22', CodePattern::$VALUE => 'に'];
		self::$NU = [CodePattern::$CODE => '23', CodePattern::$VALUE => 'ぬ'];
		self::$NE = [CodePattern::$CODE => '24', CodePattern::$VALUE => 'ね'];
		self::$NO = [CodePattern::$CODE => '25', CodePattern::$VALUE => 'の'];

		self::$HA = [CodePattern::$CODE => '26', CodePattern::$VALUE => 'は'];
		self::$HI = [CodePattern::$CODE => '27', CodePattern::$VALUE => 'ひ'];
		self::$HU = [CodePattern::$CODE => '28', CodePattern::$VALUE => 'ふ'];
		self::$HE = [CodePattern::$CODE => '29', CodePattern::$VALUE => 'へ'];
		self::$HO = [CodePattern::$CODE => '30', CodePattern::$VALUE => 'ほ'];

		self::$MA = [CodePattern::$CODE => '31', CodePattern::$VALUE => 'ま'];
		self::$MI = [CodePattern::$CODE => '32', CodePattern::$VALUE => 'み'];
		self::$MU = [CodePattern::$CODE => '33', CodePattern::$VALUE => 'む'];
		self::$ME = [CodePattern::$CODE => '34', CodePattern::$VALUE => 'め'];
		self::$MO = [CodePattern::$CODE => '35', CodePattern::$VALUE => 'も'];

		self::$YA = [CodePattern::$CODE => '36', CodePattern::$VALUE => 'や'];
		self::$YU = [CodePattern::$CODE => '37', CodePattern::$VALUE => 'ゆ'];
		self::$YO = [CodePattern::$CODE => '38', CodePattern::$VALUE => 'よ'];

		self::$RA = [CodePattern::$CODE => '39', CodePattern::$VALUE => 'ら'];
		self::$RI = [CodePattern::$CODE => '40', CodePattern::$VALUE => 'り'];
		self::$RU = [CodePattern::$CODE => '41', CodePattern::$VALUE => 'る'];
		self::$RE = [CodePattern::$CODE => '42', CodePattern::$VALUE => 'れ'];
		self::$RO = [CodePattern::$CODE => '43', CodePattern::$VALUE => 'ろ'];

		self::$WA = [CodePattern::$CODE => '44', CodePattern::$VALUE => 'わ'];
		self::$WO = [CodePattern::$CODE => '45', CodePattern::$VALUE => 'を'];
// 		self::$NN = [CodePattern::$CODE => '46', CodePattern::$VALUE => 'ん'];
	}

	/**
	 * 地域別都道府県
	 */
	public static function getLine() {
		return [
				'あ行'=> [
						self::$A,
						self::$I,
						self::$U,
						self::$E,
						self::$O
				],
				'か行'=> [
						self::$KA,
						self::$KI,
						self::$KU,
						self::$KE,
						self::$KO
				],
				'さ行'=> [
						self::$SA,
						self::$SI,
						self::$SU,
						self::$SE,
						self::$SO
				],
				'た行'=> [
						self::$TA,
						self::$TI,
						self::$TU,
						self::$TE,
						self::$TO
				],
				'な行'=> [
						self::$NA,
						self::$NI,
						self::$NU,
						self::$NE,
						self::$NO
				],
				'は行'=> [
						self::$HA,
						self::$HI,
						self::$HU,
						self::$HE,
						self::$HO
				],
				'ま行'=> [
						self::$MA,
						self::$MI,
						self::$MU,
						self::$ME,
						self::$MO
				],
				'や行'=> [
						self::$YA,
						self::$YU,
						self::$YO
				],
				'ら行'=> [
						self::$RA,
						self::$RI,
						self::$RU,
						self::$RE,
						self::$RO
				],
				'わ行'=> [
						self::$WA,
						self::$WO
				],
		];
	}
}
JapaneseSyllabary::init();