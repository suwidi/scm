<?php
	$html = '';
	foreach ($model->lpseDetailProfiles as $profiles => $value) {
		if ($value['profile_id']  == 8){
			$link = $value['value'];
		}
		// echo "<pre>";
		// print_R($value);die;
		// 1,
		if ($value['profile_id'] == 1 OR $value['profile_id'] == 7 OR $value['profile_id'] == 4){		
			
			$html .= '<li style="padding-right:10px">'
							.$value['value']."&nbsp;<small>
						</small>
					</li> ";
		}		
	}
	
?>
		<div class="col-xs-12">
            	<div class="content-search">
					<a href="javascript:void(0)" onclick="getDetil_tahap('<?php echo $link; ?>')">
					  <h5><?= $model['name'] ?> </h5>
					</a>
					<a href="javascript:void(0)" onclick="getWeb('<?php echo $model->lpse['link']; ?>')">
					  <p><?= $model->lpse['link'] ?></p>
					</a>
					<ul class="list-inline" >
						<?php echo $html; ?>
					</ul>
					
					<hr>
                </div>
    </div>
	<script>
		function getDetil_tahap(u){			
			// var url = u.replace('view', 'tahap');
			myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}
		
		function getWeb(u){
				myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}
	</script>
	