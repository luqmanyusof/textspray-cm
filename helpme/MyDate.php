<?php
namespace app\helpme;

class MyDate {
    /**
     * to return string date from a format to other given format
     * @param <type> $from = dmy / mdy /ymd
     * @param <type> $to = dmy / mdy /ymd
     * @param <type> $val
     * @param <string> $marker either - or /
     * @return <type>
     */

    public static function dateFormat($from='dmy', $to='ymd', $val='', $marker='-') {
        if ($from == '' || $to == '' || $val == '' || $val == '0000-00-00')
            return '';

        if ($from == 'dmy') {
            $day   = substr($val,0,2);
            $month = substr($val,3,2);
            $year  = substr($val,6,4);
        } else if ($from == 'mdy') {
            $month = substr($val,0,2);
            $day   = substr($val,3,2);
            $year  = substr($val,6,4);
        } else if ($from == 'ymd') {
            $year  = substr($val,0,4);
            $month = substr($val,5,2);
            $day   = substr($val,8,2);
        }

        if ($to == 'dmy')
            return $day.$marker.$month.$marker.$year;
        else if ($to == 'ymd')
            return $year.$marker.$month.$marker.$day;
        else if ($to == 'mdy')
            return $month.$marker.$day.$marker.$year;
    }
    
    public static function monthList() {
        $month = array(
            ''  => '-- SELECT MONTH --',
            // '-1' => 'All Months',
            '01' => 'Jan',
            '02' => 'Feb',
            '03' => 'Mar',
            '04' => 'Apr',
            '05' => 'May',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Aug',
            '09' => 'Sep',
            '10' => 'Oct',
            '11' => 'Nov',
            '12' => 'Dec',
        );
        return $month;
    }
    
    public function bmDesc($dt = '', $noday=0) {
        if (!empty($dt)) {
            $day = date('d',$dt);
            $mon = date('M',$dt);
            $yr  = date('Y',$dt);         
        } else {
            $day = date('d');
            $mon = date('M');
            $yr  = date('Y');
        }
        
            if ($mon == 'Jan')
                $bmMon = 'Januari';
            elseif ($mon == 'Feb')
                $bmMon = 'Februari';
            elseif ($mon == 'Mar')
                $bmMon = 'Mac';
            elseif ($mon == 'Apr')
                $bmMon = 'April';
            elseif ($mon == 'May')
                $bmMon = 'Mei';
            elseif ($mon == 'Jun')
                $bmMon = 'Jun';
            elseif ($mon == 'Jul')
                $bmMon = 'Julai';
            elseif ($mon == 'Aug')
                $bmMon = 'Ogos';
            elseif ($mon == 'Sep')
                $bmMon = 'September';
            elseif ($mon == 'Oct')
                $bmMon = 'Oktober';
            elseif ($mon == 'Nov')
                $bmMon = 'November';
            elseif ($mon == 'Dec')
                $bmMon = 'Disember';
            
            if ($noday) $day = '';
            
            return $day. ' ' . $bmMon . ' ' . $yr; 
    }
    
    public static function monthRange($from, $to) {
        $month = array(''  => '-- SELECT MONTH --');
        for ($i = $from; $i <= $to; $i++) {
            $month[$i] = $i; 
        }
        return $month;
    }
    
    public static function yearList($yr_show, $from_offset=0) {
        $year = array(''  => '-- SELECT YEAR --');
        $yr_from = date('Y') + $from_offset;
        $yr_to = $yr_from - $yr_show;
        for ($i = $yr_to; $i <= $yr_from; $i++) {
            $year[$i] = $i; 
        }
        return $year;
    }

    public static function dateRange($startdt, $enddt) {

        $query = \Yii::$app->db->createCommand("
                SELECT '$startdt' + INTERVAL a + b DAY dte
                FROM
                 (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
                    UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
                    UNION SELECT 8 UNION SELECT 9 ) d,
                 (SELECT 0 b UNION SELECT 10 UNION SELECT 20 
                    UNION SELECT 30 UNION SELECT 40) m
                WHERE '$startdt' + INTERVAL a + b DAY  <=  '$enddt'
                ORDER BY a + b
                ");
        
        $result = $query->queryColumn();
        
        return $result;
    }
    /**
     * return perbezaan masa antara dua tarikh samada second, minit, hari, minggu, bulan, tahun
     * @param string $dt_from tarikh dari i.e 01/01/2011
     * @param string $dt_to tarikh hingga 30/01/2011
     * @param char $time_part s=second, m=minit, h=hour, d=day, w=week, mt=month, y=year
     * @return int 
     */
    public static function date_diff($dt_from, $dt_to, $time_part) {
        $dt_from2 = strtotime($dt_from); // date dlm second
        $dt_to2   = strtotime($dt_to); // date dlm second
        $sec = $dt_to2 - $dt_from2;
        
        switch($time_part) {
            case 's' :
                  return $sec;
                  break;
            case 'm' :
                 $min = $sec / 60;
                 return $min;
                 break;
             case 'h' :
                 $hour = $sec / (60 * 60);
                 return $hour;
                 break;
             case 'd' :
                 $day = $sec / (60 * 60 * 24);
                 return $day;
                 break;
             case 'y' :
                 $year = $sec / (60 * 60 * 24 * 365.25);
                 return (int)$year;
                 break;
             case 'mt' :
                 $month = $sec / (60 * 60 * 24 * 30);
                 return ceil($month); // anggaran terhampir
                 break;
            default :
                return 0;
        }
    } 
}