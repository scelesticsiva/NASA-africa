<?php
	
mysql_connect('localhost','root','password') or die (mysql_error("could not connect"));
mysql_select_db('plant-range mapping') or die ("could not find db");
$output ='';	

if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$query = mysql_query("SELECT * FROM data_test WHERE plant_type LIKE '%$searchq%'") or die("could not search");
	$count = mysql_num_rows($query);
	if($count == 0){
		$output ='no result';
	}else{

		while($row = mysql_fetch_array($query)){
			$plant_type = $row['plant_type'];
			$SOC_range = $row['SOC range'];
			$PIND_range = $row['PIND range'];
			$PH_range = $row['PH range'];
			$Ca_range = $row['Ca range'];
			$P_range = $row['P range'];
			$output = $output.'<tr>'.
			'<td>'.$plant_type.'</td>'
			.'<td>'.$SOC_range.'</td>'
			.'<td>'.$PIND_range.'</td>'
			.'<td>'.$PH_range.'</td>'
			.'<td>'.$Ca_range.'</td>'
			.'<td>'.$P_range.'</td>';
			//$title = $row['title'];
			//$description = $row['description'];
			//$output = $output.'<tr>'.
			//'<td>'.$title.'</td>';
			//.'<td>'.$description.'</td>';

			//$output .= '<div> '.$title.' '.$description.'</div>';
		}
	}
}
?>
<!DOCTYPE html>
	<head>
		<tittle></tittle>
		<link rel="stylesheet" href="css/style.css" />
		<style>
			table, th, td {
    			border: 1px solid black;
			}
		</style>
		<script type="text/javascript">
			function active(){
				var searchBar = document.getElementById('searchBar');

				if(searchBar.value == 'search...'){
					searchBar.value =''
					searchBar.placeholder = 'search...'
				}
			}
			function inactive(){
				var searchBar = document.getElementById('searchBar');

				if(searchBar.value == ''){
					searchBar.value ='search...'
					searchBar.placeholder = ''
				}
			}
		</script>
	<head>
	<body>
			<form action="index1.php" method="post" id="searchForm">
				<input type="text" name="search" id="searchBar" placeholder="Search for members..." maxlength="25" autocomplete="off" onmousedown="active();" onblur="inactive()"  /><input type="submit" id="searchBtn" value="Go!" />
			</form>
			<br></br>
			<p>Detailes</p>
			<table style="width:30%">
			<tr>
			    <th></th>
			    <th>PIDN range</th> 
			    <th>SOC range</th>
			    <th>ph range</th>
			    <th>Ca range</th>
			    <th>P range</th>
			</tr>
			<?php 
			echo $output;
			?>

  
</table>

	
			
	</body>
</html>
