<?php

	require 'config.php';
	
	$langs->load('searcheverywhere@searcheverywhere');
	
	llxHeader('', $langs->trans('Searcheverywhere'), '', '', 0, 0, array('/searcheverywhere/js/jquery.tile.min.js')  );

	?>
	<style type="text/css">
		#results {
			position:relative;
			
		}
		
		#results span.loading {
			padding : 20px;
			background-color: #f64f1c;
			border-radius: 10px;
			top:50px;
			left:50px;
			position:relative;
		}
		
		#results div.result {
			
			width:300px; 
			float:left;
			
			border-color: #bbb #aaa #aaa;
		    border-style: solid;
		    border-width: 1px;
		    box-shadow: 3px 3px 4px #ddd;
		    margin: 0 5px 14px;
		   
		   
			
		}
		.highlight {
			font-weight: bold;
		}
	</style>
	<div class="tabBar">
		<input type="text" name="keyword" id="keyword" value="" />
		<input type="button" name="btseach" id="btseach" value="Rechercher" />
		
		<div id="results">
			
		</div>
		<div style="clear:both"></div>
	</div>
	<script type="text/javascript">
	
		var TSearch = ['product','company','contact','propal','order','invoice','projet','task','event'];
	
		$(document).ready(function() {
			
			$("#btseach").click(function() {
				
				var keyword = $("#keyword").val();
				$('#results').html("<span class=\"loading\">Chargement...</span>");
				
				for(x in TSearch) {
					
					$.ajax({
						url : "./script/interface.php"
						,data :{
							get:'search'
							,type:TSearch[x]
							,keyword : keyword
						}
						
					}).done(function(data) {
						
						$('#results span.loading').remove();
						
						$div = $('<div class="result" />');
						$div.append(data);
						
						$('#results').append($div);
						
						$('#results div.result').tile();
						jQuery("#results div.result .classfortooltip").tipTip({maxWidth: "600px", edgeOffset: 10, delay: 50, fadeIn: 50, fadeOut: 50});
					})
					
					
				}
				
				
			});
			
			<?php
				if(GETPOST('keyword')!='') {
					?>
					$("#keyword").val("<?php echo GETPOST('keyword') ?>");
					$("#btseach").click();
					<?php
				}			
			
			?>
			
		});
	</script>


	<?php
	
	
	llxFooter();

