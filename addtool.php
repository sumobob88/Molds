<?php
$host = "localhost";
$user = "root";
$password = "";
$connect = mysql_connect($host, $user, $password) or die("Hey couldn't connect to db");
mysql_select_db("fds", $connect) or die("Hey couldn't connect to db");
// Find Current Screws and create result array
$screw_query = "SELECT id, size, location FROM screw ORDER BY id";
$screw_result =mysql_query($screw_query)or die(mysql_error());
while($row=mysql_fetch_array($screw_result)) {
	$ssize[$row['id']] = $row['size'];
	$sloc[$row['id']] = $row['location'];
}
//Find O-Rings and create array by exploding field
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
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Tool</title>
<style>
#accordionresize {
	width:90%;
	margin-left:5%;
	margin-right:5%;
}
table{
	width:100%
}


</style>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.multi-accordion-1.5.3.js"></script>
<script type="text/javascript" src="addscript.js"></script>
</head>
<body>
<form action="commit.php?action=add&type=form_tool" method="post">
<div id="accordionresize">
<div id="accordion">
	<div id="tool_info">
		<h3><a href="#"><b>Tool Info</b></a></h3>
		<div>
			<table>
				<thead>
					<tr>
						<th colspan="4" align="center">
						Enter Tool Information Below<br>
						</th>
					</tr>
				</thead>
				<tbody>
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
						<th><label for="product_id">Product ID:</label></th>
						<td>
							<input type="text" name="product_id">
						</td>
						<th>Tool Type:</th>
						<td>
							<div id="tool_type">
							<label for="form_tool">Form Tool</label><input type="radio" name="tool_type" id="form_tool" value="form_tool">
							<label for="pre_punch">Pre Punch</label><input type="radio" name="tool_type" id="pre_punch" value="pre_punch">
							<label for="trim_tool">Trim Tool</label><input type="radio" name="tool_type" id="trim_tool" value="trim_tool">
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
		<div class="form_tool">
		<h3><a href="#"><b>Hardware</b></a></h3>
		<div id="hardware">
			<ul>
				<li><a href="#screw_tab"><b>Screws</b></a></li>
				<li><a href="#ring_tab"><b>O-Rings</b></a></li>
			</ul>
			<div id="screw_tab">
				<table>
					<thead>
						<tr>
							<th colspan="4" align="center">
								Select a Screw Size and Location Below<br>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Screw Size:
								<select name="screw[size][]">
								<option value="">Select a Screw Size...</option>
								<?php foreach ($ssize as $ssize_name) {	?>
								<option value="<?php echo $ssize_name; ?>"><?php echo $ssize_name; ?> </option>
								<?php } ?>
								</select>
							</td>
							<td>
								Position:
								<select name="screw[side][]">
									<option value="">Select a side...</option>
									<option value="plug_assist">Plug Assist Side</option>
									<option value="cavity">Cavity Side</option>
								</select>
							</td>
							<td>
								Location:
								<select  name="screw[location][]">
									<option value="">Select a Location</option>
									<?php foreach ($sloc as $value) {?>
									<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
									<?php }	?>
								</select>
							</td>
							<td>
							Quantity:
								<select  name="screw[quantity][]">
									<option value=''>Select # of Screws...</option>
									<?php for($i=0;$i<32;$i++){ ?>
									<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="button" class="button" value="+">
							</td>
						</tr>
						<tr>
							<th colspan="4" align="center">
							Create a New Screw<br>
							</th>
						</tr>
						<tr>
							<td>
								New Size:
								<input type='text' name="screw[size][]">
							</td>
							<td>
								New Position:
								<select name="screw[side][]">
									<option value="">Select a side...</option>
									<option value="plug_assist">Plug Assist Side</option>
									<option value="cavity">Cavity Side</option>
								</select>
							</td>
							<td>
								New Screw Location:
								<input type="text" name="screw[location][]">
							</td>
							<td>
								New Screw Quantity:
								<select name="screw[quantity][]">
									<option value=''>Select # of Screws...</option>
									<?php for($i=0;$i<32;$i++){ ?>
									<option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="button" class="button" value="+">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="ring_tab">
				<table>
					<tr>
<th colspan="4"><b>Select an O-Ring # and Location Below</b></th>
</tr>
<tr id="o_ring">
<td>
O-Ring #:
<select name="ring[num][]">
<option value="">Select an O-Ring #</option>
<?php foreach ($rnum as $r_num_value) {	?>
<option value="<?php echo $r_num_value; ?>"><?php echo $r_num_value; ?> </option>
<?php }	?>
</select>
</td>
<td>
Location:
<select name="ring[location][]">
<option value="">Select a Location</option>
<?php foreach ($rloc as $rloc_value) { ?>
<option value="<?php echo $rloc_value; ?>"><?php echo $rloc_value; ?> </option>
<?php } ?>
</select>
</td>
					<td>
					Quantity:
					<select name="ring[quantity][]">
					<option value=''>Select # of Rings...</option>
					<?php for($i=0;$i<32;$i++){ ?>
					<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					<?php } ?>
					</select>
					</td>
					<td>
					Comments:
					<input type="text" name="ring[comment][]">
					</td>
					</tr>
					<tr>
<td colspan="4">
<input type="button" class="button" value="+">
</td>
</tr>
					<tr>
<th colspan="4"><b>Or, Create a New O-Ring</b></th>
</tr>
<tr>
					<td>
					New Ring Num:
					<input type="text" name="ring[num][]">
					</td>
					<td>
					New Ring Location:
					<input type="text" name="ring[location][]">
					</td>
					<td>
					New Quantity:
					<select name="ring[quantity][]">
					<option value=''>Select # of Rings...</option>
					<?php for($i=0;$i<32;$i++){ ?>
					<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					<?php } ?>
					</select>
					</td>
					<td>
					Comment:
					<input type="text" name="ring[comment][]">
					</td>
					</tr>
					<tr>
<td colspan="4">
<input type="button" class="button" value="+">
</td>
</tr>
			</table>
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Top Plate</b></a></h3>
		<div id="plates">
			<ul>
				<li><a href="#top_plate">Top Plate</a></li>
				<li><a href="#water_plate">Water Plate</a></li>
				<li><a href="#stripper_plate">Stripper Plate</a></li>
			</ul>
			<div id="top_plate">
				<table>
					<thead>
					<tr>
						<th colspan="10"><b>Top Plate Information</b></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td colspan="2"></td>
						<td>Top Plate Thickness:</td>
						<td><input type="text" name="top_plate[thickness][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="top_plate[notes][]"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="10">
							<input type="button" class="button" value="+">
						</td>
					</tr>
					<tr>
						<th colspan="10"><b>Stand Offs</b></th>
					</tr>
					<tr>
						<td>Thickness:</td>
						<td><input type="text" name="stand_off[thickness][]"></td>
						<td>Height:</td>
						<td><input type="text" name="stand_off[height][]"></td>
						<td>Product #:</td>
						<td><input type="text" name="stand_off[product][]"></td>
						<td>Product Name:</td>
						<td><input type="text" name="stand_off[product_name][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="stand_off[notes][]"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
					</tbody>
				</table>
			</div>
			<div id="water_plate">
				<table>
					<thead>
					<tr>
						<th colspan="10"><b>Water Plate Info</b></th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><input type="text" name="water_plate[thickness][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="water_plate[notes][]"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
					<tr>
						<th colspan="10"><b>Water Manifold Info</b></th>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><input type="text" name="water_manifold[thickness][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="water_manifold[notes][]"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
					</tbody>
				</table>
			</div>
			<div id="stripper_plate">
				<table>
					<tr>
						<th colspan="10"><b>Stripper Plate Information</b></th>
					</tr>
					<tr>
						<td>Assembly Features</td>
						<td><b></b></td>
						<td>Thickness:</td>
						<td><input type="text" name="stripper_plate[thickness][]"></td>
						<td>Product #:</td>
						<td><input type="text" name="stripper_plate[product][]"></td>
						<td>Product Name:</td>
						<td><input type="text" name="stripper_plate[product_name][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="stripper_plate[notes][]"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Air Cylinder</b></a></h3>
		<div id="air_cylinders">
			<ul>
				<li><a href="#air_cylinder">Air Cylinder</a></li>
				<li><a href="#air_bladder">Air Bladder</a></li>
				<li><a href="#air_cylinder_spacer">Air Cylinder Spacers</a></li>
				<li><a href="#air_cylinder_rod">Air Cylinder Rod Extensions</a></li>
			</ul>
			<div id="air_cylinder">
				<table>
					<tr>
						<th colspan="10"><b>Air Cylinder Information</b></th>
					</tr>
					<tr>
						<td>Bore:</td>
						<td><input type="text" name="air_cylinder[bore][]"></td>
						<td>Stroke:</td>
						<td><input type="text"  name="air_cylinder[stroke][]"></td>
						<td>Vendor</td>
						<td><input type="text"  name="air_cylinder[vendor][]"></td>
						<td>Part #:</td>
						<td><input type="text"  name="air_cylinder[part_no][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="air_cylinder['notes'][]"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
				</table>
			</div>
			<div id="air_bladder">
				<table>
					<tr>
						<th colspan="10">Air Bladder Information</th>
					</tr>
					<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><input type="text" name="air_bladder_thickness"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="air_bladder[notes][]"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button"  value="+"></td>
					</tr>
				</table>
			</div>
			<div id="air_cylinder_spacer">
				<table>
					<thead>
						<tr>
							<th colspan="10"><b>Air Cylinder Spacer Information</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>Height:</td>
							<td><input type="text"  name="air_cylinder_spacer[height][]"></td>
							<td>Product #:</td>
							<td><input type="text"  name="air_cylinder_spacer[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text"  name="air_cylinder_spacer[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="air_cylinder_spacer[notes][]"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button"  value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="air_cylinder_rod">
				<table>
					<thead>
						<tr>
							<th colspan="10"><b>Air Cylinder Rod Extension Information</b></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>Length:</td>
							<td><input type="text"  name="air_cylinder_rod[length][]"></td>
							<td>Product #:</td>
							<td><input type="text"  name="air_cylinder_rod[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text"  name="air_cylinder_rod[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="air_cylinder_rod[notes][]"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button"  value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Cavities</b></a></h3>
		<div id="cavities">
			<ul>
				<li><a href="#base_cavity">Base Cavity</a></li>
				<li><a href="#lid_cavity">Lid Cavity</a></li>
			</ul>
			<div id="base_cavity">
				<table>
					<thead>
						<tr>
							<th colspan="10">Base Cavity Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Product #:</td>
							<td><input type="text" name="base_cavity[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="base_cavity[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="base_cavity[notes][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="lid_cavity">
				<table>
					<thead>
						<tr>
							<th colspan="10">Lid Cavity Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Product #:</td>
							<td><input type="text" name="lid_cavity[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="lid_cavity[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="lid_cavity[notes][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Inserts</b></a></h3>
		<div id="inserts">
			<ul>
				<li><a href="#hinge_insert">Hinge Insert</a></li>
				<li><a href="#lid_insert">Lid Insert</a></li>
				<li><a href="#base_insert">Base Insert</a></li>
			</ul>
			<div id="hinge_insert">
				<table>
					<thead>
						<tr>
							<th colspan="10">Hinge Insert Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Product #:</td>
							<td><input type="text" name="hinge_insert[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="hinge_insert[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="hinge_insert[notes][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="lid_insert">
				<table>
					<thead>
						<tr>
							<th colspan="10">Lid Insert Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Product #:</td>
							<td><input type="text" name="lid_insert[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="lid_insert[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="lid_insert[notes][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="base_insert">
				<table>
					<thead>
						<tr>
							<th colspan="10">Base Insert Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Product #:</td>
							<td><input type="text" name="base_insert[product][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="base_insert[product_name][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="base_insert[notes][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Logoes, Locks, and Air Fittings</b></a></h3>
		<div id="landl">
			<ul>
				<li><a href="#recycle_logo">Recycle Logo</a></li>
				<li><a href="#button_lock">Button Locks</a></li>
				<li><a href="#air_fitting">Air Fittings</a></li>
			</ul>
			<div id="recycle_logo">
			
			</div>
			<div id="button_lock">
				<table>
					<thead>
						<tr>
							<th colspan="10">Button Lock Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="2"></td>
							<td>Shape:</td>
							<td>TBD</td>
							<td>Dia:</td>
							<td><input type="text" name="button_lock[dia][]"></td>
							<td><label for="button_lock_male">Male:</label><input type="radio" name="button_lock[mf][]" value="male" id="button_lock_male"></td>
							<td><label for="button_lock_female">Female:</label><input type="radio" name="button_lock[mf][]" value="female" id="button_lock_female"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="button_lock['notes'][]"></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="air_fitting">
				<table>
					<thead>
						<tr>
							<th colspan="10">Air Fitting Info</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td colspan="6"></td>
							<td>Size: </td>
							<td><input type="text" name="air_fitting[size][]"></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="10"><input type="button" class="button" value="+"></td>
						</tr>
					</tbody>
				</table>
						
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Plug Side Plates</b></a></h3>
		<div id="plugplates">
			<ul>
				<li><a href="#bottom_plate">Bottom Plate</a></li>
				<li><a href="#side_plate">Side Plate</a></li>
				<li><a href="#3rd_plate">3rd Motion Plug Plate</a></li>
				<li><a href="#3rd_seal">3rd Motion Seals</a></li>
				<li><a href="#clamp_plate">Clamp Plate</a></li>
				<li><a href="#clamp_ring">Clamp ring</a></li>
			</ul>
			<div id="bottom_plate">
			
			</div>
			<div id="side_plate">
			
			</div>
			<div id="3rd_plate">
			
			</div>
			<div id="3rd_seal">
			
			</div>
			<div id="clamp_plate">
			
			</div>
			<div id="clamp_ring">
			
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Plugs & Spacers</b></a></h3>
		<div id="plugspacers">
			<ul>
				<li><a href="#lid_plug">Lid Plug</a></li>
				<li><a href="#lid_plug_spacer">Lid Plug Spacer</a></li>
				<li><a href="#base_plug">Base Plug</a></li>
				<li><a href="#base_plug_spacer">Base Plug Spacer</a></li>
			</ul>
			<div id="lid_plug">
			
			</div>
			<div id="lid_plug_spacer">
			
			</div>
			<div id="base_plug">
			
			</div>
			<div id="base_plug_spacer">
			
			</div>
		</div>
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Index Lug</b></a></h3>
		
		
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>O-Ring</b></a></h3>
		
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Stand Off bars</b></a></h3>
		
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Guide Pins</b></a></h3>
		
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Bushings</b></a></h3>
		
	</div>
	<div class="form_tool">
		<h3><a href="#"><b>Tooling Straps</b></a></h3>
		
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Top Plate</b></a></h3>
		<div id="top_plate">
			<ul>
				<li><a href="#top_side_top_plate">Top Plate</a></li>
				<li><a href="#top_side_standoffs">Stand Offs</a></li>
			</ul>
			<div id="top_side_top_plate">
			
			</div>
			<div id="top_side_standoffs">
			
			</div>
		</div>
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Dies</b></a></h3>
		<div id="dies">
			<ul>
				<li><a href="#die_shoe">Die Shoe</a></li>
				<li><a href="#lid_die">Lid Die</a></li>
				<li><a href="#lid_die_spacer">Lid Die Spacer</a></li>
				<li><a href="#base_die">Base Die</a></li>
				<li><a href="#base_die_spacer">Base Die Spacer</a></li>
			</ul>
			<div id="die_shoe">
			
			</div>
			<div id="lid_die">
			
			</div>
			<div id="lid_die_spacer">
			
			</div>
			<div id="base_die">
			
			</div>
			<div id="base_die_spacer">
			
			</div>
		</div>
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Fibro Bushings</b></a></h3>
	
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>PlexiGlass</b></a></h3>
	
	
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Punchs</b></a></h3>
		<div id="punch">
			<ul>
				<li><a href="#punch_shoe">Punch Shoe</a></li>
				<li><a href="#lid_punch">Lid Punch</a></li>
				<li><a href="#lid_punch_spacer">Lid Punch Spacer</a></li>
				<li><a href="#lid_punch_holder">Lid Punch Holder Block</a></li>
				<li><a href="#base_punch">Base Punch</a></li>
				<li><a href="#base_punch_spacer">Base Punch Spacer</a></li>
				<li><a href="#base_punch_holder">Base Punch Holder Block</a></li>
			</ul>
			<div id="punch_shoe">
			
			</div>
			<div id="lid_punch">
			
			</div>
			<div id="lid_punch_spacer">
			
			</div>
			<div id="lid_punch_holder">
			
			</div>
			<div id="base_punch">
			
			</div>
			<div id="base_punch_spacer">
			
			</div>
			<div id="base_punch_holder">
			
			</div>
		</div>
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Ejectors</b></a></h3>
		<div id="ejectors">
			<ul>
				<li><a href="#lid_ejector">Lid Ejector Plate</a></li>
				<li><a href="#base_ejector">Base Ejector Plate</a></li>
				<li><a href="#ejector_springs">Ejector Springs</a></li>
				<li><a href="#ejector_bolt">Ejector Shoulder Bolts</a></li>
			</ul>
			<div id="lid_ejector">
			
			</div>
			<div id="base_ejector">
			
			</div>
			<div id="ejector_springs">
			
			</div>
			<div id="ejector_bolt">
			
			</div>
		</div>
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Fibro</b></a></h3>
		<div id="fibro">
			<ul>
				<li><a href="#fibro_guide">Fibro Guide Pins</a></li>
				<li><a href="#fibro_clamps">Fibro Pin Clamps</a></li>
			</ul>
			<div id="fibro_guide">
			
			</div>
			<div id="fibro_clamps">
			
			</div>
		</div>
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Tooling Straps</b></a></h3>
	
	</div>
	<div class="pre_punch">
		<h3><a href="#"><b>Stationary Stripper Plate</b></a></h3>
		
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Punchs & Shoes</b></a></h3>
		<div id="trim_punch">
			<ul>
				<li><a href="#punch_shoe">Punch Shoe</a></li>
				<li><a href="#lid_punch">Lid Punch</a></li>
				<li><a href="#lid_punch_shoe">Lid Punch Shoe</a></li>
				<li><a href="#base_punch">Base Punch</a></li>
				<li><a href="#base_punch_spacer">Base Punch Spacer</a></li>
				<li><a href="#die_shoe">Die Shoe</a></li>
				<li><a href="#die_spacer">Die Spacer</a></li>
			</ul>
			<div id="punch_shoe">
			
			</div>
			<div id="lid_punch">
			
			</div>
			<div id="lid_punch_shoe">
			
			</div>
			<div id="base_punch">
			
			</div>
			<div id="base_punch_spacer">
			
			</div>
			<div id="die_shoe">
			
			</div>
			<div id="die_spacer">
			
			</div>
		</div>
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Dies</b></a></h3>
		<div id="dies">
			<ul>
				<li><a href="#lid_die">Lid Die</a></li>
				<li><a href="#base_die">Base Die</a></li>
			</ul>
			<div id="lid_die">
			
			</div>
			<div id="base_die">
			
			</div>
		</div>
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Bushings</b></a></h3>
		
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Aluminum Product Guide</b></a></h3>
		<div id="aluminum">
			<ul>
				<li><a href="#guide_lid">Product Guide Lid</a></li>
				<li><a href="#guide_base">Product guide Base</a></li>
			</ul>
			<div id="guide_lid">
		
			</div>
			<div id="guide_base">
		
			</div>
		</div>
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Ejector Assembly</b></a></h3>
		
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Tuddle Plate</b></a></h3>
		
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Cone Locators</b></a></h3>
		
	</div>
	<div class="trim_tool">
		<h3><a href="#"><b>Guide Pins</b></a></h3>
		
	</div>
</div>
</div>
<table>
		<tbody>
			<tr>
				<td align="center">
					<input type="submit" class="button" name="Submit" value="Submit">
					<input type="reset" class="button" name="Clear Form">
				</td>
			</tr>
		</tbody>
</table>
</form>
</body>
</html>
