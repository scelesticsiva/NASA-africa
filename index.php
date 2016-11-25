<?php
	
mysql_connect('localhost','root','password') or die (mysql_error("could not connect"));
mysql_select_db('search_bar_tutorial') or die ("could not find db");
$output ='';	

if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$query = mysql_query("SELECT * FROM products WHERE title LIKE '%$searchq%'") or die("could not search");
	$count = mysql_num_rows($query);
	if($count == 0){
		$output ='no result';
	}else{
		while($row = mysql_fetch_array($query)){
			$title = $row['title'];
			$description = $row['description'];

			$output .= '<div> '.$title.' '.$description.'</div>';
		}
	}
}
?>
<!DOCTYPE html>
	<head>
		<tittle></tittle>
		<link rel="stylesheet" href="css/style.css" />
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
			<form action="index.php" method="post" id="searchForm">
				<input type="text" name="search" id="searchBar" placeholder="Search for members..." maxlength="25" autocomplete="off" onmousedown="active();" onblur="inactive()"  /><input type="submit" id="searchBtn" value="Go!" />
			</form>
	<?php print("$output")?>
			
	</body>
</html>
