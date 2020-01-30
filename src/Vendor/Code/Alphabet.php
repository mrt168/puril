<?php
namespace App\Vendor\Code;

class Alphabet extends AAbstractCode implements AACodeImpl {

	public static $A;
	public static $B;
	public static $C;
	public static $D;
	public static $E;
	public static $F;
	public static $G;
	public static $H;
	public static $I;
	public static $J;
	public static $K;
	public static $L;
	public static $M;
	public static $N;
	public static $O;
	public static $P;
	public static $Q;
	public static $R;
	public static $S;
	public static $T;
	public static $U;
	public static $V;
	public static $W;
	public static $X;
	public static $Y;
	public static $Z;


	public static function init() {

		self::$A = [CodePattern::$CODE => '1', CodePattern::$VALUE => 'A'];
		self::$B = [CodePattern::$CODE => '2', CodePattern::$VALUE => 'B'];
		self::$C = [CodePattern::$CODE => '3', CodePattern::$VALUE => 'C'];
		self::$D = [CodePattern::$CODE => '4', CodePattern::$VALUE => 'D'];
		self::$E = [CodePattern::$CODE => '5', CodePattern::$VALUE => 'E'];
		self::$F = [CodePattern::$CODE => '6', CodePattern::$VALUE => 'F'];
		self::$G = [CodePattern::$CODE => '7', CodePattern::$VALUE => 'G'];
		self::$H = [CodePattern::$CODE => '8', CodePattern::$VALUE => 'H'];
		self::$I = [CodePattern::$CODE => '9', CodePattern::$VALUE => 'I'];
		self::$J = [CodePattern::$CODE => '10', CodePattern::$VALUE => 'J'];
		self::$K = [CodePattern::$CODE => '11', CodePattern::$VALUE => 'K'];
		self::$L = [CodePattern::$CODE => '12', CodePattern::$VALUE => 'L'];
		self::$M = [CodePattern::$CODE => '13', CodePattern::$VALUE => 'M'];
		self::$N = [CodePattern::$CODE => '14', CodePattern::$VALUE => 'N'];
		self::$O = [CodePattern::$CODE => '15', CodePattern::$VALUE => 'O'];
		self::$P = [CodePattern::$CODE => '16', CodePattern::$VALUE => 'P'];
		self::$Q = [CodePattern::$CODE => '17', CodePattern::$VALUE => 'Q'];
		self::$R = [CodePattern::$CODE => '18', CodePattern::$VALUE => 'R'];
		self::$S = [CodePattern::$CODE => '19', CodePattern::$VALUE => 'S'];
		self::$T = [CodePattern::$CODE => '20', CodePattern::$VALUE => 'T'];
		self::$U = [CodePattern::$CODE => '21', CodePattern::$VALUE => 'U'];
		self::$V = [CodePattern::$CODE => '22', CodePattern::$VALUE => 'V'];
		self::$W = [CodePattern::$CODE => '23', CodePattern::$VALUE => 'W'];
		self::$X = [CodePattern::$CODE => '24', CodePattern::$VALUE => 'X'];
		self::$Y = [CodePattern::$CODE => '25', CodePattern::$VALUE => 'Y'];
		self::$Z = [CodePattern::$CODE => '26', CodePattern::$VALUE => 'Z'];
	}
}
Alphabet::init();