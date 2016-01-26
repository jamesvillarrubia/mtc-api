<?php 

namespace App\Library;

use App\ShortAnswer as ShortAnswer;

class ELO {
    public static function compute(ShortAnswer $short1, ShortAnswer $short2, $draw = false) {

    	$score1 = $short1->rating;
    	$score2 = $short2->rating;

    	$k = 32;
    	$base = 400;

    	$r1 = pow(10,$score1/$base);
		$r2 = pow(10,$score2/$base);

		$e1 = $r1 / ($r1+$r2);
		$e2 = $r2 / ($r1+$r2);

		$s1 = 1;
		$s2 = 0;
		if($draw){
			$s1 = $s2 = 0.5;
		}

		$rp1 = round($score1 + $k * ($s1-$e1));
		$rp2 = round($score2 + $k * ($s2-$e2));


		$short1->rating = $rp1;
		$short2->rating = $rp2;
		$short1->save();
		$short2->save();

        return;
    }
}


?>