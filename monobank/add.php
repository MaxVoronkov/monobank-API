<?php
session_start();
include('./header.php') ;
if (isset($_SESSION['login'])) {

?>
<div  id="mono_info">
<h3>Карты:</h3>
<hr>
<?php

include('./function/get_user_info.php');
bal_card();

?>
<a href="info_acc.php">more </a>
</div>
<?php
include('./nav.php');
?>
<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-3">
		<h4>Аккаунт</h4>
		<form method="POST" action="function/add_acc.php">
			<p>Имя Аккаунта</p>
			<input type="text" name="mono_nameAcc" placeholder="name">
			<p>Токен Аккаунта</p>
			<textarea rows="4" cols="40" name="mono_tokenAcc" placeholder="insert token"></textarea><br>
			<input type="submit" value="ok">
		</form>
	</div>

</div>
<?php
}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

include('./footer.php');