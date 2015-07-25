<?php
	$html = '';
	foreach ($model->lpseDetailProfiles as $profiles => $value) {
		if ($value->profile_id == 8){
			$link = $value->value;
		}
		if (in_array($value->profile_id,array(1,7,4,11) )){	
			$text = $value->value;
			if(strlen($text)> 40){
				$text = substr($text,0,10)." ..... ".substr($text,-15);
			}				
			$html .= '<li>
                        	<small>'.$value->profile->name.'</small>
                        	<p>'.$text.'</p>
                        </li>';
		}		
	}
	
?>
		<div class="col-xs-12">
            	<div class="content-search">
					<a href="<?= $link; ?>" target="_blank">
					  <h5><?= $model->name ?> </h5>
					</a>
					<a href="<?= $model->lpse->link;?>" target="_blank">
					  <p><?= $model->lpse->name ?></p>
					</a>
					<ul class="list-inline list-desc" >
              
						<?php echo $html; ?>
                        
					</ul>					
					<hr>
                </div>
    </div>
	<script>
		/*function getDetil_tahap(u){			
			myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}
		
		function getWeb(u){
				myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}*/
	</script>
	