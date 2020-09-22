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
	<table class="table table-striped" id="report_table" border="1" width="100%" >
	  <thead class="thead-dark">
	   <tr>
	   	<strong>
	     <th> Дата</th>
	     <th> Валюта</th>
	     <th> Покупка</th>
	     <th> Продажа</th>
	    </strong>
	   </tr>
	  </thead>
<?php
include('./function/get_exchange.php');
}else{
?>
  <script type="text/javascript">
location.replace("../login.php");
</script>
<?php
}

include('./footer.php');