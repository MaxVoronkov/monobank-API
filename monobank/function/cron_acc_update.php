<?php

	include('./mono_api.php');
	include('../../inludes/db.php');
	$mono_user = mysqli_query($connection, "SELECT DISTINCT token FROM `mono_user`" );
	while ( $mono_user_info = mysqli_fetch_assoc($mono_user)) {
		$tok = $mono_user_info['token'];
		$returned_mono_acc = acc_api($tok);
		$mono_accounts = $returned_mono_acc['accounts'];
foreach ($mono_accounts as $value) {
	$mono_id = $value['id'] ;
	$mono_bal = $value['balance'] ;
	mysqli_query($connection, "UPDATE `mono_user` SET `balance` = '$mono_bal' WHERE `mono_id` = '$mono_id'"   );
}
}
