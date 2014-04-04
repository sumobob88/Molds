<?php 
$host = "localhost";
$user = "root";
$password = "pw";
$connect = mysql_connect($host, $user, $password) or die("Hey couldn't connect to db");
mysql_select_db("fdstest", $connect) or die("Hey couldn't connect to db");
if($_GET['action']=="edit"){
	$tool_id = $_GET['id'];
	$tool_query = "SELECT * FROM tools WHERE tool_id=" . $tool_id;
	$tool_result = mysql_query($tool_query);
	if(mysql_num_rows($tool_result)!== 1){ echo "There has been an error with your query"; }
	$tool_row = mysql_fetch_array($tool_result);
	$ts = $tool_row['ts'];
	$user = $tool_row['user_name'];
	$tool_name = $tool_row['tool_name'];
	$product_id = $tool_row['product_id'];
	$tool_type = $tool_row['tool_type'];
	$notes = $tool_row['notes'];
?><!DOCTYPE HTML>
<html>
<head>
<title><?php echo ucfirst($_GET['action']); ?> Tool</title>
<style type="text/css">
#table {
	table-layout:fixed;
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
<form action="commit.php?action=edit&type=tool" method="post">
<table id="table">
<thead>
	<tr>
		<th colspan="4"> Edit Tool
                </th>	
        </tr>
</thead>	
    <tr>
        <th colspan="2">Tool Name:</th>
            <td colspan="2">
                <input type="text" name="name" value="<?php echo $tool_name; ?>">
       		</td>
    </tr>	
    <tr>
        <th>Date:</th>
        <td>
            <input type="text" name="date" value="<?php echo date("m-d-Y"); ?>" readonly="readonly"/>
        </td>
        <th>User Name:</th>
        <td>
            <input type="text" name="user" value="<?php echo $user; ?>" readonly="readonly"/>
        </td>
    </tr>
    <tr>
        <th>Product ID:</th>
        <td>
            <input type="text" name="product_id" value="<?php echo $product_id; ?>">
        </td>
        <th>Tool Type:</th>
        <td>
            <select name="tool_type">
                <option value="">Select Tool Type...</option>
                <option value="form_tool" <?php if ($tool_type=="form_tool") { echo "selected"; }?>>Form Tool</option>
                <option value="pre_punch"<?php if ($tool_type=="pre_punch") { echo "selected"; }?>>Pre Punch</option>
                <option value="trim"<?php if ($tool_type=="trim") { echo "selected"; }?>>Trim Tool</option>
            </select>
        </td>
    </tr>
</table>
<table id="table">
<thead>
    <tr>
        <th colspan="4">HARDWARE</th>
    </tr>
</thead>
    <tr>
        <th colspan="4"><b>Screws</b></th>
    </tr>
    <tr>
        <td colspan="4" align="center">
             Screw Sizes and Locations Below<br>
        </td>
    </tr>
<?php 	
//Pull screw ids associated with the tool from screw setup
$screw_setup_query = "SELECT * FROM screw_setup WHERE tool_id=" . $tool_id;
$screw_setup_result =mysql_query($screw_setup_query);
//put the ids in an array
while($row = mysql_fetch_array($screw_setup_result)){
	$screw[$row['screw_id']]['id'] = $row['screw_id'];
	$screw[$row['screw_id']]['quantity'] = $row['quantity'];
	$screw_query = "SELECT id, size, location, notes FROM screw WHERE id=" . $row['screw_id'];
	$screw_result = mysql_query($screw_query);
	$screw_row=mysql_fetch_assoc($screw_result);
	$screw[$row['screw_id']]['size'] = $screw_row['size'];
	$screw[$row['screw_id']]['location'] = $screw_row['location'];
	$screw[$row['screw_id']]['note'] = $screw_row['notes'];	
	}
$screw_query = "SELECT id, size, location, notes FROM screw ORDER BY id";
$screw_result =mysql_query($screw_query)or die(mysql_error());
while($row=mysql_fetch_array($screw_result)) {
	$ssize[$row['id']] = $row['size'];
	$sloc[$row['id']] = $row['location'];
	$snote[$row['id']] = $row['notes'];
	}
$sloc=array_unique($sloc);
$ssize=array_unique($ssize);
foreach($sloc as $id =>$place) {
	list($side[$id], $loc[$id])= explode(":", $place);
}
$side = array_unique($side);
$loc = array_unique($loc);
?>
	<tr>
		<td>
			Screw Sizes:
		</td>
		<td>
			Position
		</td>
		<td>
			Location
		</td>
		<td>
			Quantity
		</td>
	</tr>
<?php 
$screw_count = count($screw);
foreach($screw as $screw_id) {
list($screw[$screw_id['id']]['side'], $screw[$screw_id['id']]['location'])=explode(":", $screw[$screw_id['id']]['location']);
$current_screw = current($screw);
$last_screw = end($screw);
?>
	 <tr>
        <td>
        	<input type="button" id="screw_size_button" name="screw_size[]" value="">
                <select id="screw_size_list" name="screw_size[]">
                    <option value="">Select a Screw Size...</option>
                        <?php foreach ($ssize as $ssize_name) {	?>
                    <option value="<?php echo $ssize_name;?>" <?php if($ssize_name == $screw[$screw_id['id']]['size']){echo "selected"; }?>>
                    	<?php echo $ssize_name; ?>
                   	</option>
                        <?php } ?>
		</select>
            <?php if ($screw_id === $last_screw) {?><div id="screw_size_edit"></div><?php }?>
        </td>
        <td>
        	<input type="button" id="screw_side_button" name="screw_side[]" value="">
                <select id="screw_side_list" name="screw_side[]">
                        <option value="">Select a side...</option>
                        <option value="plug_assist" <?php if ($screw[$screw_id['id']]['side'] == "plug_assist") { echo "selected"; } ?>>Plug Assist Side</option>
                        <option value="cavity" <?php if ($screw[$screw_id['id']]['side'] == "cavity") { echo "selected"; } ?>>Cavity Side</option>
                </select>	
           <?php if ($screw_id === $last_screw) {?><div id="screw_position_edit"></div><?php }?>  
        </td>
        <td>
            <select name="screw_location[]">
                <option value="">Select a Location</option>
                <?php foreach ($loc as $value) { ?>
               		<option value="<?php echo $value; ?>" <?php if ($value == $screw[$screw_id['id']]['location']){ ?> selected <?php }?>>
               		<?php echo $value; ?></option>
               		<?php }?>
            </select>
           <?php if ($screw_id === $last_screw) {?><div id="screw_location"></div><?php }?>
        </td>
        <td>
            <select name='screw_quantity[]'>
                <option value=''>Select # of Screws...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($i == $screw[$screw_id['id']]['quantity']) {?>selected <?php }?> >
                <?php echo $i; ?></option>
                <?php }?>
            </select>
            <?php 
            if ($screw_id === $last_screw) {?><div id="screw_quantity"></div><?php }?>
      </td>		
    </tr>
<?php 
}
?>
	 <tr>
	 <td align="center">
	 	<div id="add_screw">
            +
        </div>
       </td>
    </tr>
    <tr>
        <td>
            New Size:
            <input type='text' name='screw_size[]'>
            <div id="add_s_size">
            </div>
        </td>
        <td>
            New Position: 
            <select name='screw_side[]'>
                <option value="">Select a side...</option>
                <option value="plug_assist">Plug Assist Side</option>
                <option value="cavity">Cavity Side</option>
            </select>
            <div id="add_s_side">
            </div>
        </td>
        <td>
            New Screw Location: 
            <input type="text" name="screw_location[]">
            <div id="add_s_location">
            </div>
        </td>
        <td>
            Screw Quantity:
            <select name='screw_quantity[]'>
                <option value=''>Select # of Screws...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?>
            </select>
            <div id="add_s_quantity">
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="4">
        <div id="add_new_screw">
            +
        </div>
        </td>
    </tr>
	<tr>
        <th colspan="4"><b>O-Rings</b></th>
    </tr>
</table>
</form>
</body>
<?php 
}
if($_GET['action']=="add") {
$screw_query = "SELECT id, size, location FROM screw ORDER BY id";
$screw_result =mysql_query($screw_query)or die(mysql_error());
while($row=mysql_fetch_array($screw_result)) {
	$ssize[$row['id']] = $row['size'];
	$sloc[$row['id']] = $row['location'];
}
$ring_query = "SELECT id, num, location FROM o_rings ORDER BY id";
$ring_result =mysql_query($ring_query)or die(mysql_error());
while($row=mysql_fetch_array($ring_result)) {
	$rnum[$row['id']] = $row['num'];
	$rloc[$row['id']] = $row['location'];
}
foreach($sloc as $id => $place) {
list($side[$id], $loc[$id])=explode(":", $place);
 }
$sside = array_unique($side);
$sloc = array_unique($loc);
$sside = array_values($sside);
$sloc = array_values($sloc);
$ssize = array_unique($ssize);
$rloc = array_unique($rloc);
?>
</head>
<body>
<form action="commit.php?action=add&type=tool" method="post">
<table id="table">
<thead>
	<tr>
		<th colspan="4"> New Tool
                </th>	
        </tr>
</thead>	
    <tr>
        <th colspan="2">Tool Name:</th>
            <td colspan="2">
                <input type="text" name="name">
        </td>
    </tr>	
    <tr>
        <th>Date:</th>
        <td>
            <input type="text" name="date" value="<?php echo(date('n/j/Y')); ?>" />
        </td>
        <th>User Name:</th>
        <td>
            <input type="text" name="user" value="<?php echo $user; ?>" />
        </td>
    </tr>
    <tr>
        <th>Product ID:</th>
        <td>
            <input type="text" name="product_id">
        </td>
        <th>Tool Type:</th>
        <td>
        	<input type="button" id="tool_type" name="tool_type" value="Select a Tool Type">
            <select id="tool_type_select" name="tool_type_select">
                <option value="">Select Tool Type...</option>
                <option value="form_tool">Form Tool</option>
                <option value="pre_punch">Pre Punch</option>
                <option value="trim">Trim Tool</option>
            </select>
        </td>
    </tr>
</table>
<table id="table">
<thead>
    <tr>
        <th colspan="4">HARDWARE</th>
    </tr>
</thead>
    <tr>
        <th colspan="4"><b>Screws</b></th>
    </tr>
    <tr>
        <td colspan="4" align="center">
            Select a Screw Size and Location Below<br>
        </td>
    </tr>
    <tr>
        <td>
            Screw Size: 
                <select name="screw_size[]">
                    <option value="">Select a Screw Size...</option>
                        <?php foreach ($ssize as $ssize_name) {	?>
                    <option value="<?php echo $ssize_name; ?>"><?php echo $ssize_name; ?> </option>
                        <?php } ?>
		</select>
            <div id="screw_size">
            </div>
        </td>
        <td>
            Position: 
                <select name="screw_side[]">
                        <option value="">Select a side...</option>
                        <option value="plug_assist">Plug Assist Side</option>
                        <option value="cavity">Cavity Side</option>
                </select>	
            <div id="screw_position">
            </div>
        </td>
        <td>
            Location: 
            <select name="screw_location[]">
                <option value="">Select a Location</option>
                <?php foreach ($sloc as $value) {?>
                <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                <?php }	?>
            </select>
            <div id="screw_location">
            </div>
        </td>
        <td>
            Quantity:
            <select name='screw_quantity[]'>
                <option value=''>Select # of Screws...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <div id="screw_quantity">
            </div>
        </td>		
    </tr>
    <tr>
    	<div id="add_screw">
        <td colspan="4">
            <input type="button" value="+">
        </td>
        </div>
    </tr>
    <tr>
        <td>
            New Size:
            <input type='text' name='screw_size[]'>
            <div id="add_s_size">
            </div>
        </td>
        <td>
            New Position: 
            <select name='screw_side[]'>
                <option value="">Select a side...</option>
                <option value="plug_assist">Plug Assist Side</option>
                <option value="cavity">Cavity Side</option>
            </select>
            <div id="add_s_side">
            </div>
        </td>
        <td>
            New Screw Location: 
            <input type="text" name="screw_location[]">
            <div id="add_s_location">
            </div>
        </td>
        <td>
            Screw Quantity:
            <select name='screw_quantity[]'>
                <option value=''>Select # of Screws...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?>
            </select>
            <div id="add_s_quantity">
            </div>
        </td>
    </tr>
    <tr>
    	<div id="add_new_screw">
        <td colspan="4">
            <input type="button" value="+">
        </td></div>
    </tr>
    <tr>
        <th colspan="4"><b>O-Rings</b></th>
    </tr>
    <tr>
        <td colspan="4">
            Select an O-Ring # and Location Below
        </td>
    </tr>
    <tr>
        <td>
            O-Ring #:
            <select name="ring_num[]">
                <option value="">Select an O-Ring #</option>
                <?php foreach ($rnum as $r_num_value) {	?>
                <option value="<?php echo $r_num_value; ?>"><?php echo $r_num_value; ?> </option>
                <?php }	?>
            </select>
            <div id="ring_num">
            </div>
        </td>
        <td>
            Location:
            <select name="ring_location[]">
                <option value="">Select a Location</option>
                <?php foreach ($rloc as $rloc_value) { ?>
                <option value="<?php echo $rloc_value; ?>"><?php echo $rloc_value; ?> </option>
                <?php } ?>
            </select>
            <div id="ring_location">
            </div>
        </td>
        <td>
            Quantity:
            <select name='ring_quantity[]'>
                <option value=''>Select # of Rings...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <div id="ring_quantity">
            </div>
        </td>
        <td>
            Comments:
            <input type="text" name="ring_comment[]">
            <div id="ring_comment">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <input type="button" onclick="ring_Input()" value="+">
        </td>
	</tr>
    <tr>
        <td>
            New Ring Num: 
            <input type="text" name="ring_num[]">
            <div id="add_ring_num">
            </div>
        </td>
        <td>
            New Ring Location: 
            <input type="text" name="ring_location[]">
            <div id="add_ring_location">
            </div>
        </td>
        <td>
            New Quantity:
            <select name='ring_quantity[]'>
                <option value=''>Select # of Rings...</option>
                <?php for($i=0;$i<32;$i++){ ?>
                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <div id="add_ring_quantity">
            </div>
        </td>
        <td>
            Comment:
            <input type="text" name="ring_comment[]">
            <div id="add_ring_comment">
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <input type="button" onclick="add_ring_Input()" value="+">
        </td>
    </tr>
    <tr>
        <td colspan="4" >
            <input type="submit" name="Submit" value="Submit">
            <input type="reset" name="Clear Form">
        </td>
    </tr>
</table>
</form>
</body>
<?php 
}
?>
<script src="http://yui.yahooapis.com/3.5.1/build/yui/yui-min.js"></script>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.9.0/build/menu/assets/skins/sam/menu.css&2.9.0/build/button/assets/skins/sam/button.css"> 
<!-- Combo-handled YUI JS files: --> 
<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.9.0/build/yahoo-dom-event/yahoo-dom-event.js&2.9.0/build/container/container_core-min.js&2.9.0/build/menu/menu-min.js&2.9.0/build/element/element-min.js&2.9.0/build/button/button-min.js"></script>
<script>
YUI().use('node', function (Y) {
	var oToolTypeMenu = new YAHOO.widget.Button("tool_type", {
												type: "menu",
												menu: "tool_type_select" });
	
	var oScrewSizeMenu = new YAHOO.widget.Button("screw_size_button", {
												type: "menu",
												menu: "screw_size_select" });
	var oScrewSideMenu = new YAHOO.widget.Button("screw_side_button", {
												type: "menu",
												menu: "screw_side_select" });
    var add_screw = function() {
		var node1 =Y.all('#screw_size');
		var node2 =Y.all('#screw_position');
		var node3 = Y.all('#screw_location');
		var node4 = Y.all('#screw_quantity');
        node1.insert("<select name='screw_size[]'> <option value=''>Select a Screw Size...</option><?php foreach ($ssize as $ssize_name){?><option value='<?php echo $ssize_name; ?>'><?php echo $ssize_name; ?> </option><?php } ?></select><br>");
		node2.insert("<select name='screw_side[]'><option value=''>Select a side...</option><option value='plug_assist'>Plug Assist Side</option><option value='cavity'>Cavity Side</option></select><br>");
		node3.insert("<select name='screw_location[]'><option value=''>Select a Location</option><?php foreach ($sloc as $value) {?><option value='<?php echo $value; ?>'><?php echo $value; ?></option><?php } ?></select>");
		node4.insert("<select name='screw_quantity[]'><option value=''>Select # of Screws...</option><?php for($i=0;$i<32;$i++){ ?><option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?></select>");
	}
	var add_new_screw function() {
		var node1 =Y.all('#add_s_size');
		var node2 =Y.all('#add_s_side');
		var node3 = Y.all('#add_s_location');
		var node4 = Y.all('#add_s_quantity');
		node1.insert("<select name='screw_size[]'> <option value=''>Select a Screw Size...</option><?php foreach ($ssize as $ssize_name){?><option value='<?php echo $ssize_name; ?>'><?php echo $ssize_name; ?> </option><?php } ?></select><br>");
		node2.insert("<select name='screw_side[]'><option value=''>Select a side...</option><option value='plug_assist'>Plug Assist Side</option><option value='cavity'>Cavity Side</option></select><br>");
		node3.insert("<select name='screw_location[]'><option value=''>Select a Location</option><?php foreach (array_unique($sloc) as $value) {?><option value='<?php echo $value; ?>'><?php echo $value; ?></option><?php } ?></select>");
		node4.insert("<select name='screw_quantity[]'><option value=''>Select # of Screws...</option><?php for($i=0;$i<32;$i++){ ?><option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?></select>");
	}
    var add_screw = Y.one("#add_screw");
	var add_new_screw = Y.one("#add_new_screw");
    add_screw.on("click", add_screw);
	add_new_screw.on("click", add_new_screw);
});
</script>