echo"
<table id='showOutput'>
	<tr>
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