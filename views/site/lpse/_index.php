<?php
	$html = '';
	foreach ($model->lpseDetailProfiles as $profiles => $value) {
		if ($value->profile_id == 8){
			$link = $value->value;
		}
		if (in_array($value->profile_id,array(1,7,4,11) )){		
			
			$html .= '<li style="padding-right:10px">'
							.$value->value."&nbsp;<small>
						</small>
					</li> ";
		}		
	}
	
?>
		<div class="col-xs-12">
            	<div class="content-search">
					<a href="javascript:void(0)" onclick="getDetil_tahap('<?= $link; ?>')">
					  <h5><?= $model->name ?> </h5>
					</a>
					<a href="javascript:void(0)" onclick="getWeb('<?= $model->lpse->link; ?>')">
					  <p><?= $model->lpse->name ?></p>
					</a>
					<ul class="list-inline list-desc" >
						<?php echo $html; ?>
                        
                        <li>
                        	<small>Status</small>
                        	<p>Selesai</p>
                        </li>
                        <li>
                        	<small>Nama Pengadaan</small>
                        	<p>UPPBJ Jakarta Selatan</p>
                        </li>
                        <li>
                        	<small>Anggaran</small>
                        	<p>860jt</p>
                        </li>
                        <li>
                        	<small>Expired</small>
                        	<p>21 - 27 Mei 2015</p>
                        </li>
					</ul>					
					<hr>
                </div>
    </div>
	<script>
		function getDetil_tahap(u){			
			myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}
		
		function getWeb(u){
				myWindow = window.open(u, "myWindow", "width=800, height=700, scrollbars=yes");
		}
	</script>
	