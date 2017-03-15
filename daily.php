<?php

include_once("inc/defines.php");
include_once("inc/functions.php");
include_once("inc/dbconnect.php");

$sql = "SELECT *,ROUND(R.THOIGIAN/R.CUOCGOI) AS THOIGIANTB FROM ( SELECT CDR.dst, COUNT(CDR.dst) AS CUOCGOI, SUM(CDR.billsec) AS THOIGIAN FROM asteriskcdrdb.cdr CDR WHERE CDR.calldate > CURRENT_DATE() AND DATEDIFF(DATE(CDR.calldate),  CURRENT_DATE())=0  	AND CDR.lastapp='Dial'	AND  CDR.disposition = 'ANSWERED'	AND CDR.outbound_cnum = ''	AND LENGTH(CDR.src)>5 GROUP BY CDR.dst) AS R";



$result = mysqli_query($asdb, $sql ) or die("Invalid query: ".mysqli_error());

?>
<html><head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>dst</th>
			<th>CUOCGOI</th>
			<th>THOIGIAN</th>
			<th>THOIGIANTB</th>
		</tr>
	</thead>
	<?php 
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row['dst'] . "</td>";
		echo "<td>" . $row['CUOCGOI'] . "</td>";
		echo "<td>" . $row['THOIGIAN'] . "</td>";
		echo "<td>" . $row['THOIGIANTB'] . "</td>";
		echo "</tr>";
	
	}
	?>
	

</table>
</div>
</body>
</html>