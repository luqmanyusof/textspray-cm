<?php
//use Yii;
namespace app\helpme;
use app\models\Program;
use app\models\Ref;

class PubMenuPbt {

    public function pbtStart($curr = 'home') {
        $menu = [
            'home'         => ['Maklumat Penjaja','pub/home/profil', ''], 
            'business'     => ['Maklumat Syarikat', 'pub/home/business-pbt', ''],
            'association'  => ['Maklumat Persatuan', 'pub/home/user-association', ''], 
            ];
           
        //$str  = "<legend><i class='green fa fa-file-text-o'></i> Kemaskini Data Penjaja Dari Sabah / Sarawak </legend>";
        $str = "<div class='tab-pane'>
                    <div class='tabbable'>
                        <ul id='myTab' class='nav nav-tabs'>";

        foreach ($menu as $key=>$val) {
            $userid  = \Yii::$app->user->id;
            $title = $val[0];
            $url   = $val[1];
            $icon  = $val[2];
            if ($key === $curr) {
                $str .= "<li class='active'><a href='#$key' data-toggle='tab'><i class='green fa $icon bigger-120'></i> $title</a></li>";
            } else {
                $seriesID = (isset($_REQUEST['seriesid']))?$_REQUEST['seriesid']:$userid;
                $qstr = $url."&id=".$seriesID;
                
                $str .= "<li><a href='index.php?r=$qstr'><i class='orange fa $icon bigger-120'></i> $title</a></li>";
            }
        }
        $str .= "</ul>
                <div class='tab-content'>
                    <div class='tab-pane fade in active' id='$key'>";
        return $str;
    }

    public function pbtEnd() {
        $str = "
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end tabable -->
                </div>";
        return $str;
    }

}
