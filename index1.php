<?php
	
mysql_connect('localhost','root','password') or die (mysql_error("could not connect"));
//mysql_select_db('plant-range mapping') or die ("could not find db");
$output ='';	

if(isset($_POST['search'])){
	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
	$query = mysql_query("SELECT * FROM `plant-range mapping`.`data_test` WHERE plant_type LIKE '%$searchq%'") or die("could not search");
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
		
		}
	}
}
?>
<?php

//require("phpsqlajax_dbinfo.php");

// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ('localhost', 'root', 'password');
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

//$db_selected = mysql_select_db('Geo_data', $connection);
//if (!$db_selected) {
  //die ('Can\'t use db : ' . mysql_error());
//}

// Select all the rows in the markers table
if(isset($_POST['search'])){
  $searchq = $_POST['search'];
  $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

$query = "SELECT * FROM `Geo_data`.`markers` WHERE name LIKE '%$searchq%'";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("type", $row['type']);
}

//echo $dom->saveXML();
$dom->saveXML();
//$dom->load("test.xml");
$dom->save("test.xml");
}
?>
<!DOCTYPE html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<tittle></tittle>
		<link rel="stylesheet" href="css/style.css" />
		<style>
			#map {
        height: 100%;
        width: 50%;
        float: right;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
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
			<div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(8.7832, 20.5085),
          zoom: 3
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('test.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANgC3c_PB2k-eKeiPSh3DrysvEb7LzfuY&callback=initMap">
    </script>
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
