$(function(){
	$('input[type="text"]').attr("size", 10);
	$('#hardware, #plates, #air_cylinders, #dies, #cavities, #aluminum, #inserts, #landl, #trim_punch, #plugplates, #fibro, #plugspacers, #top_plate, #ejectors, #dies, #punch').tabs();
$("#accordion").accordion({
		fillspace: true,
		header: "h3",
		autoHeight: false,
	});

var $button = $(".button").button();
$button.each(function(){
	$(this).click(function(){
		var $cell = $(this).parent();
		var $row = $cell.parent();
		var $input = $row.prev().clone(	);
		$row.before( $($input) );
	});
});
$(".form_tool").hide();
$(".pre_punch").hide();
$(".trim_tool").hide();
var $set = "";
$("#form_tool").click(function(){
	switch($set){
		case "":
			break;
		case "pre_punch":
			$(".pre_punch").hide();
			break;
		case "trim_tool":
			$(".trim_tool").hide();
			break;
	}
	$(".form_tool").show("blind");
	$("form").attr("action", "commit.php?action=add&type=form_tool");
	$set = "form_tool";
});
$("#pre_punch").click(function(){
	switch($set){
		case "":
			break;
		case "form_tool":
			$(".form_tool").hide();
			break;
		case "trim_tool":
			$(".trim_tool").hide();
			break;
	}
	$(".pre_punch").show("blind");
	$("form").attr("action", "commit.php?action=add&type=pre_punch");
	$set = "pre_punch";
});
$("#trim_tool").click(function(){
	switch($set){
		case "":
			break;
		case "form_tool":
			$(".form_tool").hide();
			break;
		case "pre_punch":
			$(".pre_punch").hide();
			break;
	}
	$(".trim_tool").show("blind");
	$("form").attr("action", "commit.php?action=add&type=trim_tool");
	$set = "trim_tool";
});
});