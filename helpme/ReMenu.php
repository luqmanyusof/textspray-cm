<?php

namespace app\helpme;

class ReMenu {

    public function reappliStart($mode = 'edit', $curr = 'home', $hide=[]) {
        $menu = [
            'home'        => ['Permohonan', 'reschedule/create', ''],
            'confirm'     => ['Pengesahan', 'reschedule/confirm', '']
            ];
        
//        if ($mode === 'view') {
//            $menu['home'] = ['Permohonan', 'reschedule/view', 'fa-home']; 
//            $menu['confirm'] = ['Pengesahan', 'reschedule/confirm', 'fa-check-square-o'];
//            //unset($menu['confirm']);
//        }
        
        foreach ($hide as $h) {
            //unset($menu['confirm']);
        }
        
        $str  = "<legend><i class='green fa fa-file-text-o'></i> Permohonan Penjadualan Semula Pembiayaan</legend>";
        $str .= "<div class='tab-pane'>
                    <div class='tabbable'>
                        <ul id='myTab' class='nav nav-tabs'>";

        foreach ($menu as $key=>$val) {
            $title = $val[0];
            $url   = $val[1];
            $icon  = $val[2];
            if ($key === $curr) {
                $str .= "<li class='active'><a href='#$key' data-toggle='tab'><i class='green fa $icon bigger-120'></i> $title</a></li>";
            } else {
                $qstr = $_SERVER['QUERY_STRING'];
                //$qstr = substr_replace("r=reschedule/create","r=reschedule/confirm",0);
                $q2 = substr($qstr,19);
                if (substr($qstr,13,6) == 'create')
                    $q2 = 'confirm' . substr($qstr,19); // confirm
                else
                    $q2 = 'create' . substr($qstr,20); // create
                    
                $str .= "<li><a href='index.php?r=reschedule/$q2#$key'><i class='orange fa $icon bigger-120'></i> $title</a></li>";
            }
        }
        $str .= "</ul>
                <div class='tab-content'>
                    <div class='tab-pane fade in active' id='$key'>";
        return $str;
    }

    public function reappliEnd() {
        $str = "
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end tabable -->
                </div>";
        return $str;
    }

}
