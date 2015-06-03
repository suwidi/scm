

<div data-hveid="74">
	<h4 ><a> <?= $model['id'] .'&bull;'.$model['name']?></a>
	</h4><div>
	<div>

		<cite ><?= $model->lpse->name ?></cite>
			<div class="action-menu ab_ctl">
				<a >
					<span></span></a>
					<div >
						<ul> 
							<?php
							foreach ($model->lpseDetailProfiles as $profiles => $value) {
								?>
									<li class="action-menu-item ab_dropdownitem" role="menuitem">
										<?= $value['value'] ?>&nbsp;<small><i>
										(<?= $value['profile']->name ?>)</i></small></li>
								<?php
							}
							?>
						
						</ul>
					</div>
				</div>
			<span class="st">Informasi tambahan dan penutup</span></div>
		</div>
	</div>