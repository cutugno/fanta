<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
			<!--
			<ol class="breadcrumb">
			  <li><i class="fa fa-home"></i><a href="<?= base_url() ?>"> Home</a></li>
			  <li><i class="fa fa-laptop"></i> Dashboard</li>
			</ol>
			-->
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="row">
					<div class="col-sm-6" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading1" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
							  <h4 class="panel-title">
								  <i class="fa fa-user"></i> Profilo
							  </h4>					  
							</div>
							<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
							  <div class="panel-body">
								  <?php //var_dump ($user) ?>
								  <div class="media">
									  <div class="media-left">
										<a href="#">
										  <img class="media-object" src="<?= site_url($user['info']->avatar) ?>" alt="Avatar <?=$user['info']->username ?>">
										</a>
									  </div>
									  <div class="media-body">
										<h4 class="media-heading"><?=$user['info']->username ?></h4>
											<?= $user['standings']->punti ?> punti (<?= $user['position'] ?>° in classifica)
									  </div>
								  </div>
							  </div>
							</div>
						</div>						
					</div>
					<div class="col-sm-6" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading2" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
							  <h4 class="panel-title">
								  <i class="fa fa-calendar"></i> Ultima giornata
							  </h4>					  
							</div>
							<div id="collapse3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading2">
							  <div class="panel-body">
								   <?php var_dump($ultima) ?>
							  </div>
							</div>
						</div>						
					</div>
					<div class="col-sm-6" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading4" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
							  <h4 class="panel-title">
								  <i class="fa fa-calendar-o"></i> Prossima giornata
							  </h4>					  
							</div>
							<div id="collapse3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading4">
							  <div class="panel-body">
								  <?php var_dump ($prossima) ?>
							  </div>
							</div>
						</div>						
					</div>
					<div class="col-sm-6" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading3" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" aria-controls="collapse3">
							  <h4 class="panel-title">
								  <span class="glyphicon glyphicon-signal" aria-hidden="true"></span> Classifica
							  </h4>					  
							</div>
							<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading3">
							  <div class="panel-body">
								<?php var_dump ($standings) ?>
							  </div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
