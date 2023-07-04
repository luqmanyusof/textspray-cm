<?php
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\SysRole;
use app\models\SysMenu;
use app\helpme\VarDump;

NavBar::begin([
    'brandLabel' => '<img src="/' . Yii::$app->id . '/images/billing.png" style="height: 70px; width:auto;"> ' . Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    // 'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    // 'options' => ['class' => 'navbar-expand-md navbar-light', 'style' => 'background-color:#e3f2fd']
    'options' => ['class' => 'navbar-expand-md navbar-light']
]);
$menus = SysMenu::find()->leftjoin('sys_role', 'sys_role.sm_id = sys_menu.id')->where(['sys_role.code_role' => Yii::$app->user->identity->code_role])->andwhere(['is not', 'sm_url', null])->andWhere(['<>', 'sm_url', ''])->orderBy('sort')->all();

$item = [];
foreach($menus as $row){
    $arr = [
        'label' => ucwords(strtolower($row->sm_menu)),
        'url'   => [$row->sm_url ? '/'.$row->sm_url : '#'],
    ];
    array_push($item, $arr);
}

$arr2 = Yii::$app->user->isGuest
            ? ['label' => 'Login', 'url' => ['/site/login']]
            : '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout active']
                )
                . Html::endForm()
                . '</li>';

array_push($item,$arr2);

// VarDump::dump_debug($item);return;

echo Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $item
    // 'items' => [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'About', 'url' => ['/site/about']],
    //     ['label' => 'Contact', 'url' => ['/site/contact']],
    //     Yii::$app->user->isGuest
    //         ? ['label' => 'Login', 'url' => ['/site/login']]
    //         : '<li class="nav-item">'
    //             . Html::beginForm(['/site/logout'])
    //             . Html::submitButton(
    //                 'Logout (' . Yii::$app->user->identity->username . ')',
    //                 ['class' => 'nav-link btn btn-link logout']
    //             )
    //             . Html::endForm()
    //             . '</li>'
    // ]
]);
NavBar::end();
?>