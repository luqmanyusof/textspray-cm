<?php

namespace app\helpme;

class Menu {

    public function seriesStart($curr = 'home') {
        $menu = [
            'home'          => ['<b>Siri</b>','series/edit', 'fa fa-home'], 
            'attachment'    => ['<b>Dokumen</b>', 'attachment/index-series', 'fa fa-file'],
            'schedule'      => ['<b>Jadual</b>', 'schedule/edit', 'fa fa-calendar'], 
            'participant'   => ['<b>Peserta</b>', 'participant/index', 'fa fa-group'],
            'resource'      => ['<b>Jurulatih</b>', 'resource/index', 'fa fa-male'],
            'history'       => ['<b>Sejarah Siri</b>','training-series-status/viewhistory','fa fa-history']
            ];
           
        $str  = "<legend><i class='green fa fa-file-text-o'></i> Maklumat Siri</legend>";
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
                $seriesID = (isset($_REQUEST['seriesid']))?$_REQUEST['seriesid']:$_GET['id'];
                $qstr = $url."&id=".$seriesID;
                
                $str .= "<li><a href='index.php?r=$qstr'><i class='orange fa $icon bigger-120'></i> $title</a></li>";
            }
        }
        $str .= "</ul>
                <div class='tab-content'>
                    <div class='tab-pane fade in active' id='$key'>";
        return $str;
    }

    public function seriesEnd() {
        $str = "
                            </div><!-- end tab-pane -->
                        </div><!-- end tab-content -->
                    </div><!-- end tabable -->
                </div>";
        return $str;
    }

}
