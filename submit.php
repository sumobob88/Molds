<?php
session_start();
$post = $_SESSION['post'];
$host = "localhost";
$user = $_POST['user'];
$password = "";
$db = "fdstest";
$link = mysqli_connect($host, $user, $password, $db);
if(mysqli_connect_errno()){
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
if($_GET['action'] == "add" && $_GET['type'] == "tool") {
//Insert Tool into DB
$tool_name=$_POST['name'];
$date=$_POST['date'];
$product_id = $_POST['product_id'];
$tool_type = $_POST['tool_type'];
$tool_query = "INSERT INTO tools (date, user_name, tool_name, product_id, tool_type)" . 
"VALUES ( '" . $date . "','" . $user . "','" . $tool_name . "','" . $product_id . "','" . $tool_type . "')";
mysqli_query($link, $tool_query);
$tool_id=mysqli_insert_id($link);
//Insert Screws into DB
//Pull screw properties from POST
$screws_size = $_POST['screw_size'];
$screws_side = $_POST['screw_side'];
$screws_location = $_POST['screw_location'];
$screws_quantity = $_POST['screw_quantity'];
//Count property entries
$screws_size_count = count($screws_size);
$screws_side_count =count($screws_side);
$screws_location_count = count($screws_location);
$screws_quantity_count = count($screws_quantity);
//Find property with least entries. Set $screw_count equal to that number of entries
$screws_count=min($screws_size_count, $screws_side_count, $screws_location_count, $screws_quantity_count);
//Loop Through screws
//Set Up Insert statements
$screw_insert = "INSERT INTO screw (size, location) ";
$screw_setup_insert="INSERT INTO screw_setup (tool_id, screw_id, quantity) ";
for($i=0;$i<$screws_count;$i++){
	//set values to multidimensional array
	$screw[$i]['size'] = $screws_size[$i];
	$screw[$i]['side'] = $screws_side[$i];
	$screw[$i]['location'] = $screws_location[$i];
	$screw[$i]['quantity'] = $screws_quantity[$i];
	//merge side and location
	$screw[$i]['location']=$screw[$i]['side'] . ":" . $screw[$i]['location'];
$screw_values = "VALUES ('" . $screw[$i]['size'] . "', '" . $screw[$i]['location'] . "');";
$screw_query = $screw_insert . $screw_values;
mysqli_query($link, $screw_query);	
$screw_id = mysqli_insert_id($link);
$screw_setup_value = "VALUES (" . $tool_id . ", " . $screw_id . ", " . $screw[$i]['quantity'] . ")";
$screw_setup_query = $screw_setup_insert . $screw_setup_value;
mysqli_query($link, $screw_setup_query);

}
//Pull ring properties from POST
$ring_num = $_POST['ring_num'];
$ring_location = $_POST['ring_location'];
$ring_quantity = $_POST['ring_quantity'];
$ring_comment = $_POST['ring_comment'];
//Count num of entries in each property
$ring_num_count = count($ring_num);
$ring_location_count = count($ring_location);
$ring_quantity_count = count($ring_quantity);
//Find property with least entries (not including optional fields such as comment). Set $ring_count equal to that number of entries 
$ring_count = min($ring_num_count, $ring_location_count, $ring_quantity_count);
//Set up Insert statements
$ring_insert="INSERT INTO o_rings(num, location, notes) ";
$ring_setup_insert= "INSERT INTO o_ring_setup ( tool_id, o_rings_id, quantity) ";
//Loop through rings
for($i=0;$i<$ring_count;$i++){
	//set values to multidimensional
    $ring[$i]['num'] = $ring_num[$i];
    $ring[$i]['location'] = $ring_location[$i];
    $ring[$i]['quantity'] = $ring_quantity[$i];
    $ring[$i]['comment'] = $ring_comment[$i];
$ring_value="VALUES (" . $ring[$i]['num'] . ", '" . $ring[$i]['location'] . "', '" . $ring[$i]['comment'] . "');";
$ring_query = $ring_insert . $ring_value;
mysqli_query($link, $ring_query);
$ring_id=mysqli_insert_id($link);
$ring_setup_value= "VALUES (" . $tool_id . ", " . $ring_id . ", " . $ring[$i]['quantity'] . ");";
$ring_setup_query = $ring_setup_insert . $ring_setup_value;
mysqli_query($link, $ring_setup_query);
}
}
echo $screw_id . $ring_id;
?>