<?php
session_start();
$_SESSION['post'] = $_POST;
$host = "localhost";
$user = "root";
$password = "";
$connect = mysql_connect($host, $user, $password) or die("Hey couldn't connect to db");
mysql_select_db("fdstest", $connect) or die("Hey couldn't connect to db");
?><!DOCTYPE HTML>
<html>
<head>
<title><?php echo ucfirst($_GET['action'] . $_GET['type']); ?></title>
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
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>	
	<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery.multi-accordion-1.5.3.js"></script>
<script type="text/javascript">
$(function(){
$("#accordion").multiAccordion({active: 'all'});
$('#hardware, #plates, #air_cylinders, #dies, #cavities, #aluminum, #inserts, #landl, #trim_punch, #plugplates, #fibro, #plugspacers, #top_plate, #ejectors, #dies, #punch').tabs();
});
</script>

<body>
<?php
if($_GET['action'] =='add') {
?>
<form action="submit.php?action=add&type=<?php echo $_GET['type']; ?>" method="post">
<div id="accordion">
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
						<td colspan="2"><?php echo $_POST['name']; ?>
							<input type="hidden" name="name">
						</td>
					</tr>
					<tr>
						<th>Date:</th>
	        			<td><?php echo $_POST['date']; ?>
	            		
	        			</td>
	        			<th>User Name:</th>
	        			<td><?php echo $_POST['user']; ?>
	            	
	        			</td>
	   				</tr>
					<tr>
	       				<th><label for="product_id">Product ID:</label></th>
	        			<td><?php echo $_POST['product_id']; ?>
	            			<input type="hidden" name="product_id">
	       				</td>
	       				<th>Tool Type:</th>
	        			<td>
	            			<div id="tool_type">
	            				<?php if($_GET['type'] == "form_tool"){ ?><label for="form_tool">Form Tool</label><input type="radio" name="tool_type" id="form_tool" value="form_tool" checked="checked"  ><?php } ?>
	                			<?php if($_GET['type'] == "pre_punch"){ ?><label for="pre_punch">Pre Punch</label><input type="radio" name="tool_type" id="pre_punch" value="pre_punch" checked="checked" ><?php } ?>
	               				<?php if($_GET['type'] == "trim_tool"){ ?><label for="trim_tool">Trim Tool</label><input type="radio" name="tool_type" id="trim_tool" value="trim_tool" checked="checked" ><?php } ?>
	            			</div>
	        			</td>
	    			</tr>
	    		</tbody>
			</table>
		</div>
<?php if($_GET['type'] == "form_tool") { ?>
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
					<?php $screw = $_POST['screw'];
$numvalues = 0;
$numpropertys = 0;

foreach($screw as $property) {  // go thought the first level
    foreach($property as $value) {  // go through the second level
        $numvalues++;
    }
    $numpropertys++;
}
$numscrews = $numvalues/$numpropertys;
$numvalues = 0;
$numpropertys = 0;
					
					
					for($i=0;$i<$numscrews;$i++){ ?>
						<tr>
								<td>Screw Size: <?php echo $screw['size'][$i]; ?></td>
								<td>Position: <?php echo $screw['side'][$i]; ?></td>
	                			<td>Location:<?php echo $screw['location'][$i]; ?></td>
	           					<td>Quantity:<?php echo $screw['quantity'][$i]; ?></td>
	            			</tr>
						<?php } ?>
				</tbody>
    		</table>
    		</div>
    		<div id="ring_tab">
				<table>
						<tr>
       						<th colspan="4"><b>O-rings</b></th>
    					</tr>
						<?php $ring = $_POST['ring'];
						foreach($ring as $property){
							foreach($property as $value){
								$numvalues++;
								}
							$numpropertys++;
						}
							
						$numring = $numvalues/$numpropertys;
						$numvalues = 0;
						$numpropertys = 0;
						for($i=0;$i<$numring;$i++){ ?>
    					<tr>
        					<td>O-Ring #:<?php echo $ring['num'][$i]; ?></td>
        					<td>Location:<?php echo $ring['location'][$i]; ?></td>
					        <td>Quantity:<?php echo $ring['quantity'][$i]; ?></td>
					        <td>Comments:<?php echo $ring['comment'][$i]; ?></td>
					    </tr>
					   <?php } ?>
			</table>
			</div>
		</div>
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
					<?php $top_plate = $_POST['top_plate'];
					foreach($top_plate as $property){
							foreach($property as $value){
								$numvalues++;
								}
							$numpropertys++;
						}
						$numtop_plate = $numvalues/$numpropertys;
						$numvalues = 0;
						$numpropertys = 0;
						for($i=0;$i<$numtop_plate;$i++){ ?>
					<tr>
						<td colspan="2"></td>
						<td>Top Plate Thickness:</td>
						<td><?php echo $top_plate['thickness'][$i]; ?></td>
						<td>Notes:</td>
						<td><?php echo $top_plate['notes'][$i]; ?></td>
						<td colspan="3"></td>
					</tr>
					<?php } ?>
					<tr>
						<th colspan="10"><b>Stand Offs</b></th>
					</tr>
					<?php 
					$stand_off = $_POST['stand_off'];
					foreach($stand_off as $property){
							foreach($property as $value){
								$numvalues++;
								}
							$numpropertys++;
						}
						$numstand_off = $numvalues/$numpropertys;
						$numvalues = 0;
						$numpropertys = 0;
						for($i=0;$i<$numstand_off;$i++){
						?>
						<tr>
							<td>Thickness:</td>
							<td><?php echo $stand_off['thickness'][$i]; ?></td>
							<td>Height:</td>
							<td><?php echo $stand_off['height'][$i]; ?></td>
							<td>Product #:</td>
							<td><?php echo $stand_off['product'][$i]; ?></td>
							<td>Product Name:</td>
							<td><?php echo $stand_off['product_name'][$i]; ?></td>
							<td>Notes:</td>
							<td><?php echo $stand_off['notes'][$i]; ?></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<div id="water_plate">
				<table>
					<THEAD>
					<tr>
						<th colspan="10"><b>Water Plate Info</b></th>
					</tr>
					</thead>
					<tbody>
					<?php
					$water_plate = $_POST['water_plate'];
					foreach($water_plate as $property){
							foreach($property as $value){
								$numvalues++;
								}
							$numpropertys++;
						}
						$numwater_plate = $numvalues/$numpropertys;
						$numvalues = 0;
						$numpropertys = 0;
						for($i=0;$i<$numwater_plate;$i++){ ?>
					<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><?php echo $water_plate['thickness'][$i]; ?></td>
						<td>Notes:</td>
						<td><?php echo $water_plate['notes'][$i]; ?></td>
						<td colspan="3"></td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
					<tr>
						<th colspan="10"><b>Water Manifold Info</b></th>
					</tr>
					<<tr>
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
						<td><b>TO BE CODED</b></td>
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
<?php
}
}
?>
<table>
    <tr>
        <td class="center" colspan="4" >
            <input type="submit" name="Submit" value="Submit">
                <input type="reset" name="Clear Form">
        </td>
    </tr>
</form>
</table>

</html>
