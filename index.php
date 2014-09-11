<?php
parse_ini_file
$host = "localhost";
$user = "fds";
$password = "u7q2v7J6usSvrmnG";
$db = 'fds';
$mysqli = new mysqli($host,$user,$password, $db);
if($mysqli->connect_errno) {
	echo "Failed to connect to mysql". "( ". $mysqli->connect_errno . " ) - ". $mysqli->connect_error .".";
}
?><!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href='css/style.css'>
<title>Tooling Setup</title>
</style>
</head>
<body>
<table id="table">
	<thead>
	<tr>
            <th colspan="5">Tools
                <a href="addtool.php">[ADD]</a>
            </th>
	</tr>
	<tr>
		<th>Tool Name</th>
		<th>Product ID</th>
		<th>Tool Type</th>
		<th>Notes</th>
		<th>EDIT/DROP</th>
	</tr>
</thead>
<?php 
$toolsql = "SELECT * FROM tools";
$result = $mysqli->query($toolsql) or die(mysql_error());
while($row = $result->fetch_array(MYSQL_NUM)) {
?>
	<tr>
		<td>
			<?php echo $row['tool_name']; ?>
		</td>
		<td>
			<?php echo $row['product_id']; ?>
		</td>
		<td>
			<?php echo $row['tool_type']; ?>
		</td>
		<td>
			<?php echo $row['notes']; ?>
		</td>
		<td>
			<a href="tool.php?action=edit&id=<?php echo$row['tool_id']; ?>">[EDIT]</a>
			<a href="tool.php?action=delete&id=<?php echo$row['tool_id']; ?>">[DELETE]</a>
		</td>
	</tr>

<?php
 }
?>
</table>
<table id="table">
<thead>
    <tr>
        <th colspan="4">
            Hardware
        </th>
    </tr>
    <tr>
        <th colspan="4">
            Screws <a href="screw.php?action=add&id=">[ADD]</a>
        </th>
    </tr>
    <tr>
        <th>Size</th>
        <th>Location</th>
        <th>Notes</th>
        <th>EDIT/DROP</th>
    </tr>
</thead>
<?php
$screwsql = "SELECT * FROM screw";
$result = mysql_query($screwsql) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
?>
    <tr>
        <td>
            <?php echo $row['size']; ?>
        </td>
        <td>
            <?php echo $row['location']; ?>
        </td>
        <td>
            <?php echo $row['notes']; ?>
        </td>
        <td>
            <a href="screw.php?action=edit&id=<?php echo$row['id']; ?>">[EDIT]</a>
            <a href="screw.php?action=delete&id=<?php echo$row['id']; ?>">[DELETE]</a>
        </td>
    </tr>
<?php
}
?>
    <tr>
        <th colspan="4">O-Rings
            <a href="ring.php?action=add&id=">[ADD]</a>
        </th>
    </tr>
    <tr>
        <th>O-Ring Num</th>
        <th>Location</th>
        <th>Notes</th>
        <th>EDIT/DROP</th>
    </tr>
<?php 
$ringsql = "SELECT * FROM o_rings";
$result = mysql_query($ringsql) or die(mysql_error());
while($row = mysql_fetch_array($result)) {
?>
    <tr>
        <td>
            <?php echo $row['num']; ?>
        </td>
        <td>
            <?php echo $row['location']; ?>
        </td>
        <td>
            <?php echo $row['notes']; ?>
        </td>
        <td>
		<a href="ring.php?action=edit&id=<?php echo$row['id']; ?>">[EDIT]</a>
		<a href="ring.php?action=delete&id=<?php echo$row['id']; ?>">[DELETE]</a>
        </td>
    </tr>
<?php
 }

?>
</table>
</body>
</html>
