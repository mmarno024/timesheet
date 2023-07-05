<?php

function number_to_words($number) {
	if ($number > 999999999) {
		throw new Exception("Number is out of range");
	}

	$Gn = floor($number / 1000000); /* Millions (giga) */
	$number -= $Gn * 1000000;
	$kn = floor($number / 1000); /* Thousands (kilo) */
	$number -= $kn * 1000;
	$Hn = floor($number / 100); /* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10); /* Tens (deca) */
	$n = $number % 10; /* Ones */
	$cn = round(($number - floor($number)) * 100); /* Cents */
	$result = "";

	if ($Gn) {$result .= number_to_words($Gn) . " Million";}

	if ($kn) {$result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand";}

	if ($Hn) {$result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred";}

	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
		"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
		"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
		"Nineteen");
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
		"Seventy", "Eighty", "Ninety");

	if ($Dn || $n) {
		if (!empty($result)) {
			$result .= " ";
		}

		if ($Dn < 2) {
			$result .= $ones[$Dn * 10 + $n];
		} else {
			$result .= $tens[$Dn];
			if ($n) {
				$result .= "-" . $ones[$n];
			}
		}
	}

	if ($cn) {
		if (!empty($result)) {
			$result .= ' and ';
		}
		$title = $cn == 1 ? 'cent ' : 'cents';
		$result .= $title . ' ' . strtolower(number_to_words($cn)) . ' only';
	}

	if (empty($result)) {$result = "zero";}

	return $result;
}
function number_to_words_in_yen($number) {
	if ($number > 999999999) {
		throw new Exception("Number is out of range");
	}

	$Gn = floor($number / 1000000); /* Millions (giga) */
	$number -= $Gn * 1000000;
	$kn = floor($number / 1000); /* Thousands (kilo) */
	$number -= $kn * 1000;
	$Hn = floor($number / 100); /* Hundreds (hecto) */
	$number -= $Hn * 100;
	$Dn = floor($number / 10); /* Tens (deca) */
	$n = $number % 10; /* Ones */
	$cn = round(($number - floor($number)) * 100); /* Cents */
	$result = "";

	if ($Gn) {$result .= number_to_words($Gn) . " Million";}

	if ($kn) {$result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand";}

	if ($Hn) {$result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred";}

	$ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
		"Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
		"Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
		"Nineteen");
	$tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
		"Seventy", "Eighty", "Ninety");

	if ($Dn || $n) {
		if (!empty($result)) {
			$result .= "  ";
		}

		if ($Dn < 2) {
			$result .= $ones[$Dn * 10 + $n];
		} else {
			$result .= $tens[$Dn];
			if ($n) {
				$result .= "-" . $ones[$n];
			}
		}
	}

	if ($cn) {
		if (!empty($result)) {
			$result .= ' and ';
		}
		$title = $cn == 1 ? 'cent ' : 'cents';
		$result .= $title . ' ' . strtolower(number_to_words($cn)) . ' only';
	}

	if (empty($result)) {$result = "zero";}

	return $result;
}

/*
 * FUNGSI NUMERIK KE TERHITUNG
 * (c) 2008-2010 by amarullz@yahoo.com
 *
 */

function terbilang_get_valid($str, $from, $to, $min = 1, $max = 9) {
	$val = false;
	$from = ($from < 0) ? 0 : $from;
	for ($i = $from; $i < $to; $i++) {
		if (((int) $str{$i} >= $min) && ((int) $str{$i} <= $max)) {
			$val = true;
		}

	}
	return $val;
}
function terbilang_get_str($i, $str, $len) {
	$numA = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
	$numB = array("", "se", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ");
	$numC = array("", "satu ", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ");
	$numD = array(0 => "puluh", 1 => "belas", 2 => "ratus", 4 => "ribu", 7 => "juta", 10 => "milyar", 13 => "triliun");
	$buf = "";
	$pos = $len - $i;
	switch ($pos) {
	case 1:
		if (!terbilang_get_valid($str, $i - 1, $i, 1, 1)) {
			$buf = $numA[(int) $str{$i}];
		}

		break;
	case 2:case 5:case 8:case 11:case 14:
		if ((int) $str{$i} == 1) {
			if ((int) $str{$i + 1} == 0) {
				$buf = ($numB[(int) $str{$i}]) . ($numD[0]);
			} else {
				$buf = ($numB[(int) $str{$i + 1}]) . ($numD[1]);
			}

		} else if ((int) $str{$i} > 1) {
			$buf = ($numB[(int) $str{$i}]) . ($numD[0]);
		}
		break;
	case 3:case 6:case 9:case 12:case 15:
		if ((int) $str{$i} > 0) {
			$buf = ($numB[(int) $str{$i}]) . ($numD[2]);
		}
		break;
	case 4:case 7:case 10:case 13:
		if (terbilang_get_valid($str, $i - 2, $i)) {
			if (!terbilang_get_valid($str, $i - 1, $i, 1, 1)) {
				$buf = $numC[(int) $str{$i}] . ($numD[$pos]);
			} else {
				$buf = $numD[$pos];
			}

		} else if ((int) $str{$i} > 0) {
			if ($pos == 4) {
				$buf = ($numB[(int) $str{$i}]) . ($numD[$pos]);
			} else {
				$buf = ($numC[(int) $str{$i}]) . ($numD[$pos]);
			}

		}
		break;
	}
	return $buf;
}
function toTerbilang($nominal) {
	$buf = "";
	$str = $nominal . "";
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++) {
		$buf = trim($buf) . " " . terbilang_get_str($i, $str, $len);
	}
	return trim($buf);
}

?>

