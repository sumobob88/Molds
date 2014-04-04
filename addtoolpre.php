<!DOCTYPE HTML>
<?php 
$host = "localhost";
$user = "root";
$password = "pw";
$connect = mysql_connect($host, $user, $password) or die("Hey couldn't connect to db");
mysql_select_db("fdstest", $connect) or die("Hey couldn't connect to db");
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Tool</title>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
<style type="text/css">
	html, body {
            height:100%;
	}
<?php for($x=1;$x<30;$x++){?>
#screw<?php echo $x; ?>
{
	display: none;
}
<?php }?>
#screw0 {
	display: table-row;
}
<?php for($x=1;$x<30;$x++){?>
#newscrew<?php echo $x; ?>
{
	display: none;
}
<?php }?>
#newscrew0 {
	display: table-row;
}
html, body {
      height:100%;
      width:80%;
      margin-left:10%;
      margin-fight:10%;
	}
table {
	table-layout: auto;
	border-collapse: collapse;
	width: 100%;
	align: center;
}
th {
	text-align: center;
}
td {
	text-align:center;
}
td#left {
	text-align:left;
}

</style>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	var accordion = $("#accordion").accordion({header: "h3" });
	$("#addNewScrew, #addScrew, #addRing, #addNewRing").button();
	$("#addNewScrew").click(function(){
		$("#screw0").clone().appendTo('#screw tbody');
	});
	
});
</script>
</head>
<body>
<div id="accordion">
	<div>
		<h3><a href="#"><b>Tool Info</b></a></h3>
		<div>
			<table>
				<tr>
					<th colspan="4" align="center">
					Enter Tool Information Below<br>
					</th>
				</tr>
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
            			<select name="tool_type">
            				<option value="">Select Tool Type...</option>
               				<option value="form_tool">Form Tool</option>
                			<option value="pre_punch">Pre Punch</option>
               				<option value="trim">Trim Tool</option>
            			</select>
        			</td>
    			</tr>
			</table>
		</div>
	</div>
	<div>
			<h3><a href="#"><b>Screws</b></a></h3>
			<div>
			<table id="screw">
				<thead>
						<tr>
							<th colspan="4" align="center">
								Select a Screw Size and Location Below<br>
							</th>
						</tr>
				</thead>
				<tbody>
						<?php for($x=0;$x<30;$x++){?>
							<tr id="screw<?php echo $x; ?>" >
								<td>
									Screw Size:
									<select name="screw_size[]">
	                    				<option value="">Select a Screw Size...</option>
	                       				 <?php foreach ($ssize as $ssize_name) {	?>
	                    				<option value="<?php echo $ssize_name; ?>"><?php echo $ssize_name; ?> </option>
	                        			<?php } ?>
									</select>
								</td>
								<td>
									Position: 
									<select name="screw_side[]">
	                        			<option value="">Select a side...</option>
	                        			<option value="plug_assist">Plug Assist Side</option>
	                        			<option value="cavity">Cavity Side</option>
	                				</select>
	                			</td>
	                			<td>
	                				Location:
	                				<select  name="screw_location[]">
	                					<option value="">Select a Location</option>
	             						<?php foreach ($sloc as $value) {?>
	                					<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
	                					<?php }	?>
	           						 </select>
	           					</td>
	           					<td>
	           						Quantity:
	            					<select  name='screw_quantity[]'>
	               						<option value=''>Select # of Screws...</option>
	                					<?php for($i=0;$i<32;$i++){ ?>
	                					<option value='<?php echo $i; ?>'><?php echo $i; ?></option>
	                					<?php } ?>
	            					</select>
	            				</td>
	            			</tr>
	            			<?php }?>
	            		<tr>
	            		<td>
    						<input type="button" id="addScrew" value="+">
    						</td>
    					</tr>
    					<tr>
            				<th colspan="4" align="center">
								Create a New Screw<br>
							</th>
						</tr>
						<?php for($x=0;$x<30;$x++){?>
						<tr id="newscrew<?php echo $x; ?>">
        					<td>
           						 New Size:
            					<input type='text' name='screw_size[]'>
        					</td>
        					<td>
           						 New Position: 
            					<select name='screw_side[]'>
               						 <option value="">Select a side...</option>
                					<option value="plug_assist">Plug Assist Side</option>
                					<option value="cavity">Cavity Side</option>
            					</select>
            				</td>
        					<td>
           						 New Screw Location: 
          						  <input type="text" name="screw_location[]">
        					</td>
      						<td>
           						 New Screw Quantity:
            					<select name='screw_quantity[]'>
                					<option value=''>Select # of Screws...</option>
               						 <?php for($i=0;$i<32;$i++){ ?>
                					<option value='<?php echo $i; ?>'><?php echo $i; ?></option><?php } ?>
            					</select>
        					</td>
    					</tr>
    				<?php }?>
    				<tr>
   						<td colspan="4">
   							<input type="button" id="addNewScrew" value="+">
   						</td>
   					</tr>
   				</tbody>
    		</table>
    		</div>
	</div>
	<div>
		<h3><a href="#"><b>O-Rings</b></a></h3>
		<div>
		<table>
						<tr>
       						<th colspan="4"><b>Select an O-Ring # and Location Below</b></th>
    					</tr>
    					<tr id="o_ring">
        					<td>
            					O-Ring #:
            					<select name="ring_num[]">
               						 <option value="">Select an O-Ring #</option>
               						 <?php foreach ($rnum as $r_num_value) {	?>
                					<option value="<?php echo $r_num_value; ?>"><?php echo $r_num_value; ?> </option>
                					<?php }	?>
            					</select>
        					</td>
        					<td>
            					Location:
            					<select name="ring_location[]">
                					<option value="">Select a Location</option>
                					<?php foreach ($rloc as $rloc_value) { ?>
                					<option value="<?php echo $rloc_value; ?>"><?php echo $rloc_value; ?> </option>
                					<?php } ?>
            					</select>
        					</td>
					        <td>
					            Quantity:
					            <select name='ring_quantity[]'>
					                <option value=''>Select # of Rings...</option>
					                <?php for($i=0;$i<32;$i++){ ?>
					                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					                <?php } ?>
					            </select>
					        </td>
					        <td>
					            Comments:
					            <input type="text" name="ring_comment[]">
					        </td>
					    </tr>
					    <tr>
   						<td colspan="4">
   							<input type="button" id="addRing" value="+">
   						</td>
   					</tr>
					    <tr>
       						<th colspan="4"><b>Or, Create a New O-Ring</b></th>
    					</tr>
    					<tr>
					        <td>
					            New Ring Num: 
					            <input type="text" name="ring_num[]">
					        </td>
					        <td>
					            New Ring Location: 
					            <input type="text" name="ring_location[]">
					        </td>
					        <td>
					            New Quantity:
					            <select name='ring_quantity[]'>
					                <option value=''>Select # of Rings...</option>
					                <?php for($i=0;$i<32;$i++){ ?>
					                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					                <?php } ?>
					            </select>
					        </td>
					        <td>
					            Comment:
					            <input type="text" name="ring_comment[]">
					        </td>
					    </tr>
					    <tr>
   						<td colspan="4">
   							<input type="button" id="addNewRing" value="+">
   						</td>
   					</tr>
			</table>
		</div>
	</div>
	<div>
		<h3><a href="#"><b>Submit</b></a></h3>
		<div>
		<table>
			<tr>
				<td colspan="4" >
					<input type="submit" name="Submit" value="Submit">
					<input type="reset" name="Clear Form">
				</td>
			</tr>
		</table>
		</div>
	</div>
</div>

</div>

</body>
