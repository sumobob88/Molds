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
									<select name="screw['size'][]">
	                    				<option value="">Select a Screw Size...</option>
	                       				 <?php foreach ($ssize as $ssize_name) {	?>
	                    				<option value="<?php echo $ssize_name; ?>"><?php echo $ssize_name; ?> </option>
	                        			<?php } ?>
									</select>
								</td>
								<td>
									Position: 
									<select name="screw['side'][]">
	                        			<option value="">Select a side...</option>
	                        			<option value="plug_assist">Plug Assist Side</option>
	                        			<option value="cavity">Cavity Side</option>
	                				</select>
	                			</td>
	                			<td>
	                				Location:
	                				<select  name="screw['location'][]">
	                					<option value="">Select a Location</option>
	             						<?php foreach ($sloc as $value) {?>
	                					<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
	                					<?php }	?>
	           						 </select>
	           					</td>
	           					<td>
	           						Quantity:
	            					<select  name="screw['quantity'][]">
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
            					<input type='text' name="screw['size'][]">
        					</td>
        					<td>
           						 New Position: 
            					<select name="screw['side'][]">
               						 <option value="">Select a side...</option>
                					<option value="plug_assist">Plug Assist Side</option>
                					<option value="cavity">Cavity Side</option>
            					</select>
            				</td>
        					<td>
           						 New Screw Location: 
          						  <input type="text" name="screw['location'][]">
        					</td>
      						<td>
           						 New Screw Quantity:
            					<select name="screw['quantity'][]">
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
            					<select name="ring['num'][]">
               						 <option value="">Select an O-Ring #</option>
               						 <?php foreach ($rnum as $r_num_value) {	?>
                					<option value="<?php echo $r_num_value; ?>"><?php echo $r_num_value; ?> </option>
                					<?php }	?>
            					</select>
        					</td>
        					<td>
            					Location:
            					<select name="ring['location'][]">
                					<option value="">Select a Location</option>
                					<?php foreach ($rloc as $rloc_value) { ?>
                					<option value="<?php echo $rloc_value; ?>"><?php echo $rloc_value; ?> </option>
                					<?php } ?>
            					</select>
        					</td>
					        <td>
					            Quantity:
					            <select name="ring['quantity'][]">
					                <option value=''>Select # of Rings...</option>
					                <?php for($i=0;$i<32;$i++){ ?>
					                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					                <?php } ?>
					            </select>
					        </td>
					        <td>
					            Comments:
					            <input type="text" name="ring['comment'][]">
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
					            <input type="text" name="ring['num'][]">
					        </td>
					        <td>
					            New Ring Location: 
					            <input type="text" name="ring['location'][]">
					        </td>
					        <td>
					            New Quantity:
					            <select name="ring['quantity'][]">
					                <option value=''>Select # of Rings...</option>
					                <?php for($i=0;$i<32;$i++){ ?>
					                <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
					                <?php } ?>
					            </select>
					        </td>
					        <td>
					            Comment:
					            <input type="text" name="ring['comment'][]">
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
						<td><input type="text" name="top_plate['thickness'][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="top_plate['notes'][]"></td>
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
						<td><input type="text" name="stand_off['thickness'][]"></td>
						<td>Height:</td>
						<td><input type="text" name="stand_off['height'][]"></td>
						<td>Product #:</td>
						<td><input type="text" name="stand_off['product'][]"></td>
						<td>Product Name:</td>
						<td><input type="text" name="stand_off['product_name'][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="stand_off['notes'][]"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
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
					<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><input type="text" name="water_plate['thickness'][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="water_plate['notes'][]"></td>
						<td colspan="3"></td>
					</tr>
					<tr>
						<td colspan="10"><input type="button" class="button" value="+"></td>
					</tr>
					<tr>
						<th colspan="10"><b>Water Manifold Info</b></th>
					</tr>
					<<tr>
						<td colspan="3"></td>
						<td>Thickness:</td>
						<td><input type="text" name="water_manifold['thickness'][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="water_manifold['notes'][]"></td>
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
						<td>Assembnly Features</td>
						<td><b>TO BE CODED</b></td>
						<td>Thickness:</td>
						<td><input type="text" name="stripper_plate['thickness'][]"></td>
						<td>Product #:</td>
						<td><input type="text" name="stripper_plate['product'][]"></td>
						<td>Product Name:</td>
						<td><input type="text" name="stripper_plate['product_name'][]"></td>
						<td>Notes:</td>
						<td><input type="textarea" name="stripper_plate['notes'][]"></td>
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
						<td><input type="text" name="air_cylinder['bore'][]"></td>
						<td>Stroke:</td>
						<td><input type="text"  name="air_cylinder['stroke'][]"></td>
						<td>Vendor</td>
						<td><input type="text"  name="air_cylinder['vendor'][]"></td>
						<td>Part #:</td>
						<td><input type="text"  name="air_cylinder['part_no'][]"></td>
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
						<td><input type="textarea" name="air_bladder['notes'][]"></td>
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
							<td><input type="text"  name="air_cylinder_spacer['height'][]"></td>
							<td>Product #:</td>
							<td><input type="text"  name="air_cylinder_spacer['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text"  name="air_cylinder_spacer['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="air_cylinder_spacer['notes'][]"></td>
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
							<td><input type="text"  name="air_cylinder_rod['length'][]"></td>
							<td>Product #:</td>
							<td><input type="text"  name="air_cylinder_rod['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text"  name="air_cylinder_rod['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="air_cylinder_rod['notes'][]"></td>
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
							<td><input type="text" name="base_cavity['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="base_cavity['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="base_cavity['notes'][]"></td>
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
							<td><input type="text" name="lid_cavity['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="lid_cavity['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="lid_cavity['notes'][]"></td>
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
							<td><input type="text" name="hinge_insert['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="hinge_insert['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="hinge_insert['notes'][]"></td>
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
							<td><input type="text" name="lid_insert['product]'[]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="lid_insert['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="lid_insert['notes'][]"></td>
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
							<td><input type="text" name="base_insert['product'][]"></td>
							<td>Product Name:</td>
							<td><input type="text" name="base_insert['product_name'][]"></td>
							<td>Notes:</td>
							<td><input type="textarea" name="base_insert['notes'][]"></td>
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
							<td><input type="text" name="button_lock['dia'][]"></td>
							<td><label for="button_lock_male">Male:</label><input type="radio" name="button_lock['mf'][]" value="male" id="button_lock_male"></td>
							<td><label for="button_lock_female">Female:</label><input type="radio" name="button_lock['mf'][]" value="female" id="button_lock_female"></td>
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
			
			</div>
		</div>
	</div>