<?php

    if($_GET['q'] == 'Search...'){
        header('Location:index.php');
    }
    if($_GET['q'] !== ''){
        $con = mysql_connect('localhost','root','');
        $db = mysql_select_db('search_bar_tutorial');


?>
<!Doctype html>
<html>
	<head>
		<tittle>search bar</tittle>
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
			<form action="index.php" method="GET" id="searchForm" />
				<input type="text" name="q" id="searchBox" placeholder="" value="search..." maxlength="25" autocomplete="off" onmousedown="active();" onblur="inactive()" /><input type="submit" id="searchBtn" value="Go!" />
			</form>
			<?php
                if(!isset($q)){
                    echo '';
                }else {
                    $query = mysql_query("SELECT * FORM products WHERE title LIKE '%$q%' OR description LIKE '%$q%'");
                    $num_rows = mysql_num_rows($query);
                    ?>
                    <p><strong><?php echo $num_rows; ?></strong> result for '<?php echo $q; ?>'</p>
                    while ($row = mysql_fetch_array($query)) {
                        $id = $row['id'];
                        $tittle = $row['tittle'];
                        $desc = $row['description'];

                        echo '<h3>' . '' . $tittle . '' . $desc . '<br />';
                    }
                }
			?>
	</body>
</html>
<?php
    }else{
        header('locationL: index.php');
    }
?>