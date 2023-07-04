<?php
namespace app\helpme;


class LoanCalc {
    //put your code here
    public static function getRepayment ($amount, $month, $setYr='') {
        
        if ($month <= 6) {
            $yr = 1;
            $rate = 0.01;
        } else if ($month >= 7 && $month <= 12) {
            $yr = 1;
            $rate = 0.02;
        } else if ($month >= 13 && $month <= 24) {
            $yr = 2;
            $rate = 0.025;
        } else if ($month >= 25 && $month <= 36) {
            $yr = 3;
            $rate = 0.03;
        } else if ($month >= 37 && $month <= 48) {
            $yr = 4;
            $rate = 0.035;
        } else if ($month >= 49 && $month <= 60) {
            $yr = 5;
            $rate = 0.04;
        }

        $v1 = pow(1 + $rate, $yr);
        $v2 = (1 - (1 / $v1)) / $rate;
        $v3 = round($v2, 4);
        //echo $v3;

        $repayment = $amount / $v3 * $yr;
        
        if ($setYr)
            return $yr;
        else 
            return number_format($repayment,2, '.', '');
    }
}
