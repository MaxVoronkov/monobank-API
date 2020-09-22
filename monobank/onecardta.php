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
info_all();
$idcard = $_GET['id'];
?>
<div id="pagemenu">
<button id="copy" onclick="selectElementContents( document.getElementById('report_table') );">Select</button>
</div>    
<div class="table-result">
	<table class="table table-striped" id="report_table" border="1" width="100%" >
	  <thead class="thead-dark">
	   <tr>
	   	<strong>
	     <th> Дата</th>
	     <th> Описание</th>
	     <th> Сумма по счету</th>
	     <th> Сумма в валюте карты</th>
	     <th> Карта/Имя</th>
	     <th> Баланс</th>
	    </strong>
	   </tr>
	  </thead>
<?php
	include('./function/get_statistic.php');
	stat_card($idcard);
?>
</table>
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