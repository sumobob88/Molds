<!doctype html>
<html>
<head>
	<title>YUI Plugin: gallery-node-accordion </title>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?3.2.0/build/cssfonts/fonts-min.css&3.2.0/build/cssreset/reset-min.css&3.2.0/build/cssbase/base-min.css">
	<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/gallery-2010.05.21-18-16/build/gallery-node-accordion/assets/skins/sam/gallery-node-accordion.css" />
	<style>
		/* module examples */
		div#demo {
				position:relative;
				width:22em;
				padding: 10px;
		}
		.yui3-accordion .yui3-accordion-item {
				text-align: left;
		}
				.yui3-accordion .yui3-accordion-item .yui3-accordion-item-bd {
					padding: 5px;
				}
	</style>
</head>
<body class="yui3-skin-sam">
	<div id="doc">

		<div id="demo">
			<div class="hd">
				<h3 class="title">Accordion using the default skin + Easing animation</h3>
				<p>More information about gallery-node-accordion here: <br /><a href="http://yuilibrary.com/gallery/show/node-accordion">http://yuilibrary.com/gallery/show/node-accordion</a></p>
			</div>
			<div class="bd">

				<div id="myaccordion" class="yui3-accordion">

						<div class="yui3-module yui3-accordion-item yui3-accordion-item-active first-of-type">
							
									<div class="yui3-hd yui3-accordion-item-hd">
										<a href="#" class="yui3-accordion-item-trigger">item 1</a>
						</div>
									<div class="yui3-bd yui3-accordion-item-bd">
										<p>
								item 1 content here...
									</p>
							</div>
						
					</div>
						<div class="yui3-module yui3-accordion-item">
							
									<div class="yui3-hd yui3-accordion-item-hd">
										<a href="#" class="yui3-accordion-item-trigger">item 2</a>
						</div>
									<div class="yui3-bd yui3-accordion-item-bd">
										<p>
								item 2 content here...
									</p>
							</div>
			
					</div>
					<div class="yui3-module yui3-accordion-item">
						
									<div class="yui3-hd yui3-accordion-item-hd">
										<a href="#" class="yui3-accordion-item-trigger">item 3</a>
						</div>
									<div class="yui3-bd yui3-accordion-item-bd">
										<p>
								item 3 content here...
									</p>
							</div>
			
					</div>
			
				</div>
					
			</div>
		</div>

	</div>

<!-- YUI 3 Seed //-->
<script type="text/javascript" src="http://yui.yahooapis.com/3.2.0/build/yui/yui-min.js"></script>
<!-- Initialization process //-->
<script type="text/javascript">
	YUI({
			//Last Gallery Build of this module
			gallery: 'gallery-2010.05.21-18-16'
	}).use('anim', 'gallery-node-accordion', function (Y) {
		
			Y.one("#myaccordion").plug(Y.Plugin.NodeAccordion, { 
			anim: Y.Easing.backIn
		});
		
	});
</script>
</body>
</html>
