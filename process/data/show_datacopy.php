<?php
require_once("db_connect.php");
include("../include/header_1.inc");
echo "<title>Client Data</title>";
include("../include/header_2.inc");
$sql = "select * from corpclient";
$result = mysqli_query($link,$sql);
$rowcount=mysqli_num_rows($result);

if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} 
elseif($_GET['startrow']<=0)
{
  $startrow = 0;
}

elseif($_GET['startrow']<$rowcount and $_GET['startrow']!=0)
{
  $startrow = (int)$_GET['startrow'];
}

else
{
	$startrow = 0;
}
// variables to replace
// cfn, cln, cem, database? cid, 

// chunks - full name, address

// address: first name, last name, street, city, state, zip
// department: ID, full name, dept ID, department, 
// - department.dept_name / dept_id
// application software: ID, full name
// - software.soft_id = #
// operating system: full name, operating system.
// - software.soft_id = #
// residency by state: full name, address
// - address.cst = 'CC'
// residency by zip: full name, address
// - address.czip = #####
// just query everything and then display bits?
$query1 = "select cfn,cln,cem
from corpclient
order by cid
LIMIT $startrow, 10";
$result1 = mysqli_query($link,$query1);

$dept = 3;
$queryDept = "select corpclient.cid,cfn,cln,dept_name, department.dept_id
from corpclient, department
where corpclient.dept_id = department.dept_id
and department.dept_id = $dept
order by cid
LIMIT $startrow, 10";
$resultDept = mysqli_query($link, $queryDept);


	
echo"
<table id='showOutput'>
	<tr>";

	if(false){
		echo"
		<td class='client_data'>Client First Name</td><td class='client_data'>Client Last Name</td><td class='client_data'>Email</td></tr>";

		while($row = mysqli_fetch_array($result1))
		{
			echo"
			<tr>";
			echo"<td class='data_td'>{$row['cfn']}</td>" .
			"<td class='data_td'>{$row['cln']} </td>" .
			"<td class='data_td'>{$row['cem']}</td>";
			echo"</tr>";
		}
	}
	elseif(isset($dept)){
		echo"
		<td class='client_data'>Client First Name</td><td class='client_data'>Client Last Name</td><td class='client_data'>Dept Name</td><td class='client_data'>Dept ID</td></tr>";
		while($row = mysqli_fetch_array($resultDept))
		{
			echo"
			<tr>";
			echo"<td class='data_td'>{$row['cfn']}</td>" .
			"<td class='data_td'>{$row['cln']} </td>" .
			"<td class='data_td'>{$row['dept_name']}</td>".
			"<td class='data_td'>{$row['dept_id']}</td>";
			echo"</tr>";
		}
	}
	
echo"
	<tr>
		<td>
			<button class='btn' onclick=\"window.location.href='../index.php'\">Return to Home Page</button>
		</td>
		<td>
			<a class='btn' href=".$_SERVER['PHP_SELF'].'?startrow='.($startrow-10);
			echo">Previous</a>
		</td>
		<td  colspan='3'>
			<a class='btn' href=".$_SERVER['PHP_SELF'].'?startrow='.($startrow+10);
			echo">Next</a>
		</td>
	</tr>
</table>";
mysqli_close($link);

include("../include/footer.inc");

?>



