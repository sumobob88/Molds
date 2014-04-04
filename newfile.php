<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.3.0/build/cssreset/reset-min.css&3.3.0/build/cssfonts/fonts-min.css&gallery-2011.03.23-22-20/build/gallery-accordion/assets/skins/sam/gallery-accordion.css">

<style type="text/css">
	html, body {
            height:100%;
	}
</style>
<style>
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
div#demo {
	position: relative;
	width:70%;
	margin-left:15%;
	margin-right:15%;
	padding: 10px;
}

</style>
	
</head>
<body class="yui3-skin-sam">
<form action="commit.php?action=add&type=tool" method="post">
		<div class="hd">
			<h3 class="title" align="center" >New Tool</h3>
		</div>
		<div id="myaccordion" class="yui3-accordion">
			<div id="toolinfo" class="yui3-accordion-item yui3-accordion-item-alwaysvisible" yuiconfig='{"closable": true}'>
				<div class="yui3-widget-hd">
					<a class="yui3-accordion-item-icon"></a>
					<a class="yui3-accordion-item-label"><b>Tool Info</b></a>
						<div class="yui3-accordion-item-icons">
							<a class="yui3-accordion-item-iconalwaysvisible"></a>
							<a class="yui3-accordion-item-iconexpanded"></a>
							<a class="yui3-accordion-item-iconclose yui3-accordion-item-iconclose-hidden"></a>
						</div>
				</div>
				<div class="yui3-widget-bd">
					<div id="p1" style="position:relative;">
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
       						<th>Product ID:</th>
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
			</div>
			<div id="screw" class="yui3-accordion-item" data-contentheight="stretch">
				<div class="yui3-widget-hd">
					<a class="yui3-accordion-item-icon"></a>
					<a class="yui3-accordion-item-label"><b><b>Screws</b></b></a>
						<div class="yui3-accordion-item-icons">
							<a class="yui3-accordion-item-iconalwaysvisible"></a>
							<a class="yui3-accordion-item-iconexpanded"></a>
							<a class="yui3-accordion-item-iconclose yui3-accordion-item-iconclose-hidden"></a>
						</div>
				</div>
				<div id="screwbody" class="yui3-widget-bd">
					<div id="p2" style="position:relative;">
					<table>
						<tr>
							<th colspan="4" align="center">
								Select a Screw Size and Location Below<br>
							</th>
						</tr>
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
    				</table>
    			</div>
			</div>
			</div>
    		<div id="ring" class="yui3-accordion-item" data-contentheight="stretch">
				<div class="yui3-widget-hd">
					<a class="yui3-accordion-item-icon"></a>
					<a class="yui3-accordion-item-label"><b><b>O-Rings</b></a>
						<div class="yui3-accordion-item-icons">
							<a class="yui3-accordion-item-iconalwaysvisible"></a>
							<a class="yui3-accordion-item-iconexpanded"></a>
							<a class="yui3-accordion-item-iconclose yui3-accordion-item-iconclose-hidden"></a>
						</div>
				</div>
				<div id="ringbody" class="yui3-widget-bd">
					<div id="p3" style="position:relative;">
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
			</div>
	  	<div id="submit" class="yui3-accordion-item" >
			<div class="yui3-accordion-item yui3-accordion-item-alwaysvisible">
				<div class="yui3-bd yui3-widget-bd">
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
</form>
</body>

<!-- YUI 3 Seed //-->
<!-- Initialization process //-->
<script type="text/javascript" src="http://yui.yahooapis.com/3.2.0/build/yui/yui-min.js"></script>
<script type="text/javascript">	
YUI({
    gallery : 'gallery-2011.03.23-22-20'
}).use( 'gallery-accordion', function(Y) {
   
	var accordion = newY.accordion({
		srcNode: "#myaccordion",
		useAnimation: true,
	});
	accordion.render();
});
</script>
<script>
YUI().use('node', 'dom-style', 'selector-css3',  function (Y) {
	var oaddscrewclicked = 0;
	var oaddnewscrewclicked = 0;
	//Find and Create variables for button, row, and container
	Y.one("#addScrew").on('click', function(){
		oaddscrewclicked++;
		if(oaddscrewclicked>0){
		Y.one("#screw1").setStyle('display', 'table-row');
		}
		if(oaddscrewclicked>1){
			Y.one("#screw2").setStyle('display', 'table-row');
		}
		if(oaddscrewclicked>2){
			Y.one("#screw3").setStyle('display', 'table-row');
		}
		if(oaddscrewclicked>3){
			Y.one("#screw4").setStyle('display', 'table-row');
		
		}
		if(oaddscrewclicked>4){
			Y.one("#screw5").setStyle('display', 'table-row');
		}
		if(oaddscrewclicked>5){
			Y.one("#screw6").setStyle('display', 'table-row');
		
		}
		if(oaddscrewclicked>6){
			Y.one("#screw7").setStyle('display', 'table-row');
			
		}
		if(oaddscrewclicked>7){
			Y.one("#screw8").setStyle('display', 'table-row');	
		}
		if(oaddscrewclicked>8){
			Y.one("#screw9").setStyle('display', 'table-row');
		}
	});
	Y.one("#addNewScrew").on('click', function(){
		oaddnewscrewclicked++;
		if(oaddnewscrewclicked>0){
		Y.one("#newscrew1").setStyle('display', 'table-row');
		}
		if(oaddnewscrewclicked>1){
			Y.one("#newscrew2").setStyle('display', 'table-row');
		}
		if(oaddnewscrewclicked>2){
			Y.one("#newscrew3").setStyle('display', 'table-row');
		}
		if(oaddnewscrewclicked>3){
			Y.one("#newscrew4").setStyle('display', 'table-row');
		
		}
		if(oaddnewscrewclicked>4){
			Y.one("#newscrew5").setStyle('display', 'table-row');
		}
		if(oaddnewscrewclicked>5){
			Y.one("#newscrew6").setStyle('display', 'table-row');
		
		}
		if(oaddnewscrewclicked>6){
			Y.one("#newscrew7").setStyle('display', 'table-row');
			
		}
		if(oaddnewscrewclicked>7){
			Y.one("#newscrew8").setStyle('display', 'table-row');	
		}
		if(oaddnewscrewclicked>8){
			Y.one("#newscrew9").setStyle('display', 'table-row');
		}
	});
	
});
</script>


</body>
</html>