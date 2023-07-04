<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\SysUser;

$client = SysUser::findOne($model->user_id);

?>
<!-- <div class="row">
	<div class="col-md-5" style="text-align:right;">
		<h1>INVOICE</h1>
	</div>
	<div class="col-md-5">
		<img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/images/billing.png" style="height: 70px; width:auto;">
	</div>
</div>
<br> -->
<table class="table" width="100%">
	<tr>
		<td width="30%">
			<img src="/<?php echo Yii::$app->id; ?>/images/billing.png" style="height: 70px; width:auto;">
		</td>
		<td align="right"><h1>RECEIPT</h1></td>
	</tr>
</table>

<table class="table">
	<tr><td>
		TextSpray<br>
		Addr1<br>
		addr2<br>
		addr3<br>
	</td></tr>
	<tr><td><br><br></td></tr>
	<tr><td>Bill to:<hr></td></tr>
	<tr><td><?= $client->su_name ?></td></tr>
</table>
<br><br>

<table class="table table-bordered table-striped" border="1">
	<tr>
		<td align="center"><b>DESCRIPTION</b></td>
		<td align="center"><b>QTY</b></td>
		<td align="center"><b>UNIT PRICE</b></td>
		<td align="center"><b>TOTAL</b></td>
	</tr>
	<tr>
		<td>
			<b>Monthly BIll: RM <?= number_format($model->amount,2) ?></b><br>For: <?= $model->month ?><br>Last Pay Date: <?= $model->last_pay_date ?>
		</td>
		<td align="center">1</td>
		<td align="right"><?= number_format($model->amount,2) ?></td>
		<td align="right"><?= number_format($model->amount,2) ?></td>
	</tr>
	<tr><td>-</td><td></td><td></td><td></td></tr>
	<tr><td>-</td><td></td><td></td><td></td></tr>
	<tr><td>-</td><td></td><td></td><td></td></tr>
	<tr><td colspan="2"></td><td><b>TOTAL</b></td><td align="right"><b>RM <?= number_format($model->amount,2) ?></b></td></tr>
</table>
<hr>
<table class="table" width="100%">
	<tr><td align="center">This is computer generated Receipt. Signature is not required.</td></tr>
</table>