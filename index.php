<?php
$host = "localhost";
$user = "root";
$password = "";
$connect = mysql_connect($host, $user, $password) or die("Hey couldn't connect");
mysql_select_db("fds", $connect) or die("Hey couldn't connect to db");
?><!DOCTYPE HTML>
<html>
<head>
<title>Tooling Setup</title>
<style type="text/css">
#table {
	table-layout:auto;
	border: 1px solid #e3e3e3;
	background-color: #f2f2f2;
    width: 80%;
	margin-left:10%;
	margin-right:10%;
	border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	
}
#table td, #table th {
	padding: 5px;
	color: #333;
}
#table thead {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	padding: .2em 0 .2em .5em;
	text-align: center;
	color: #4B4B4B;
	background-color: #C8C8C8;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e3e3e3), color-stop(.6,#B3B3B3));
	background-image: -moz-linear-gradient(top, #D6D6D6, #B0B0B0, #B3B3B3 90%);
	border-bottom: solid 1px #999;
}
#table th {
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 17px;
	line-height: 20px;
	font-style: normal;
	font-weight: normal;
	text-align: center;
	text-shadow: white 1px 1px 1px;
	align: center;
}

#table td {
	line-height: 20px;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 14px;
	border-bottom: 1px solid #fff;
	border-top: 1px solid #fff;
}
#table td:hover {
	background-color: #fff;
}
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
$result = mysql_query($toolsql) or die(mysql_error());
while($row = mysql_fetch_array($result)) {
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