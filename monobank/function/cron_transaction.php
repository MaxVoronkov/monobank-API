<?php
include('../../inludes/db.php');
include('./mono_api.php');
$time = '-2 day';
$mono_user = mysqli_query($connection, "SELECT * FROM `mono_user`" );
while ( $mono_user_info = mysqli_fetch_assoc($mono_user)) {
$tok = $mono_user_info['token'];
$id_acc = $mono_user_info['mono_id'];
date_default_timezone_set('Europe/Kiev');
$mono_ta = transaction($tok, $id_acc, $time);
foreach ($mono_ta as $value) {
	$mono_ta_id = $value['id'];
	$normdate = date_create();
	date_timestamp_set($normdate, $value['time']) ;
	$mono_ta_date = date_format($normdate, 'Y-m-d H:i:s');
	$mono_amount = $value['operationAmount'];
	$mono_amount_val = $value['amount'];
	$mono_description = $value['description'];
	$mono_balance = $value['balance'];
	mysqli_query($connection, "INSERT INTO `mono_transaction` (`id`, `ta_mono_id`, `date`, `description`, `sum`, `val_sum`, `id_card`, `ballance`) VALUES  (NULL, '$mono_ta_id', '$mono_ta_date','$mono_description', '$mono_amount', '$mono_amount_val', '$id_acc', '$mono_balance');");
}
};
