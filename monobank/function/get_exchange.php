<?php
session_start();
if (isset($_SESSION['login'])) {
include('../inludes/db.php');

	$mono_exchange_data = mysqli_query($connection, "SELECT * FROM `mono_exchange` ORDER BY `date` DESC");
	while ($mono_exchange = mysqli_fetch_assoc($mono_exchange_data)) {
?>
	<tr>
     <th> <?php echo $mono_exchange['date']; ?></th>
     <th> <?php echo $mono_exchange['currency']; ?></th>
     <th> <?php echo str_replace(".", ",", $mono_exchange['buy']); ?></th>
     <th> <?php echo str_replace(".", ",", $mono_exchange['Sell']); ?></th>
  	</tr>
<?php
}
}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

