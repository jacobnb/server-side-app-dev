<?php
require("../data/db_connect.php");
#$st = $_POST['st'];
/*
$sql = "select cfn,cln,cstreet,ccity,cst,czip,corpclient.cem
from corpclient, address
where corpclient.cem = address.cem and cst='$st'";
*/
#$result =  mysqli_query($link,$sql);
$sql_1 = "Select * from department";
$result1 = mysqli_query($link,$sql_1);

$sql_2 = "select distinct cst from address order by cst";
$result2 = mysqli_query($link,$sql_2);

if(!empty($_POST['cst']) or isset($_POST['cst']))
{
	$s = $_POST['cst'];
}
else
{
	$s = 'VT';
}
;
$sql_3 = "select distinct cst, czip from address 
			where cst='$s' order by czip";
$result3 = mysqli_query($link,$sql_3);

include("../include/header_1.inc");
echo"<title>View Client Data</title>";
include("../include/header_2.inc");
echo'
	<form name="manage" action="#" method="post">
	<table>
		<tr>
			<td>View Client Data By:</td>
		</tr>
		<tr>
			<td>
				<input type="radio" name="data" value="d">Department
				<input type="radio" name="data" value="s">State
				<input type="radio" name="data" value="z">Zip Code
		</tr>
		<tr>
			<td>
			<input type="submit" value="Select View" name="s">
			<input type="reset" value="Clear Form" name="r">
	</table>
	</form>
	
	<div id="dept">
		<form name="dept" action="#" method="post">
			<select name="d">
				<option value="">Choose One</option>';
				while($row = mysqli_fetch_assoc($result1))
				{
					echo"<option value='".$row['dept_id']."'>".$row['dept_name'];
				}
			echo'
			</select>
			<input type="submit" value="Select Department" />
		</form>
	</div>
	<div id="st">
		<form name="st" action="#" method="post">
			<select name="s">
				<option value="">Choose One</option>';
				while($row = mysqli_fetch_assoc($result2))
				{
					echo"<option value='".$row['cst']."'>".$row['cst'];
				}
			echo'
			</select>
			<input type="submit" value="Select State" />
		</form>
	</div>
	<div id="zip">
		<form name="zip" action="#" method="post">
			<select name="z">
				<option value="">Choose One</option>';
				while($row = mysqli_fetch_assoc($result3))
				{
					echo"<option value='".$row['czip']."'>".$row['czip'];
				}
			echo'
			</select>
			<input type="submit" value="Select State" />
		</form>
	</div>';
				
	
	

include("../include/footer.inc");
?>










