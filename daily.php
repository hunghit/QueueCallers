<?php

include_once("inc/defines.php");
include_once("inc/functions.php");
include_once("inc/dbconnect.php");

$sql = "SELECT *,ROUND(R.THOIGIAN/R.CUOCGOI) AS THOIGIANTB FROM ( SELECT CDR.dst, COUNT(CDR.dst) AS CUOCGOI, SUM(CDR.billsec) AS THOIGIAN FROM asteriskcdrdb.cdr CDR WHERE CDR.calldate > CURRENT_DATE() AND DATEDIFF(DATE(CDR.calldate),  CURRENT_DATE())=0  	AND CDR.lastapp='Dial'	AND  CDR.disposition = 'ANSWERED'	AND CDR.outbound_cnum = ''	AND LENGTH(CDR.src)>5 GROUP BY CDR.dst) AS R";



$result = mysqli_query($asdb, $sql ) or die("Invalid query: ".mysqli_error());

?>

<table>
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