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
<div id="pagemenu">
<button id="copy" onclick="selectElementContents( document.getElementById('report_table') );">Select</button>
    <form id="lim" action="index.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="lim" placeholder="сколько записей?">
    <input type="submit" value="OK">
    </form>
    <form id="lim" action="index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="lim" value="200000000000">
    <input type="submit" value="Показать все">
    </form>
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
$lim = $_POST['lim'];
if (isset($lim) and $lim != 0) {
	include('./function/get_statistic.php');
	all_stat($lim);
}else{
	include('./function/get_statistic.php');
	all_stat(50);
}


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