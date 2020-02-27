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

// TODO: this allows user to go through a bunch of blank pages. try something like 
// $rowcount = mysqli_num_rows($resultDept);
// if($startrow > ($rowcount+20)){
// 	$startrow = $startrow-10;
// }
// after query
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
if(isset($_POST['data'])){
	$data = $_POST['data'];
}
else{
	$data = "VT";
}
if(isset($_POST['query_id'])){
	$query_id=$_POST['query_id'];
}
else {
	$query_id = 0;
}
// 1 - department
// TODO: 2 - application software 
// 3 - OS
// 4 - State
// 5 - zip



switch($query_id){
	case 1: //Department
		$queryDept = "select corpclient.cid,cfn,cln,dept_name, department.dept_id
		from corpclient, department
		where corpclient.dept_id = department.dept_id
		and department.dept_id = $data
		order by cid
		LIMIT $startrow, 10";
		$resultDept = mysqli_query($link, $queryDept);

	break;
	case 2: //Application software
	case 3: // OS
		$queryOS = "select corpclient.cid,cfn,cln,soft_name, software.soft_id
		from corpclient, software, clientsoftware
		where corpclient.cid=clientsoftware.cid 
		and software.soft_id=clientsoftware.soft_id 
		and software.soft_id = $data 
		order by cid
		LIMIT $startrow, 10";
		$resultOS = mysqli_query($link, $queryOS);
	break;
	case 4: //State
		$queryState = "select corpclient.cid,cfn,cln,cstreet,ccity,cst,czip
		from corpclient, address
		where corpclient.cid=address.cid
		and address.cst='$data'
		order by cid
		LIMIT $startrow, 10";
		$resultState = mysqli_query($link, $queryState);
	break;
	case 5: //zip
		$queryZip = "select corpclient.cid,cfn,cln,cstreet,ccity,cst,czip
		from corpclient, address
		where corpclient.cid=address.cid
		and address.czip=$data
		order by cid
		LIMIT $startrow, 10";
		$resultZip = mysqli_query($link, $queryZip);
	break;
	default:
		$query1 = "select cfn,cln,cem
		from corpclient
		order by cid
		LIMIT $startrow, 10";
		$result1 = mysqli_query($link,$query1);
	break;
}



	
echo"
<table id='showOutput'>
	<tr>";
	switch($query_id){
		case 1: //Department
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
		break;
		case 2: //Application software
		case 3: // OS
			echo"
		<td class='client_data'>Client First Name</td><td class='client_data'>Client Last Name</td><td class='client_data'>Software</td><td class='client_data'>Software ID</td></tr>";
		while($row = mysqli_fetch_array($resultOS))
		{
			echo"
			<tr>";
			echo"<td class='data_td'>{$row['cfn']}</td>" .
			"<td class='data_td'>{$row['cln']} </td>" .
			"<td class='data_td'>{$row['soft_name']}</td>".
			"<td class='data_td'>{$row['soft_id']}</td>";
			echo"</tr>";
		}
		break;
		case 4: //State
			echo"
		<td class='client_data'>Client First Name</td><td class='client_data'>Client Last Name</td><td class='client_data'>Street</td><td class='client_data'>City</td><td class='client_data'>State</td><td class='client_data'>Zip</td></tr>";
		while($row = mysqli_fetch_array($resultState))
		{
			echo"
			<tr>";
			echo"<td class='data_td'>{$row['cfn']}</td>" .
			"<td class='data_td'>{$row['cln']} </td>" .
			"<td class='data_td'>{$row['cstreet']}</td>".
			"<td class='data_td'>{$row['ccity']}</td>".
			"<td class='data_td'>{$row['cst']}</td>".
			"<td class='data_td'>{$row['czip']}</td>";
			echo"</tr>";
		}
		break;
		case 5: //zip
			echo"
		<td class='client_data'>Client First Name</td><td class='client_data'>Client Last Name</td><td class='client_data'>Street</td><td class='client_data'>City</td><td class='client_data'>State</td><td class='client_data'>Zip</td></tr>";
		while($row = mysqli_fetch_array($resultZip))
		{
			echo"
			<tr>";
			echo"<td class='data_td'>{$row['cfn']}</td>" .
			"<td class='data_td'>{$row['cln']} </td>" .
			"<td class='data_td'>{$row['cstreet']}</td>".
			"<td class='data_td'>{$row['ccity']}</td>".
			"<td class='data_td'>{$row['cst']}</td>".
			"<td class='data_td'>{$row['czip']}</td>";
			echo"</tr>";
		}
		break;
		default:
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
		break;
	}
	
	//use forms here to pass POST values.
echo"
	<tr>
		<td>
			<button class='btn' onclick=\"window.location.href='../index.php'\">Return to Home Page</button>
		</td>
		<td>
		<form method='post' action=".$_SERVER['PHP_SELF'].'?startrow='.($startrow-10).">
			<input type='hidden' name='query_id' value=".$query_id.">
			<input type='hidden' name='data' value=".$data.">
			<input class='btn' type='submit' value='Previous' />
		</form>
			
		</td>
		<td  colspan='3'>
		<form method='post' action=".$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).">
			<input type='hidden' name='query_id' value=".$query_id.">
			<input type='hidden' name='data' value=".$data.">
			<input class='btn' type='submit' value='Next' />
		</form>
			
		</td>
	</tr>
</table>";
mysqli_close($link);

include("../include/footer.inc");

?>



