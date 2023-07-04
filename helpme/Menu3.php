<?php

namespace app\helpme;

class Menu3 {

    public function appliStart($mode = 'edit', $curr = 'home', $hide=[]) {
        $menu = [
            'home'        => ['Permohonan','appeal/edit', 'fa-home']
            ];
        
        if ($mode === 'view') {
            $menu['home'] = ['Permohonan', 'appeal/view', 'fa-home']; 
            unset($menu['confirm']);
        }
        
        foreach ($hide as $h) {
            unset($menu['confirm']);
        }
        
        $str  = "<legend><i class='green fa fa-file-text-o'></i> Rayuan Permohonan Pembiayaan</legend>";
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
                $str .= "<li><a href='index.php?r=$url'><i class='orange fa $icon bigger-120'></i> $title</a></li>";
            }
        }
        $str .= "</ul>
                <div class='tab-content'>
                    <div class='tab-pane fade in active' id='$key'>";
        return $str;
    }

    public function appliEnd() {
        $str = "
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end tabable -->
                </div>";
        return $str;
    }

}
