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
					<?php if ($pronostici) : ?>
					<!-- panel pronostici -->
					<div class="col-xs-12" style="margin-bottom:15px">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading1" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
							  <h4 class="panel-title">
								  <i class="fa fa-user"></i> Pronostici prossima giornata: <?= reset($pronostici)[0]->descr." (".convertDateTime(reset($pronostici)[0]->inizio).")" ?>
							  </h4>					  
							</div>
							<div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
							  <div class="panel-body">	
								<table class="table table-bordered table-condensed" style="margin-top:10px">
										<colgroup>
											<col width="180" />
											<?php foreach (reset($pronostici) as $key=>$val) : ?>
											<col width="100" />
											<?php endforeach ?>
										</colgroup>
										<thead>
											<tr>
												<th class="text-center" style="border-right:2px solid #000">PARTITA</th>
												<?php foreach (reset($pronostici) as $key=>$val) : ?>
												<th class="text-center"><?= strtoupper($val->id_user) ?></th>
												<?php endforeach ?>										
											</tr>
										</thead>	
										<tbody>	
											<?php foreach ($pronostici as $partita) : ?>
											<tr>
												<td class="text-center" style="border-right:2px solid #000"><?= reset($partita)->partita ?></td>
												<?php foreach ($partita as $val) : ?>
												<td class="text-center"><?= NULL == $val->pronostico ? "-" : $val->pronostico ?></td>
												<?php endforeach ?>
											</tr>
											
											<?php endforeach ?>
										</tbody>
									</table>							
							  </div>
							</div>
						</div>	
					</div>
					<?php endif ?>
					<?php if (isset($scores)) : ?>
					<!-- panel risultati -->
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading2" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" aria-controls="collapse2">
							  <h4 class="panel-title">
								  <i class="fa fa-user"></i> Risultati ultima giornata: <?= $giornata->descr." (".convertDateTime($giornata->inizio).")" ?>
							  </h4>					  
							</div>
							<div id="collapse2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading2">
							  <div class="panel-body">
							<div class="row">
								<div class="col-xs-12 text-right">
									<small>
										<strong>Punteggi: </strong>
										&nbsp;&nbsp;
										<span class="text-success">Punteggio azzeccato (5 punti)</span>
										&nbsp;&nbsp;
										<span class="text-info">Risultato azzeccato (3 punti)</span>
										&nbsp;&nbsp;	
										<span class="text-danger">Risultato sbagliato (0 punti)</span>										
									</small>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<table class="table table-bordered table-condensed" style="margin-top:10px" id="calendar_table">
										<colgroup>
											<col width="180" />
											<col width="150" />
											<?php foreach (array_keys(reset($scores)) as $user) : ?>
											<col width="100" />
											<?php endforeach ?>
										</colgroup>
										<thead>
											<tr>
												<th class="text-center">PARTITA</th>
												<th class="text-center" style="border-right:2px solid #000">RISULTATO</th>
												<?php foreach (array_keys(reset($scores)) as $user) : ?>
												<th class="text-center"><?= strtoupper($user) ?></th>
												<?php endforeach ?>										
											</tr>
										</thead>	
										<tbody>	
											<?php foreach ($scores as $key=>$score) : ?>
											<tr>
												<td class="text-center"><?= reset($score)[0]->partita ?></td>
												<td class="text-center" style="border-right:2px solid #000"><?= reset($score)[0]->risultato ?></td>
												<?php foreach (array_keys($score) as $user) : ?>
												<td class="text-center <?= $score[$user][0]->class ?>">
													<?= $score[$user][0]->pronostico ?>
												</td>
												<?php endforeach ?>
											</tr>
											<?php endforeach ?>
											<tr>
												<td class="border-top:2px solid #000"></td>
												<td class="text-right" style="border-right:2px solid #000;border-top:2px solid #000"><strong>PUNTEGGIO</strong></td>
												<?php foreach (array_keys($score) as $user) : ?>
												<td class="text-center" style="border-top:2px solid #000">
												<?php 
													$punteggio=0;
													foreach ($scores as $score) {
														$punteggio+=$score[$user][0]->punteggio;
													}
													echo $punteggio;
												?>
												</td>
												<?php endforeach ?>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
							</div>
						</div>							
					</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>
